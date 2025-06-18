<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $query = Brand::query();

        // Apply filters
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $brands = $query->paginate(10);
        // Logic to retrieve and display brands
        return Inertia::render('Admin/Brand/index', [
            'brands' => $brands,
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Brand::create($attributes);

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $brand->update($attributes);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }
}
