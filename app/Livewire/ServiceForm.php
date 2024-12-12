<?php

namespace App\Livewire;

use App\Models\Geofence;
use App\Models\Service;
use Livewire\Component;

class ServiceForm extends Component
{

    public Service $service;
    public $cod;
    public $title;
    public $date_start;
    public $date_end;


    public function newGeofence($id,$geofence){
        $q = $id;
        // dd($id,$geofence);
        // Geofence::create([
        //     'group_service_id' => $id,
        //     'points' => $geofence
        //]);
    }

    public function mount($s){
        $this->service = Service::find($s);
        $this->cod = $this->service->cod;
        $this->title = $this->service->title;
        $this->date_start = $this->service->date_start;
        $this->date_end = $this->service->date_end;
    }

    public function render()
    {
        return view('livewire.service-form');
    }
}
