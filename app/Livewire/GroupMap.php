<?php

namespace App\Livewire;

use App\Models\Geofence;
use App\Models\GroupService;
use App\Models\Service;
use Livewire\Component;

class GroupMap extends Component
{
    public Service $service;
    public $g;
    public $geofences = [];
    public $group = [];

    public function getGeofences()
    {
        $this->geofences = Geofence::where('group_service_id',$this->g)->get();
        $this->dispatch('loadGeofences',$this->geofences);
    }

    public function mount($id){
        $this->g = $id;
        $this->service = GroupService::find($id)->service;
    }

    public function render()
    {
        return view('livewire.group-map');
    }
}
