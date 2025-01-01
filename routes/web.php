<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\AdminApprovalController;
use App\Http\Controllers\TestAuthController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::put('/new-password/update', [NewPasswordController::class, 'update'])->name('new-password.update');

    Route::get('/registration-status', [AdminApprovalController::class, 'showStatus'])->name('registration-status');
    Route::post('/close-registration-status', [AdminApprovalController::class, 'closeStatus'])->name('close-registration-status');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::put('/password/update', [PasswordController::class, 'update'])->name('password.update');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/masyarakat/dashboard', function () {
            return view('masyarakat.dashboard');
        })->name('masyarakat.dashboard');
        
        Route::get('/masyarakat/profile', [ProfileController::class, 'editMasyarakat'])->name('masyarakat.profile.edit');
        Route::patch('/masyarakat/profile', [ProfileController::class, 'update'])->name('masyarakat.profile.update');
    });

    Route::group(['middleware' => 'isAdmin'], function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/admin/profile', [ProfileController::class, 'editAdmin'])->name('admin.profile.edit');
        Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
        
        // Admin approval
        Route::get('/admin/approval', [AdminApprovalController::class, 'index'])->name('admin.approval');
        Route::post('/admin/approval/{user}', [AdminApprovalController::class, 'approveUser'])->name('admin.approve');
    });




    // // TS-01: Test Registrasi Pengguna
    // Route::post('/test-register', [TestAuthController::class, 'register'])->name('register');

    // // TS-02: Test Melihat Status Registrasi
    // Route::middleware('auth')->get('/test-registration-status', [TestAuthController::class, 'registrationStatus'])->name('registration.status');

    // // TS-03: Test Approval Registrasi oleh Admin
    // Route::middleware(['auth', 'role:admin'])->post('/admin/test-approve-registration', [AdminApprovalController::class, 'approveRegistration'])->name('admin.approve.registration');

    // // TS-04: Test Login Pengguna
    // Route::post('/test-login', [TestAuthController::class, 'login'])->name('login');

    // // TS-05: Test Mengubah Password Pengguna
    // Route::middleware('auth')->post('/test-change-password', [TestAuthController::class, 'changePassword'])->name('change.password');

    // // TS-06: Test Fitur Lupa Password
    // Route::post('/test-forgot-password', [TestAuthController::class, 'forgotPassword'])->name('forgot.password');

    // // TS-07: Test Melengkapi Profil Pengguna
    // Route::middleware('auth')->post('/test-complete-profile', [TestAuthController::class, 'completeProfile'])->name('complete.profile');

require __DIR__.'/auth.php';
