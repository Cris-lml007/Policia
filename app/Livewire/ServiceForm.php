<?php

namespace App\Livewire;

use App\Models\DetailService;
use App\Models\Geofence;
use App\Models\GroupService;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ServiceForm extends Component
{

    public Service $service;
    protected $cod;
    protected $title;
    protected $date_start;
    protected $date_end;
    public $modify;

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

    public function defineSupervisor($ci,$id){
        $this->service->groupService()->where('id',$id)->update(['user_ci' => $ci]);
        $this->dispatch('openModal');
    }

    public function updateService(){
        DB::beginTransaction();
        try {
            $client = new Client();
            $ip = env('API_SERVICE');
            $response = $client->get("$ip/$this->service->cod");

            if ($response->getStatusCode() == 200) {
                $service = json_decode($response->getBody(), true);
                $this->service->title = $service['servicio'];
                $this->service->date_start = $service['fecha_inicio'];
                $this->service->date_end = $service['fecha_fin'];
                $this->service->lat = $service['latitud'];
                $this->service->long = $service['longitud'];
                $this->service->save();
                $this->service->groupService()->delete();

                $data1 = [];
                foreach ($service['grupos'] as $value) {
                    if (!User::createForAPI($value['encargado']))
                        throw new \Exception("Error al crear el usuario encargado.");
                    $group = GroupService::create([
                        'service_id' => $this->service->id,
                        'user_ci' => $value['encargado']
                    ]);

                    foreach ($value['integrantes'] as $v) {
                        if (!User::createForAPI($v)) throw new \Exception("Error al crear el usuario integrante.");

                        $data1[] = [
                            'group_service_id' => $group->id,
                            'user_ci' => $v,
                            'service_id' => $this->service->id
                        ];
                    }
                }

                DetailService::upsert($data1, [], []);
                DB::commit();
                $message = "Se Actualizo Correctamente.";
            } else {
                DB::rollBack();
                $message = "No se Pudo Actualizar";
                return;
            }
        } catch (\Exception) {
            DB::rollBack();
            $message = "No se Pudo Actualizar";
            return;
        }

        return redirect()->route('dashboard.getService', $this->service->id)->with('message',$message);
    }

    public function destroyGeofence($id){
        GroupService::find($id)->geofence()->delete();
    }

    public function getGroup($id){
        $this->group =  GroupService::find($id);
        $this->dispatch('openModal');
    }

    public function mount($s){
        $this->service = Service::find($s);
        $this->cod = $this->service->cod;
        $this->title = $this->service->title;
        $this->date_start = $this->service->date_start;
        $this->date_end = $this->service->date_end;
        $this->modify = Carbon::now() < Carbon::parse($this->service->date_start);
        // $this->geofences = Geofence::all()->toArray();
    }

    public function render()
    {
        return view('livewire.service-form')
            ->with('cod',$this->cod)
            ->with('title',$this->title)
            ->with('date_start',$this->date_start)
            ->with('date_end',$this->date_end);
    }
}
