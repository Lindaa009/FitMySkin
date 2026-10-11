<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Tidak Ditemukan · FitMySkin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fitmyskin.css') }}">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div style="max-width: 560px; width: 100%; text-align: center; padding: 40px 20px;">

        <div style="font-size: 100px; line-height: 1; margin-bottom: 8px;">🌸</div>

        <div>
            <span style="background: var(--rose-pale); color: var(--rose); font-size: 10px; font-weight: 800; letter-spacing: 1.5px; padding: 6px 16px; border-radius: 999px; text-transform: uppercase; display: inline-block; margin-bottom: 16px;">
                ERROR 404
            </span>
            <h1 style="margin: 0 0 12px; font-size: clamp(28px, 4vw, 40px); font-weight: 800; letter-spacing: -1.5px; color: var(--ink);">
                Ups, Halamannya Nggak Ketemu 🌷
            </h1>
            <p style="margin: 0 auto; max-width: 480px; color: var(--muted); font-size: 13px; line-height: 1.7;">
                Sepertinya halaman yang kamu cari udah pindah, kehapus, atau nggak pernah ada. Yuk balik ke tempat yang aman.
            </p>
        </div>

        <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-top: 28px;">
            <a href="{{ url('/dashboard') }}" class="button button-primary" style="border-radius: 99px; padding: 0 24px; background: var(--rose); text-decoration: none;">
                🏠 Kembali ke Dashboard
            </a>
            <a href="{{ url('/') }}" class="button button-secondary" style="border-radius: 99px; padding: 0 24px; text-decoration: none;">
                🔑 Ke Halaman Login
            </a>
        </div>

    </div>
</body>
</html>