<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeSlider;
use Illuminate\Http\Request;

class AdminSliderController extends AdminController
{
    public function index()
    {
        $sliders = HomeSlider::orderBy('sort_order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = $request->has('status');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/sliders'), $filename);
            $data['image'] = 'sliders/' . $filename;
        }

        HomeSlider::create($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    public function edit(HomeSlider $slider)
    {
        return view('admin.sliders.form', compact('slider'));
    }

    public function update(Request $request, HomeSlider $slider)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = $request->has('status');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/sliders'), $filename);
            $data['image'] = 'sliders/' . $filename;
        }

        $slider->update($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(HomeSlider $slider)
    {
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully.');
    }
}
