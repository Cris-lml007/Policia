<?php

namespace App\Livewire;

use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StaffForm extends Component
{

    public $id;
    #[Validate('unique:users,ci')]
    public $ci;
    public $surname;
    public $name;
    public $position;
    public $cellular;
    public $range;
    public $active;
    public $username;
    #[Validate('confirmed')]
    public $password;
    public $password_confirmation;

    public $isSave = false;
    public User $person;

    public $listeners = ['get'=>'getPerson','new'=>'newLocal'];
    public $local = false;

    public function toggleActive(){
        $user = User::where('ci',$this->ci)->first();
        $user->active = !$user->active;
        $user->save();
        $this->dispatch('update');
    }

    public function getPerson($ci){
        $this->isSave = false;
        $p = User::where('ci',$ci)->first();
        $this->person = $p;
        $this->surname = $p->surname;
        $this->name = $p->name;
        $this->ci = $p->ci;
        $client = new Client();
        try {
            $response = $client->get('http://localhost:9000/api/staff/'.$ci);
            $json = json_decode($response->getBody());
        } catch (Exception $error) {
        }finally{
            $this->cellular = $p->cellular;
            $this->range = $p->range;
            $this->position = $json->position ?? null;
            $this->active = $p->active==0 ? true : false;
            $this->username = $p->username;
        }
    }

    public function newLocal(){
        $this->local = true;
    }

    public function createLocal(){
        $this->validate();
        $this->person = new User();
        $this->person->ci = $this->ci;
        $this->person->surname = $this->surname;
        $this->person->name = $this->name;
        $this->person->cellular = $this->cellular;
        $this->person->range = $this->range;
        $this->person->username = $this->username;
        $this->person->password = bcrypt($this->password);
        $this->person->active = $this->active ? 0 : 1;
        $this->person->local = true;
        $this->person->save();
        $this->dispatch('update');
        $this->isSave = true;
    }


    public function updatePassword(){
        $this->validate();
        $this->person->password = $this->password;
        $this->person->save();
        $this->dispatch('update');
        $this->isSave = true;
    }

    public function updatedPasswordConfirmation(){
        if(!empty($this->password_confirmation)) $this->validate();
    }

    public function restart(){
        $this->isSave = false;
        $this->resetValidation();
        $this->reset();
    }

    public function render()
    {
        return view('livewire.staff-form');
    }
}
