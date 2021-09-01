<?php

namespace App\Http\Controllers;

use App\Themes;

class FrontendThemeController extends Controller
{
    public function show($slug){
        $theme = Themes::where('slug','=',$slug)->first();
        return view('frontend.theme.index',compact('theme'));
    }
}
