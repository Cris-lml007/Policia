<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function staff(){
        if(!Gate::allows('admin'))
            return redirect(route('dashboard.home'));
        return view('staff');
    }
    public function users(){
        return view('users');
    }
    public function unidades(){
        return view('unidades');
    }
    public function home(){
        if(Gate::allows('admin'))
            return view('home');
        else if(Gate::allows('supervisor'))
            return view('service-supervisor');
        else return view('qrscan');
    }
    public function service(){
        if(!Auth::check()) return abort(404);
        if(Auth::user()->role == Role::ADMIN)
            return view('service-admin');
        else if(Auth::user()->role == Role::SUPERVISOR)
            return view('service-supervisor');
        return abort(404);
    }

    public function attendance(){
        return view('attendance');
    }
    public function reports(){
        return view('reports');
    }
}
