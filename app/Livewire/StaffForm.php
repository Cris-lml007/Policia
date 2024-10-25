<?php

namespace App\Livewire;

use App\Models\Person;
use App\Models\Range;
use Livewire\Component;

class StaffForm extends Component
{

    public $id;
    public $ci;
    public $surname;
    public $name;
    public $gender;
    public $position;
    public $birthdate;
    public $cellular;
    public $observation;
    public $range;

    public $isSave = false;


    public function updateOrCreate(){
        $this->validate([
            'ci' => ['required','integer'],
            'surname' => ['required'],
            'name' => ['required'],
            'gender' => ['required','integer','between:0,1'],
            // 'position' => ['required'],
            'range' => ['exists:ranges,name'],
            'birthdate' => ['required','date'],
        ]);
        if(!empty($this->ci) or $this->ci != null){
            Person::create([
                'ci' => $this->ci,
                'surname' => $this->surname,
                'name' => $this->name,
                'birthdate' => $this->birthdate,
                'gender' => $this->gender,
                'position' => $this->position,
                'cellular' => $this->cellular,
                'observation' => $this->observation,
                'range_id' => Range::where('name',$this->range)->first()->id
            ]);
        }
        $this->dispatch('update');
        $this->isSave = true;
    }

    public function getRanges(){
        return Range::all();
    }

    public function render()
    {
        return view('livewire.staff-form');
    }
}
