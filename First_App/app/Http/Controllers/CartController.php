<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    
    public function addCart(Request $request){
        $input = $request->all();
        $user_id = auth()->user()->id;
        $input['user_id'] = $user_id;

        $cartModel = new Cart();
        $result = $cartModel->sameProduct($input['user_id'],$input['product_id']);
        if ($result->isEmpty()){
            Cart::create($input);
        }else{
            $existingCart = $result ->first();
            $existingCart->update($input);
        }
       
        return redirect()->route('user')->with('success', 'Item added to cart successfully');
    }

    public function getCarts(){
        $id = auth()->user()->id;
        $carts = Cart::with('getProduct')->where('user_id',$id)->get();
        if (!$carts->isEmpty()){
            $results = $carts->all();
            return view('cart',["items" => $results]);
        }
        return view('cart',["items" => collect()]);
    }

    public function deleteCart(Cart $cart){
        $cart->delete();
        return redirect()->route('cart')->with('success', 'Remove item from cart successfully');
    }

    public function updateCart(Request $request, Cart $cart){
        $field = $request->all();
        $quantity = $cart->quantity;

        if(array_key_exists("decrease",$field)){
            $cart->quantity = $quantity - 1;
        }else{
            $cart->quantity = $quantity + 1;
        }

        if($cart->save()){
            return redirect()->route('cart')->with('success', 'Update Quantity from cart successfully');
        };
    }

    public function checkout(Request $request){
        $cart_data = $request->input('cartData');
        
        $cartData = json_decode($cart_data);
        
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
    
        $lineItems = [];

        foreach($cartData as $cart){
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'myr', 
                    'product_data' => [
                        'name' => $cart->get_product->title, 
                        
                    ],
                    'unit_amount' => $cart->get_product->price * 100,
                ],
                'quantity' => (int)$cart->quantity,
            ];
        };

        try{
            $session = $stripe->checkout->sessions->create([
                'payment_method_types' => ["card"],
                'success_url' => url("/success?session_id={CHECKOUT_SESSION_ID}"),
                'cancel_url' => url("/failed"),
                'line_items' => $lineItems,
                'mode' => 'payment',
            ]);

        }catch (Exception $e){
            throw $e;
        }
       

        return redirect()->to($session->url);
    }

    public function handleSuccess(){
        $sessionId = request('session_id');
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        $session = $stripe->checkout->sessions->retrieve($sessionId);
        
        return view('success',['details' => $session->customer_details]);
        
        
    }

    public function handleWebhook(Request $request){
        
        Log::error('Webhook request:', ['request' => $request->all()]);

        // Pass the request data to the view
        $requestData = [
            'headers' => $request->header(),
            'body' => $request->getContent(),
        ];

        return view('test', ["requestData" => $requestData]);
    }
}
