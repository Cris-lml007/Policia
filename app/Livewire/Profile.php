<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $token;

    public function generateToken(){
        $user = User::find(Auth::user()->id);
        if(!$user()->tokens()->exists())
            $this->token = $user()->createToken('mobile')->plainTextToken;
        else
            $this->dispatch("alert");
    }

    public function render()
    {
        $user = Auth::user();
        return view('livewire.profile')
            ->with('surname',$user->surname)
            ->with('name',$user->name)
            ->with('range',$user->range)
            ->with('cellular',$user->cellular)
            ->with('username',$user->username);
    }
}
