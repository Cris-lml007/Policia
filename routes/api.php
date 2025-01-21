<?php

use App\Models\DetailService;
use App\Models\GroupService;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/service/{codigo}/destroy',function(Request $request){
    $service = Service::where('cod',$request->codigo)->first();
    if(Carbon::parse($service->date_start)<Carbon::now()){
        $service->destroy();
        return response("service deleted successfully",200);
    }
    return response("cannot delete service",202);
});

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
        return response("there was an error creating service: $th",400);
    }
    $data1 = [];
    foreach ($r['grupos'] as $value) {
        if(!User::createForAPI($value['encargado'])){
            $service->destroy();
            return response("there was an error creating service",400);
        }
        $group = GroupService::create([
            'service_id' => $service->id,
            'user_ci' => $value['encargado']
        ]);
        foreach ($value['integrantes'] as $v) {
            if(!User::createForAPI($v)){
                $service->destroy();
                return response("there was an error creating service",400);
            }
            $data1 [] = [
                'group_service_id' => $group->id,
                'user_ci' => $v,
                'service_id' => $service->id
            ];
        }
        DetailService::upsert($data1,[],[]);
    }
    return response()->json(['message' => 'service created successfully'],201);
});





Route::get('/info',function(Request $request){
    return response()->json($request->all());
});

// Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user',function(Request $request){
        return response()->json(Auth::user());
    });
// });
//
Route::get('/createForAPI/{ci}',function($ci){
    try{
        if(!User::where('ci',$ci)->exists()){
            $client = new Client();
            $response = $client->get('http://'.env('IP_SERVICE','localhost:8000').'/api/staff/'.$ci);
            if($response->getStatusCode() == 200){
                $obj = json_decode($response->getBody(),true);
                User::create([
                    'ci' => $ci,
                    'username' => $obj['name'].$ci,
                    'password' => bcrypt('12345678'),
                    'surname' => $obj['surname'],
                    'name' => $obj['name'],
                    'cellular' => $obj['cellular'],
                    'range' => $obj['range']
                ]);
                return response("usuario creado");
            }else{
                return response("el usuario no se encontro",200);
            }
        }
        return response("usuario ya existe");

    }catch(Exception $e){
        return response("error: $e");
    }
    // if(User::createForAPI($ci)) return response("user created successfully",200);
    // else return response("user already exists",202);
});
