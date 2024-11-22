<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();


Route::prefix('/dashboard')->middleware('auth')->controller(DashboardController::class)->group(function(){
    Route::get('staff','staff')->name('dashboard.staff');
    Route::get('users','users')->name('dashboard.users');
    Route::get('','home')->name('dashboard.home');
    Route::get('service','service')->name('dashboard.service');
    Route::get('/attendance','attendance')->name('dashboard.attendace');
    Route::get('reports','reports')->name('dashboard.reports');
});

