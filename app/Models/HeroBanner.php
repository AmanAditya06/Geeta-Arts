<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model
{
    use HasFactory;

    protected $table = 'hero_banners';
    protected $fillable = [
        'ref_type',
        'ref_slug',
        'title',
        'subtitle',
        'image',
        'status',
    ];
}
