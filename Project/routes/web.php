<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaketHematController;
use App\Http\Controllers\StoreProfileController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\IntegrityController;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Halaman utama
Route::view('/', 'welcome')->name('welcome');

// Dashboard user
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profil user
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Route logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::get('/login', Login::class);



    


require __DIR__.'/auth.php';

// CRUD Routes untuk resource
Route::resource('menus', MenuController::class);
Route::resource('categories', CategoryController::class);
Route::resource('pakethemats', PaketHematController::class);
Route::resource('store', StoreProfileController::class);
Route::resource('pemesanans', PemesananController::class);

Route::get('/store', [StoreProfileController::class, 'profile']);
Route::get('/store/profile', [StoreProfileController::class, 'profile'])->name('store.profile');
Route::get('/store/{store}/edit', [StoreProfileController::class, 'edit'])->name('store.edit');
Route::put('/store/{store}', [StoreProfileController::class, 'update'])->name('store.update');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/user-roles', [UserRoleController::class, 'index'])->name('admin.roles.index');
    Route::put('/users/{id}/role', [UserRoleController::class, 'updateUserRole'])->name('admin.roles.updateUserRole');

    Route::get('menus/with-trashed', [MenuController::class, 'indexWithTrashed'])->name('admin.menus.withtrashed');
    Route::get('menus/only-trashed', [MenuController::class, 'onlyTrashed'])->name('admin.menus.onlyTrashed');
    Route::delete('menus/{id}/soft-delete', [MenuController::class, 'softDelete'])->name('admin.menus.softDelete');
    Route::put('menus/{id}/restore', [MenuController::class, 'restore'])->name('admin.menus.restore');
    Route::delete('menus/{id}/force-delete', [MenuController::class, 'forceDelete'])->name('admin.menus.forceDelete');

    Route::get('pakethemats/with-trashed', [PaketHematController::class, 'withTrashed'])->name('admin.pakethemats.withtrashed');
    Route::get('pakethemats/only-trashed', [PaketHematController::class, 'onlyTrashed'])->name('admin.pakethemats.onlyTrashed');
    Route::delete('pakethemats/{id}/soft-delete', [PaketHematController::class, 'softDelete'])->name('admin.pakethemats.softDelete');
    Route::put('pakethemats/{id}/restore', [PaketHematController::class, 'restore'])->name('admin.napakethemats.restore');    
    Route::delete('pakethemats/{id}/force-delete', [PaketHematController::class, 'forceDelete'])->name('admin.pakethemats.forceDelete');

    Route::resource('menus', MenuController::class);
    Route::resource('pakethemats', PaketHematController::class);

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/menus', [AdminController::class, 'menusIndex'])->name('admin.menus.index');

    Route::get('/pakethemats', [PaketHematController::class, 'index'])->name('admin.pakethemats.index');
    Route::get('pakethemats/create', [PaketHematController::class, 'create'])->name('admin.pakethemats.create');

    // Categories
    Route::get('/categories', [AdminController::class, 'categoriesIndex'])->name('admin.categories.index');

    // Pemesanans
    Route::get('/pemesanans', [AdminController::class, 'pemesanans'])->name('admin.pemesanans.index');

    Route::get('/store', [StoreProfileController::class, 'profile'])->name('admin.store.profile');
    Route::get('/store/edit', [StoreProfileController::class, 'edit'])->name('admin.store.edit');
    Route::put('/store', [StoreProfileController::class, 'update'])->name('admin.store.update');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('user.profile.edit');  // Define this route
    Route::get('admin/store/create', [StoreProfileController::class, 'create'])->name('admin.store.create');
    Route::post('admin/store/store', [StoreProfileController::class, 'store'])->name('admin.store.store');
    Route::get('/admin/integrity', [IntegrityController::class, 'index'])
     ->name('admin.integrity.index');

});

Route::prefix('user')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/menus', [MenuController::class, 'index'])->name('user.menus.index');

    Route::get('/pakethemats', [PaketHematController::class, 'index'])->name('user.pakethemats.index');

    Route::get('/pemesanans', [PemesananController::class, 'index'])->name('user.pemesanans.index');
    Route::get('/pemesanans/create', [PemesananController::class, 'create'])->name('user.pemesanans.create');
    Route::get('/pemesanans/{id}/confirm-delete', [PemesananController::class, 'confirmDelete'])->name('user.pemesanans.confirm-delete');
    Route::post('/pemesanans', [PemesananController::class, 'store'])->name('user.pemesanans.store');
    Route::delete('/pemesanans/{id}', [PemesananController::class, 'destroy'])->name('user.pemesanans.destroy');
    
    // Add the edit route here for user profile editing
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('user.profile.edit');  // Define this route
    
    Route::get('/store', [StoreProfileController::class, 'profile'])->name('user.store.profile');
});

