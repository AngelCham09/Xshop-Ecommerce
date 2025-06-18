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
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'category', 'product_images']);

        // Apply filters
        if ($request->has('inStock')) {
            $query->where('inStock', $request->inStock);
        }

        if ($request->has('published')) {
            $query->where('published', $request->published);
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(10);
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
            'category_id' => ['nullable'],
            'brand_id' => ['nullable'],
            'product_images.*' => ['nullable', File::types(['png', 'jpg', 'webp'])],
        ]);

        $attributes['created_by'] = auth()->user()->id;
        $attributes['inStock'] = 1;
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

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $attributes = request()->validate([
            'title' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'description' => ['nullable'],
            'category_id' => ['nullable'],
            'brand_id' => ['nullable'],
            'product_images.*' => ['nullable', File::types(['png', 'jpg', 'webp'])],
        ]);

        $attributes['updated_by'] = auth()->user()->id;
        if ($request->has('product_images')) {

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

        $product->fill($attributes);
        $product->save();
        return redirect()->back()->with('success', 'Product updated successfully');

    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->deleted_by = auth()->user()->id;
        $product->save();
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function updateStockStatus(Request $request, $id)
    {
        $request->validate([
            'inStock' => 'required|boolean',
        ]);
        $product = Product::findOrFail($id);
        $product->inStock = $request->inStock;
        $product->save();

        return redirect()->back()->with('success', 'Product stock status updated successfully');
    }

    public function updatePublishedStatus(Request $request, $id)
    {
        $request->validate([
            'published' => 'required|boolean',
        ]);
        $product = Product::findOrFail($id);
        $product->published = $request->published;
        $product->save();

        return redirect()->back()->with('success', 'Product published status updated successfully');
    }
}
