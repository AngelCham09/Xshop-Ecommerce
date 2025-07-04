<?php

namespace App\Http\Controllers\User;

use App\Helper\Cart;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckoutController extends Controller
{
    public function view()
    {
        $addresses = UserAddress::where('user_id', Auth::user()->id)->orderBy('isMain', 'desc')->get();
        $deliveryMethods = DeliveryMethod::orderBy('id', 'asc')->get();


        return Inertia::render('User/Checkout', [
            'addresses' => $addresses,
            'deliveryMethods' => $deliveryMethods,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|exists:user_addresses,id',
            'deliveryMethod' => 'required|exists:delivery_methods,id',
            'carts' => 'required|array',
            'products' => 'required|array',
            'total' => 'required|numeric',
        ]);

        $user = $request->user();
        $carts = $request->carts;
        $products = $request->products;
        $address = $request->address;
        $deliveryMethod = $request->deliveryMethod;

        $deliveryFees = DeliveryMethod::where('id', $deliveryMethod)->first()->price;

        $mergedData = [];

        foreach($carts as $cart)
        {
            foreach($products as $product)
            {
                if($cart['product_id'] == $product['id'])
                {
                    $mergedData[] = array_merge($cart, [
                        'title' => $product['title'],
                        'price' => $product['price'],
                    ]);
                }
            }
        }

        //stripe payment
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_KEY')
        );

        $lineItems= [];
        foreach($mergedData as $data)
        {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'sgd',
                    'product_data' => [
                        'name' => $data['title'],
                    ],
                    'unit_amount' => (int)($data['price'] * 100),
                ],
                'quantity' => $data['quantity'],
            ];
        }

        $lineItems[] = [
            'price_data' => [
                'currency' => 'sgd',
                'product_data' => [
                    'name' => 'Delivery Fee',
                ],
                'unit_amount' => (int)($deliveryFees * 100),
            ],
            'quantity' => 1,
        ];

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);

        if($address){
            $order = new Order();
            $order->status = 'unpaid';
            $order->total_price = $request->total + $deliveryFees;
            $order->session_id = $checkout_session->id;
            $order->user_address_id = $address;
            $order->created_by = $user->id;
            $order->delivery_method_id = $deliveryMethod;
            $order->save();
            $cartItems = CartItem::where('user_id', $user->id)->get();
            foreach($cartItems as $cartItem){
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'unit_price' => $cartItem->product->price,
                ]);
                $cartItem->delete();


                //Remove cartitem from cookies
                $cartItems = Cart::getCookieCartItems();
                foreach($cartItems as $item){
                    unset($item);
                }

                array_slice($cartItems, 0, count($cartItems));
                Cart::setCookieCartItems($cartItems);
            }


            //Payment
            $paymentData = [
                'order_id' => $order->id,
                'amount' => $order->total_price,
                'status' => 'pending',
                'type' => 'stripe',
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ];

            Payment::create($paymentData);
        }

        return Inertia::location($checkout_session->url);
    }

    public function success(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_KEY'));
        $sessionId = $request->get('session_id');

        try{
            $session = Session::retrieve($sessionId);
            if(!$session){
                throw new NotFoundHttpException();
            }
            $order = Order::where('session_id', $session->id)->first();
            if(!$order){
                throw new NotFoundHttpException();
            }

            if($order->status == 'unpaid'){
                $order->status = 'paid';
                $order->save();

                $order->payment()->update([
                    'status' => 'completed',
                ]);
            }

            return redirect()->route('home');

        }catch(\Exception $e){
            throw new NotFoundHttpException();
        }
    }
    public function cancel(Request $request)
    {

        return redirect()->route('home')->with('info', 'Payment was cancelled. You can try again.');
    }
}
