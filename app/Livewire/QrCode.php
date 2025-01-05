<?php

namespace App\Livewire;

use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode as Qr;

class QrCode extends Component
{

    public $token;
    public $token_instant;
    public $message = null;

    public function mount($detail_service){
        $token = Carbon::now()->toString() . $detail_service;
        $token = Hash::make($token);
        $this->token_instant = Token::create([
            'detail_service_id' => $detail_service,
            'token' => $token
        ]);
        $this->token = base64_encode(Qr::generate($token));
    }

    public function render()
    {
        $this->message = $this->token_instant->is_used;
        return view('livewire.qr-code');
    }
}
