<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $table = 'page_contents';

    protected $fillable = [
        'page_slug',
        'section_key',
        'label',
        'title',
        'subtitle',
        'description',
        'image',
        'status'
    ];

    // protected $casts = [
    //     'description' => 'array'
    // ];


}
