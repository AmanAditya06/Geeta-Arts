<?php

namespace App\Http\Controllers\Admin;

use App\Models\PageContent;
use Illuminate\Http\Request;

class AdminPageContentController extends AdminController
{
    public function index()
    {
        $contents = PageContent::orderBy('page_slug')->orderBy('section_key')->get();
        return view('admin.page-contents.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.page-contents.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'page_slug' => 'required|string|max:100',
            'section_key' => 'required|string|max:100',
            'label' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/page-contents'), $filename);
            $data['image'] = 'page-contents/' . $filename;
        }

        PageContent::create($data);

        return redirect()->route('admin.page-contents.index')->with('success', 'Page content created successfully.');
    }

    public function edit(PageContent $pageContent)
    {
        return view('admin.page-contents.form', compact('pageContent'));
    }

    public function update(Request $request, PageContent $pageContent)
    {
        $data = $request->validate([
            'page_slug' => 'required|string|max:100',
            'section_key' => 'required|string|max:100',
            'label' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/page-contents'), $filename);
            $data['image'] = 'page-contents/' . $filename;
        }

        $pageContent->update($data);

        return redirect()->route('admin.page-contents.index')->with('success', 'Page content updated successfully.');
    }

    public function destroy(PageContent $pageContent)
    {
        $pageContent->delete();
        return redirect()->route('admin.page-contents.index')->with('success', 'Page content deleted successfully.');
    }
}
