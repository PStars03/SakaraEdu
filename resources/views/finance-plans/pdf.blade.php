<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rencana Keuangan Beasiswa - {{ $plan->title }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #334155; background: #fff; }
        
        .header { background: linear-gradient(135deg, #005F9E 0%, #172B5F 100%); color: white; padding: 28px 32px; border-radius: 0 0 16px 16px; margin-bottom: 28px; }
        .header-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
        .logo-text { font-size: 22px; font-weight: bold; letter-spacing: 1px; }
        .logo-sub { font-size: 11px; color: rgba(255,255,255,0.7); }
        .header-title { font-size: 18px; font-weight: bold; margin-bottom: 4px; }
        .header-sub { font-size: 11px; color: rgba(255,255,255,0.8); }
        
        .section { margin: 0 32px 20px; }
        
        .info-grid { display: flex; gap: 20px; margin-bottom: 24px; }
        .info-box { flex: 1; background: #F8FBFF; border: 1px solid #E2E8F0; border-radius: 10px; padding: 14px; }
        .info-box .label { font-size: 10px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .info-box .value { font-size: 14px; font-weight: bold; color: #172B5F; }
        .info-box .sub { font-size: 10px; color: #64748b; margin-top: 2px; }
        
        .amount-box { background: #005F9E; border-radius: 10px; padding: 16px 20px; margin-bottom: 20px; color: white; text-align: center; }
        .amount-label { font-size: 11px; color: rgba(255,255,255,0.8); margin-bottom: 6px; }
        .amount-value { font-size: 28px; font-weight: bold; }
        .amount-sub { font-size: 10px; color: rgba(255,255,255,0.7); margin-top: 4px; }
        
        .section-title { font-size: 13px; font-weight: bold; color: #172B5F; padding: 10px 0; border-bottom: 2px solid #E2E8F0; margin-bottom: 12px; }
        
        .allocation-row { display: flex; align-items: center; padding: 10px 14px; border-radius: 8px; margin-bottom: 8px; }
        .allocation-row.alt { background: #F8FBFF; }
        .allocation-color { width: 12px; height: 12px; border-radius: 3px; margin-right: 10px; flex-shrink: 0; }
        .allocation-name { flex: 1; font-size: 12px; font-weight: 600; color: #334155; }
        .allocation-sub { font-size: 10px; color: #94a3b8; font-weight: normal; margin-top: 1px; }
        .allocation-amount { font-size: 13px; font-weight: bold; color: #172B5F; text-align: right; }
        .allocation-pct { font-size: 10px; color: #94a3b8; text-align: right; }
        
        .total-row { background: linear-gradient(135deg, #005F9E 0%, #172B5F 100%); border-radius: 10px; padding: 14px 18px; margin-top: 12px; display: flex; align-items: center; justify-content: space-between; color: white; }
        .total-label { font-size: 13px; font-weight: bold; }
        .total-amount { font-size: 18px; font-weight: bold; }
        
        .badge-row { display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap; }
        .badge { padding: 4px 10px; border-radius: 20px; font-size: 10px; font-weight: 600; }
        .badge-blue { background: #EFF6FF; color: #005F9E; border: 1px solid #BFDBFE; }
        .badge-purple { background: #F5F3FF; color: #7C3AED; border: 1px solid #DDD6FE; }
        
        .footer { margin: 24px 32px 0; padding-top: 16px; border-top: 1px solid #E2E8F0; display: flex; justify-content: space-between; align-items: center; }
        .footer-left { font-size: 10px; color: #94a3b8; }
        .footer-right { font-size: 10px; color: #94a3b8; }
        
        .note { background: #FFF7ED; border: 1px solid #FED7AA; border-radius: 8px; padding: 10px 14px; margin-top: 16px; }
        .note p { font-size: 10px; color: #C2410C; }
        .note strong { font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <div class="header-top">
            <div>
                <div class="logo-text">SakaraEdu</div>
                <div class="logo-sub">Platform Edukasi & Beasiswa Indonesia</div>
            </div>
            <div style="text-align: right;">
                <div class="logo-sub">Dicetak: {{ now()->format('d M Y, H:i') }}</div>
            </div>
        </div>
        <div class="header-title">Rencana Alokasi Dana Beasiswa</div>
        <div class="header-sub">{{ $plan->title }} — {{ auth()->user()->name }}</div>
    </div>

    <div class="section">

        {{-- Badges --}}
        <div class="badge-row">
            @if($plan->uses_transport)
                <span class="badge badge-blue">🚌 Menggunakan Transport: Rp {{ number_format($plan->transport_cost, 0, ',', '.') }}/hari</span>
            @endif
            @if($plan->uses_rent)
                <span class="badge badge-purple">🏠 Menggunakan Kos: Rp {{ number_format($plan->rent_cost, 0, ',', '.') }}/bulan</span>
            @endif
        </div>

        {{-- Info Grid --}}
        <div class="info-grid">
            <div class="info-box">
                <div class="label">Nama Pemilik</div>
                <div class="value">{{ auth()->user()->name }}</div>
            </div>
            <div class="info-box">
                <div class="label">Durasi Semester</div>
                <div class="value">6 Bulan</div>
                <div class="sub">180 hari</div>
            </div>
            <div class="info-box">
                <div class="label">Tanggal Dibuat</div>
                <div class="value">{{ $plan->created_at->format('d M Y') }}</div>
            </div>
        </div>

        {{-- Total Beasiswa --}}
        <div class="amount-box">
            <div class="amount-label">Total Dana Beasiswa</div>
            <div class="amount-value">Rp {{ number_format($amount, 0, ',', '.') }}</div>
            <div class="amount-sub">≈ Rp {{ number_format($amount / 6, 0, ',', '.') }} / bulan &nbsp;|&nbsp; ≈ Rp {{ number_format($amount / 180, 0, ',', '.') }} / hari</div>
        </div>

        {{-- Allocation Details --}}
        <div class="section-title">Rincian Alokasi per Semester</div>

        @if($plan->uses_rent && $rentTotal > 0)
        <div class="allocation-row alt">
            <div class="allocation-color" style="background: #7C3AED;"></div>
            <div style="flex: 1;">
                <div class="allocation-name">Biaya Kos / Tempat Tinggal</div>
                <div class="allocation-sub">Rp {{ number_format($plan->rent_cost, 0, ',', '.') }} / bulan</div>
            </div>
            <div>
                <div class="allocation-amount">Rp {{ number_format($rentTotal, 0, ',', '.') }}</div>
            </div>
        </div>
        @endif

        <div class="allocation-row">
            <div class="allocation-color" style="background: #F97316;"></div>
            <div style="flex: 1;">
                <div class="allocation-name">Uang Makan</div>
                <div class="allocation-sub">≈ Rp {{ number_format($foodAmount / 180, 0, ',', '.') }} / hari &nbsp;|&nbsp; ≈ Rp {{ number_format($foodAmount / 6, 0, ',', '.') }} / bulan</div>
            </div>
            <div>
                <div class="allocation-amount">Rp {{ number_format($foodAmount, 0, ',', '.') }}</div>
            </div>
        </div>

        @if($plan->uses_transport && $transportTotal > 0)
        <div class="allocation-row alt">
            <div class="allocation-color" style="background: #12A8E8;"></div>
            <div style="flex: 1;">
                <div class="allocation-name">Uang Transport</div>
                <div class="allocation-sub">Rp {{ number_format($plan->transport_cost, 0, ',', '.') }} / hari</div>
            </div>
            <div>
                <div class="allocation-amount">Rp {{ number_format($transportTotal, 0, ',', '.') }}</div>
            </div>
        </div>
        @endif

        <div class="allocation-row">
            <div class="allocation-color" style="background: #7ACB00;"></div>
            <div style="flex: 1;">
                <div class="allocation-name">Tabungan / Investasi</div>
                <div class="allocation-sub">≈ Rp {{ number_format($savingAmount / 6, 0, ',', '.') }} / bulan</div>
            </div>
            <div>
                <div class="allocation-amount" style="color: #057A2E;">Rp {{ number_format($savingAmount, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="allocation-row alt">
            <div class="allocation-color" style="background: #F59E0B;"></div>
            <div style="flex: 1;">
                <div class="allocation-name">Lain-lain / Dana Darurat</div>
                <div class="allocation-sub">≈ Rp {{ number_format($otherAmount / 6, 0, ',', '.') }} / bulan</div>
            </div>
            <div>
                <div class="allocation-amount">Rp {{ number_format($otherAmount, 0, ',', '.') }}</div>
            </div>
        </div>

        {{-- Total --}}
        <div class="total-row">
            <div class="total-label">Total Keseluruhan</div>
            <div class="total-amount">Rp {{ number_format($amount, 0, ',', '.') }}</div>
        </div>

        <div class="note">
            <p><strong>⚠️ Catatan:</strong> Rencana ini adalah estimasi berdasarkan persentase alokasi yang kamu pilih. Sesuaikan dengan kondisi dan kebutuhan nyata kamu.</p>
        </div>

    </div>

    <div class="footer">
        <div class="footer-left">SakaraEdu — Wujudkan Impendidikanmu 🎓</div>
        <div class="footer-right">sakaraedu.com</div>
    </div>

</body>
</html>
