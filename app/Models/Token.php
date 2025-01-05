<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    public $fillable = [
        'detail_service_id',
        'token'
    ];

    public function detailService(){
        return $this->belongsTo(DetailService::class);
    }
}
