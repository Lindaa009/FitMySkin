<?php

namespace Tests\Feature;

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
            ->assertSee('class="nav-toggle-label">Menu</span>', false);
    }

    public function test_profile_and_notifications_are_available_to_authenticated_users(): void
    {
        $user = new User;
        $user->setAttribute('id_user', 1);

        $this->actingAs($user)
            ->get('/profil')
            ->assertOk()
            ->assertSee('Informasi Personal')
            ->assertSee('data-skin-type="Normal"', false)
            ->assertSee('data-profile-group="concerns"', false)
            ->assertSee('data-profile-group="allergies"', false);

        $this->actingAs($user)
            ->get('/notifikasi')
            ->assertOk()
            ->assertSee('Notifikasi & Pengingat Cantik')
            ->assertSee(route('analisis.kecocokan'), false)
            ->assertSee(route('jurnal.malam'), false)
            ->assertSee('data-share-achievement', false)
            ->assertDontSee('href="#"');
    }

    public function test_routine_page_exposes_working_controls_for_demo(): void
    {
        $user = new User;
        $user->setAttribute('id_user', 1);

        $this->actingAs($user)
            ->get('/profil/kelola-langkah')
            ->assertOk()
            ->assertSee('reset-routine', false)
            ->assertSee('insert-routine-step', false)
            ->assertSee('fitmyskin.routines.v1')
            ->assertSee('routine-step-type', false)
            ->assertSee('save-routine', false);
    }

    public function test_analysis_actions_have_real_navigation_and_product_controls(): void
    {
        $this->get('/analisis/kecocokan')
            ->assertOk()
            ->assertSee(route('dashboard'), false)
            ->assertSee(route('profil'), false)
            ->assertSee('pause-suspect-product', false)
            ->assertSee('stop-suspect-product', false)
            ->assertDontSee('href="#"');
    }

    public function test_dashboard_product_summary_matches_demo_catalog_defaults(): void
    {
        $user = new User;
        $user->setAttribute('id_user', 1);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Total <span data-dashboard-product-total>4</span> Produk Terdaftar', false)
            ->assertSee('data-dashboard-active-products style=', false)
            ->assertSee('data-dashboard-paused-products style=', false);
    }
}
