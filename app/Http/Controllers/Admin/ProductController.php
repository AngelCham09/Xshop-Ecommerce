<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return Inertia::render('Admin/Product/index', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'title' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'description' => ['nullable'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'product_images' => ['required', File::types(['png', 'jpg', 'webp'])],
        ]);

        $product = Product::create(
            $attributes
        );

        $productImages = $request->file('product_images');
        foreach ($productImages as $image) {
            $imageName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->save('product_images', $imageName);

            ProductImage::create([
                'product_id' => $product->id,
                'image' => 'product_images/' . $imageName,
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');

    }
}