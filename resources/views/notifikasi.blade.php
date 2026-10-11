@extends('layouts.app')

@section('title', 'Notifikasi & Pengingat Cantik')
@section('page', 'notifikasi')

@section('content')
<div style="max-width: 1080px; margin: 0 auto; display: grid; gap: 28px;">

    <!-- BANNER ATAS NOTIFIKASI -->
    <div class="journal-card aside-tip" style="padding: 32px; border-radius: 28px; background: linear-gradient(135deg, #fff0f3 0%, #fff7f5 100%); border-color: #f6e4e6;">
        <span class="eyebrow"><span class="eyebrow-dot"></span> PUSAT KABAR & RUTINITAS</span>
        <h1 style="margin: 8px 0 10px; font-size: clamp(24px, 3.5vw, 32px); font-weight: 800; letter-spacing: -1px; color: #862348;">
            Notifikasi & Pengingat Cantik 🔔✨
        </h1>
        <p class="intro-copy" style="max-width: 580px;">
            Pantau pengingat rutinitas harian, deteksi dini reaksi kulit, dan kabar seru dari FitMySkin.
        </p>
    </div>

    <!-- GRID UTAMA (2 KOLOM) -->
    <div class="notifications-grid" style="display: grid; grid-template-columns: 1fr 300px; gap: 24px; align-items: start;">

        <!-- KOLOM KIRI: DAFTAR NOTIFIKASI -->
        <div style="display: grid; gap: 16px;">

            <!-- CARD 1: WASPADA BREAKOUT -->
            <div class="journal-card" data-notification="skin-warning" style="padding: 20px 24px; border-radius: 22px; display: flex; align-items: flex-start; gap: 18px; position: relative;">
                <div style="width: 44px; height: 44px; border-radius: 50%; background: #fdf2f4; border: 1px solid #f7d5de; display: grid; place-items: center; color: #ab2c5d; font-size: 18px; flex-shrink: 0; position: relative;">
                    ⚠️
                    <span style="position: absolute; top: -2px; right: -2px; width: 10px; height: 10px; background: #ab2c5d; border-radius: 50%; border: 2px solid white;"></span>
                </div>
                <div style="flex-grow: 1;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                        <span style="background: #fdf2f4; color: #ab2c5d; font-size: 8px; font-weight: 800; letter-spacing: 0.8px; padding: 3px 10px; border-radius: 99px; text-transform: uppercase;">WASPADA BREAKOUT</span>
                        <span style="font-size: 10px; color: var(--muted); font-weight: 600;">10 Menit Lalu</span>
                    </div>
                    <h3 style="margin: 0 0 6px; font-size: 14px; font-weight: 800; color: var(--ink);">
                        Peringatan Deteksi Bahan Aktif! 🚨
                    </h3>
                    <p style="margin: 0 0 14px; color: var(--muted); font-size: 11px; line-height: 1.5; max-width: 520px;">
                        Kamu menggunakan Glycolic Acid Exfoliating Brightening 2 malam berturut-turut. Jangan lupa beri jeda hidrasi barrier malam ini ya, cantik!
                    </p>
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        <a href="{{ route('analisis.kecocokan') }}" class="button button-primary" style="font-size: 10px; height: 32px; padding: 0 14px; border-radius: 99px; background: #ab2c5d;">Lihat Analisis Kecocokan</a>
                        <button type="button" data-dismiss-notification class="button button-secondary" style="font-size: 10px; height: 32px; padding: 0 14px; border-radius: 99px; background: #faf5f3; border-color: transparent; color: var(--ink);">Tandai Sudah Paham</button>
                    </div>
                </div>
            </div>

            <!-- CARD 2: RITUAL MALAM -->
            <div class="journal-card" style="padding: 20px 24px; border-radius: 22px; display: flex; align-items: flex-start; gap: 18px;">
                <div style="width: 44px; height: 44px; border-radius: 50%; background: #fdf2f4; border: 1px solid #f7d5de; display: grid; place-items: center; color: #ab2c5d; font-size: 18px; flex-shrink: 0;">
                    🌙
                </div>
                <div style="flex-grow: 1;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                        <span style="background: #fdf2f4; color: #ab2c5d; font-size: 8px; font-weight: 800; letter-spacing: 0.8px; padding: 3px 10px; border-radius: 99px; text-transform: uppercase;">RITUAL MALAM</span>
                        <span style="font-size: 10px; color: var(--muted); font-weight: 600;">1 Jam Lalu</span>
                    </div>
                    <h3 style="margin: 0 0 6px; font-size: 14px; font-weight: 800; color: var(--ink);">
                        Waktunya Ritual Skincare Malam! 💖
                    </h3>
                    <p style="margin: 0 0 14px; color: var(--muted); font-size: 11px; line-height: 1.5;">
                        Pukul 21:00 WIB. Kulitmu butuh nutrisi sebelum tidur pulas. Yuk centang produk malam ini!
                    </p>
                    <a href="{{ route('jurnal.malam') }}" class="button button-primary" style="font-size: 10px; height: 32px; padding: 0 16px; border-radius: 99px; background: #ef6b94;">Buka Jurnal Sekarang →</a>
                </div>
            </div>

            <!-- CARD 3: STREAK BOOSTER -->
            <div class="journal-card" style="padding: 20px 24px; border-radius: 22px; display: flex; align-items: flex-start; gap: 18px; background: #faf5f3; border-color: transparent;">
                <div style="width: 44px; height: 44px; border-radius: 50%; background: #fdf2f4; border: 1px solid #f7d5de; display: grid; place-items: center; color: #ab2c5d; font-size: 18px; flex-shrink: 0;">
                    🔥
                </div>
                <div style="flex-grow: 1;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                        <span style="background: #fdf2f4; color: #ab2c5d; font-size: 8px; font-weight: 800; letter-spacing: 0.8px; padding: 3px 10px; border-radius: 99px; text-transform: uppercase;">STREAK BOOSTER</span>
                        <span style="font-size: 10px; color: var(--muted); font-weight: 600;">Hari Ini 08:00 WIB</span>
                    </div>
                    <h3 style="margin: 0 0 6px; font-size: 14px; font-weight: 800; color: var(--ink);">
                        Selamat! 5 Hari Streak Glowing Berturut-turut! 🥳✨
                    </h3>
                    <p style="margin: 0 0 14px; color: var(--muted); font-size: 11px; line-height: 1.5;">
                        Kamu makin konsisten merawat skin barrier. Tetap semangat mencapai kulit impian mu!
                    </p>
                    <button type="button" data-share-achievement class="button button-secondary" style="font-size: 10px; height: 32px; padding: 0 16px; border-radius: 99px; background: white; color: #ab2c5d; border-color: #f7d5de;">
                        📢 Bagikan Pencapaian
                    </button>
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN: TIPS CANTIK -->
        <div>
            <div class="journal-card" style="padding: 24px; border-radius: 24px; background: linear-gradient(135deg, #fff0f3 0%, #fff7f5 100%); border-color: #f6e4e6;">
                <div style="width: 36px; height: 36px; border-radius: 50%; background: #ab2c5d; color: white; display: grid; place-items: center; font-size: 16px; margin-bottom: 12px;">
                    💡
                </div>
                <h3 style="margin: 0 0 8px; font-size: 14px; font-weight: 800; color: var(--ink);">Tips Cantik</h3>
                <p style="margin: 0; color: var(--muted); font-size: 11px; line-height: 1.6;">
                    Menyetel alarm pengingat 15 menit sebelum waktu tidur membantu penyerapan sleeping mask tanpa menempel pada bantal!
                </p>
            </div>
        </div>

    </div>

    <p id="notification-feedback" role="status" aria-live="polite" hidden style="margin: 0; color: var(--rose); font-size: 11px;"></p>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const feedback = document.getElementById('notification-feedback');
        const warningCard = document.querySelector('[data-notification="skin-warning"]');
        const dismissedKey = 'fitmyskin.notifications.skin-warning-dismissed';

        const showFeedback = (message) => {
            if (feedback) {
                feedback.textContent = message;
                feedback.hidden = false;
            }
        };

        try {
            if (window.localStorage.getItem(dismissedKey) === 'true' && warningCard) {
                warningCard.hidden = true;
                warningCard.style.display = 'none';
            }
        } catch (error) {
            console.error('Status notifikasi tidak dapat dibaca.', error);
            showFeedback('Status notifikasi tidak dapat dibaca dari penyimpanan browser.');
        }

        document.querySelector('[data-dismiss-notification]')?.addEventListener('click', () => {
            try {
                window.localStorage.setItem(dismissedKey, 'true');
                if (warningCard) {
                    warningCard.hidden = true;
                    warningCard.style.display = 'none';
                }
                showFeedback('Notifikasi ditandai sudah dipahami.');
            } catch (error) {
                console.error('Status notifikasi tidak dapat disimpan.', error);
                showFeedback('Notifikasi belum tersimpan. Periksa penyimpanan browser lalu coba lagi.');
            }
        });

        document.querySelector('[data-share-achievement]')?.addEventListener('click', async () => {
            const shareData = {
                title: 'FitMySkin',
                text: 'Aku sudah menjaga rutinitas skincare selama 5 hari bersama FitMySkin!',
                url: window.location.origin,
            };

            try {
                if (navigator.share) {
                    await navigator.share(shareData);
                    showFeedback('Pencapaian berhasil dibagikan.');
                    return;
                }

                await navigator.clipboard.writeText(`${shareData.text} ${shareData.url}`);
                showFeedback('Teks pencapaian disalin. Kamu bisa membagikannya.');
            } catch (error) {
                if (error.name === 'AbortError') {
                    return;
                }

                console.error('Pencapaian tidak dapat dibagikan.', error);
                showFeedback('Pencapaian tidak dapat dibagikan dari browser ini.');
            }
        });
    });
</script>
@endpush
@endsection
