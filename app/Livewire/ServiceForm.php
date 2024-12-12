<?php

namespace App\Livewire;

use App\Models\Geofence;
use App\Models\GroupService;
use App\Models\Service;
use Livewire\Component;

class ServiceForm extends Component
{

    public Service $service;
    public $cod;
    public $title;
    public $date_start;
    public $date_end;

    public $geofences = [];
    public $group = [];

    public function getGeofences()
    {
        $this->geofences = Geofence::whereHas('groupService',function($query){
            $query->where('service_id',$this->service->id);
        })->get();
        $this->dispatch('loadGeofences',$this->geofences);
    }

    public function newGeofence($id,$geofence){
        Geofence::create([
            'group_service_id' => $id,
            'points' => json_encode(json_decode($geofence)[0])
        ]);
    }

    public function destroyGeofence($id){
        GroupService::find($id)->geofence()->delete();
    }

    public function getGroup($id){
        $this->group =  GroupService::find($id)->detailService;
    }

    public function mount($s){
        $this->service = Service::find($s);
        $this->cod = $this->service->cod;
        $this->title = $this->service->title;
        $this->date_start = $this->service->date_start;
        $this->date_end = $this->service->date_end;
        $this->geofences = Geofence::all()->toArray();
    }

    public function render()
    {
        return view('livewire.service-form');
    }
}
