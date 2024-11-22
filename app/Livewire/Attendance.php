<?php

namespace App\Livewire;

use Livewire\Component;

class Attendance extends Component
{

    public $isQr = false;

    public function qr(){
        $this->isQr = true;
    }

    public function canceledQr(){
        $this->isQr = false;
    }


    public function render()
    {
        return view('livewire.attendance');
    }
}
