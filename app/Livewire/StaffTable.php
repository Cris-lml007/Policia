<?php

namespace App\Livewire;

use App\Enums\Role;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class StaffTable extends Component
{

    public $message;
    public $search;
    public $listeners = ['update','syncStaff'];

    use WithPagination;
    public function render()
    {
        if(Auth::user()->role == Role::ADMIN){
            if(!empty($this->search)){
                $persons = User::where('surname','like','%'.$this->search.'%')
                    ->orWhere('name','like','%'.$this->search.'%')
                    ->orWhere('range','like','%'.$this->search.'%')
                    ->orWhere('cellular','like','%'.$this->search.'%')
                    ->paginate(10);
            }else{
                $persons = User::paginate(10);
            }
        }else{
            if(!empty($this->search)){
                $persons = User::where(function($query){
                    $query->where('surname','like','%'.$this->search.'%')
                          ->orWhere('name','like','%'.$this->search.'%')
                          ->orWhere('range','like','%'.$this->search.'%')
                          ->orWhere('cellular','like','%'.$this->search.'%');
                })->where(function($query){
                    $query->where('role',Role::STAFF->value)
                          ->orWhere('role',Role::SUPERVISOR->value);
                })
                  ->paginate(10);
            }else{
                $persons = User::orwhere('role',Role::SUPERVISOR)->orWhere('role',Role::STAFF)->paginate(10);
            }
        }
        return view('livewire.staff-table',compact(['persons']));
    }

    public function syncStaff(){
        $client = new Client();
        $ip =env('API_STAFF');
        try{
            $response = $client->get($ip);
            if($response->getStatusCode() == 200){
                $json = json_decode($response->getBody(),true);
                $list = [];
                foreach ($json as $obj) {
                    $list [] = [
                        'ci' => $obj['ci'],
                        'username' => $obj['name'].$obj['ci'],
                        'password' => bcrypt('12345678'),
                        'surname' => $obj['surname'],
                        'name' => $obj['name'],
                        'cellular' => $obj['cellular'],
                        'range' => $obj['range']

                    ];
                }
                User::upsert($list,['ci','username'],['cellular','range']);
                $this->message = 1;
            }
        }catch(Exception){
            $this->message = -1;
        }
    }

    public function getPerson($id){
        $this->dispatch('get',$id);
    }

    public function newLocal(){
        $this->dispatch('new');
    }
}
