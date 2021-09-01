<?php

namespace App\Http\Controllers;

use App\Reviews;

class ShowallreviewsController extends Controller
{
    public function allreviews(){
       $reviews = Reviews::where('is_accepted','=',1)
            ->orderBy('overall','desc')->latest()->paginate(10);

       $recentreviews = Reviews::where('is_accepted','=', 1)
           ->orderBy('id','desc')->latest()->paginate(10);

        return view('frontend.showallreviews',compact('reviews','recentreviews' ));
    }
}
