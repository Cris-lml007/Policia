<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use app\Models\Service;
use app\Models\GroupService;
use app\Models\User;

class ServiceAdmin extends Component
{
    use WithPagination;

    public function status($codeStatus){
        switch($codeStatus)
        {
            case 0: return "Programado";
            case 1: return "En curso";
            case 2: return "Concluido";
        }
    }

    public function render()
    {
        $services = Service::all()  ->select('title', 'status', 'date')
                                    ->orderBy('date','desc')      
                                    ->paginate(10);

        return view('livewire.service-admin',compact(['services']));
    }

    public function detailService()
    {
        $sevices = GroupService::all()  ->select('title', 'status', 'date')
                                        ->orderBy('date','desc')      
                                        ->paginate(10);

    }
}
