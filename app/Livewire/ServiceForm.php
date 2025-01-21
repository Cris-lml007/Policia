<?php

namespace App\Livewire;

use App\Models\DetailService;
use App\Models\Geofence;
use App\Models\GroupService;
use App\Models\Service;
use App\Models\User;
use GuzzleHttp\Client;
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

    public function update(){
        try{
            $client = new Client();
            $ip =env('API_SERVICE');
            $response = $client->get("http://$ip/$this->service->cod");
            if($response->getStatusCode() == 200){
                $service = json_decode($response->getBody());
                $this->service->title = $service->servicio;
                $this->service->date_start = $service->fecha_inicio;
                $this->service->date_end = $service->fecha_fin;
                $this->service->lat = $service->latitud;
                $this->service->long = $service->longitud;
                $this->service->groupService()->delete();
                $this->service->save();
            }else{
                return;
            }

            $data1 = [];
            foreach ($service['grupos'] as $value) {
                if(!User::createForAPI($value['encargado'])){
                    $this->service->groupService()->delete();
                    return;
                }
                $group = GroupService::create([
                    'service_id' => $this->service->id,
                    'user_ci' => $value['encargado']
                ]);
                foreach ($value['integrantes'] as $v) {
                    if(!User::createForAPI($value['encargado'])){
                        $this->service->groupService()->delete();
                        return;
                    }
                    $data1 [] = [
                        'group_service_id' => $group->id,
                        'user_ci' => $v,
                        'service_id' => $this->service->id
                    ];
                }
                DetailService::upsert($data1,[],[]);
            }

        }finally{
            return redirect()->route('dashboard.getService',$this->service->id);
        }
    }

    public function destroyGeofence($id){
        GroupService::find($id)->geofence()->delete();
    }

    public function getGroup($id){
        $this->group =  GroupService::find($id)->detailService;
        $this->dispatch('openModal');
    }

    public function mount($s){
        $this->service = Service::find($s);
        $this->cod = $this->service->cod;
        $this->title = $this->service->title;
        $this->date_start = $this->service->date_start;
        $this->date_end = $this->service->date_end;
        // $this->geofences = Geofence::all()->toArray();
    }

    public function render()
    {
        return view('livewire.service-form');
    }
}
