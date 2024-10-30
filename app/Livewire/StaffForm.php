<?php

namespace App\Livewire;

use App\Models\Person;
use App\Models\Range;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StaffForm extends Component
{

    public $id;
    #[Validate('required|integer')]
    public $ci;
    #[Validate('required|alpha')]
    public $surname;
    #[Validate('required|alpha')]
    public $name;
    #[Validate('required|between:0,1')]
    public $gender;
    public $position;
    #[Validate('required|date')]
    public $birthdate;
    #[Validate('integer|min_digits:8|max_digits:8')]
    public $cellular;
    public $observation;
    #[Validate('exists:ranges,name')]
    public $range;

    public $isSave = false;

    public $listeners = ['get'=>'getPerson'];

    public function getPerson($id){
        $p = Person::find($id);
        $this->surname = $p->surname;
        $this->name = $p->name;
        $this->ci = $p->ci;
        $this->observation = $p->observation;
        $this->cellular = $p->cellular;
        $this->range = $p->range->name ?? null;
        $this->gender = $p->gender;
        $this->position = $p->position;
        $this->birthdate = $p->birthdate;
    }


    public function updateOrCreate(){
        $this->validate();
        Person::updateOrCreate(
            [
                'ci' => $this->ci,
                'surname' => $this->surname,
                'name' => $this->name,
                'birthdate' => $this->birthdate,
                'gender' => $this->gender,
                'position' => $this->position,
                'cellular' => $this->cellular,
                'observation' => $this->observation,
                'range_id' => Range::where('name',$this->range)->first()->id
            ],
            [
                'ci' => $this->ci
            ]
        );
        $this->dispatch('update');
        $this->isSave = true;
    }

    public function getRanges(){
        return Range::all();
    }

    public function restart(){
        $this->resetValidation();
        $this->reset();
    }

    public function render()
    {
        return view('livewire.staff-form');
    }
}
