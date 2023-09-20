<?php

namespace App\Http\Controllers;

use Exception;
use Ramsey\Uuid\Uuid;
use App\Models\Trades;
use App\Models\TradeDetails;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class TradeController extends Controller
{

    public function store(Request $request){

        try {

            $rules = [
                'directions' => ['required', Rule::in('buy','sell')],
                'user_name' => 'required|string',
                'notes' => 'required|string',
                'currency' => ['required', Rule::in('cad')],
                'quantity' => 'required|integer',
            ];

            $validator = Validator::make($request->all(), $rules);
            
            if ($validator->fails()) {
                return response()->json('Bad request. The standard option for requests that fail to pass validation.', 400);
            }

            $apiResponse = $this->getCost();

            if ( $apiResponse === false ){
                return response()->json('Bad request. Request to CoinGecko\s Api failed!.', 400);
            }

            if ( $apiResponse->failed() || $apiResponse->clientError() ){
                return response()->json('Bad request. Request to CoinGecko\s Api failed!.', 400);
            } else if ( $apiResponse->successful()  ){
                $apiData = $apiResponse->json();
            }
                
            $trade = Trades::Create([
                'uuid' => $this->generateUUID(),
                'directions' => $request['directions'],
                'cost' => $apiData['bitcoin']['cad'],
                'quantity' => $request['quantity'],
                'user_name' => $request['user_name'],
                'notes' => $request['notes'],
            ]);

            $totalAmount = ( $request['quantity'] * $apiData['bitcoin']['cad'] );

            $trade->tradeDetails()->create([
                    'amount' => $totalAmount,
                    'currency' => 'cad'
            ]);

            $respone = Trades::find($trade->id);
            $respone['trade_details'] = $respone->tradeDetails;

            return response()->json(['status'=>200, 'message'=> 'The requested trade created successfully!', 'data'=>$respone]);


        } catch (Exception $e){
            Log::error('Faied', ['message'=>$e->getMessage(), 'stackTrace'=>$e->getTraceAsString()]);
            return response()->json(['status'=>500, 'message'=> 'Failed to create the trade', 'errorMessage'=>$e->getMessage()]);
        }
        

    }

    private function generateUUID(){
        return Uuid::uuid4()->toString();
    }

    private function getCost(){

        try {

            $requestData = [
                'ids' => 'bitcoin',
                'vs_currencies' => 'cad'
            ];
            $api_url = "https://api.coingecko.com/api/v3/simple/price";

            return Http::get($api_url, $requestData);
        } catch (Exception $e){
            Log::error('Faied', ['message'=>$e->getMessage(), 'stackTrace'=>$e->getTraceAsString()]);
            return false;
        }
    }

}
