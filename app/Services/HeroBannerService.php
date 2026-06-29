<?php

namespace App\Services;

use App\Models\HeroBanner;

class HeroBannerService
{
    public static function getPage($slug)
    {
        return HeroBanner::where([
            'ref_type' => 'page',
            'ref_slug' => $slug,
            'status'   => 1
        ])->first();
    }

    public static function getCategory($slug)
    {
        return HeroBanner::where([
            'ref_type' => 'category',
            'ref_slug' => $slug,
            'status'   => 1
        ])->first();
    }
}
