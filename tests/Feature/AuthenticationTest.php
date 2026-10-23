<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_protected_pages_to_login(): void
    {
        $this->get('/beranda')->assertRedirect(route('login.pengguna'));
        $this->get('/admin')->assertRedirect(route('login.pengguna'));
    }

    public function test_user_can_register_with_a_hashed_password(): void
    {
        $this->post('/registrasi', [
            'nama' => 'Pengguna Tes',
            'email' => 'pengguna@example.test',
            'password' => 'password123',
            'konfirmasi_password' => 'password123',
        ])->assertRedirect(route('login.pengguna'));

        $user = User::where('email', 'pengguna@example.test')->firstOrFail();

        $this->assertSame('Pengguna Tes', $user->nama_lengkap);
        $this->assertTrue(Hash::check('password123', $user->password_hash));
        $this->assertNotSame('password123', $user->password_hash);
    }

    public function test_registration_shows_clear_validation_errors(): void
    {
        $this->post('/registrasi', [])->assertSessionHasErrors([
            'nama' => 'Nama lengkap wajib diisi.',
            'email' => 'Email wajib diisi.',
            'password' => 'Kata sandi wajib diisi.',
            'konfirmasi_password' => 'Konfirmasi kata sandi wajib diisi.',
        ]);
    }

    public function test_user_can_log_in_and_access_protected_pages(): void
    {
        $user = $this->createUser();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ])->assertRedirect(route('pengguna.beranda'));

        $this->assertAuthenticatedAs($user);
        $this->get('/beranda')->assertOk();
    }

    public function test_invalid_login_shows_a_clear_error(): void
    {
        $user = $this->createUser();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ])->assertRedirect(route('login.pengguna'))
            ->assertSessionHas('error', 'Kata sandi salah!');
    }

    public function test_authenticated_user_can_log_out(): void
    {
        $user = $this->createUser();
        $this->actingAs($user);

        $this->post('/logout')->assertRedirect(route('landing.home'));

        $this->assertGuest();
    }

    public function test_user_seeder_creates_five_accounts_with_hashed_passwords(): void
    {
        $this->seed(UserSeeder::class);

        $users = User::where('email', 'like', 'dummy%@smartdisaster.test')->get();

        $this->assertCount(5, $users);
        $this->assertTrue(Hash::check('password123', $users->first()->password_hash));
        $this->assertNotSame('password123', $users->first()->password_hash);
    }

    private function createUser(): User
    {
        return User::create([
            'nama_lengkap' => 'Pengguna Tes',
            'email' => 'pengguna@example.test',
            'no_telepon' => '081234567890',
            'role' => 'mahasiswa',
            'password_hash' => Hash::make('password123'),
        ]);
    }
}
