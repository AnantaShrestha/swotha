<?php
/**
 * Created by PhpStorm.
 * User: anish
 * Date: 4/8/17
 * Time: 11:53 AM
 */

namespace App\Http\Composers;


use App\Trips;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;

class ReviewComposer
{
	/**
	 * @param View $view
	 * @throws Exception
	 */
	public function compose(View $view)
    {
        $path = storage_path() . "/json/country.json";
        if (!File::exists($path)) {
            throw new Exception("Invalid File");
        }

        $file = File::get($path);
        $countries = \GuzzleHttp\json_decode($file,true);
        $view->with(compact('countries'));
        $view->with('trips', Trips::select('name', 'slug')->get());
    }
}