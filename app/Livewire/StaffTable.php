<?php

namespace App\Livewire;

use App\Models\Person;
use Livewire\Component;
use Livewire\WithPagination;

class StaffTable extends Component
{

    public $search;
    public $listeners = ['update'];

    use WithPagination;
    public function render()
    {
        if(!empty($this->search)){
            $persons = Person::where('surname','like','%'.$this->search.'%')
                ->orWhere('name','like','%'.$this->search.'%')
                ->orWhere('position','like','%'.$this->search.'%')
                ->orWhereHas('range',function($query){
                    $query->where('name','like','%'.$this->search.'%');
                })
                ->paginate(10);
        }else{
            $persons = Person::paginate(10);
        }
        return view('livewire.staff-table',compact('persons'));
    }
}
