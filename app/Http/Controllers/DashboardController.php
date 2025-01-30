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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware(function($request,$next){
            if(Auth::user()->role == Role::DISABLED) return redirect(route('activate'));
            else return $next($request);
        });
    }

    public function staff(){
        if(!Gate::allows('admin') && !Gate::allows('user'))
            return redirect(route('dashboard.home'));
        return view('staff');
    }

    public function home(){
        if (Auth::user()->role != Role::ADMIN && Auth::user()->role != Role::USER){
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
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->refresh();
        if(!Auth::check()) return abort(404);
        if(Auth::user()->role == Role::ADMIN || Auth::user()->role == Role::USER){
            $services = Service::orderBy('date_start')->paginate();
            return view('service-admin',compact(['services']));
        }else if(Auth::user()->role == Role::SUPERVISOR){
            $service = GroupService::where('user_ci',Auth::user()->ci)->whereHas('service',function($query){
                $query->where('date_start','<=',Carbon::now())->where('date_end','>=',Carbon::now());
            })->first();
            return view('service-supervisor',compact(['service']));
        }
        // if(Gate::allows('admin'))
        //     return view('home');
        // else if(Gate::allows('supervisor'))
        //     return view('service-supervisor');
        return view('qrscan');
    }
    public function service(){
        // if(!Auth::check()) return abort(404);
        if(Auth::user()->role == Role::ADMIN || Auth::user()->role == Role::USER){
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
        if(!Gate::allows('supervisor',Auth::user())) return abort(404);
        $groupService = GroupService::where('user_ci',Auth::user()->ci)->whereHas('service',function($query){
            $query->where('date_start','<=',Carbon::now())->where('date_end','>=',Carbon::now());
        })->first();

        $attendance = DB::select("
        select count(*) as attendance
        from attendances inner join detail_services d on d.id = detail_service_id
        where d.service_id = $groupService->service_id group by detail_service_id order by attendance DESC limit 1
        ")[0]->attendance;
        //     Attendance::whereHas('detailService',function($query)use ($groupService) {
        //     $query->where('group_service_id',$groupService->id);
        // })->count();

        $absences = $sql = "
        SELECT COUNT(*) as absences
        FROM (
        SELECT COUNT(*) AS asistencias
        FROM attendances
        INNER JOIN detail_services d ON d.id = detail_service_id
        WHERE d.service_id = $groupService->service_id
        GROUP BY detail_service_id
        ORDER BY asistencias DESC
        LIMIT 1
        ) a,
        (
        SELECT d.user_ci, COUNT(detail_service_id) AS asistencias
        FROM attendances
        RIGHT JOIN detail_services d ON d.id = detail_service_id
        WHERE d.group_service_id = $groupService->service_id
        GROUP BY d.user_ci
        ) b
        WHERE b.asistencias < a.asistencias;
        ";
        $result = DB::select($sql);
        $absences = $result['0']->absences;
        return view('reports',compact(['groupService','attendance','absences']));
    }

    public function getService(Service $service){
        // dd($service);
        if(Gate::allows('admin',Auth::user()) || Gate::allows('user',Auth::user())){
            return view('service',compact(['service']));
        }else{
            return abort(404);
        }
    }

    public function getReport(){
        if(!Gate::allows('supervisor',Auth::user())) return abort(404);

        $groupService = GroupService::where('user_ci',Auth::user()->ci)->whereHas('service',function($query){
            $query->where('date_start','<=',Carbon::now())->where('date_end','>=',Carbon::now());
        })->first();

        $attendance = DB::select("
        select count(*) as attendance
        from attendances inner join detail_services d on d.id = detail_service_id
        where d.service_id = $groupService->service_id group by detail_service_id order by attendance DESC limit 1
        ")[0]->attendance;

        $absences = $sql = "
        SELECT COUNT(*) as absences
        FROM (
        SELECT COUNT(*) AS asistencias
        FROM attendances
        INNER JOIN detail_services d ON d.id = detail_service_id
        WHERE d.service_id = $groupService->service_id
        GROUP BY detail_service_id
        ORDER BY asistencias DESC
        LIMIT 1
        ) a,
        (
        SELECT d.user_ci, COUNT(detail_service_id) AS asistencias
        FROM attendances
        RIGHT JOIN detail_services d ON d.id = detail_service_id
        WHERE d.group_service_id = $groupService->service_id
        GROUP BY d.user_ci
        ) b
        WHERE b.asistencias < a.asistencias;
        ";
        $result = DB::select($sql);
        $absences = $result['0']->absences;

        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        $pdf->loadView('pdf.report',compact(['groupService','attendance','absences']));
        $pdf->setPaper('letter');
        $pdf->render();
        return $pdf->stream();
    }
}
