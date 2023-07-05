<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CurrencyConverterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'currency_code'=>'required|string|size:3'
        ]);
        $baseCurrencyCode=config('app.currency');
        $currencyCode=$request->input('currency_code');
        $cacheKey='currency_rate_'.$currencyCode;        
        
        $rate=Cache::get($cacheKey,0);
        
        if(!$rate){
            $converter=new CurrencyConverter(config('services.currency_converter.api_key'));
            $rate=$converter->convert($baseCurrencyCode,$currencyCode);
            
            Cache::put($cacheKey,$rate,now()->addMinute(60));

        }

        Session::put('currency_rates',$currencyCode);

        return redirect()->back();
    }
}