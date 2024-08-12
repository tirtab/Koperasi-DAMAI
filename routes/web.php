<?php

use App\Http\Controllers\InstallmentsController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\MandatorySavingsController;
use App\Http\Controllers\PrincipalSavingsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:Admin']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('installments', InstallmentsController::class);
    Route::resource('principal-saving', PrincipalSavingsController::class);
});

Route::group(['middleware' => ['role:Admin|Anggota']], function() {
    Route::resource('mandatory-saving', MandatorySavingsController::class);
    Route::resource('loans', LoansController::class);
    Route::resource('installments', InstallmentsController::class);
    Route::resource('principal-saving', PrincipalSavingsController::class);
});
