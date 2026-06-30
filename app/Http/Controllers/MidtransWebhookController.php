<?php

namespace App\Http\Controllers;

use App\Models\BootcampRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransWebhookController extends Controller
{
    /**
     * Handle incoming webhook from Midtrans.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request)
    {
        try {
            $serverKey = config('midtrans.server_key');
            $signatureKey = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
            
            // 1. Validasi Signature
            if ($signatureKey !== $request->signature_key) {
                Log::warning("Midtrans Webhook: Invalid signature key for Order ID {$request->order_id}");
                return response()->json(['message' => 'Invalid signature key'], 403);
            }

            $transaction = BootcampRegistration::with(['bootcamp.creator'])->where('order_id', $request->order_id)->first();
            
            if (!$transaction) {
                Log::warning("Midtrans Webhook: Transaction not found for Order ID {$request->order_id}");
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            // Hindari pemrosesan ganda
            if ($transaction->status === 'success' && $transaction->payout_status !== null) {
                return response()->json(['message' => 'Transaction already processed']);
            }

            $status = $request->transaction_status;

            // 2. Update Status Transaksi
            if (in_array($status, ['capture', 'settlement'])) {
                $transaction->update(['status' => 'success']);
                
                // 3. Eksekusi Auto-Disbursement jika bootcamp berbayar
                if ($transaction->amount > 0) {
                    $this->processPayout($transaction);
                }
                
            } elseif (in_array($status, ['expire', 'cancel', 'deny'])) {
                $transaction->update(['status' => 'failed']);
            } elseif ($status === 'pending') {
                $transaction->update(['status' => 'pending']);
            }

            return response()->json(['message' => 'Webhook processed successfully']);

        } catch (\Exception $e) {
            Log::error("Midtrans Webhook Error: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Proses Split Payment & Payout menggunakan Midtrans Iris.
     *
     * @param BootcampRegistration $transaction
     * @return void
     */
    private function processPayout(BootcampRegistration $transaction)
    {
        $creator = $transaction->bootcamp->creator;

        // Cek apakah admin instansi memiliki data rekening
        if (!$creator || !$creator->bank_name || !$creator->bank_account_number) {
            Log::error("Midtrans Iris: Creator of bootcamp {$transaction->bootcamp_id} does not have valid bank info.");
            $transaction->update(['payout_status' => 'failed', 'payout_info' => ['error' => 'Bank info missing']]);
            return;
        }

        // Kalkulasi 95% untuk instansi (Creator), 5% untuk Platform (SakaraEdu)
        $grossAmount = (float) $transaction->amount;
        $payoutAmount = floor($grossAmount * 0.95);

        // Jika jumlah payout di bawah batas minimum transfer antar bank (umumnya Rp 10.000)
        if ($payoutAmount < 10000) {
            Log::warning("Midtrans Iris: Payout amount too small (Rp {$payoutAmount}) for order {$transaction->order_id}");
            $transaction->update(['payout_status' => 'failed', 'payout_info' => ['error' => 'Amount too small']]);
            return;
        }

        $irisCreatorKey = config('midtrans.iris_creator_key');
        $isProduction = config('midtrans.is_production');
        $irisUrl = $isProduction 
            ? 'https://app.midtrans.com/iris/api/v1/payouts' 
            : 'https://app.sandbox.midtrans.com/iris/api/v1/payouts';

        // Hit API Midtrans Iris
        try {
            $response = Http::withBasicAuth($irisCreatorKey, '')
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->post($irisUrl, [
                    'payouts' => [
                        [
                            'beneficiary_name' => substr($creator->name, 0, 50),
                            'beneficiary_account' => $creator->bank_account_number,
                            'beneficiary_bank' => strtolower($creator->bank_name),
                            'beneficiary_email' => $creator->email,
                            'amount' => strval($payoutAmount),
                            'notes' => 'Payout Bootcamp: ' . substr($transaction->bootcamp->title, 0, 50),
                        ]
                    ]
                ]);

            if ($response->successful()) {
                Log::info("Midtrans Iris Payout Success for order {$transaction->order_id}", $response->json());
                $transaction->update([
                    'payout_status' => 'success',
                    'payout_info' => $response->json()
                ]);
            } else {
                Log::error("Midtrans Iris Payout Failed for order {$transaction->order_id}", [
                    'status' => $response->status(),
                    'response' => $response->json()
                ]);
                $transaction->update([
                    'payout_status' => 'failed',
                    'payout_info' => $response->json()
                ]);
            }
        } catch (\Exception $e) {
            Log::error("Midtrans Iris API Error: " . $e->getMessage());
            $transaction->update([
                'payout_status' => 'failed',
                'payout_info' => ['exception' => $e->getMessage()]
            ]);
        }
    }
}
