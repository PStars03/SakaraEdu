<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Financial Advisor — {{ $planner->major }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; color: #334155; background: #fff; }

        .header { background: linear-gradient(135deg, #172B5F, #005F9E); color: white; padding: 24px 32px; margin-bottom: 24px; }
        .header h1 { font-size: 20px; font-weight: bold; margin-bottom: 4px; }
        .header p { font-size: 11px; opacity: 0.75; }
        .header .badge { display: inline-block; margin-top: 10px; padding: 4px 12px; border-radius: 8px; font-size: 11px; font-weight: bold; }
        .badge-surplus { background: rgba(74, 222, 128, 0.2); border: 1px solid rgba(74, 222, 128, 0.4); color: #86efac; }
        .badge-deficit { background: rgba(248, 113, 113, 0.2); border: 1px solid rgba(248, 113, 113, 0.4); color: #fca5a5; }

        .content { padding: 0 32px 32px; }

        .section-title { font-size: 12px; font-weight: bold; color: #172B5F; margin-bottom: 12px; padding-bottom: 6px; border-bottom: 2px solid #005F9E; text-transform: uppercase; letter-spacing: 0.05em; }

        .grid { display: table; width: 100%; margin-bottom: 20px; }
        .col-left { display: table-cell; width: 38%; vertical-align: top; padding-right: 16px; }
        .col-right { display: table-cell; width: 62%; vertical-align: top; }

        .card { background: #F8FBFF; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; margin-bottom: 12px; }
        .row { display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid #f1f5f9; }
        .row:last-child { border-bottom: none; }
        .row .label { color: #64748b; }
        .row .value { font-weight: bold; color: #1e293b; }
        .total-row { background: #172B5F; color: white; border-radius: 8px; padding: 10px 12px; margin-top: 10px; display: flex; justify-content: space-between; }

        .surplus-card { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 10px 12px; margin-top: 8px; }
        .deficit-card { background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 10px 12px; margin-top: 8px; }

        .ai-response { line-height: 1.7; }
        .ai-response h1, .ai-response h2, .ai-response h3 { font-size: 12px; font-weight: bold; color: #172B5F; margin: 12px 0 6px; }
        .ai-response p { margin-bottom: 8px; color: #475569; }
        .ai-response ul, .ai-response ol { padding-left: 16px; margin-bottom: 8px; }
        .ai-response li { margin-bottom: 4px; color: #475569; }
        .ai-response strong { color: #1e293b; }

        .footer { margin-top: 24px; padding-top: 12px; border-top: 1px solid #e2e8f0; text-align: center; font-size: 9px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="header">
        <h1>AI Student Financial Advisor</h1>
        <p>SakaraEdu — Analisis Keuangan Semester</p>
        <div>
            <span class="{{ $planner->isSurplus() ? 'badge badge-surplus' : 'badge badge-deficit' }}">
                {{ $planner->surplusDeficitLabel }}
            </span>
        </div>
    </div>

    <div class="content">

        <div class="grid">
            {{-- Left: Kalkulasi --}}
            <div class="col-left">
                <div class="section-title">Rincian Kalkulasi</div>

                <div class="card">
                    <div class="row">
                        <span class="label">Program Studi</span>
                        <span class="value" style="font-size:10px">{{ $planner->major }}</span>
                    </div>
                    <div class="row">
                        <span class="label">Tanggal Analisis</span>
                        <span class="value">{{ $planner->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>

                <div class="card">
                    <div class="row">
                        <span class="label">Biaya UKT/SPP</span>
                        <span class="value">Rp {{ number_format($planner->ukt_fee, 0, ',', '.') }}</span>
                    </div>
                    @if($planner->monthly_rent)
                    <div class="row">
                        <span class="label">Kos/Sewa (6 bln)</span>
                        <span class="value">Rp {{ number_format($planner->monthly_rent * 6, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div class="row">
                        <span class="label">Konsumsi (6 bln)</span>
                        <span class="value">Rp {{ number_format($planner->monthly_consumption * 6, 0, ',', '.') }}</span>
                    </div>
                    @if($planner->monthly_transport)
                    <div class="row">
                        <span class="label">Transport (180 hr)</span>
                        <span class="value">Rp {{ number_format($planner->monthly_transport * 180, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    <div class="total-row">
                        <span>Total Pengeluaran</span>
                        <span>Rp {{ number_format($planner->total_expense, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="card">
                    <div class="row">
                        <span class="label">Dana Tersedia</span>
                        <span class="value" style="color:#005F9E">Rp {{ number_format($planner->self_fund, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="{{ $planner->isSurplus() ? 'surplus-card' : 'deficit-card' }}">
                    <div style="display:flex; justify-content:space-between; font-weight:bold; color:{{ $planner->isSurplus() ? '#15803d' : '#dc2626' }}">
                        <span>{{ $planner->isSurplus() ? 'Surplus' : 'Defisit' }}</span>
                        <span>Rp {{ number_format(abs($planner->surplus_deficit), 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Right: AI Response --}}
            <div class="col-right">
                <div class="section-title">Analisis & Saran AI SakaraEdu</div>

                @if($planner->ai_response_text)
                    <div class="ai-response">
                        {!! \Illuminate\Support\Str::markdown($planner->ai_response_text) !!}
                    </div>
                @else
                    <p style="color:#94a3b8; font-style:italic">Analisis AI tidak tersedia untuk riwayat ini.</p>
                @endif
            </div>
        </div>

        <div class="footer">
            Dokumen ini dibuat oleh SakaraEdu AI Financial Advisor • {{ now()->format('d F Y H:i') }} • Hanya untuk referensi edukatif
        </div>
    </div>
</body>
</html>
