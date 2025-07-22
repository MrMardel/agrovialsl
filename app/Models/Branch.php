<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'slug',
        'address',
        'city',
        'province',
        'country',
        'postal_code',
        'latitude',
        'longitude',
        'is_active',
    ];

    /**
     * Relación: una sucursal tiene muchos productos
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
