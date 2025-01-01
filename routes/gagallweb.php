<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\AdminApprovalController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);

// Registration Status Route (accessible only by users not approved)
// Route::get('/registration-status', function () {
//     return view('auth.registrasi-status'); 
// })->name('registration-status')->middleware('guest');


// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/registration-status', function () {
        return view('auth.registrasi-status'); 
    })->name('registration-status');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::middleware(['auth'])->group(function () {
        Route::put('/password/update', [PasswordController::class, 'update'])->name('password.update');
    });
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/masyarakat/dashboard', function () {
        return view('masyarakat.dashboard');
    })->name('masyarakat.dashboard');
    Route::get('/masyarakat/profile', [ProfileController::class, 'editMasyarakat'])->name('masyarakat.profile.edit');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    //admin approval
    Route::get('/admin/approval', [AdminApprovalController::class, 'index'])->name('admin.approval');
    Route::post('/admin/approval/{user}', [AdminApprovalController::class, 'approveUser'])->name('admin.approve');
    
    // // Rute untuk admin
    // Route::middleware(['admin'])->group(function () {
    //     Route::get('/admin/dashboard', function () {
    //         return view('admin.dashboard');
    //     })->name('admin.dashboard');
    // });

    // // Rute untuk masyarakat
    // Route::middleware(['masyarakat'])->group(function () {
    //     Route::get('/masyarakat/dashboard', function () {
    //         return view('masyarakat.dashboard');
    //     })->name('masyarakat.dashboard');
    // });
});

require __DIR__.'/auth.php';
