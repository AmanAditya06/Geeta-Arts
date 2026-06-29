<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeCarouselimages;
use Illuminate\Http\Request;

class AdminCarouselController extends AdminController
{
    public function index()
    {
        $carousels = HomeCarouselimages::orderBy('sort_order')->get();
        return view('admin.carousels.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousels.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'page_slug' => 'required|string|max:100',
            'section_key' => 'required|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = $request->has('status');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/carousels'), $filename);
            $data['image'] = 'carousels/' . $filename;
        }

        HomeCarouselimages::create($data);

        return redirect()->route('admin.carousels.index')->with('success', 'Carousel image created successfully.');
    }

    public function edit(HomeCarouselimages $carousel)
    {
        return view('admin.carousels.form', compact('carousel'));
    }

    public function update(Request $request, HomeCarouselimages $carousel)
    {
        $data = $request->validate([
            'page_slug' => 'required|string|max:100',
            'section_key' => 'required|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = $request->has('status');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/carousels'), $filename);
            $data['image'] = 'carousels/' . $filename;
        }

        $carousel->update($data);

        return redirect()->route('admin.carousels.index')->with('success', 'Carousel image updated successfully.');
    }

    public function destroy(HomeCarouselimages $carousel)
    {
        $carousel->delete();
        return redirect()->route('admin.carousels.index')->with('success', 'Carousel image deleted successfully.');
    }
}
