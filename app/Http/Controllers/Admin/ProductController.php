<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['brand', 'category', 'product_images'])->get();
        $brands = Brand::get();
        $categories = Category::get();

        return Inertia::render('Admin/Product/index', [
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories
        ]);
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
            'product_images.*' => ['nullable', File::types(['png', 'jpg', 'webp'])],
        ]);

        $product = Product::create(
            $attributes
        );

        if($request->has('product_images'))
        {

            $productImages = $request->file('product_images');
            foreach ($productImages as $image) {

                $imageName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                // Store the image in the 'product_images' directory in the 'public' disk
                $image->storeAs('product_images', $imageName, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'product_images/' . $imageName,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');

    }

    public function deleteImage($id)
    {
        $image = ProductImage::where('id', $id)->delete();

        return redirect()->route('admin.products.index')->with('success', 'Image deleted successfully');
    }
}
