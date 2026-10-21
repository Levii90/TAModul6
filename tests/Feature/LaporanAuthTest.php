<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaporanAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_report_form_is_public_but_report_list_requires_login(): void
    {
        $this->get(route('laporan.create'))->assertOk();
        $this->get(route('laporan.index'))
            ->assertRedirect(route('login'));
    }

    public function test_guest_can_submit_report_without_exposing_report_data_on_confirmation(): void
    {
        $response = $this->post(route('laporan.store'), [
            'nama_pelapor' => 'Warga Bandung',
            'lokasi' => 'Baleendah',
            'tinggi_genangan' => 75,
            'tanggal_kejadian' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('laporan.confirmation'));
        $this->assertDatabaseHas('laporan', [
            'nama_pelapor' => 'Warga Bandung',
            'lokasi' => 'Baleendah',
        ]);
        $this->get(route('laporan.confirmation'))
            ->assertOk()
            ->assertDontSee('Warga Bandung');
    }

    public function test_authenticated_petugas_can_view_reports_and_profile(): void
    {
        $petugas = User::factory()->create();
        Laporan::create([
            'nama_pelapor' => 'Warga Bandung',
            'lokasi' => 'Baleendah',
            'tinggi_genangan' => 75,
            'tanggal_kejadian' => now()->toDateString(),
        ]);

        $this->actingAs($petugas)
            ->get(route('laporan.index'))
            ->assertOk()
            ->assertSee('Warga Bandung');

        $this->actingAs($petugas)
            ->get(route('petugas.profile'))
            ->assertOk()
            ->assertSee($petugas->name)
            ->assertSee($petugas->email);
    }
}
