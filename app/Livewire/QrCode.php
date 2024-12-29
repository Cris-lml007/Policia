<?php

namespace App\Livewire;

use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode as Qr;

class QrCode extends Component
{

    public $token;

    public function mount($detail_service){
        $token = Carbon::now()->toString() . $detail_service;
        Token::create([
            'detail_service_id' => $detail_service,
            'token' => $token
        ]);
        $this->token = base64_encode(Qr::generate(Crypt::encryptString($token)));
    }

    public function render()
    {
        return view('livewire.qr-code');
    }
}
