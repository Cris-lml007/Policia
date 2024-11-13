<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/dashboard')->controller(DashboardController::class)->group(function(){
    Route::get('staff','staff')->name('dashboard.staff');
    Route::get('users','users')->name('dashboard.users');
    Route::get('unidades','unidades')->name('dashboard.unidades');
    Route::get('home','home')->name('dashboard.home');
    Route::get('service-admin','serviceAdmin')->name('dashboard.service-admin');
    Route::get('service-supervisor','serviceSupervisor')->name('dashboard.service-supervisor');
});

