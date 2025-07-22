<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'model',
        'license_plate',
        'vin',
        'year',
        'measurement_type',
        'last_recorded',
        'next_service_at',
        'last_service_at',
        'last_service_record',
        'active',
    ];
}
