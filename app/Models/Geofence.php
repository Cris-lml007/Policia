<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geofence extends Model
{
    use HasFactory;

    public $fillable = [
        'group_service_id',
        'points'
    ];

    public function groupService(){
        return $this->belongsTo(GroupService::class);
    }
}
