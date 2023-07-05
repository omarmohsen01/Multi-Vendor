<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Throwable;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order=$event->order;
        try{
            foreach($order->products as $product)
            {
                $product->decrement('quantity',$product->quantity);
                // Product::where('id','=',$order->product_id)
                //     ->update([
                //         'quantity'=>DB::raw('quantity - '.$product->quantity)
                //     ]);
            }
        }catch(Throwable $e){
            
        }
    }
}