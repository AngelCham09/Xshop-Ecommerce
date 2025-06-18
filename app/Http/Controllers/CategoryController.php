<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        // Apply filters
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $categories = $query->paginate(10);
        // Logic to retrieve and display brands
        return Inertia::render('Admin/Category/index', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Category::create($attributes);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category->update($attributes);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }
}
