<?php

namespace App\Http\Controllers\User;

use App\Services\HeroBannerService;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\HeroBanner;

use function Laravel\Prompts\table;

class ProductController extends Controller
{


    public function category($slug)
    {
        // dd($slug);
        // 1️ Category
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // 2️ Banner
        $hero = HeroBannerService::getCategory($slug);

        // 3️ Products (relation use)
        $groupedProducts = $category->products()
            ->where('status', 1)
            ->get()
            ->groupBy('type');

        return view('pages.category', compact(
            'category',
            'hero',
            'groupedProducts'
        ));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        return view('pages.single-product', compact('product'));
    }


}
