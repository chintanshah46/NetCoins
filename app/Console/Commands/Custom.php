<?php 

namespace App\Console\Commands;

use App\Models\Trades;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class custom extends Command {

    protected $signature = 'test';

    public function handle (){
        // $requestData = [
        //     'ids' => 'bitcoin',
        //     'vs_currencies' => 'cad'
        // ];

        // $api_url = "https://api.coingecko.com/api/v3/simple/price";


        // // $response = Http::withUrlParameters($requestData)->get($api_url);

        // $response = Http::get($api_url, $requestData);

        // $data = $response->json();

        

        // dd($data['bitcoin']['cad']);

        $respone = Trades::find(18);
        // dd($respone->tradeDetails());

        // dd(config('app.coingeco_api_url'));
        $tradeArray = ['litecoin','bitcoin','ethereum'];

        dd($tradeArray[array_rand($tradeArray)]);
    }
    
}
