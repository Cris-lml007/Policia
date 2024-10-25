<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    use HasFactory;

    public $fillable = [
        'name'
    ];

    public function persons(){
        return $this->hasMany(Person::class);
    }
}
