<?php

namespace App\Livewire;

use App\Models\GroupService;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
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
        if(!empty($this->search)){
            $persons = User::where('surname','like','%'.$this->search.'%')
                ->orWhere('name','like','%'.$this->search.'%')
                ->orWhere('range','like','%'.$this->search.'%')
                ->orWhere('cellular','like','%'.$this->search.'%')
                ->where('role','!=',0)
                ->paginate(10);
        }else{
            $persons = User::where('role','!=',0)->paginate(10);
        }
        return view('livewire.staff-table',compact(['persons']));
    }

    public function syncStaff(){
        $client = new Client();
        $ip =env('IP_SERVICE','localhost:8000');
        try{
            $response = $client->get("http://$ip/server/auxi/public/api/staff");
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
        }catch(Exception $error){
            $this->message = -1;
        }
    }

    public function getPerson($id){
        $this->dispatch('get',$id);
    }
}
