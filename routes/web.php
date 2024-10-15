<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

require __DIR__.'/global.php';

Route::get('admin/',[AuthController::class,'adminIndex'])->name('admin.index');
Route::post('admin/',[AuthController::class,'adminLogin'])->name('admin.login');
Route::get('dt/',[AuthController::class,'districtIndex'])->name('district.index');
Route::post('dt/',[AuthController::class,'districtLogin'])->name('district.login');
Route::get('op/',[AuthController::class,'operatorIndex'])->name('operator.index');
Route::post('op/',[AuthController::class,'operatorLogin'])->name('operator.login');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/dashboard/',[DashboardController::class,'adminDashboard'])->name('admin.dashboard');
    Route::get('admin/logout/',[AuthController::class,'adminLogout'])->name('admin.logout');

    Route::get('admin/district/create',[MainController::class,'createDistrict'])->name('admin.createDistrict');
});

Route::middleware(['auth:district'])->group(function () {
    Route::get('dt/dashboard/',[DashboardController::class,'districtDashboard'])->name('district.dashboard');
    Route::get('dt/logout/',[AuthController::class,'districtLogout'])->name('district.logout');

    Route::get('dt/oparator/create',[MainController::class,'createOparator'])->name('district.createOparator');
});
Route::middleware(['auth:operator'])->group(function () {
    Route::get('op/dashboard/',[DashboardController::class,'operatorDashboard'])->name('operator.dashboard');
    Route::get('op/logout/',[AuthController::class,'operatorLogout'])->name('operator.logout');

    // Route::get('dt/oparator/create',[MainController::class,'createOparator'])->name('district.createOparator');
});