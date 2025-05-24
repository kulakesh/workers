<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

// URL::forceScheme('https');

require __DIR__.'/global.php';

Route::get('/', function () {
    return view('website.home');
})->name('website.home');
Route::get('/select-district',[MainController::class,'selectDistrict'])->name('selectDistrict');

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
Route::middleware('guest:accountant')->prefix('ac')->name('accountant.')->group(function () {
    Route::get('/',[AuthController::class,'accountantIndex'])->name('index');
    Route::post('/',[AuthController::class,'accountantLogin'])->name('login');
});

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'adminDashboard'])->name('dashboard');
    Route::get('/logout',[AuthController::class,'adminLogout'])->name('logout');
    Route::get('/change-password',[DashboardController::class,'adminChangePasswordIndex'])->name('ChangePasswordIndex');
    Route::post('/change-password',[DashboardController::class,'adminChangePasswordCreate'])->name('ChangePasswordCreate');

    Route::get('/district/create',[MainController::class,'createDistrict'])->name('createDistrict');
    Route::get('/settings/documents',[MainController::class,'createDocument'])->name('createDocument');
    Route::get('/settings/benefits',[MainController::class,'createBenefits'])->name('createBenefits');
    Route::get('/reports/workers',[MainController::class,'adminWorkersReport'])->name('workersReport');
    Route::get('/workers/edit/{id}',[MainController::class,'adminWorkerEdit'])->name('workerEdit');
    Route::get('/reports/icard/{id}',[MainController::class,'adminIcard'])->name('adminIcard');
});

Route::middleware(['auth:district'])->prefix('dt')->name('district.')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'districtDashboard'])->name('dashboard');
    Route::get('/logout',[AuthController::class,'districtLogout'])->name('logout');
    Route::get('/change-password',[DashboardController::class,'dtChangePasswordIndex'])->name('ChangePasswordIndex');
    Route::post('/change-password',[DashboardController::class,'dtChangePasswordCreate'])->name('ChangePasswordCreate');

    Route::get('/oparator/create',[MainController::class,'createOparator'])->name('createOparator');
    Route::get('/reports/workers',[MainController::class,'districtWorkersReport'])->name('workersReport');
    Route::get('/reports/workers/approvals',[MainController::class,'districtWorkersReportApproval'])->name('workersReportApproval');
    Route::get('/reports/workers/approved',[MainController::class,'districtWorkersApproved'])->name('districtWorkersApproved');
    Route::get('/reports/workers/rejected',[MainController::class,'districtWorkersRejected'])->name('districtWorkersRejected');
    Route::get('/workers/edit/{id}',[MainController::class,'districtWorkerEdit'])->name('workerEdit');
});
Route::middleware(['auth:operator'])->prefix('op')->name('operator.')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'operatorDashboard'])->name('dashboard');
    Route::get('/logout',[AuthController::class,'operatorLogout'])->name('logout');
    Route::get('/change-password',[DashboardController::class,'opChangePasswordIndex'])->name('ChangePasswordIndex');
    Route::post('/change-password',[DashboardController::class,'opChangePasswordCreate'])->name('ChangePasswordCreate');

    Route::get('/workers/create',[MainController::class,'createWorker'])->name('createWorker');
    Route::get('/reports/workers',[MainController::class,'operatorWorkersReport'])->name('workersReport');
    Route::get('/workers/edit/{id}',[MainController::class,'operatorWorkerEdit'])->name('workerEdit');
});
Route::middleware(['auth:accountant'])->prefix('ac')->name('accountant.')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'accountantDashboard'])->name('dashboard');
    Route::get('/logout',[AuthController::class,'accountantLogout'])->name('logout');
    Route::get('/change-password',[DashboardController::class,'acChangePasswordIndex'])->name('ChangePasswordIndex');
    Route::post('/change-password',[DashboardController::class,'acChangePasswordCreate'])->name('ChangePasswordCreate');

    Route::get('/reports/payment/un-verified',[MainController::class,'accountantPaymentUnVerify'])->name('PaymentUnVerify');
    Route::get('/reports/payment/verified',[MainController::class,'accountantPaymentVerify'])->name('PaymentVerify');
    Route::get('/reports/payment/rejected',[MainController::class,'accountantPaymentReject'])->name('PaymentReject');
    Route::get('/reports/payment/all',[MainController::class,'accountantPaymentAll'])->name('PaymentAll');
});