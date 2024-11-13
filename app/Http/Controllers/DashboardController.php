<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function staff(){
        return view('staff');
    }
    public function users(){
        return view('users');
    }
    public function unidades(){
        return view('unidades');
    }
    public function home(){
        return view('home');
    }
    public function serviceAdmin(){
        return view('service-admin');
    }
}
