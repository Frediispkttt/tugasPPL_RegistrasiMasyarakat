<?php 

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\AdminApprovalController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::put('/new-password/update', [NewPasswordController::class, 'update'])->name('new-password.update');

Route::get('/registration-status', function () {
    return view('auth.registrasi-status');
})->name('registration-status');

// Approved Routes
Route::middleware('status_role:admin,approved')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/profile', [ProfileController::class, 'editAdmin'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('/password/update', [PasswordController::class, 'update'])->name('password.update');

    // Admin approval
    Route::get('/admin/approval', [AdminApprovalController::class, 'index'])->name('admin.approval');
    Route::post('/admin/approval/{user}', [AdminApprovalController::class, 'approveUser'])->name('admin.approve');
});

Route::middleware('status_role:masyarakat,approved')->group(function () {
    Route::get('/masyarakat/dashboard', function () {
        return view('masyarakat.dashboard');
    })->name('masyarakat.dashboard');

    Route::get('/masyarakat/profile', [ProfileController::class, 'editMasyarakat'])->name('masyarakat.profile.edit');
    Route::patch('/masyarakat/profile', [ProfileController::class, 'update'])->name('masyarakat.profile.update');
    Route::put('/password/update', [PasswordController::class, 'update'])->name('password.update');
});

// Pending Routes for All
Route::middleware('status_role:admin,pending')->group(function () {
    Route::get('/registration-status', function () {
        return view('auth.registrasi-status');
    })->name('admin.registration-status');
});

Route::middleware('status_role:masyarakat,pending')->group(function () {
    Route::get('/registration-status', function () {
        return view('auth.registrasi-status');
    })->name('masyarakat.registration-status');
});
