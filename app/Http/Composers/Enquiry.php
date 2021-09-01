<?php
/**
 * Created by PhpStorm.
 * User: sushil
 * Date: 6/22/17
 * Time: 2:36 PM
 */

namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;

class Enquiry
{
    public function compose(View $view)
    {
//        $view->with('reviews', Reviews::where('is_accepted','=','1')->paginate(3));
        $path = storage_path() . "/json/country.json";
        if (!File::exists($path)) {
            throw new Exception("Invalid File");
        }
        $file = File::get($path);
        $countries = \GuzzleHttp\json_decode($file,true);
        $view->with(compact('countries'));
    }

}