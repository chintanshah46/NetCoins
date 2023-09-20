<?php

namespace App\Http\Controllers;

use Exception;
use Ramsey\Uuid\Uuid;
use App\Models\Trades;
use App\Models\TradeDetails;
use App\StoreTrade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class TradeController extends Controller
{

    public function store(StoreTrade $storeTrade, Request $request){

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
            
            $respone = $storeTrade->storeTradeAndDetails($request);

            return response()->json(['status'=>200, 'message'=> 'The requested trade created successfully!', 'data'=>$respone]);


        } catch (Exception $e){
            Log::error('Faied', ['message'=>$e->getMessage(), 'stackTrace'=>$e->getTraceAsString()]);
            return response()->json(['status'=>500, 'message'=> 'Failed to create the trade', 'errorMessage'=>$e->getMessage()]);
        }
        
    }

}
