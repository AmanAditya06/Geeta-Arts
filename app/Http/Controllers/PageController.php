<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use App\Models\Category;
use App\Models\PageContent;
use App\Models\HomeCarouselimages;
use App\Services\HeroBannerService;

class PageController extends Controller
{

    // 🔹 HOME PAGE
    public function index()
    {
        $sliders = HomeSlider::where('status',1)
            ->orderBy('sort_order')
            ->get();
        $carousel = HomeCarouselimages::where('page_slug', 'home')
            ->where('section_key', 'home_carousel_images')
            ->where('status', 1)
            ->orderBy('sort_order')
            ->get();
        
        $categories = Category::where('status',1)->get();

        $contents = PageContent::where('page_slug','home')
            ->get()
            ->keyBy('section_key');

        return view('pages.index', compact(
            'sliders',
            'categories',
            'contents',
            'carousel'
        ));
    }

    // 🔹 ABOUT PAGE
    public function about()
    {
        $hero = HeroBannerService::getPage('about');

        $contents = PageContent::where('page_slug','about')
            ->get()
            ->keyBy('section_key');

        return view('pages.about', compact(
            'hero',
            'contents'
        ));
    }

    // 🔹 CONTACT PAGE
    public function contact()
    {
        $hero = HeroBannerService::getPage('contact');

        $contents = PageContent::where('page_slug','contact')
            ->get()
            ->keyBy('section_key');

        return view('pages.contact', compact(
            'hero',
            'contents'
        ));
    }

    // 🔹 CUSTOMISATION PAGE
    public function customisation()
    {
        $hero = HeroBannerService::getPage('customisation');

        $contents = PageContent::where('page_slug','customisation')
            ->get()
            ->keyBy('section_key');

        return view('pages.customisation', compact(
            'hero',
            'contents'
        ));
    }

    // 🔹 CUSTOMER SERVICE
    public function customerservice()
    {
        $hero = HeroBannerService::getPage('customer-service');

        $contents = PageContent::where('page_slug','customer-service')
            ->get()
            ->keyBy('section_key');

        return view('pages.customerservice', compact(
            'hero',
            'contents'
        ));
    }
}
