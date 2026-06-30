<?php

namespace App\Http\Controllers;

use App\Models\AiSemesterPlanner;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiAdvisorController extends Controller
{
    public function index()
    {
        $planners = auth()->user()->aiSemesterPlanners()->latest()->get();

        return view('ai-advisor.index', compact('planners'));
    }

    public function create()
    {
        return view('ai-advisor.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'major'               => 'required|string|max:100',
            'ukt_fee'             => 'required|numeric|min:0',
            'monthly_rent'        => 'nullable|numeric|min:0',
            'monthly_consumption' => 'required|numeric|min:0',
            'monthly_transport'   => 'nullable|numeric|min:0',
            'self_fund'           => 'required|numeric|min:0',
        ]);

        // FR-B2: Calculate total expense
        $ukt          = (float) $validated['ukt_fee'];
        $rent         = (float) ($validated['monthly_rent'] ?? 0);
        $consumption  = (float) $validated['monthly_consumption'];
        $transport    = (float) ($validated['monthly_transport'] ?? 0);
        $selfFund     = (float) $validated['self_fund'];

        $totalExpense    = $ukt + ($rent * 6) + ($consumption * 6) + ($transport * 180);
        $surplusDeficit  = $selfFund - $totalExpense;

        // FR-B3: Build AI prompt
        $statusLabel = $surplusDeficit >= 0
            ? 'surplus sebesar Rp ' . number_format($surplusDeficit, 0, ',', '.')
            : 'defisit sebesar Rp ' . number_format(abs($surplusDeficit), 0, ',', '.');

        $prompt = "Berikan analisis keuangan terstruktur untuk mahasiswa jurusan {$validated['major']} "
            . "dengan total kebutuhan satu semester sebesar Rp " . number_format($totalExpense, 0, ',', '.') . " "
            . "dan mengalami {$statusLabel}. "
            . "Berikan dalam format Markdown yang rapi:\n"
            . "1. **Ringkasan Kondisi Keuangan** — evaluasi singkat situasi finansial\n"
            . "2. **3 Tips Efisiensi Anggaran** — tips spesifik dan praktis\n"
            . "3. **Rekomendasi Bantuan Kampus** — beasiswa, bantuan UKT, program kampus\n"
            . "4. **2 Peluang Kerja Paruh Waktu** — yang sesuai dengan jurusan {$validated['major']}\n"
            . "Gunakan bahasa Indonesia yang jelas dan ramah Gen-Z.";

        // Call Gemini API
        $aiResponse = $this->callGeminiApi($prompt);

        // Save to database
        $planner = auth()->user()->aiSemesterPlanners()->create([
            'major'               => $validated['major'],
            'ukt_fee'             => $ukt,
            'monthly_rent'        => $rent > 0 ? $rent : null,
            'monthly_consumption' => $consumption,
            'monthly_transport'   => $transport > 0 ? $transport : null,
            'self_fund'           => $selfFund,
            'total_expense'       => $totalExpense,
            'surplus_deficit'     => $surplusDeficit,
            'ai_response_text'    => $aiResponse,
        ]);

        return redirect()->route('ai-advisor.show', $planner->id)
            ->with('success', 'Analisis AI berhasil dibuat!');
    }

    public function show($id)
    {
        $planner = auth()->user()->aiSemesterPlanners()->findOrFail($id);

        return view('ai-advisor.show', compact('planner'));
    }

    /**
     * Retry AI generation for an existing planner record.
     */
    public function regenerate($id)
    {
        $planner = auth()->user()->aiSemesterPlanners()->findOrFail($id);

        $statusLabel = (float) $planner->surplus_deficit >= 0
            ? 'surplus sebesar Rp ' . number_format($planner->surplus_deficit, 0, ',', '.')
            : 'defisit sebesar Rp ' . number_format(abs($planner->surplus_deficit), 0, ',', '.');

        $prompt = "Berikan analisis keuangan terstruktur untuk mahasiswa jurusan {$planner->major} "
            . "dengan total kebutuhan satu semester sebesar Rp " . number_format($planner->total_expense, 0, ',', '.') . " "
            . "dan mengalami {$statusLabel}. "
            . "Berikan dalam format Markdown yang rapi:\n"
            . "1. **Ringkasan Kondisi Keuangan** — evaluasi singkat situasi finansial\n"
            . "2. **3 Tips Efisiensi Anggaran** — tips spesifik dan praktis\n"
            . "3. **Rekomendasi Bantuan Kampus** — beasiswa, bantuan UKT, program kampus\n"
            . "4. **2 Peluang Kerja Paruh Waktu** — yang sesuai dengan jurusan {$planner->major}\n"
            . "Gunakan bahasa Indonesia yang jelas dan ramah Gen-Z.";

        $aiResponse = $this->callGeminiApi($prompt);

        if ($aiResponse) {
            $planner->update(['ai_response_text' => $aiResponse]);
            return redirect()->route('ai-advisor.show', $id)
                ->with('success', 'Analisis AI berhasil diperbarui!');
        }

        return redirect()->route('ai-advisor.show', $id)
            ->with('error', 'Gagal mendapatkan respons dari server AI. Silakan coba beberapa saat lagi.');
    }

    public function destroy($id)
    {
        $planner = auth()->user()->aiSemesterPlanners()->findOrFail($id);
        $planner->delete();

        return redirect()->route('ai-advisor.index')
            ->with('success', 'Riwayat analisis berhasil dihapus.');
    }

    public function exportPdf($id)
    {
        $planner = auth()->user()->aiSemesterPlanners()->findOrFail($id);

        $pdf = Pdf::loadView('ai-advisor.pdf', compact('planner'))
            ->setPaper('a4', 'portrait');

        $filename = 'ai-advisor-' . str_replace(' ', '-', strtolower($planner->major)) . '-' . $planner->id . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Call Free Text AI API (Pollinations.ai)
     * This API is completely free and requires no API key.
     * Uses OpenAI/Mistral models in the background.
     */
    private function callGeminiApi(string $prompt): ?string
    {
        try {
            $response = Http::timeout(45)->post('https://text.pollinations.ai/', [
                'messages' => [
                    [
                        'role' => 'system', 
                        'content' => 'Kamu adalah AI Financial Advisor SakaraEdu yang ramah, profesional, dan menggunakan bahasa Indonesia gaya Gen-Z. Berikan saran keuangan yang praktis dan masuk akal.'
                    ],
                    [
                        'role' => 'user', 
                        'content' => $prompt
                    ]
                ],
                'model' => 'openai' // Uses GPT-4o-mini or similar free model via Pollinations
            ]);

            if ($response->successful()) {
                $text = $response->body();
                if ($text) {
                    logger()->info("Pollinations AI success");
                    return $text;
                }
            }

            logger()->error("Pollinations API error: " . $response->status() . ' — ' . $response->body());

        } catch (\Throwable $e) {
            logger()->error("Pollinations API exception: " . $e->getMessage());
        }

        return null;
    }
}
