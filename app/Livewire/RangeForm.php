<?php

namespace App\Livewire;

use App\Models\Range;
use Livewire\Component;

class RangeForm extends Component
{
    public $name;

    public function createOrUpdate(){
        Range::updateOrCreate(
            [
                'name' => $this->name,
            ],
            ['name' => $this->name]
        );
        $this->dispatch('refreshRange');
    }

    public function render()
    {
        return view('livewire.range-form');
    }
}
