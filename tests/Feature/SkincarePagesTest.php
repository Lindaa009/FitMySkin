<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class SkincarePagesTest extends TestCase
{
    public function test_skincare_pages_are_available_and_render_their_primary_actions(): void
    {
        $this->get('/katalog')
            ->assertOk()
            ->assertSee('Katalog')
            ->assertSee('Tambah produk');

        $this->get('/jurnal/pagi')
            ->assertOk()
            ->assertSee('Jurnal')
            ->assertSee('Simpan jurnal pagi');

        $this->get('/jurnal/malam')
            ->assertOk()
            ->assertSee('Simpan jurnal malam');

        $this->get('/jurnal/riwayat')
            ->assertOk()
            ->assertSee('Riwayat')
            ->assertSee('history-list');
    }

    public function test_analysis_page_remains_available(): void
    {
        $this->get('/analisis/kecocokan')
            ->assertOk()
            ->assertSee('Analisis Kecocokan - FitMySkin');
    }

    public function test_dashboard_shows_navigation_to_dashboard_and_profile(): void
    {
        $user = new User;
        $user->setAttribute('id_user', 1);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Dashboard')
            ->assertSee('Katalog Produk')
            ->assertSee('Profil')
            ->assertSee(route('dashboard'), false)
            ->assertSee(route('profil'), false)
            ->assertSee('aria-label="Buka navigasi"', false)
            ->assertSee('aria-controls="main-navigation"', false);
    }

    public function test_profile_is_available_to_authenticated_users(): void
    {
        $user = new User;
        $user->setAttribute('id_user', 1);

        $this->actingAs($user)
            ->get('/profil')
            ->assertOk()
            ->assertSee('Informasi Personal')
            ->assertSee('data-skin-type="Normal"', false)
            ->assertSee('id="concerns-container"', false)
            ->assertSee('id="alergi-container"', false)
            ->assertSee('id="btn-add-concern"', false)
            ->assertSee('id="btn-add-alergi"', false);
    }

    public function test_notifications_page_is_removed(): void
    {
        $user = new User;
        $user->setAttribute('id_user', 1);

        $this->actingAs($user)
            ->get('/notifikasi')
            ->assertNotFound();
    }

    public function test_routine_page_exposes_working_controls_for_demo(): void
    {
        $user = new User;
        $user->setAttribute('id_user', 1);

        $this->actingAs($user)
            ->get('/profil/kelola-langkah')
            ->assertOk()
            ->assertSee('id="btn-reset-routine"', false)
            ->assertSee('id="add-step-select"', false)
            ->assertSee('Sisipkan')
            ->assertSee('let routineData =')
            ->assertSee("fetch('/routines'", false)
            ->assertSee('id="btn-save-routine"', false);
    }

    public function test_analysis_page_shows_recommendations_and_navigation(): void
    {
        $this->get('/analisis/kecocokan')
            ->assertOk()
            ->assertSee(route('dashboard'), false)
            ->assertSee(route('jurnal.riwayat'), false)
            ->assertSee('Analisis Kecocokan Produk & Iritasi', false)
            ->assertSee('Rekomendasi Berdasarkan Data Jurnalmu')
            ->assertSee('Belum Ada Pemicu Iritasi Terdeteksi')
            ->assertDontSee('href="#"');
    }

    public function test_dashboard_product_summary_matches_the_users_products(): void
    {
        $user = User::query()->create([
            'nama_user' => 'Test User',
            'alamat_email' => 'dashboard@example.test',
            'password' => 'password',
        ]);

        Product::query()->create([
            'id_user' => $user->id_user,
            'nama_produk' => 'Cleanser',
            'merek' => 'Test Brand',
            'jenis_produk' => 'Cleanser',
            'jadwal_pemakaian' => 'Siang',
            'status_pemakaian' => 'Aktif',
        ]);

        Product::query()->create([
            'id_user' => $user->id_user,
            'nama_produk' => 'Moisturizer',
            'merek' => 'Test Brand',
            'jenis_produk' => 'Moisturizer',
            'jadwal_pemakaian' => 'Malam',
            'status_pemakaian' => 'Tidak Aktif',
        ]);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Total 2 Produk')
            ->assertSee('Sedang Aktif')
            ->assertSee('Stop / Dijeda')
            ->assertViewHas('totalProduk', 2)
            ->assertViewHas('produkAktif', 1)
            ->assertViewHas('produkStop', 1);
    }
}
