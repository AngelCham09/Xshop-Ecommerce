<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductListController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'brand', 'product_images')->where('published', 1);
        $filterProducts = $products->filtered()->paginate(9)->withQueryString();

        $categories = Category::get();
        $brands = Brand::get();

        return Inertia::render('User/ProductList', [
            'products' => ProductResource::collection($filterProducts),
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'product_images']);

        return Inertia::render('User/ProductDetail', [
            'product' => new ProductResource($product),
        ]);
    }
}
