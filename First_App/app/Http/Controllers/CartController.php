<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Log;
use Mailgun\Mailgun;
use Mailgun\HttpClient\HttpClientConfigurator;
use App\Mail\CustomMail;
use Illuminate\Support\Facades\Mail;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;
use UnexpectedValueException;

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

        $id = auth()->user()->id;
        $cartModel = new Cart();
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $endpoint_secret = 'whsec_e7ed0a9ae1884a880bc145a251a86111e3d5f1dd092e1db5b52b7a0a444e5c12';
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $event = null;
        try {
            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (UnexpectedValueException $e) {
            // Invalid payload
            Log::error('Invalid payload');
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (SignatureVerificationException $e) {
            // Invalid signature
            Log::error('Invalid signature');
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                $cartModel->deleteUserCart($id);
                $paymentIntent = $event->data->object;
                $name = $paymentIntent['customer_details']['name'];
                $c_id = $paymentIntent['id'];
                $products = $stripe->checkout->sessions->allLineItems($c_id)['data'];

                $total = 0;
                foreach ($products as $item){
                    $price = $item['amount_total'] / 100;
                    $total = $total + $price;
                }

                Mail::to('wonghouyee@moneymatch.co')->send(new CustomMail($name,$products,$total));
                
                break;
            default:
                Log::info('Received unknown event type ' . $event->type);
                return response()->json(['message' => 'Received unknown event type ' . $event->type]);
        }

    }
}
