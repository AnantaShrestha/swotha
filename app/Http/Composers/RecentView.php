<?php
/**
 * Created by PhpStorm.
 * User: msbomrel
 * Date: 9/21/17
 * Time: 1:04 PM
 */

namespace App\Http\Composers;


use App\Trips;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class RecentView
{
    public function compose(View $view)
    {
        $recents = Session::get('recent.trips');
        if($recents != null){
            $recents = array_reverse(array_unique($recents));
        }
        $view->with('recentTrips', Trips::with('customtrip', 'views')->find($recents));
    }

}
