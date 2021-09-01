<?php

namespace App\Http\Controllers;

use App\EmailSubscribe;
use Illuminate\Http\Request;

class EmailSubscribeController extends Controller
{
	public function insert(Request $request){
		$email = $request->email;

        $checkduplicate = EmailSubscribe::where('email','=',$email)->first();

        if(empty($checkduplicate)) {
			if (isset($_SERVER['HTTP_CLIENT_IP']))
				$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
			else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
				$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			else if (isset($_SERVER['HTTP_X_FORWARDED']))
				$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
			else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
				$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
			else if (isset($_SERVER['HTTP_FORWARDED']))
				$ipaddress = $_SERVER['HTTP_FORWARDED'];
			else if (isset($_SERVER['REMOTE_ADDR']))
				$ipaddress = $_SERVER['REMOTE_ADDR'];
			else
				$ipaddress = 'UNKNOWN';


			$PublicIP = $ipaddress;

			$json = file_get_contents("http://api.ipstack.com/".$PublicIP."?access_key=26a3ab68192c92dd9800032e6e76dde0&format=1");
			$json = json_decode($json, true);
			$country = $json['country_name'];

			$nayaemail = new EmailSubscribe();
			$nayaemail->email = $email;
			$nayaemail->ipaddress = $ipaddress;
			$nayaemail->country = $country;
			$nayaemail->subscribed = 1;
			$nayaemail->save();

			$data = array();
			$data[0] = 1;
			$data[1] = "You have successfully subscribed.";
			return response ()->json ($data);

		}else{
			$data = array();
			$data[0] = 0;
			$data[1] = "This email has already been subscribed.";
			return response ()->json ($data);

		}

    }
}
