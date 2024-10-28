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
});

Route::get('/users', function() {
    return view ('users'); })->name('users');
    Route::get('/unidades', function() {
        return view ('unidades'); })->name('unidades');
