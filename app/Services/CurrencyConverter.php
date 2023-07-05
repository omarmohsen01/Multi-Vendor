<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter{
    private $apiKey;
    protected $baseUrl='https://free.currencyconverterapi.com/api/v7';

    public function __construct(string $apiKey)
    {
        $this->apiKey=$apiKey;
    }
    
    public function convert(string $from,string $to,float $amount=1) : float
    {
        $q="{$from}_{$to}";
        $response=Http::baseUrl($this->baseUrl)
            ->get('/convert',[
                'q'=>$q,
                'compact'=>'y',
                'apiKey'=>$this->apiKey,
            ]);
        $resualt=$response->json();
        return $resualt[$q]*$amount;
    }
}