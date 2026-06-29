<?php 


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeCarouselimages extends Model
{
    protected $table = 'home_carousel_images';
    protected $fillable = [
        'page_slug',
        'section_key',
        'image',
        'sort_order',
        'status'
    ];
}

?>