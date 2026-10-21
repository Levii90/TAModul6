<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PetugasSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_petugas_seeder_creates_six_accounts_with_hashed_passwords(): void
    {
        $this->seed();

        $this->assertDatabaseCount('users', 6);
        $admin = User::where('email', 'admin@bpbd-bandung.go.id')->firstOrFail();
        $petugas = User::where('email', 'petugas01@bpbd-bandung.go.id')->firstOrFail();

        $this->assertTrue(Hash::check('BpbdAdmin#2026', $admin->password));
        $this->assertTrue(Hash::check('password', $petugas->password));
        $this->assertNotSame('password', $petugas->password);

        $this->post(route('login.store'), [
            'email' => $admin->email,
            'password' => 'BpbdAdmin#2026',
        ])->assertRedirect(route('laporan.index'));

        $this->assertAuthenticatedAs($admin);
    }
}
