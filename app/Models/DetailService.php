<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailService extends Model
{
    use HasFactory;
    public $fillable = [
        'title',
        'date',
        'status',
        'lat',
        'long'
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
}
