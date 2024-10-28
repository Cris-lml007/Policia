<?php

namespace App\Livewire;

use App\Models\Range;
use Livewire\Component;
use Livewire\WithPagination;

class RangeTable extends Component
{
    public $search;

    public $listeners = ['refreshRange'];

    use WithPagination;
    public function render()
    {
        if(!empty($this->search)){
            $ranges = Range::where('name','like','%'.$this->search.'%')->paginate(10);
        }else{
            $ranges = Range::paginate(10);
        }
        return view('livewire.range-table',compact('ranges'));
    }
}
