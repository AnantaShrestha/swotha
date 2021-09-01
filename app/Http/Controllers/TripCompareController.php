<?php

namespace App\Http\Controllers;

use App\Trips;

class TripCompareController extends Controller
{
    public function compare($triplist){

        $id =explode(',',$triplist);
        $trips = [];
        $count = 0;
        foreach($id as $i){
          $trips[$count++] = Trips::find($i);
        }
        return view('frontend.searchpage.compare',compact('trips'));
    }
}
