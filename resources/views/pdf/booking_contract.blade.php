<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 0; size: a4 portrait; }
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; width: 100%; height: 100%; font-family: 'Times-Roman', serif; font-size: 11pt; color: #1a1a1a; }
        
        /* Aksen Bar Atas - Slate Gold */
        .gold-bar { background: #B59461; height: 12pt; width: 100%; position: absolute; top: 0; left: 0; }
        
        /* Watermark Identitas */
        .watermark { position: absolute; top: 40%; left: 10%; transform: rotate(-45deg); font-size: 50pt; color: rgba(181, 148, 97, 0.04); z-index: -1; font-weight: bold; white-space: nowrap; text-transform: uppercase; }
        
        .container { padding: 50pt 60pt; position: relative; }
        
        .logo-container { text-align: center; margin-bottom: 25pt; }
        
        .header-title { text-align: center; border-bottom: 0.5pt solid #eaeaea; padding-bottom: 15pt; margin-bottom: 25pt; }
        .subtitle { color: #B59461; font-size: 8pt; letter-spacing: 5pt; text-transform: uppercase; font-weight: bold; }
        .main-title { font-size: 28pt; color: #0F172A; margin: 8pt 0; font-style: italic; letter-spacing: -1pt; }
        
        /* Label Seksi Bergaris Kiri */
        .section-label { color: #B59461; font-size: 8pt; letter-spacing: 2pt; text-transform: uppercase; margin-top: 25pt; font-weight: bold; border-left: 2.5pt solid #B59461; padding-left: 10pt; margin-bottom: 10pt; }
        
        /* Grid Data Bersih */
        .data-grid { width: 100%; border-collapse: collapse; }
        .data-grid td { padding: 8pt 0; vertical-align: top; border-bottom: 0.1pt solid #f1f1f1; }
        .label { font-size: 8.5pt; color: #888; text-transform: uppercase; width: 35%; letter-spacing: 0.5pt; }
        .value { font-size: 10.5pt; color: #0F172A; font-weight: bold; }
        
        /* Box Informasi Legal */
        .warning-box { margin-top: 30pt; background: #fafaf9; border: 0.5pt solid #e5e7eb; padding: 15pt; }
        .warning-title { font-size: 8.5pt; color: #B59461; font-weight: bold; text-transform: uppercase; margin-bottom: 5pt; }
        .warning-text { font-size: 8.5pt; color: #64748b; text-align: justify; line-height: 1.5; }
        
        .footer-policy { margin-top: 25pt; font-size: 8pt; color: #94a3b8; border-top: 0.5pt solid #f1f1f1; padding-top: 12pt; text-align: center; font-style: italic; }
        
        .footer { position: absolute; bottom: 30pt; left: 0; width: 100%; text-align: center; font-size: 7.5pt; color: #cbd5e1; letter-spacing: 1pt; text-transform: uppercase; }
        
        /* Badge Lunas */
        .paid-badge { position: absolute; top: 60pt; right: 60pt; border: 1.5pt solid #22c55e; color: #22c55e; padding: 4pt 10pt; font-size: 8pt; font-weight: bold; text-transform: uppercase; transform: rotate(5deg); }
    </style>
</head>
<body>
    <div class="gold-bar"></div>
    <div class="watermark">D'BEST HOTEL BANDUNG</div>

    <div class="container">
        <div class="paid-badge">Payment Verified</div>

        <div class="logo-container">
            @if(isset($logo) && $logo)
                <img src="{{ $logo }}" style="width: 100pt;">
            @else
                <h2 style="color: #0F172A; letter-spacing: 8pt; margin: 0; font-size: 18pt; text-transform: uppercase;">D'Best</h2>
            @endif
        </div>

        <div class="header-title">
            <span class="subtitle">Official Stay Confirmation</span>
            <h1 class="main-title">Reservation Certificate.</h1>
            <p style="font-size: 8.5pt; color: #64748b; margin: 5pt 0; text-transform: uppercase; letter-spacing: 1pt;">
                Reference: {{ strtoupper($data->transaction_id) }}
            </p>
        </div>

        <div class="section-label">01. Primary Guest Information</div>
        <table class="data-grid">
            <tr>
                <td class="label">Legal Name</td>
                <td class="value">{{ strtoupper($data->customer_name) }}</td>
            </tr>
            <tr>
                <td class="label">Communication</td>
                <td class="value">{{ $data->customer_email }} &bull; {{ $data->customer_phone }}</td>
            </tr>
            <tr>
                <td class="label">Verification ID</td>
                <td class="value">#{{ ($data->transaction_id) }}</td>
            </tr>
        </table>

        <div class="section-label">02. Accommodation Logistics</div>
        <table class="data-grid">
            <tr>
                <td class="label">Room Category</td>
                <td class="value" style="color: #B59461;">{{ $data->room_type_name }}</td>
            </tr>
            <tr>
                <td class="label">Room Assignment</td>
                <td class="value">Room {{ $data->room_number }}</td>
            </tr>
            <tr>
                <td class="label">Stay Schedule</td>
                <td class="value">
                    {{ date('d M Y', strtotime($data->check_in)) }} — {{ date('d M Y', strtotime($data->check_out)) }}
                </td>
            </tr>
            <tr>
                <td class="label">Duration</td>
                <td class="value">{{ $data->total_nights }} Night(s) / {{ $data->total_nights + 1 }} Days</td>
            </tr>
        </table>

        <div class="section-label">03. Financial Settlement</div>
        <table class="data-grid">
            <tr>
                <td class="label">Grand Total</td>
                <td class="value" style="font-size: 14pt;">IDR {{ number_format($data->total_amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Payment Status</td>
                <td class="value" style="color: #22c55e;">FULLY SETTLED</td>
            </tr>
        </table>

        <div class="warning-box">
            <div class="warning-title">General Provisions</div>
            <p class="warning-text">
                Check-in time is scheduled for 14:00 WIB and Check-out at 12:00 WIB. This document is a legally binding confirmation of your reservation at D'Best Hotel Bandung. Guests are required to present a valid government-issued ID upon arrival.
            </p>
        </div>

        <div class="footer-policy">
            D'Best Hotel Bandung &bull; Jl. Otista No.460, Bandung, Jawa Barat &bull; (022) 5228899
        </div>
    </div>

    <div class="footer">
        Verified & Secured by D'Best Group &bull; {{ date('Y') }}
    </div>
</body>
</html>