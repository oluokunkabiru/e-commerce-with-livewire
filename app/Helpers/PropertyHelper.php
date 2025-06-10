<?php

use App\Models\Country;
use App\Models\MyShop;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;

if (!function_exists('settings')) {

    /**
     * description
     *
     * @param
     * @return
     */



    function settings()
    {
        $settings =  MyShop::first();
        return $settings;


    }
}
if (!function_exists('CurrencyRate')) {

    /**
     * description
     *
     * @param
     * @return
     */



    function CurrencyRate()
    {


        $client = new Client();
        try {

            $response = $client->get("https://api.flutterwave.com/v3/transfers/rates", [

                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '. env('FLUTTERWAVE_SECRET_KEY')
                ],
                'query' => [
                    'destination_currency' =>'NGN',
                    'source_currency' => Country()->currency,
                    'amount' => 1,
                ]
            ]);



                $data = $response->getBody()->getContents();

                // return $data;
                $tData = (json_decode($data, TRUE));
                if($tData['status']=="success"){
                    $prince = $tData['data'];
                    $rate= $prince['rate'];
                    // info($rate);

                    Session::put('rate', $rate);
                    // return $rate;
                }

                // info(['Data'=>$tData]);

                // print_r($tData);
                // return $tData;

            } catch (RequestException $e) {
                if ($e->hasResponse()) {
                    // RequestException with response
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = $e->getResponse()->getBody()->getContents();
                    $errorMessage = json_decode($errorMessage, TRUE);
                    $errorMessage = $errorMessage['message'];
                    Log::error($errorMessage);
                    // $errorMessage = $errorMessage['description'];
                } else {
                    // RequestException without response (e.g., connection error)
                    $statusCode = 500;

                    $errorMessage = 'Could not connect to the server, .';
                    Session::put('rate', 1);


                }

                // Create the JSON response
                // return 1;

                // return response()->json(['status'=>'failed','error' => $errorMessage], $statusCode);
            } catch (ConnectException $e) {
                // ConnectException (connection error)
                $statusCode = 500;
                $errorMessage = 'Could not connect to the server, Kindly chack your connection.';
                // return "Nara";
                // return 1;
                Session::put('rate', 1);


                // Create the JSON response
                // return response()->json(['status'=>'failed','error' => $errorMessage], $statusCode);
            }

    }











}




if (!function_exists('Country')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function Country()
    {
        $ip = env('APP_DEBUG') ? '149.102.229.247':request()->ip();
        $location= Stevebauman\Location\Facades\Location::get($ip);
        $country = Country::where('name', $location->countryName)->first();
        return $country;


    }

}



