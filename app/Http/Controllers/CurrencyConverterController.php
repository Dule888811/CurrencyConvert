<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CurrencyConverterController
{
    public function convert(Request $request) : JsonResponse
    {
       $response = Http::withHeaders(
            ['X-RapidAPI-Host' => 'currency-converter5.p.rapidapi.com',
            'X-RapidAPI-Key' => '549f710fa6mshbf4b95a87de28c8p132786jsn64590970fc3b'])->get('https://currency-converter5.p.rapidapi.com/currency/convert',$request);
        if($response->failed())
        {
            throw new \RuntimeException('failed to convert',$response->status());
        }

        $amount =  $response->json('rates.' . $request['to'] . '.rate_for_amount');
        return response()->json(['amount' => $amount]);
    }
}
