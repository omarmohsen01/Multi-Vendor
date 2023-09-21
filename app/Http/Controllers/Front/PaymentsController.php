<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;


class PaymentsController extends Controller
{
    public function create(Order $order){
        return view('front.payment.create',[
            'order'=>$order
        ]);
    }

    public function createStripePaymentIntent(Order $order)
    {
        $amount=$order->items->sum(function($item){
            return $item->price * $item->quantity;
        });
        
        $stripe = new \Stripe\StripeClient(
            config('services.strip.secret_key')
        );
        $paymentIntent=$stripe->paymentIntents->create([
            'amount' => $order->total,
            'currency' => 'usd',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
        return [
            'clientSecret' => $paymentIntent->client_secret,
        ];
        
    }

    public function confirm(Request $request,Order $order)
    {
        dd($request->all());
    }
}