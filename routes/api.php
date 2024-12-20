<?php

use App\Models\DetailService;
use App\Models\GroupService;
use App\Models\Service;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/service',function(Request $request){
    $r = $request->all();
    try {
        $service = Service::create([
            'cod' => $r['codigo'],
            'title' => $r['servicio'],
            'date_start' => $r['fecha_inicio'],
            'date_end' => $r['fecha_fin'],
            'lat' => $r['latitud'],
            'long' => $r['longitud']
        ]);
    } catch (\Throwable $th) {
        return "hubo un error al crear servicio: $th";
    }
    $data1 = [];
    foreach ($r['grupos'] as $value) {
        $group = GroupService::create([
            'service_id' => $service->id,
            'user_ci' => $value['encargado']
        ]);
        foreach ($value['integrantes'] as $v) {
            if(!User::where('ci',$v)->exists()){
                $client = new Client();
                $response = $client->get('http://'.env('IP_SERVICE','localhost:8000').'/server/simulador/public/api/staff/'.$v);
                if($response->getStatusCode() == 200){
                    $obj = json_decode($response->getBody(),true);
                    User::create([
                            'ci' => $obj['ci'],
                            'username' => $obj['name'].$obj['ci'],
                            'password' => bcrypt('12345678'),
                            'surname' => $obj['surname'],
                            'name' => $obj['name'],
                            'cellular' => $obj['cellular'],
                            'range' => $obj['range']
                    ]);
                }
            }
            $data1 [] = [
                'group_service_id' => $group->id,
                'user_ci' => $v,
                'service_id' => $service->id
            ];
        }
        DetailService::upsert($data1,[],[]);
    }
    return response()->json(['message' => 'servicio creado correctamente'],200);
});
