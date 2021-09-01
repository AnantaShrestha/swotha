<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Cities;
use App\CoverImage;
use App\Destinations;
use App\HoldDates;
use App\Reviews;
use App\SearchSeo;
use App\SiteViews;
use App\TeamMembers;
use App\TripDates;
use App\TripPackages;
use App\Trips;
use App\User;
use Illuminate\Support\Facades\Auth;

class TestIndexController extends Controller
{
    public function index(){

        $site_views = SiteViews::first();
        $total_views = $site_views->site_views + 1;
        $site_views->update(['site_views' => $total_views]);

        $video = CoverImage::select('image','is_video')->where('is_video', 1)->first();

        if(is_null($video)) {
            $coverImages = CoverImage::select('image', 'is_video', 'is_parallax', 'description', 'title', 'image_url')
                ->where([['is_parallax', 0], ['is_video', 0]])->orderBy('rank')->get();
        }

        //Parallax sorting them according to rank
        $parallaxes = CoverImage::select('image','title','description','is_parallax')
            ->where('is_parallax', '!=', 0)->orderBy('is_parallax', 'asc')->get();

        //Trip packages according to rank
//      $packages = TripPackages::with('trips')
//            ->select('id','title', 'rank', 'image','image_url','image_url_thumb')->orderBy('rank', 'asc')->get();

        $packages = TripPackages::with('trips')->orderBy('rank', 'asc')->get();

        //36 random trips in chunks because each row has 12 trips
       $randomTrips = Trips::select('id')->inRandomOrder()->limit(18)->pluck('id')->toArray();

//      dd($randomTrips);

        $randomTrips = array_chunk($randomTrips, 9);
        $oneTrips = Trips::with('customtrip')->select('id', 'cover_image', 'name', 'slug')->findOrFail($randomTrips[0])->toArray();
       
        //$oneTrips = array_chunk($oneTrips, 3);
        $secondTrips = Trips::with('customtrip')->select('id', 'cover_image', 'name', 'slug')->findOrFail($randomTrips[1])->toArray();
        //$secondTrips = array_chunk($secondTrips, 3);
        //Featured Trips are trips according to popularity
        $featuredTrips = Trips::select('name', 'cover_image', 'slug', 'poplularity')->orderBy('poplularity','desc')->limit(8)->latest()->get();

        //Last Minute Deals
        $dates = TripDates::all();
        $id = [];
        $count = 0;
        foreach ($dates as $date){
            if(strtotime($date->start_date) < strtotime('-3 month ago')
                and strtotime($date->start_date) > strtotime('now') and $date->discount != null) {
                $id[$count++] = $date->id;
            }
        }
        $lastDeal= TripDates::with('trips')->orderBy('start_date','asc')->limit(10)->find($id);

        //10 latest blogs
        $allBlogs = Articles::select('id', 'cover_image', 'title', 'slug')->where('is_published', '=', 1)->limit(10)->latest()->get();
//      $blogsviewed = Articles::where('is_published','=',1)->limit(10)->orderBy('view','desc')->get();

        //Reviews
        $reviews = Reviews::latest()->get();
        $searchbar = SearchSeo::select('content')->where('what','=',1)->first();
        $title = SearchSeo::select('content')->where('what','=',2)->first();
        $description = SearchSeo::select('content')->where('what','=',3)->first();
        $keywords = SearchSeo::select('content')->where('what','=',4)->first();

        $destinations = Destinations::where('position','!=',NULL)->get();

        $cities = Cities::all();

        $vipmembers = TeamMembers::select('id', 'photo', 'fullname', 'position')->where('show_in_homepage', '=', 1)->inRandomOrder()->limit(5)->get();

        $tripcounts = Trips::count();

        $totalusers = User::count();

        $fixed = TripDates::select('id')->latest()->first()->id;
        $seats = [];
        if (Auth::user()) {
            $seats = HoldDates::where([
                ['user_id', '=', Auth::user()->id],
                ['is_confirmed', '=', 1],
            ])->get();
        }
        return view('frontend.testindex',
            compact('coverImages', 'video', 'parallaxes', 'packages', 'featuredTrips',
                'lastDeal', 'allBlogs', 'reviews',
                'searchbar', 'title', 'description', 'keywords', 'destinations',
                'cities', 'vipmembers', 'total_views', 'totalusers', 'tripcounts', 'fixed', 'seats','randomTrips','oneTrips','secondTrips'));
    }


}