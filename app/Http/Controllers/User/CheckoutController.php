<?php

namespace App\Http\Controllers\User;

use App\Helper\Cart;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
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
        return Inertia::render('User/Checkout');
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $carts = $request->carts;
        $products = $request->products;

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

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);

        $newAddress = $request->address;
        if($newAddress['address'] != null){
            $address = UserAddress::where('isMain', 1)->count();
            if($address > 0 ){
                $address = UserAddress::where('isMain', 1)->update(['isMain' => 0]);
            }

            $address = new UserAddress();
            $address->address1 = $newAddress['address'];
            $address->type = $newAddress['type'];
            $address->city = $newAddress['city'];
            $address->state = $newAddress['state'];
            $address->postcode = $newAddress['postcode'];
            $address->country_code = $newAddress['country'];
            $address->user_id = Auth::user()->id;
            $address->save();

        }

        $mainAddress = $user->user_address()->where('isMain', 1)->first();
        if($mainAddress){
            $order = new Order();
            $order->status = 'unpaid';
            $order->total_price = $request->total;
            $order->session_id = $checkout_session->id;
            $order->user_address_id = $mainAddress->id;
            $order->created_by = $user->id;
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

            return redirect()->route('dashboard');

        }catch(\Exception $e){
            throw new NotFoundHttpException();
        }
    }
}
