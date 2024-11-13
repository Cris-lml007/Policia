<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    use HasFactory;

    public $fillable = [
        'name'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function name():Attribute{
        return Attribute::make(
            set: fn($value) => strtoupper($value),
            get: fn($value) => ucwords($value)
        );
    }
}
