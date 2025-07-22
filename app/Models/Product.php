<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'sku',
        'name',
        'description',
        'cost_price',
        'resale_price',
        'final_price',
        'stock',
        'warehouse_location',
        'branch_id',
        'category_id',
        'brand_id',
        'type',
        'is_public',
        'published_at',
        'tags',
        'barcode',
    ];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'resale_price' => 'decimal:2',
        'final_price' => 'decimal:2',
        'published_at' => 'datetime',
        'is_public' => 'boolean',
        'tags' => 'array',
    ];

    /**
     * Relación: un producto pertenece a una sucursal
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Opcionales: relaciones a categoría y marca
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Scope para búsqueda simple por código, nombre o sku
     */
    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        $term = "%{$term}%";

        return $query->where(function ($q) use ($term) {
            $q->where('code', 'like', $term)
              ->orWhere('sku', 'like', $term)
              ->orWhere('name', 'like', $term);
        });
    }

    /**
     * Scope para filtrar por tipo
     */
    public function scopeType($query, ?string $type)
    {
        if (!$type) {
            return $query;
        }

        return $query->where('type', $type);
    }

    /**
     * Scope para filtrar solo productos públicos
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }
}
