<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Role;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ci',
        'surname',
        'name',
        'role',
        'username',
        'password',
        'range',
        'cellular'
    ];

    public function groupServices(){
        // return $this->hasMany(DetailService::class);
        return $this->hasMany(GroupService::class);
    }

    public function detailService(){
        return $this->hasMany(DetailService::class,'user_ci','ci');
    }

    public static function createForAPI($ci){
        try{
            if(!User::where('ci',$ci)->exists()){
                $client = new Client();
                $response = $client->get(env('API_STAFF').'/'.$ci);
                if($response->getStatusCode() == 200){
                    $obj = json_decode($response->getBody(),true);
                    $username = strtolower(substr($obj['name'],0,3).substr($obj['surname'],0,3)).$obj['ci'];
                    User::create([
                        'ci' => $ci,
                        'username' => $username,
                        'password' => bcrypt('12345678'),
                        'surname' => $obj['surname'],
                        'name' => $obj['name'],
                        'cellular' => $obj['cellular'],
                        'range' => $obj['range']
                    ]);
                    return true;
                }
                return false;
            }
            return true;

        }catch(Exception){
            return false;
        }
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role' => Role::class,
            'email_verified_at' => 'datetime',
            'password' => 'hashed'
        ];
    }
}
