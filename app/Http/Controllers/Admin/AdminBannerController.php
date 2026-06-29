<?php

namespace App\Http\Controllers\Admin;

use App\Models\HeroBanner;
use Illuminate\Http\Request;

class AdminBannerController extends AdminController
{
    public function index()
    {
        $banners = HeroBanner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ref_type' => 'required|in:page,category',
            'ref_slug' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/banners'), $filename);
            $data['image'] = 'banners/' . $filename;
        }

        HeroBanner::create($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(HeroBanner $banner)
    {
        return view('admin.banners.form', compact('banner'));
    }

    public function update(Request $request, HeroBanner $banner)
    {
        $data = $request->validate([
            'ref_type' => 'required|in:page,category',
            'ref_slug' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/banners'), $filename);
            $data['image'] = 'banners/' . $filename;
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(HeroBanner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }
}
