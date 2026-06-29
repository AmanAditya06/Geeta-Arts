<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends AdminController
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'sku' => 'nullable|string|max:100',
            'type' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
        $data['status'] = $request->has('status');
        $data['is_featured'] = $request->has('is_featured');
        $data['stock'] = $data['stock'] ?? 0;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/Product-images'), $filename);
            $data['image'] = $filename;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'sku' => 'nullable|string|max:100',
            'type' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data['status'] = $request->has('status');
        $data['is_featured'] = $request->has('is_featured');
        $data['stock'] = $data['stock'] ?? 0;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/Product-images'), $filename);
            $data['image'] = $filename;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
