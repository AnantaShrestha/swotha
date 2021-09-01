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

class VerifyRecaptcha
{
    public static function checkRecaptcha($token){
        $action = 'home';
        $score = 0;
        $score = app('recaptcha')->verify($token, $action, $score);
        $captchaValidated = false;
        if($score > 0.7) {
            $captchaValidated = true;
        }
        return$captchaValidated;
    }

}