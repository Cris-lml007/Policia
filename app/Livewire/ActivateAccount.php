<?php

namespace App\Livewire;

use App\Enums\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ActivateAccount extends Component
{
    private $username;
    public $password;
    public $password1;


    public function boot(){
        if(Auth::user()->role != Role::DISABLED) return redirect(route('dashboard.home'));
        $this->username = Auth::user()->username;
    }

    public function changePassword(){
        try {
            if(($this->password == $this->password1) && strlen($this->password)>=8){
                $user = Auth::user();
                $user->password = $this->password;
                $user->role = Role::USER;
                $user->save();
                return redirect(route('dashboard.home'));
            }
            $this->dispatch('error');
            return;
        } catch (\Throwable $th) {
            $this->dispatch('error');
        }
    }


    public function render()
    {
        return view('livewire.activate-account')
            ->with('username',$this->username)
            ->extends('layouts.app')
            ->section('content');
    }
}
