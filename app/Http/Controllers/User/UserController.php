<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::with(['brand', 'category', 'product_images'])->orderBy('id', 'desc')->limit(6)->get();

        return Inertia::render('User/Index', [
            'products' => $products,
            'canLogin' => app('router')->has('login'),
            'canRegister' => app('router')->has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function about()
    {
        return Inertia::render('User/About');
    }

    public function contact()
    {
        return Inertia::render('User/ContactUs');
    }

    public function privacy()
    {
        return Inertia::render('User/Privacy');
    }

    public function terms()
    {
        return Inertia::render('User/TermsConditions');
    }
}
