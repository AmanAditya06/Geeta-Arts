<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    
    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'type',
        'slug',
        'price',
        'stock',
        'is_featured',
        'image',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'stock' => 'integer',
        'price' => 'decimal:2',
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
