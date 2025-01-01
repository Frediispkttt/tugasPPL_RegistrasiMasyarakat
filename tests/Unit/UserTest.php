<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    /**
     * TS-01: Test Registrasi Pengguna
     */
    public function testUserRegistration()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'role' => 'masyarakat', // Default role
            'status' => 'pending', // Default status
        ]);
    }

    /**
     * TS-02: Test Melihat Status Registrasi
     */
    public function testCheckRegistrationStatus()
    {
        $user = User::factory()->create(['status' => 'pending']);

        $response = $this->actingAs($user)->get('/registration-status');
        $response->assertStatus(200)
                 ->assertJson(['status' => 'pending']);
    }

    /**
     * TS-03: Test Approval Registrasi oleh Admin
     */
    public function testAdminApprovalRegistration()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['status' => 'pending']);

        $response = $this->actingAs($admin)->post('/admin/approve-registration', [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'status' => 'approved', // Status berubah setelah disetujui
        ]);
    }

    /**
     * TS-04: Test Login Pengguna
     */
    public function testUserLogin()
    {
        $user = User::factory()->create(['password' => Hash::make('password123')]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Login successful']);
    }

    /**
     * TS-05: Test Mengubah Password Pengguna
     */
    public function testChangeUserPassword()
    {
        $user = User::factory()->create(['password' => Hash::make('oldpassword')]);

        $response = $this->actingAs($user)->post('/change-password', [
            'current_password' => 'oldpassword',
            'new_password' => 'newpassword123',
            'new_password_confirmation' => 'newpassword123',
        ]);

        $response->assertStatus(200);
        $this->assertTrue(Hash::check('newpassword123', $user->fresh()->password));
    }

    /**
     * TS-06: Test Fitur Lupa Password
     */
    public function testForgotPassword()
    {
        $user = User::factory()->create();

        $response = $this->post('/forgot-password', ['email' => $user->email]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('password_resets', ['email' => $user->email]);
    }

    /**
     * TS-07: Test Melengkapi Profil Pengguna
     */
    public function testCompleteUserProfile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/complete-profile', [
            'address' => '123 Main St',
            'photo' => 'photo.jpg',
            'date_of_birth' => '1990-01-01',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'address' => '123 Main St',
            'photo' => 'photo.jpg',
            'date_of_birth' => '1990-01-01',
        ]);
    }
}
