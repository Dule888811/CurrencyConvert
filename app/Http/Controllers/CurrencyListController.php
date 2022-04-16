<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument;

class CurrencyListController extends Controller
{
        public function currencyList() : View
        {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://currency-converter5.p.rapidapi.com/currency/list",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: currency-converter5.p.rapidapi.com",
                    "X-RapidAPI-Key: 549f710fa6mshbf4b95a87de28c8p132786jsn64590970fc3b"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            }
                $currencies = explode(',',$response);
                for($i=1;$i<count($currencies) - 1;$i++)
                {
                    if(is_string($currencies[$i]))
                    {
                        $currenciesConvert[] =  explode(':',$currencies[$i]);
                     $currency[] =   substr($currenciesConvert[$i - 1][0], 1, -1);
                    }


                }

                return view('welcome',['currency'=> $currency]) ;



        }

}
