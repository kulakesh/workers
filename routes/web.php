<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

URL::forceScheme('https');

require __DIR__.'/global.php';
Route::get('/barcode/{code}',[MainController::class,'barcodeIndex'])->name('barcodeIndex');
Route::get('/qrcode/{code}',[MainController::class,'qrcodeIndex'])->name('qrcodeIndex');

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',[AuthController::class,'adminIndex'])->name('index');
    Route::post('/',[AuthController::class,'adminLogin'])->name('login');
});
Route::middleware('guest:district')->prefix('dt')->name('district.')->group(function () {
    Route::get('/',[AuthController::class,'districtIndex'])->name('index');
    Route::post('/',[AuthController::class,'districtLogin'])->name('login');
});
Route::middleware('guest:operator')->prefix('op')->name('operator.')->group(function () {
    Route::get('/',[AuthController::class,'operatorIndex'])->name('index');
    Route::post('/',[AuthController::class,'operatorLogin'])->name('login');
});

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'adminDashboard'])->name('dashboard');
    Route::get('/logout',[AuthController::class,'adminLogout'])->name('logout');

    Route::get('/district/create',[MainController::class,'createDistrict'])->name('createDistrict');
    Route::get('/settings/documents',[MainController::class,'createDocument'])->name('createDocument');
    Route::get('/reports/workers',[MainController::class,'workersReport'])->name('workersReport');
    Route::get('/reports/icard/{id}',[MainController::class,'adminIcard'])->name('adminIcard');
});

Route::middleware(['auth:district'])->prefix('dt')->name('district.')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'districtDashboard'])->name('dashboard');
    Route::get('/logout',[AuthController::class,'districtLogout'])->name('logout');

    Route::get('/oparator/create',[MainController::class,'createOparator'])->name('createOparator');
});
Route::middleware(['auth:operator'])->prefix('op')->name('operator.')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'operatorDashboard'])->name('dashboard');
    Route::get('/logout',[AuthController::class,'operatorLogout'])->name('logout');

    Route::get('/workers/create',[MainController::class,'createWorker'])->name('createWorker');
});