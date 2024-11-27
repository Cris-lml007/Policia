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
        'user_ci'
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function detailService(){
        return $this->hasMany(DetailService::class);
    }

    public function supervisor(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
