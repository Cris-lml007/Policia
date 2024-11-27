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
        'user_ci'
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function groupService(){
        return $this->hasOne(GroupService::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'user_ci','ci');
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }
}
