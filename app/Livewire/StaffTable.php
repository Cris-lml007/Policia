<?php

namespace App\Livewire;

use App\Models\User;
use Exception;
use GuzzleHttp\Client;
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
            $persons = User::where('surname','like','%'.$this->search.'%')
                ->orWhere('name','like','%'.$this->search.'%')
                ->orWhere('range','like','%'.$this->search.'%')
                ->orWhere('cellular','like','%'.$this->search.'%')
                ->paginate(10);
        }else{
            $persons = User::paginate(10);
        }
        return view('livewire.staff-table',compact(['persons']));
    }

    public function syncStaff(){
        $client = new Client();
        try{
            $response = $client->get('http://localhost:9000/api/staff');
            if($response->getStatusCode() == 200){
                $json = json_decode($response->getBody(),true);
                $list = [];
                foreach ($json as $obj) {
                    $list [] = [
                        'ci' => $obj['ci'],
                        'username' => $obj['name'].$obj['ci'],
                        'password' => '12345678',
                        'surname' => $obj['surname'],
                        'name' => $obj['name'],
                        'cellular' => $obj['cellular'],
                        'range' => $obj['range']

                    ];
                }
                User::upsert($list,['ci','username'],['cellular','range']);
            }
        }catch(Exception $error){
            return dd($error);
        }
    }

    public function getPerson($id){
        $this->dispatch('get',$id);
    }
}
