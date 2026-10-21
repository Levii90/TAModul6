<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'secret-password',
            'password_confirmation' => 'secret-password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('laporan.index'));
        $user = User::where('email', 'test@example.com')->firstOrFail();
        $this->assertTrue(Hash::check('secret-password', $user->password));
    }

    public function test_registration_validates_required_fields_and_unique_email(): void
    {
        User::factory()->create(['email' => 'existing@example.com']);

        $this->from('/register')->post('/register', [
            'name' => '',
            'email' => 'existing@example.com',
            'password' => 'short',
            'password_confirmation' => 'different',
        ])->assertRedirect('/register')
            ->assertSessionHasErrors(['name', 'email', 'password']);
    }
}
