<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupService extends Model
{
    use HasFactory;
    public $fillable = [
        'group_service_id',
        'user_id',
        'service_id',
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function detailService(){
        return $this->hasOne(DetailService::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
