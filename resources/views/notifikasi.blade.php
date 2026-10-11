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
    <div style="display: grid; grid-template-columns: 1fr 300px; gap: 24px; align-items: start;">

        <!-- KOLOM KIRI: DAFTAR NOTIFIKASI -->
        <div style="display: grid; gap: 16px;">

            @forelse ($notifikasi as $notif)
                @php
                    $bgStyle = $notif['tipe'] === 'streak' ? 'background: #faf5f3; border-color: transparent;' : '';
                    $dotBadge = in_array($notif['tipe'], ['warning', 'ritual']);
                @endphp
                <div class="journal-card" style="padding: 20px 24px; border-radius: 22px; display: flex; align-items: flex-start; gap: 18px; position: relative; {{ $bgStyle }}">
                    <div style="width: 44px; height: 44px; border-radius: 50%; background: #fdf2f4; border: 1px solid #f7d5de; display: grid; place-items: center; color: #ab2c5d; font-size: 18px; flex-shrink: 0; position: relative;">
                        {{ $notif['icon'] }}
                        @if ($dotBadge)
                            <span style="position: absolute; top: -2px; right: -2px; width: 10px; height: 10px; background: #ab2c5d; border-radius: 50%; border: 2px solid white;"></span>
                        @endif
                    </div>
                    <div style="flex-grow: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            @php
                                $labelColor = '#ab2c5d';
                                $labelBg = '#fdf2f4';
                                if (isset($notif['severity'])) {
                                    if ($notif['severity'] === 'Tinggi') { $labelColor = '#fff'; $labelBg = '#BA1A1A'; }
                                    elseif ($notif['severity'] === 'Sedang') { $labelColor = '#fff'; $labelBg = '#F57C00'; }
                                }
                            @endphp
                            <span style="background: {{ $labelBg }}; color: {{ $labelColor }}; font-size: 8px; font-weight: 800; letter-spacing: 0.8px; padding: 3px 10px; border-radius: 99px; text-transform: uppercase;">{{ $notif['label'] }}</span>
                            <span style="font-size: 10px; color: var(--muted); font-weight: 600;">{{ $notif['waktu'] }}</span>
                        </div>
                        <h3 style="margin: 0 0 6px; font-size: 14px; font-weight: 800; color: var(--ink);">
                            {{ $notif['judul'] }}
                        </h3>
                        <p style="margin: 0 0 14px; color: var(--muted); font-size: 11px; line-height: 1.5; max-width: 520px;">
                            {{ $notif['pesan'] }}
                        </p>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            @if ($notif['aksi_link'])
                                <a href="{{ $notif['aksi_link'] }}"
                                   class="button {{ $notif['aksi_style'] === 'primary' ? 'button-primary' : 'button-secondary' }}"
                                   style="font-size: 10px; height: 32px; padding: 0 16px; border-radius: 99px; {{ $notif['aksi_style'] === 'primary' ? 'background: #ab2c5d;' : 'background: white; color: #ab2c5d; border-color: #f7d5de;' }}">
                                    {{ $notif['aksi_text'] }}
                                </a>
                            @else
                                <button type="button"
                                        data-share="{{ $notif['judul'] }}"
                                        class="button {{ $notif['aksi_style'] === 'primary' ? 'button-primary' : 'button-secondary' }} btn-share"
                                        style="...">
                                    {{ $notif['aksi_text'] }}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="journal-card" style="padding: 40px; text-align: center; border-radius: 22px;">
                    <div style="font-size: 32px; margin-bottom: 10px;">🔕</div>
                    <h3 style="margin: 0 0 6px; font-size: 14px; font-weight: 800;">Belum ada notifikasi</h3>
                    <p style="margin: 0; font-size: 11px; color: var(--muted);">Terus catat jurnal harianmu untuk mendapatkan pengingat & analisis.</p>
                </div>
            @endforelse

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

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.btn-share').forEach(btn => {
            btn.addEventListener('click', async () => {
                const text = btn.dataset.share || 'Aku lagi konsisten merawat kulit pakai FitMySkin! 🌸';
                
                // Coba pakai Web Share API (kalau didukung)
                if (navigator.share) {
                    try {
                        await navigator.share({
                            title: 'FitMySkin — Pencapaian Streak',
                            text: text,
                            url: window.location.origin,
                        });
                        return;
                    } catch (err) {
                        // User cancel atau error, fallback ke copy
                    }
                }

                // Fallback: copy ke clipboard
                try {
                    await navigator.clipboard.writeText(text + ' ' + window.location.origin);
                    const toast = document.querySelector('#app-toast');
                    if (toast) {
                        toast.textContent = '✅ Pencapaian dicopy ke clipboard!';
                        toast.classList.add('is-visible');
                        setTimeout(() => toast.classList.remove('is-visible'), 3000);
                    } else {
                        alert('✅ Pencapaian dicopy!');
                    }
                } catch (e) {
                    alert('Pencapaianmu: ' + text);
                }
            });
        });
    });
</script>
@endpush
@endsection