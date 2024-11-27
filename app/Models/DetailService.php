<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailService extends Model
{
    use HasFactory;
    public $fillable = [
        'group_service_id',
        'service_id',
        'user_id'
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function groupService(){
        return $this->hasOne(GroupService::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }
}
