<?php

use App\Models\DetailService;
use App\Models\GroupService;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/service/{codigo}/destroy',function(Request $request){
        $service = Service::where('cod',$request->codigo)->first();
        if (!$service) {
            return response("service not found",404);
        }
        if(Carbon::parse($service->date_start)>Carbon::now()){
            $service->delete();
            return response("service deleted successfully",200);
        }
        return response("cannot delete service",202);
    })->can('service');

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
            return response("there was an error creating service",400);
        }
        $data1 = [];
        foreach ($r['grupos'] as $value) {
            if(!empty($value['encargado'])){
                if(!User::createForAPI($value['encargado'])){
                    $service->delete();
                    return response("there was an error creating service",400);
                }
            }
            $group = GroupService::create([
                'service_id' => $service->id,
                'user_ci' => empty($value['encargado']) ? null : $value['encargado']
            ]);
            foreach ($value['integrantes'] as $v) {
                if(!User::createForAPI($v)){
                    $service->delete();
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
    })->can('service');
});

Route::get('/checkhealth',function(){
    return response()->json(['message' => 'ok'],200);
});
