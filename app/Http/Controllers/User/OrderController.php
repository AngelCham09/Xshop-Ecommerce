<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('order_items.product.product_images')->where('created_by', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return Inertia::render('User/Profile/Order/Index', [
            'orders' => OrderResource::collection($orders),
        ]);
    }
}
