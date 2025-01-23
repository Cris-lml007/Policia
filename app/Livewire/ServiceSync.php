<?php

namespace App\Livewire;

use App\Models\DetailService;
use App\Models\GroupService;
use App\Models\Service;
use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class ServiceSync extends Component
{
    public $message;

    public $listeners = ['syncServices'];

    public function syncServices(){
        $client = new Client();
        try {
            $response = $client->get(env('API_SERVICE'));

            $externalServices = json_decode($response->getBody(), true);
            if (!is_array($externalServices)) {
                throw new \Exception('La respuesta de la API no tiene un formato válido.');
            }
            DB::beginTransaction();
            foreach ($externalServices as $externalService) {
                $existingService = Service::where('cod', $externalService['codigo'])->first();

                if (!$existingService) {
                    User::createForAPI($externalService['encargado']);
                    $service = Service::create([
                        'cod' => $externalService['codigo'],
                        'title' => $externalService['servicio'],
                        'date_start' => $externalService['fecha_inicio'],
                        'date_end' => $externalService['fecha_fin'],
                        'lat' => $externalService['latitud'],
                        'long' => $externalService['longitud']
                    ]);

                    foreach ($externalService['grupos'] as $grupo) {
                        User::createForAPI($grupo['encargado']);

                        $group = GroupService::create([
                            'service_id' => $service->id,
                            'user_ci' => $grupo['encargado']
                        ]);
                        $data = [];
                        foreach ($grupo['integrantes'] as $integrante) {
                            User::createForAPI($integrante);
                            $data[] = [
                                'group_service_id' => $group->id,
                                'user_ci' => $integrante,
                                'service_id' => $service->id
                            ];
                        }
                        DetailService::upsert($data, [], []);
                    }
                }
            }
            DB::commit();
            $this->message= 1;
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->message= -1;
            throw $th;
        }
    }




    public function render()
    {
        return view('livewire.service-sync');
    }
}
