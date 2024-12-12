<?php

namespace App\Livewire;

use App\Models\GroupService;
use App\Models\token;
use Auth;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode as Qr;
use Illuminate\Support\Str;

    class QrCode extends Component
    {
        
        public function getQR(){
            $user_mark = $_SESSION["id_mark"];            
            session_destroy();
            
            $activoUser = Auth::user();
            $dataForToken = GroupService::with("supervisor")
                ->where('supervisor_id',$activoUser->ci)
                ->where("status",1)
                ->selectRaw("id,supervisor_id,status")->first();

                $token = Str::random(60);
                
            
            $newToken = new  token();
            $newToken->supervisor_id = $dataForToken->supervisor_id;
            $newToken->agent_id = $user_mark;
            $newToken->token = $token;
            $newToken->group_service_id = $dataForToken->id;
            $newToken->save(); 


            return base64_encode(Qr::generate($token));
        }

    public function render()
    {
        return view('livewire.qr-code');
    }
}
