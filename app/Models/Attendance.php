<?php

namespace App\Models;

use App\Enums\Type as EnumsType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public $fillable = [
        'detail_service_id',
        'type',
        'latitude',
        'longitude'
    ];

    public function detailService(){
        return $this->belongsTo(DetailService::class);
    }

    protected function cast(): array{
        return [
            'type' => EnumsType::class
        ];
    }
}
