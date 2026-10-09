<?php

namespace Tests\Feature;

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
}
