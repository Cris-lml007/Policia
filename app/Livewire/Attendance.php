<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Attendance extends Component
{

    public $isQr = false;

    public $persons = [];

    public function qr(){
        $this->isQr = true;
    }

    public function canceledQr(){
        $this->isQr = false;
    }

    public function mount(){
        $this->persons = Auth::user();
    }


    public function render()
    {
        return view('livewire.attendance');
    }
}
