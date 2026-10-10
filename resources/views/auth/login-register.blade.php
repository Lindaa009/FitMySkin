<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fef8f5">
    <title>Masuk atau Daftar · FitMySkin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fitmyskin.css') }}">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
        }
    </style>
</head>
<body data-page="auth">

    <!-- Konten Utama Login & Register -->
    <div style="display: flex; align-items: center; justify-content: center; width: 100%; max-width: 860px; margin: auto;">
        <div style="background: white; border-radius: 23px; border: 1px solid var(--line); box-shadow: var(--shadow); overflow: hidden; width: 100%; display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));">
            
            <!-- Sisi Kiri: Banner Info -->
            <div style="background: linear-gradient(135deg, var(--rose-pale), var(--peach)); padding: 35px; display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <p class="eyebrow"><span class="eyebrow-dot"></span> SKIN JOURNAL & HABIT TRACKER</p>
                    <h1 style="font-size: 26px; font-weight: 800; letter-spacing: -.8px; margin: 12px 0 10px; line-height: 1.25;">
                        Ritual Cantik, <br><span style="color: var(--rose);">Kulit Sehat</span> Terawat.
                    </h1>
                    <p style="color: var(--muted); font-size: 11px; margin: 0 0 20px;">
                        Catat perjalanan kulitmu setiap hari, temukan rutinitas paling pas, dan nikmati kilau alami tanpa rasa khawatir.
                    </p>
                </div>
                <div style="background: rgba(255,255,255,0.85); padding: 15px; border-radius: 16px; border: 1px solid var(--line);">
                    <p style="margin: 0 0 6px; font-size: 11px; font-style: italic; color: var(--ink);">
                        "Sejak pakai FitMySkin, skin barrier aku pulih dan gak pernah salah beli skincare lagi! 💖"
                    </p>
                    <strong style="font-size: 10px; color: var(--rose);">Maya, FitMySkin Member (Jakarta)</strong>
                </div>
            </div>

            <!-- Sisi Kanan: Form Login / Register -->
            <div style="padding: 35px; display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="margin-bottom: 22px;">
                        <span style="color: var(--rose); font-size: 9px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase;">Member Space</span>
                        <h2 style="margin: 3px 0 0; font-size: 18px; font-weight: 800;">Hai Cantik, Selamat Datang! 🌸</h2>
                    </div>

                    <!-- Tab Switcher -->
                    <div style="display: flex; background: #f7efec; padding: 4px; border-radius: 14px; margin-bottom: 20px;">
                        <button type="button" id="tab-login" onclick="switchMode('login')" style="flex: 1; padding: 10px; border: none; border-radius: 10px; background: white; font-weight: 800; font-size: 10px; cursor: pointer; color: var(--ink); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">Masuk (Login)</button>
                        <button type="button" id="tab-register" onclick="switchMode('register')" style="flex: 1; padding: 10px; border: none; border-radius: 10px; background: transparent; font-weight: 800; font-size: 10px; cursor: pointer; color: var(--muted);">Daftar Akun Baru</button>
                    </div>

                    <form action="{{ route('dashboard') }}" method="GET" style="display: grid; gap: 14px;">
                        <div id="field-nama" class="form-field" style="display: none;">
                            <label>Nama Lengkap <span style="color: var(--rose);">*wajib</span></label>
                            <input type="text" placeholder="nama lengkap kamu">
                        </div>

                        <div class="form-field">
                            <label>Alamat Email</label>
                            <input type="email" placeholder="nama.kamu@email.com" required>
                        </div>

                        <div class="form-field">
                            <label>Kata Sandi / Password</label>
                            <input type="password" placeholder="••••••••" required>
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 10px;">
                            <label style="display: flex; align-items: center; gap: 6px; cursor: pointer;">
                                <input type="checkbox" style="accent-color: var(--rose);"> Ingat Saya
                            </label>
                            <a href="#" style="color: var(--rose); font-weight: 700;">Lupa sandi?</a>
                        </div>

                        <button type="submit" id="btn-submit" class="button button-primary" style="width: 100%; margin-top: 6px;">
                            Masuk Sekarang ✨
                        </button>
                    </form>
                </div>

                <p style="margin: 20px 0 0; text-align: center; color: var(--muted); font-size: 9px;">
                    🛡️ Data jurnal dan foto kulitmu 100% aman dan terenkripsi.
                </p>
            </div>

        </div>
    </div>

    <!-- Skrip JS khusus Auth -->
    <script src="{{ asset('js/auth.js') }}" defer></script>
</body>
</html>
