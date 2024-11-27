<?php

namespace App\Livewire;

use App\Enums\Type;
use App\Models\DetailService;
use App\Models\GroupService;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Attendance extends Component
{

    public $search;
    public $isQr = false;
    public $attendance_quantity = 0;
    public $group_id;
    public DetailService $user_detail;

    public function qr(){
        $this->isQr = true;
        $this->dispatch('openModal');
    }

    public function canceledQr(){
        $this->isQr = false;
        $this->dispatch('openModal');
    }

    public function getAttendance(User $user){
        $this->user_detail = $user->DetailService()->where('group_service_id',$this->group_id)->first();
        $this->attendance_quantity = $this->user_detail->attendances()->count();
        $this->dispatch('openModal');
    }

    public function manualAttendance(){
        $this->user_detail->attendances()->create([
            'type' => Type::MANUAL
        ]);
        $this->getAttendance($this->user_detail->user);
        $this->dispatch('openModal');
    }

    use WithPagination;
    public function render()
    {
        if(empty($this->search)){
            $group = GroupService::where('user_ci',7322343)->whereHas('service',function($query){
                $query->where('date_start','<=',Carbon::now())->where('date_end','>=',Carbon::now());
            })->first()?->detailService()->paginate(1);
        }else{
            $group = GroupService::where('user_ci',7322343)->whereHas('service',function($query){
                $query->where('date_start','<=',Carbon::now())->where('date_end','>=',Carbon::now());
            })->whereHas('users',function($query){
                $query->where('surname','like','%'.$this->search.'%')->orWhere('name','like','%'.$this->search.'%');
            })->first()?->detailService()->paginate(1);
        }
        if(!empty($group) or $group!=null){
            $this->group_id = $group[0]->group_service_id;
        }
        return view('livewire.attendance',compact(['group']));
    }
}
