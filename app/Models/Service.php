<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $fillable = [
        'cod',
        'title',
        'date',
        'status',
        'lat',
        'long'
    ];

    public function groupService(){
        return $this->hasMany(GroupService::class);
    }

    public function detailService(){
        return $this->hasMany(DetailService::class);
    }
}
