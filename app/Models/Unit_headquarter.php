<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit_headquarter extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'unit_id',
        'latitude',
        'longitude',
        'birthdate',
        'inCharge',
    ];
}
