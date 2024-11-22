<?php

namespace App\Livewire;

use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode as Qr;

class QrCode extends Component
{

    public function getQR(){
        return base64_encode(Qr::generate(md5(rand(1,99999))));
    }

    public function render()
    {
        return view('livewire.qr-code');
    }
}
