<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
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
        if (Auth::user()->role == Role::ADMIN) break;
        else if (Service::where('date_start','<=',Carbon::now())
            ->where('date_end','>=',Carbon::now())
            ->whereHas('groupService',function($query){$query->where('user_ci',Auth::user()->ci);})
            ->exists()
            ){
                $u = User::find(Auth::user()->id);
                $u->role = Role::SUPERVISOR;
                $u->save();
            }else{
                $u = User::find(Auth::user()->id);
                $u->role = Role::STAFF;
                $u->save();
            }
        if(Gate::allows('admin'))
            return view('home');
        else if(Gate::allows('supervisor'))
            return view('service-supervisor');
        else return view('qrscan');
    }
    public function service(){
        if(!Auth::check()) return abort(404);
        if(Auth::user()->role == Role::ADMIN){
            $services = Service::orderBy('date_start')->paginate();
            return view('service-admin',compact(['services']));
        }else if(Auth::user()->role == Role::SUPERVISOR)
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
