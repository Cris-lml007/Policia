<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupService extends Model
{
    use HasFactory;
    public $fillable = [
        'service_id',
        'supervisor_id',
        'lat',
        'long',
        'user_id'
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function detService(){
        return $this->hasOne(DetService::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
