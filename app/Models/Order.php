<?php

namespace App\Models;

use Carbon\Carbon as CarbonCarbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'store_id','user_id','payment_method','status','payment_status'
    ];
    
    public function store()
    {
        return $this->belongsTo(Order::class,'store_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')
        ->withDefault(['name'=>'Guest Customer']);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'order_items','order_id','id','id')
            ->using(OrderItem::class)
            ->withPivot([
                'product_name','price','quantity','options'
            ]);
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class,'order_id','id')
            ->where('type','=','billing');
    } 

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class,'order_id','id')
            ->where('type','=','shipping');
    }
    
    public static function booted()
    {
        static::creating(function(Order $order){
            $order->number=Order::getNextOrderNymber() ;
        });
    }

    public static function getNextOrderNymber()
    {
        $year=Carbon::now()->year;
        $number=Order::whereYear('created_at',$year)->max('number');
        if($number)
        {
            return $number+1;
        }
        return $year.'0001';
    }
}