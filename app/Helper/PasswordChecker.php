<?php
/**
 * Created by PhpStorm.
 * User: msbomrel
 * Date: 12/13/17
 * Time: 4:16 PM
 */

namespace App\Helper;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordChecker
{
	public static function checkpass($pass){
		$adminpass = Auth::user()->password;
		if (Hash::check($pass, $adminpass))
		{
			$value = true;
		}else{
			$value = false;
		}
		return $value;
	}
	
}