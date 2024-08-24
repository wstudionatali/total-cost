<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('scan/{product_code}', [\App\Http\Controllers\HomeController::class, 'scan'])->name('scan');
Route::get('remove/{product_code}', [\App\Http\Controllers\HomeController::class, 'remove'])->name('remove');
Route::get('remove_all/', [\App\Http\Controllers\HomeController::class, 'remove_all'])->name('remove_all');
