<?php

namespace App;

use Exception;
use App\Models\Trades;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class StoreTrade {

    private $cost;
    private $currency;
    private $crypto_coins;

    public function __construct()
    {
        $this->getCostThroughApi();
    }

    public function storeTradeAndDetails($request){

        try{

            $trade = Trades::Create([
                'uuid' => Helper::generateUUID(),
                'directions' => $request['directions'],
                'cost' => $this->cost,
                'quantity' => $request['quantity'],
                'user_name' => $request['user_name'],
                'notes' => $request['notes'],
            ]);
    
            $totalAmount = ( $request['quantity'] * $this->cost );
    
            $trade->tradeDetails()->create([
                    'crypto_coins' => $this->crypto_coins,
                    'amount' => $totalAmount,
                    'currency' => $this->currency
            ]);

            return $this->getRecentlyCreatedTradeAndDetails($trade->id);

        } catch (Exception $e){
            Log::error('Faied: StoreTrade->storeTradeAndDetails', ['message'=>$e->getMessage(), 'stackTrace'=>$e->getTraceAsString()]);
            return false;
        }

    }

    private function getRecentlyCreatedTradeAndDetails($id){
        $respone = Trades::find($id);
        $respone['trade_details'] = $respone->tradeDetails;

        return $respone;
    }

    private function getCostThroughApi(){

        try {

            $tradeArray = ['litecoin','bitcoin','ethereum'];

            $requestData = [
                'ids' => $tradeArray[array_rand($tradeArray)],
                'vs_currencies' => 'cad'
            ];
            $this->currency = $requestData['vs_currencies'];
            $this->crypto_coins = $requestData['ids'];

            $api_url = config('app.coingeco_api_url')."/simple/price";

            $apiResponse = Http::get($api_url, $requestData);
            if ( $apiResponse->successful()  ){
                $apiData = $apiResponse->json();
                $this->cost = $apiData[$requestData['ids']][$requestData['vs_currencies']];
            } else {
                $this->cost = 0;
            }

        } catch (Exception $e){
            Log::error('Faied: StoreTrade->getCost', ['message'=>$e->getMessage(), 'stackTrace'=>$e->getTraceAsString()]);
            return false;
        }
    }
    
}