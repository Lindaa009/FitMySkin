<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Jurnal — FitMySkin</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            color: #33262b;
            font-size: 11px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding-bottom: 16px;
            border-bottom: 2px solid #ab2c5d;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #ab2c5d;
            margin: 0 0 4px;
            font-size: 22px;
            letter-spacing: -0.5px;
        }
        .header p {
            margin: 2px 0;
            color: #82747a;
            font-size: 10px;
        }
        .info-box {
            background: #fef8f5;
            border: 1px solid #f0e5e2;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 16px;
            font-size: 10px;
        }
        .info-box strong { color: #ab2c5d; }
        .journal-entry {
            border: 1px solid #f0e5e2;
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }
        .journal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 6px;
            border-bottom: 1px dashed #f0e5e2;
            margin-bottom: 6px;
        }
        .journal-date {
            font-weight: bold;
            color: #ab2c5d;
            font-size: 12px;
        }
        .journal-badge {
            background: #fff0f2;
            color: #ab2c5d;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
        }
        .journal-row {
            margin: 3px 0;
            font-size: 10px;
            color: #574146;
        }
        .journal-row strong {
            color: #33262b;
            display: inline-block;
            min-width: 70px;
        }
        .footer {
            text-align: center;
            color: #9b8b90;
            font-size: 9px;
            margin-top: 24px;
            padding-top: 12px;
            border-top: 1px solid #f0e5e2;
        }
        .empty {
            text-align: center;
            padding: 40px;
            color: #82747a;
            font-style: italic;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>🌸 FitMySkin</h1>
        <p>Riwayat Jurnal Kulit</p>
        <p>Rawat kulitmu, satu langkah setiap hari.</p>
    </div>

    <div class="info-box">
        <strong>Nama:</strong> {{ $user->nama_user }}<br>
        <strong>Email:</strong> {{ $user->alamat_email }}<br>
        <strong>Total Catatan:</strong> {{ $journals->count() }} jurnal<br>
        <strong>Tanggal Export:</strong> {{ $tanggalExport }}
    </div>

    @if ($journals->count() > 0)
        @foreach ($journals as $entry)
            <div class="journal-entry">
                <div class="journal-header">
                    <div class="journal-date">{{ $entry['date_formatted'] }}</div>
                    <div class="journal-badge">{{ $entry['type'] === 'morning' ? '☀️ Jurnal Pagi' : '🌙 Jurnal Malam' }}</div>
                </div>
                <div class="journal-row"><strong>Kondisi:</strong> {{ $entry['condition'] }}</div>
                @if (count($entry['symptoms']) > 0)
                    <div class="journal-row"><strong>Gejala:</strong> {{ implode(', ', $entry['symptoms']) }}</div>
                @endif
                @if (count($entry['products']) > 0)
                    <div class="journal-row"><strong>Produk:</strong> {{ implode(', ', $entry['products']) }}</div>
                @endif
                @if (!empty($entry['note']))
                    <div class="journal-row"><strong>Catatan:</strong> {{ $entry['note'] }}</div>
                @endif
            </div>
        @endforeach
    @else
        <div class="empty">
            Belum ada catatan jurnal yang tersimpan.
        </div>
    @endif

    <div class="footer">
        <p><strong>FitMySkin</strong> © {{ date('Y') }} — Dicetak pada {{ $tanggalExport }}</p>
    </div>

</body>
</html>