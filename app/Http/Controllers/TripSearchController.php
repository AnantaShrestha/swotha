<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class TripSearchController extends Controller
{
    public function index(Request $request)
    {

        $input = $request->all();
        $query = $input['q'];
        return view('frontend.searchpage.search', compact('query'));
    }

}
