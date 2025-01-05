<?php

namespace App\Livewire;

use App\Enums\Type;
use App\Models\Token;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class QrScan extends Component
{

    public $listeners = ['Qr' => 'readQr'];
    public $message = 0;

    public function readQr($qr){
        $token = Token::where('token',$qr)->whereHas('detailService',function($query){ $query->where('user_ci',Auth::user()->ci);})->first();
        if($token !=null && !$token->is_used){
            $token->is_used = true;
            $token->detailService->attendances()->create([
                'type' => Type::QR,
                'token_id' => $token->id
            ]);
            $token->save();
            $this->message = 1;
        }else{
            $this->message = -1;
        }
        $this->dispatch('message');
    }



    public function render()
    {
        return view('livewire.qr-scan');
    }
}
