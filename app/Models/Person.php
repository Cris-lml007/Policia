<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    public $fillable = [
        'ci',
        'surname',
        'name',
        'range_id',
        'position',
        'department_id',
        'birthdate',
        'cellular',
        'observation',
        'gender'
    ];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function range(){
        return $this->belongsTo(Range::class);
    }

    public function getRangeAttribute(){
        return $this->belongsTo(Range::class)->first()->name ?? '';
    }

    // public function department(){
    //     return $this->belongsTo()
    // }
}
