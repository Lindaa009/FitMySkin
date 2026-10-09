@extends('layouts.app')

@section('title', 'Katalog Produk')
@section('page', 'catalog')

@section('content')
    <section class="page-intro catalog-intro">
        <div>
            <p class="eyebrow"><span class="eyebrow-dot"></span> RUANG RAWAT KULITMU</p>
            <h1>Katalog <span>Produk</span></h1>
            <p class="intro-copy">Semua produk skincare-mu tersusun rapi, jadi kamu selalu tahu apa yang dipakai.</p>
        </div>
        <button class="button button-primary" type="button" data-open-product-form>
            <span class="button-plus" aria-hidden="true">+</span> Tambah produk
        </button>
    </section>

    <section class="catalog-overview" aria-label="Ringkasan katalog">
        <div class="overview-copy">
            <span class="overview-icon" aria-hidden="true">✿</span>
            <div>
                <strong>Rutinitas yang lebih mindful</strong>
                <p>Catat produkmu dan lihat kembali apa yang cocok untuk kulitmu.</p>
            </div>
        </div>
        <div class="overview-count"><strong data-product-count>0</strong><span>produk tersimpan</span></div>
    </section>

    <section class="catalog-toolbar" aria-label="Cari dan saring produk">
        <label class="search-field">
            <span class="search-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Cari produk</span>
            <input id="product-search" type="search" placeholder="Cari nama atau kandungan produk..." autocomplete="off">
        </label>
        <label class="select-field">
            <span class="visually-hidden">Filter jenis produk</span>
            <select id="product-filter">
                <option value="all">Semua jenis</option>
                <option value="cleanser">Pembersih</option>
                <option value="toner">Toner</option>
                <option value="serum">Serum</option>
                <option value="moisturizer">Pelembap</option>
                <option value="sunscreen">Sunscreen</option>
                <option value="exfoliator">Eksfoliasi</option>
            </select>
        </label>
    </section>

    <section class="section-heading">
        <div>
            <p class="eyebrow">KOLEKSI KULITMU</p>
            <h2>Produk tersimpan <span class="section-count" data-product-count>0</span></h2>
        </div>
        <label class="select-field status-filter">
            <span class="visually-hidden">Filter status produk</span>
            <select id="product-status-filter">
                <option value="all">Semua status</option>
                <option value="active">Sedang digunakan</option>
                <option value="paused">Diistirahatkan</option>
            </select>
        </label>
    </section>

    <section class="product-grid" id="product-grid" aria-live="polite"></section>

    <dialog class="app-dialog" id="product-dialog" aria-labelledby="product-dialog-title">
        <form class="dialog-card" id="product-form">
            <div class="dialog-heading">
                <div>
                    <p class="eyebrow">KOLEKSI KULITMU</p>
                    <h2 id="product-dialog-title">Tambah produk</h2>
                </div>
                <button class="icon-button" type="button" data-close-dialog aria-label="Tutup">×</button>
            </div>
            <label class="form-field">Nama produk
                <input name="name" type="text" maxlength="80" placeholder="Contoh: Hydrating Toner" required>
            </label>
            <label class="form-field">Merek
                <input name="brand" type="text" maxlength="50" placeholder="Nama merek" required>
            </label>
            <label class="form-field">Jenis produk
                <select name="category" required>
                    <option value="">Pilih jenis produk</option>
                    <option value="cleanser">Pembersih</option>
                    <option value="toner">Toner</option>
                    <option value="serum">Serum</option>
                    <option value="moisturizer">Pelembap</option>
                    <option value="sunscreen">Sunscreen</option>
                    <option value="exfoliator">Eksfoliasi</option>
                </select>
            </label>
            <label class="form-field">Kandungan utama
                <input name="ingredient" type="text" maxlength="80" placeholder="Contoh: Ceramide, Niacinamide">
            </label>
            <label class="form-field">Waktu pemakaian
                <select name="routine" required>
                    <option value="both">Pagi dan malam</option>
                    <option value="morning">Pagi saja</option>
                    <option value="evening">Malam saja</option>
                </select>
            </label>
            <div class="dialog-actions">
                <button class="button button-secondary" type="button" data-close-dialog>Batal</button>
                <button class="button button-primary" type="submit">Simpan produk</button>
            </div>
        </form>
    </dialog>
@endsection
