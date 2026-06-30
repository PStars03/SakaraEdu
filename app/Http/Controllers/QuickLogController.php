<?php

namespace App\Http\Controllers;

use App\Models\DailyTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuickLogController extends Controller
{
    /**
     * Store transaction from natural language input via Groq AI.
     */
    public function store(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:500',
        ]);

        $prompt = $request->input('prompt');
        $apiKey = config('services.groq.api_key');

        if (! $apiKey) {
            return back()->with('error', 'GROQ_API_KEY belum dikonfigurasi di .env.');
        }

        try {
            // Setup Groq API Request
            $systemPrompt = "You are a transaction parser. Parse the user's natural language input into a JSON object with a single key 'transactions' containing an array of transactions. "
                . "Each transaction object must have exactly 3 keys: "
                . "'type' (string, either 'masuk' or 'keluar'), "
                . "'amount' (number, extract the numeric value, e.g. 15rb = 15000), "
                . "'category' (string, a short category name like 'Konsumsi', 'Transportasi', 'Hiburan', 'Gaji', dll). "
                . "ONLY output the JSON object. Example: {\"transactions\": [{\"type\":\"keluar\",\"amount\":18000,\"category\":\"Konsumsi\"}]}";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type'  => 'application/json',
            ])->timeout(15)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.1-8b-instant',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.1,
                'response_format' => ['type' => 'json_object'],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $content = $data['choices'][0]['message']['content'] ?? null;

                // Groq response format for json_object requires the output to be a JSON object, not an array directly.
                // So let's adjust the parsing logic in case it wraps it in an object like { "transactions": [...] }
                $parsed = json_decode($content, true);

                if (is_array($parsed)) {
                    $transactions = isset($parsed['transactions']) ? $parsed['transactions'] : $parsed;

                    // If it's still not a list of transactions, check if it returned a single object
                    if (isset($transactions['type'])) {
                        $transactions = [$transactions];
                    }

                    $savedCount = 0;
                    foreach ($transactions as $t) {
                        if (isset($t['type']) && isset($t['amount'])) {
                            DailyTransaction::create([
                                'user_id'          => auth()->id(),
                                'transaction_type' => in_array(strtolower($t['type']), ['masuk', 'keluar']) ? strtolower($t['type']) : 'keluar',
                                'amount'           => (float) $t['amount'],
                                'category'         => $t['category'] ?? 'Lainnya',
                                'description'      => $prompt, // Save the original prompt as description
                            ]);
                            $savedCount++;
                        }
                    }

                    if ($savedCount > 0) {
                        return back()->with('success', "QuickLog AI berhasil mencatat {$savedCount} transaksi.");
                    } else {
                        return back()->with('error', 'AI tidak dapat mendeteksi transaksi dari kalimat tersebut.');
                    }
                }

                logger()->error("QuickLog Groq Parsing Error: Content was not valid JSON. Content: " . $content);
                return back()->with('error', 'Gagal memparsing respons dari Groq AI.');
            }

            logger()->error("QuickLog Groq API Error: " . $response->status() . " - " . $response->body());
            return back()->with('error', 'Gagal menghubungi Groq API. Periksa API Key dan limit.');

        } catch (\Throwable $e) {
            logger()->error("QuickLog Groq Exception: " . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan sistem saat memproses QuickLog AI.');
        }
    }
}
