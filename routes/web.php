<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermintaanController;

// Landing page (welcome)
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'     => Route::has('login'),
        'canRegister'  => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

// Auth routes
Route::get('/login',    [AuthController::class, 'loginForm'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// Dashboard (authenticated)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Barang CRUD
    Route::prefix('barang')->name('barangs.')->group(function () {
        Route::get('/',             [BarangController::class, 'index'])->name('index');
        Route::get('/create',       [BarangController::class, 'create'])->name('create');
        Route::post('/',            [BarangController::class, 'store'])->name('store');
        Route::get('/{barang}',     [BarangController::class, 'show'])->name('show');
        Route::get('/{barang}/edit', [BarangController::class, 'edit'])->name('edit');
        Route::put('/{barang}',     [BarangController::class, 'update'])->name('update');
        Route::delete('/{barang}',  [BarangController::class, 'destroy'])->name('destroy');
    });

    // User/Anggota CRUD
    Route::prefix('anggota')->name('admin.')->group(function () {
        Route::get('/',              [UserController::class, 'index'])->name('index');
        Route::get('/create',        [UserController::class, 'create'])->name('create');
        Route::post('/',             [UserController::class, 'store'])->name('store');
        Route::get('/{user}',       [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit',  [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}',    [UserController::class, 'destroy'])->name('destroy');
    });
});
// Route::middleware(['auth', 'role:user,admin,spv'])->group(function () {
//     Route::get('/permintaan', [PermintaanController::class, 'indexUser'])->name('permintaan.index');
// });
Route::middleware(['auth'])->group(function () {
    Route::get('/permintaan', [PermintaanController::class, 'indexUser'])->name('permintaan.index');
});

// USER - Ajukan permintaan
// USER - Ajukan dan edit permintaan sendiri
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/permintaan/create', [PermintaanController::class, 'create'])->name('permintaan.create');
    Route::post('/permintaan/store', [PermintaanController::class, 'store'])->name('permintaan.store');

    // Tambahan untuk edit permintaan sendiri
    Route::get('/permintaan/{id}/edit', [PermintaanController::class, 'editUser'])->name('permintaan.user.edit');
    Route::put('/permintaan/{id}', [PermintaanController::class, 'updateUser'])->name('permintaan.user.update');
});


// SPV - Menyetujui permintaan
Route::middleware(['auth', 'role:spv'])->group(function () {
    Route::get('/permintaan/spv', [PermintaanController::class, 'indexSpv'])->name('permintaan.spv.index');
    Route::post('/permintaan/spv/setujui/{id}', [PermintaanController::class, 'setujuiSpv'])->name('permintaan.spv.setujui');
});

// Admin - Menyetujui permintaan final
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/permintaan/admin', [PermintaanController::class, 'indexAdmin'])->name('permintaan.admin.index');
    Route::post('/permintaan/admin/setujui/{id}', [PermintaanController::class, 'setujuiAdmin'])->name('permintaan.admin.setujui');
});
