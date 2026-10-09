@extends('layouts.app')

@section('title', 'Riwayat Jurnal')
@section('page', 'history')

@section('content')
    <section class="page-intro history-intro">
        <div>
            <p class="eyebrow"><span class="eyebrow-dot"></span> JEJAK PERJALANAN KULITMU</p>
            <h1>Riwayat <span>jurnal</span></h1>
            <p class="intro-copy">Lihat kembali catatanmu dan temukan perubahan kulit dari hari ke hari.</p>
        </div>
        <a class="button button-primary" href="{{ route('jurnal.pagi') }}">Tulis jurnal <span aria-hidden="true">+</span></a>
    </section>

    <section class="history-summary" aria-label="Ringkasan jurnal">
        <div class="history-summary-icon" aria-hidden="true">♡</div>
        <div><p class="eyebrow">PERJALANANMU</p><h2><span data-history-count>0</span> catatan tersimpan</h2><p>Terima kasih sudah meluangkan waktu untuk memahami kulitmu.</p></div>
        <div class="history-summary-streak"><strong data-journal-streak>0</strong><span>hari mencatat</span></div>
    </section>

    <section class="history-toolbar" aria-label="Filter riwayat jurnal">
        <label class="search-field">
            <span class="search-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Cari catatan jurnal</span>
            <input id="history-search" type="search" placeholder="Cari catatan atau kondisi kulit..." autocomplete="off">
        </label>
        <label class="select-field">
            <span class="visually-hidden">Filter jenis jurnal</span>
            <select id="history-type-filter">
                <option value="all">Semua rutinitas</option>
                <option value="morning">Jurnal pagi</option>
                <option value="evening">Jurnal malam</option>
            </select>
        </label>
    </section>

    <section class="section-heading history-heading">
        <div><p class="eyebrow">CATATAN TERBARU</p><h2>Perjalanan kulitmu</h2></div>
        <span class="history-result-count" id="history-result-count"></span>
    </section>
    <section class="history-list" id="history-list" aria-live="polite"></section>
@endsection