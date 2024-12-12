<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TokenController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
Route::get('/counter', Counter::class);

Livewire::setScriptRoute(function($handle){
    return Route::get(env('APP_URL') . '/livewire/livewire.js',$handle);
});

Livewire::setUpdateRoute(function($handle){
    return Route::post(env('APP_URL').'/livewire/update',$handle);
});

Route::get('/', function () {
    return redirect(route('login'));
});

Route::post("dashboard/mark",[TokenController::class,"register"]);

Auth::routes();


Route::prefix('/dashboard')->middleware('auth')->controller(DashboardController::class)->group(function(){
    Route::get('staff','staff')->name('dashboard.staff');
    Route::get('users','users')->name('dashboard.users');
    Route::get('','home')->name('dashboard.home');
    Route::get('service','service')->name('dashboard.service');
    Route::get('/attendance','attendance')->name('dashboard.attendace');
    Route::get('reports','reports')->name('dashboard.reports');
    Route::get('/service/{service}','getService')->name('dashboard.getService');
    Route::get('/reports/get','getReport')->name('dashboard.report');
});

