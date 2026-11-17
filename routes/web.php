<?php

use App\Http\Controllers\BentoController;
use App\Http\Controllers\VaultController;
use Illuminate\Support\Facades\Route;

// Halaman Utama: Bento Grid Profile
Route::get('/', [BentoController::class, 'index'])->name('bento.index');
Route::post('/bento', [BentoController::class, 'store'])->name('bento.store');

// Halaman Kedua: UI Component & Code Snippet Vault
Route::get('/vault', [VaultController::class, 'index'])->name('vault.index');
Route::post('/vault', [VaultController::class, 'store'])->name('vault.store');