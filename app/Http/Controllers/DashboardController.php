<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Attendance;
use App\Models\GroupService;
use App\Models\Service;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
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
        if (Auth::user()->role != Role::ADMIN){
            if (Service::where('date_start','<=',Carbon::now())
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
        }else if(Auth::user()->role == Role::SUPERVISOR){
            $service = GroupService::where('user_ci',Auth::user()->ci)->whereHas('service',function($query){
                $query->where('date_start','<=',Carbon::now())->where('date_end','>=',Carbon::now());
            })->first();
            return view('service-supervisor',compact(['service']));
        }
        return abort(404);
    }

    public function attendance(){
        return view('attendance');
    }
    public function reports(){
        $groupService = GroupService::where('user_ci',Auth::user()->ci)->whereHas('service',function($query){
            $query->where('date_start','<=',Carbon::now())->where('date_end','>=',Carbon::now());
        })->first();

        $attendance = Attendance::whereHas('detailService',function($query)use ($groupService) {
            $query->where('group_service_id',$groupService->id);
        })->count();

        $aus = Attendance::selectRaw('detail_service_id, COUNT(*) as attendance_count')
            ->groupBy('detail_service_id')->orderBy('attendance_count','desc')
            ->first();
        return view('reports',compact(['groupService','attendance','aus']));
    }

    public function getService(Service $service){
        // dd($service);
        return view('service',compact(['service']));
    }

    public function getReport(){
        $groupService = GroupService::where('user_ci',Auth::user()->ci)->whereHas('service',function($query){
            $query->where('date_start','<=',Carbon::now())->where('date_end','>=',Carbon::now());
        })->first();

        $attendance = Attendance::whereHas('detailService',function($query)use ($groupService) {
            $query->where('group_service_id',$groupService->id);
        })->count();

        $aus = Attendance::selectRaw('detail_service_id, COUNT(*) as attendance_count')
            ->groupBy('detail_service_id')->orderBy('attendance_count','desc')
            ->first();

        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        $pdf->loadView('pdf.report',compact(['groupService','attendance','aus']));
        $pdf->setPaper('letter');
        $pdf->render();
        return $pdf->stream();
    }
}
