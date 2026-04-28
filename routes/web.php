<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/katalog', [DashboardController::class, 'katalog'])->name('katalog');

Route::get('/detail/{id}', [DashboardController::class, 'detail'])->name('detail');

Route::view('/tentang', 'tentang')->name('tentang');

Route::get('/admin', [DashboardController::class, 'admin'])->name('admin');
Route::get('/admin/edit/{id}', [DashboardController::class, 'adminEdit'])->name('admin.edit');
Route::post('/admin/store', [DashboardController::class, 'store'])->name('admin.store');
Route::post('/admin/update/{id}', [DashboardController::class, 'update'])->name('admin.update');
Route::delete('/admin/delete/{id}', [DashboardController::class, 'delete'])->name('admin.delete');
Route::get('/hitung/{a}/{b}', function ($a, $b) {
    return $a + $b;
});