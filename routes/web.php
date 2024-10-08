<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

require __DIR__.'/global.php';

Route::get('admin/',[AuthController::class,'index'])->name('admin.index');
Route::post('admin/',[AuthController::class,'login'])->name('admin.login');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/dashboard/',[DashboardController::class,'adminDashboard'])->name('admin.dashboard');
    Route::get('admin/logout/',[AuthController::class,'logout'])->name('admin.logout');

    Route::get('admin/district/create',[MainController::class,'createDistrict'])->name('admin.createDistrict');
});