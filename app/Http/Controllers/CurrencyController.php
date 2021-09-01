<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{

    public function convert(Request $request){
    	$input = $request->all();

        $URL = 'http://www.apilayer.net/api/live?access_key=99b49ac94265654845d6e0876a643f31&format=1';

        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        $data = json_decode($contents);

//    	$data = json_decode(file_get_contents('http://www.apilayer.net/api/live?access_key=99b49ac94265654845d6e0876a643f31&format=1'));
    	$toConvert = 'USD'.strtoupper($input['toConvert']);
    	$values  = array();
    	$values[] = $data->quotes->$toConvert;
        $values[] = $toConvert;
        $values[] = strtoupper($input['toConvert']);

        return response()->json($values);
    }
}
