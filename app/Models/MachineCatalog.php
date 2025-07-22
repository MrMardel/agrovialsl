<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MachineCatalog extends Model
{
    protected $fillable = [
        'title',
        'brand',
        'model',
        'power_type',
        'condition',
        'year',
        'hours',
        'price',
        'location',
        'description',
        'technical_specs',
        'features',
        'maintenance',
        'attachments',
        'is_published',
        'published_at',
        'slug',
    ];

    protected $casts = [
        'technical_specs' => 'array',
        'features' => 'array',
        'maintenance' => 'array',
        'attachments' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
}
