<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\User;
use Illuminate\Support\Str;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function checkout($productId)
    {        

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $product = Product::findOrFail($productId);
            if (!Auth::check()) {
                $user = User::create([
                    'name' => 'Guest ' . Str::random(8), 
                    'email' => 'guest' . Str::random(8) . '@example.com', 
                    'password' => bcrypt(Str::random(16)),
                ]);
    
                Auth::login($user);
            }
            $user = Auth::user();
            if (!$user->stripe_id) {
                $user->createAsStripeCustomer();
            }
    
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'inr',
                            'product_data' => [
                                'name' => $product->name,
                                'description' => $product->description,
                            ],
                            'unit_amount' => $product->price * 100, 
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('payment.success', ['productId' => $product->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('products.show', ['id' => $product->id]), 
                'customer' => $user->stripe_id,
                'metadata' => [
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                ],
            ]);

            return redirect($session->url);

        } catch (\Exception $e) {
            return back()->with('error_message', 'Error while creating Stripe session: ' . $e->getMessage());
        }
    }


    public function success(Request $request, $productId)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session_id = $request->query('session_id');
        $session = \Stripe\Checkout\Session::retrieve($session_id);
        if ($session->payment_status == 'paid') {
            $product = Product::findOrFail($productId);
            return view('products.payment-success', [
                'product' => $product,
            ]);
        }
        return redirect()->route('payment.cancel');

    }

    public function cancel(Request $request)
    {
        $product = Product::findOrFail($request->id);
        return view('products.payment-cancel', compact('product'));
    }
}

