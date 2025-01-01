<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class TestAuthController extends Controller
{
    // TS-01: Registrasi Pengguna
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // TS-02: Melihat Status Registrasi
    public function registrationStatus()
    {
        $status = Auth::user()->status;

        return response()->json(['status' => $status], 200);
    }

    // TS-04: Login Pengguna
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'Login successful'], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // TS-05: Mengubah Password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    // TS-06: Fitur Lupa Password
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Password reset link sent'], 200)
            : response()->json(['message' => 'Failed to send reset link'], 400);
    }

    // TS-07: Melengkapi Profil Pengguna
    public function completeProfile(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'photo' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
        ]);

        $user = Auth::user();
        $user->address = $request->address;
        $user->photo = $request->photo;
        $user->date_of_birth = $request->date_of_birth;
        $user->save();

        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
}
