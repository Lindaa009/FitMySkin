@extends('layouts.app')

@section('title', 'Jurnal Malam')
@section('page', 'journal')

@section('content')
    <section class="page-intro journal-intro">
        <div>
            <p class="eyebrow"><span class="eyebrow-dot"></span> TUTUP HARI DENGAN LEMBUT</p>
            <h1>Jurnal <span>malam</span></h1>
            <p class="intro-copy">Luangkan waktu sejenak untuk mencatat rutinitas dan reaksi kulitmu malam ini.</p>
        </div>
        <a class="button button-secondary" href="{{ route('jurnal.riwayat') }}">Lihat riwayat <span aria-hidden="true">↗</span></a>
    </section>

    <section class="journal-layout">
        <form class="journal-form" id="journal-form" data-journal-type="evening" novalidate>
            <div class="journal-card">
                <div class="journal-card-heading">
                    <span class="step-number">01</span>
                    <div>
                        <p class="eyebrow">RUTINITAS MALAM</p>
                        <h2>Apa yang kamu pakai?</h2>
                    </div>
                </div>
                <p class="form-hint">Pilih produk yang kamu gunakan malam ini. Kamu bisa memilih lebih dari satu.</p>
                <div class="journal-products" id="journal-products"></div>
                <a class="text-link" href="{{ route('katalog') }}">Kelola produk di katalog <span aria-hidden="true">→</span></a>
            </div>

            <div class="journal-card">
                <div class="journal-card-heading">
                    <span class="step-number">02</span>
                    <div>
                        <p class="eyebrow">KENALI KULITMU</p>
                        <h2>Bagaimana kondisi kulitmu?</h2>
                    </div>
                </div>
                <p class="form-hint">Pilih yang paling menggambarkan kondisi kulitmu hari ini.</p>
                <div class="condition-grid" role="group" aria-label="Kondisi kulit">
                    <button class="condition-choice" type="button" data-condition="Nyaman" aria-pressed="false"><span>☁</span>Nyaman</button>
                    <button class="condition-choice" type="button" data-condition="Kering" aria-pressed="false"><span>◌</span>Kering</button>
                    <button class="condition-choice" type="button" data-condition="Berminyak" aria-pressed="false"><span>✧</span>Berminyak</button>
                    <button class="condition-choice" type="button" data-condition="Kemerahan" aria-pressed="false"><span>♡</span>Kemerahan</button>
                    <button class="condition-choice" type="button" data-condition="Perih" aria-pressed="false"><span>!</span>Perih</button>
                </div>
            </div>

            <div class="journal-card">
                <div class="journal-card-heading">
                    <span class="step-number">03</span>
                    <div>
                        <p class="eyebrow">CERITA KULITMU</p>
                        <h2>Ada hal lain yang kamu rasakan?</h2>
                    </div>
                </div>
                <div class="symptom-list">
                    <label class="check-option"><input type="checkbox" name="symptoms" value="Gatal"><span>Gatal</span></label>
                    <label class="check-option"><input type="checkbox" name="symptoms" value="Bruntusan"><span>Bruntusan</span></label>
                    <label class="check-option"><input type="checkbox" name="symptoms" value="Mengelupas"><span>Mengelupas</span></label>
                    <label class="check-option"><input type="checkbox" name="symptoms" value="Tidak ada"><span>Tidak ada</span></label>
                </div>
                <label class="form-field note-field">Catatan (opsional)
                    <textarea name="note" rows="4" maxlength="500" placeholder="Ceritakan lebih lanjut tentang kulitmu hari ini..."></textarea>
                </label>
                <label class="form-field date-field">Tanggal jurnal
                    <input name="date" type="date" required>
                </label>
            </div>

            <div class="journal-submit">
                <p>Catatanmu tersimpan di perangkat ini dan bisa dilihat kembali di halaman riwayat.</p>
                <button class="button button-primary" type="submit">Simpan jurnal malam <span aria-hidden="true">→</span></button>
            </div>
        </form>

        <aside class="journal-aside">
            <div class="aside-card aside-tip">
                <span class="tip-icon" aria-hidden="true">☾</span>
                <p class="eyebrow">WAKTU UNTUK DIRIMU</p>
                <h2>Terima kasih sudah merawat diri.</h2>
                <p>Catatan kecil hari ini bisa membantu menemukan pola kulitmu dari waktu ke waktu.</p>
            </div>
            <div class="aside-card">
                <p class="eyebrow">RUTINITASMU</p>
                <h2>Sudah berapa hari kamu mencatat?</h2>
                <p class="streak-number"><span data-journal-streak>0</span> <span>hari</span></p>
                <p>Setiap catatan membantu kamu lebih memahami kulitmu.</p>
            </div>
            <a class="aside-history-link" href="{{ route('jurnal.riwayat') }}">Buka riwayat jurnal <span aria-hidden="true">↗</span></a>
        </aside>
    </section>
@endsection