<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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

    public function DetailService(){
        return $this->hasMany(DetailService::class,'user_ci','ci');
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
