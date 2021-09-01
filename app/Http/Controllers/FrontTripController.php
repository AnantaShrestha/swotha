<?php

namespace App\Http\Controllers;

use App\About;
use App\Cities;
use App\Departments;
use App\Destinations;
use App\Themes;
use App\TripDates;
use App\TripPackages;
use App\Trips;
use App\TripViews;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenGraph;
use SEOMeta;
use Twitter;

class FrontTripController extends Controller
{


    public function redirectTo(Request $request, $slug)
    {

        $isTrip = Trips::where('slug', '=', $slug)->first();
        if ($isTrip) {
            return $this->showTrip($request, $slug);
        }

        $isTpack = TripPackages::where('slug', '=', $slug)->first();
        if ($isTpack) {
            return $this->showTripsPack($slug);
        }

        $isDest = $destination = Destinations::where('slug', '=', $slug)->first();
        if ($isDest) {
            return $this->showDestination($slug);
        }

        $isCity = Cities::where('slug', '=', $slug)->first();
        if ($isCity) {
            return $this->showCity($slug);
        }

        $isTheme = Themes::where('slug', '=', $slug)->first();
        if ($isTheme) {
            return $this->showVenture($slug);
        }

        $isAbout = About::where('slug', '=', $slug)->first();

        if ($isAbout) {
            return $this->showAbout($slug);
        }

        return redirect()->back();
    }

    private function getView($viewName)
    {
        if (request()->segment(1) == 'amp') {
            if (view()->exists($viewName . '-amp')) {
                $viewName .= '-amp';
            } else {
                abort(404);
            }
        }
        return $viewName;
    }

    /*trip package*/
    public function showTripsPack($slug)
    {
        $all = TripPackages::where('slug', '=', $slug)->first();
        $alltrips = $all->trips;
        return view('frontend.packtrips', compact('alltrips', 'all'));

    }

    /*destinaton*/
    public function showDestination($slug)
    {
        $destination = Destinations::where('slug', '=', $slug)->first();
        return view('frontend.destinations.index', compact('destination'));
    }

    /*city*/

    public function showCity($slug)
    {
        $city = Cities::where('slug', '=', $slug)->first();
        return view('frontend.region.index', compact('city'));
    }

    /*venture*/

    public function showVenture($slug)
    {
        $theme = Themes::where('slug', '=', $slug)->first();
        return view('frontend.theme.index', compact('theme'));
    }

    /*show about*/
    public function showAbout($slug)
    {
        $about = About::where('slug', '=', $slug)->first();
        $sections = $about->details;
        $departments = Departments::orderBy('updated_at', 'DESC')->get();
        $view = "frontend.about.show";

        $team = "";
        if ($slug == "our-team") {
            $view = "frontend.about.teammembers";
            $team = $about;
        }
        return view($view, compact('about', 'team', 'sections', 'departments'));
    }

    /*about teams*/
    public function showTeams($slug)
    {
        $team = About::where('slug', '=', $slug)->first();
        $departments = Departments::orderBy('updated_at', 'DESC')->get();
        return view('frontend.about.teammembers', compact('team', 'departments'));
    }

    /*show trips*/
    public function showTrip(Request $request, $slug)
    {

        $trip = Trips::where('slug', '=', $slug)->first();

        $id = $trip->id;

        $tripdatess = TripDates::orderBy('start_date', 'asc')
            // ->where('discount','=',NULL)
            ->where('trip_id', '=', $id)->get();

//        dd(date('Y-m-d'));
        $tripdatess = TripDates::select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(start_date, '%M') month_one"), DB::raw("DATE_FORMAT(start_date, '%Y-%m') new_date"),
            DB::raw('YEAR(start_date) year, MONTH(start_date) month'))
            ->groupby('year', 'month')->where('trip_id', '=', $id)->where('start_date', '>', date('Y-m-d'))
            ->get();

//	    dd($tripdatess);
        $request->session()->push('recent.trips', $id);

        $dt = new DateTime();
        $dt->format('Y-m-d H');

        $view = TripViews::where('trip_id', '=', $trip->id)
            ->first();

        if (!$view) {
            $views = new TripViews();
            $views->trip_id = $trip->id;
            $views->count = 1;
            $views->save();
        } else {
            $view->update(['count' => $view->count + 1]);
        }

        if (!empty($trip->seotrip)) {
            SEOMeta::setTitle($trip->seotrip->meta_title);
            SEOMeta::setDescription($trip->seotrip->meta_description);

            if ($trip->seotrip != null) {
                SEOMeta::addKeyword([$trip->seotrip->keywords]);
            }
            SEOMeta::setCanonical('https:www.swotahtravel.com/trip/' . $trip->slug);

            OpenGraph::setDescription($trip->seotrip->meta_description);
            OpenGraph::setTitle($trip->name);
            OpenGraph::setUrl('https:www.swotahtravel.com/trip/' . $trip->slug);
            OpenGraph::addProperty('type', 'trips');
        }

        //Similar Trips
        /*------------------Start of Khatarnak, Bhayanak, Dardnak AI code------------------*/
        if (isset($trip->customtrip) && ($trip->customtrip->beyond_border == 1)) {
            $recommended = DB::table('customtrip')
                ->join('trips', function ($join) {
                    $join->on('trips.id', '=', 'customtrip.trip_id')
                        ->where('customtrip.beyond_border', '=', 1);
                })
                ->whereBetween('price', [$trip->price - 500, $trip->price + 500])
                ->whereBetween('days', [$trip->days - 5, $trip->days + 5])
                ->limit(3)->get();

            if (count($recommended) < 3) {
                $recommended = DB::table('customtrip')
                    ->join('trips', function ($join) {
                        $join->on('trips.id', '=', 'customtrip.trip_id')
                            ->where('customtrip.beyond_border', '=', 1);
                    })
                    ->whereBetween('price', [$trip->price - 800, $trip->price + 800])
                    ->limit(3)->get();

                if (count($recommended) < 2) {
                    $recommended = DB::table('customtrip')
                        ->join('trips', function ($join) {
                            $join->on('trips.id', '=', 'customtrip.trip_id')
                                ->where('customtrip.beyond_border', '=', 1);
                        })
                        ->limit(3)->get();
                }
            }
        } else {
            $recommended = DB::table('customtrip')
                ->join('trips', function ($join) {
                    $join->on('trips.id', '=', 'customtrip.trip_id')
                        ->where('customtrip.beyond_border', '=', 0);
                })
                ->whereIn('ventures', explode(",", $trip->ventures))
                ->whereBetween('altitude', [$trip->altitude - 800, $trip->altitude + 800])
                ->whereBetween('price', [$trip->price - 500, $trip->price + 500])
                ->whereBetween('days', [$trip->days - 5, $trip->days + 5])
                ->whereIn('regions', explode(",", $trip->regions))
                ->whereBetween('physical_rating', [$trip->physical_rating - 2, $trip->physical_rating + 2])
                ->count();

            if ($recommended < 3) {
                $recommended = DB::table('customtrip')
                    ->join('trips', function ($join) {
                        $join->on('trips.id', '=', 'customtrip.trip_id')
                            ->where('customtrip.beyond_border', '=', 0);
                    })
                    ->whereIn('ventures', explode(",", $trip->ventures))
                    ->whereBetween('altitude', [$trip->altitude - 800, $trip->altitude + 800])
                    ->whereBetween('price', [$trip->price - 500, $trip->price + 500])
                    ->whereBetween('days', [$trip->days - 5, $trip->days + 5])
                    ->whereIn('regions', explode(",", $trip->regions))
                    ->count();

                if ($recommended < 3) {
                    $recommended = DB::table('customtrip')
                        ->join('trips', function ($join) {
                            $join->on('trips.id', '=', 'customtrip.trip_id')
                                ->where('customtrip.beyond_border', '=', 0);
                        })
                        ->whereIn('ventures', explode(",", $trip->ventures))
                        ->whereBetween('altitude', [$trip->altitude - 800, $trip->altitude + 800])
                        ->whereBetween('price', [$trip->price - 500, $trip->price + 500])
                        ->whereBetween('days', [$trip->days - 5, $trip->days + 5])
                        ->count();

                    if ($recommended < 3) {
                        $recommended = DB::table('customtrip')
                            ->join('trips', function ($join) {
                                $join->on('trips.id', '=', 'customtrip.trip_id')
                                    ->where('customtrip.beyond_border', '=', 0);
                            })
                            ->whereIn('ventures', explode(",", $trip->ventures))
                            ->whereBetween('altitude', [$trip->altitude - 500, $trip->altitude + 500])
                            ->whereBetween('price', [$trip->price - 500, $trip->price + 500])
                            ->count();

                        if ($recommended < 3) {
                            $recommended = DB::table('customtrip')
                                ->join('trips', function ($join) {
                                    $join->on('trips.id', '=', 'customtrip.trip_id')
                                        ->where('customtrip.beyond_border', '=', 0);
                                })
                                ->whereIn('ventures', explode(",", $trip->ventures))
                                ->whereBetween('altitude', [$trip->altitude - 300, $trip->altitude + 300])
                                ->count();

                            if ($recommended < 3) {
                                $recommended = DB::table('customtrip')
                                    ->join('trips', function ($join) {
                                        $join->on('trips.id', '=', 'customtrip.trip_id')
                                            ->where('customtrip.beyond_border', '=', 0);
                                    })
                                    ->whereIn('ventures', explode(",", $trip->ventures))
                                    ->limit(3)->inRandomOrder()->get();
                            } else {
                                $recommended = DB::table('customtrip')
                                    ->join('trips', function ($join) {
                                        $join->on('trips.id', '=', 'customtrip.trip_id')
                                            ->where('customtrip.beyond_border', '=', 0);
                                    })
                                    ->whereIn('ventures', explode(",", $trip->ventures))
                                    ->whereBetween('altitude', [$trip->altitude - 300, $trip->altitude + 300])
                                    ->limit(3)->inRandomOrder()->get();
                            }
                        } else {
                            $recommended = DB::table('customtrip')
                                ->join('trips', function ($join) {
                                    $join->on('trips.id', '=', 'customtrip.trip_id')
                                        ->where('customtrip.beyond_border', '=', 0);
                                })
                                ->whereIn('ventures', explode(",", $trip->ventures))
                                ->whereBetween('altitude', [$trip->altitude - 300, $trip->altitude + 300])
                                ->whereBetween('price', [$trip->price - 500, $trip->price + 500])
                                ->limit(3)->inRandomOrder()->get();
                        }

                    } else {
                        $recommended = DB::table('customtrip')
                            ->join('trips', function ($join) {
                                $join->on('trips.id', '=', 'customtrip.trip_id')
                                    ->where('customtrip.beyond_border', '=', 0);
                            })
                            ->whereIn('ventures', explode(",", $trip->ventures))
                            ->whereBetween('altitude', [$trip->altitude - 500, $trip->altitude + 500])
                            ->whereBetween('price', [$trip->price - 500, $trip->price + 500])
                            ->whereBetween('days', [$trip->days - 5, $trip->days + 5])
                            ->limit(3)->inRandomOrder()->get();
                    }
                } else {
                    $recommended = DB::table('customtrip')
                        ->join('trips', function ($join) {
                            $join->on('trips.id', '=', 'customtrip.trip_id')
                                ->where('customtrip.beyond_border', '=', 0);
                        })
                        ->whereIn('ventures', explode(",", $trip->ventures))
                        ->whereBetween('altitude', [$trip->altitude - 800, $trip->altitude + 800])
                        ->whereBetween('price', [$trip->price - 500, $trip->price + 500])
                        ->whereBetween('days', [$trip->days - 5, $trip->days + 5])
                        ->whereIn('regions', explode(",", $trip->regions))
                        ->limit(3)->inRandomOrder()->get();
                }
            } else {
                $recommended = DB::table('customtrip')
                    ->join('trips', function ($join) {
                        $join->on('trips.id', '=', 'customtrip.trip_id')
                            ->where('customtrip.beyond_border', '=', 0);
                    })
                    ->whereIn('ventures', explode(",", $trip->ventures))
                    ->whereBetween('altitude', [$trip->altitude - 800, $trip->altitude + 800])
                    ->whereBetween('price', [$trip->price - 500, $trip->price + 500])
                    ->whereBetween('days', [$trip->days - 5, $trip->days + 5])
                    ->whereIn('regions', explode(",", $trip->regions))
                    ->whereBetween('physical_rating', [$trip->physical_rating - 2, $trip->physical_rating + 2])
                    ->limit(3)->inRandomOrder()->get();
            }
        }

        $allid = [];
        foreach ($recommended as $r) {
            array_push($allid, $r->id);
        }
        $recommended = Trips::findOrFail($allid);
        /*------------------End of Khatarnak, Bhayanak, Dardnak AI Code------------------*/
//	    dd($tripdatess);

        $istrip = true;
//        return view($this->getView('frontend.tripPage.showtrips'), compact('trip', 'tripdatess', 'recommended'));
        return view('frontend.tripPage.showtrips', compact('trip', 'tripdatess', 'recommended','istrip'));
    }


    public function customtrip($id)
    {
        $trip = Trips::findOrFail($id);

        $total = explode(',', $trip->customtrip->accomodation_cost);
//        dd($total);
        foreach ($total as $item) {
            $price = explode(':', $item);
//            dd($price);
            if ($price[0] == 1) {
                $star_1 = $price[1];
                continue;
            } elseif ($price[0] == 2) {
                $star_2 = $price[1];
                continue;
            } elseif ($price[0] == 3) {
                $star_3 = $price[1];
                continue;
            } elseif ($price[0] == 4) {
                $star_4 = $price[1];
                continue;
            } elseif ($price[0] == 5) {
                $star_5 = $price[1];
                continue;
            }
        }

        $allratios = explode(',', $trip->customtrip->ratios);
        $porterratio = 0;
        $assistantratio = 0;
        $guideratio = 0;
        $sherparatio = 0;

        if ($trip->customtrip->porter_cost != 0) {
            $porterratio = $allratios[0];
        }
        if ($trip->customtrip->assistant_cost != 0) {
            $assistantratio = $allratios[1];
        }
        if ($trip->customtrip->guide_cost != 0) {
            $guideratio = $allratios[2];
        }
        if ($trip->customtrip->sherpa_cost != 0) {
            $sherparatio = $allratios[3];
        }
        $citytour = $trip->customtrip->citytour_cost;
        $private = $trip->customtrip->private_cost;

        return view('frontend.custombook.customtrip',
            compact('trip', 'star_1', 'star_2', 'star_3', 'star_4', 'star_5', 'citytour',
                'porterratio', 'assistantratio', 'guideratio', 'sherparatio', 'private'));
    }

    public function groupdiscount(Request $request)
    {
        $number = $request->number;
        $tripid = $request->tripid;
        $value = $request->value;
        $value1 = $request->value1;
        $trip = Trips::findOrFail($tripid);
        $tourprice = $trip->customtrip->citytour_cost;
        $mealsprice = $trip->customtrip->meals_cost;
        $tprice = null;

        $grandtotal = $trip->price * $number;
        $allratios = explode(',', $trip->customtrip->ratios);
        $porterratio = $allratios[0];
        $assistantratio = $allratios[1];
        $guideratio = $allratios[2];
        $sherparatio = $allratios[3];

        $porprice = str_replace(':1', '', $porterratio);
//	    dd($porprice);
        $defaultporter = ceil($number / $porprice);
        $guiprice = str_replace(':1', '', $guideratio);
        $defaultguide = ceil($number / $guiprice);
        $assprice = str_replace(':1', '', $assistantratio);
        $defautassistant = ceil($number / $assprice);
        $sherprice = str_replace(':1', '', $sherparatio);
        $defaultsherpa = ceil($number / $sherprice);

        if ($value == 0) {
            $tprice = -($tourprice * $number);
            $fake = -($tourprice * $number);
        } else {
            $tprice = 0;
            $fake = $tourprice;
        }

        if ($value1 == 0) {
            $mprice = -($mealsprice * $number);
            $mfake = -($mealsprice * $number);
        } else {
            $mprice = 0;
            $mfake = $mealsprice;
        }

        $defaultroom = ceil($number / 2);
        $data = array();
        $data[0] = $number;
        $data[1] = $tripid;
        $data[2] = $grandtotal;
        $data[3] = $defaultporter;
        $data[4] = $tprice;
        $data[5] = $fake;
        $data[6] = $defaultroom;
        $data[7] = $defaultguide;
        $data[8] = $defautassistant;
        $data[9] = $defaultsherpa;
        $data[10] = $mprice;
        $data[11] = $mfake;
        return response()->json($data);
    }

    public function porterpriceup(Request $request)
    {
        $number = $request->number;
        $tripid = $request->tripid;
        $defaultporter = $request->defaultporter;
        $trip = Trips::findOrFail($tripid);

        if ($defaultporter != 0) {
            $extraporter = $number - $defaultporter;
        } else {
            $extraporter = $number;
        }

        $price = $trip->customtrip->porter_cost;
        $porterprice = $price * $extraporter;
        $data = array();
        $data[0] = $number;
        $data[1] = $tripid;
        $data[2] = $porterprice;
        return response()->json($data);

    }

    public function porterpricedown(Request $request)
    {
        $number = $request->number;
        $tripid = $request->tripid;
        $defaultporter = $request->defaultporter;
        $trip = Trips::findOrFail($tripid);
        $price = $trip->customtrip->porter_cost;

        if ($defaultporter != 0) {
            $minusporter = $number - $defaultporter;
        } else {
            $minusporter = $number;
        }

        $porterprice = $minusporter * $price;
        $data = array();
        $data[0] = $number;
        $data[1] = $tripid;
        $data[2] = $porterprice;
        return response()->json($data);

    }

    public function transport(Request $request)
    {
        $transport = $request->transport;
        $tripid = $request->tripid;
        $currentpeople = $request->currentpeople;
        $trip = Trips::findOrFail($tripid);

        $public = $trip->customtrip->public_cost;
        $private = $trip->customtrip->private_cost;
        $flight = $trip->customtrip->flight_cost;

        if ($transport == 'public') {
            $aprice = ($public - $private) * $currentpeople;
            $rprice = $public;
            $t = 'public';
        } elseif ($transport == 'flight') {
            $aprice = ($flight - $private) * $currentpeople;
            $rprice = $flight;
            $t = 'flight';
        } else {
            $aprice = 0;
            $rprice = $private;
            $t = 'private';
        }
        $data = array();
        $data[0] = $aprice;
        $data[1] = $t;
        $data[2] = $rprice;
        return response()->json($data);
    }

    public function accomodation(Request $request)
    {
        $star_3 = null;
        $star = null;
        $default = null;
        $extraroom = null;
        $value = $request->value;
        $room = $request->room;
        $tripid = $request->tripid;
        $currentpeople = $request->currentpeople;
        $defaultroom = $request->defaultroom;

        $extraroom = ($room - ceil($currentpeople / 2));

        $trip = Trips::findOrFail($tripid);

        $total = explode(',', $trip->customtrip->accomodation_cost);

        foreach ($total as $item) {
            $price = explode(':', $item);
            if ($price[0] == 3) {
                $default = $price[1];
                continue;
            }
        }

        foreach ($total as $item) {
            $price = explode(':', $item);
            if ($price[0] == $value) {
                $star_3 = $price[1];
                continue;
            }

        }
        if ($default == $star_3) {
            $star = 0;
        } else {
            $star = ($star_3 - $default) * $defaultroom;
        }

        $extraprice = $star_3 * $extraroom;

        $totalprice = $star_3;
        $reducedprice = $star + $extraprice;
        $data = array();
        $data[0] = $totalprice;
        $data[1] = $reducedprice;
        $data[2] = $extraroom;
        $data[3] = $extraprice;
        return response()->json($data);
    }

    public function roomup(Request $request)
    {
        $extraroom = null;
        $roomnumber = $request->roomnumber;
        $manche = $request->manche;
        $defaultstar = $request->defaultstar;
        $defaultroom = $request->defaultroom;
        $currentprice = $request->paisa;

        $extraroom = ($roomnumber - ceil($manche / 2));

        if ($defaultstar == $currentprice) {
            if ($extraroom != 0) {
                $price = $currentprice * $extraroom;
            } else {
                $price = 0;
            }
        } else {
            $price = $currentprice * $roomnumber - $defaultstar * $defaultroom;
        }

        $data = array();
        $data[0] = $roomnumber;
        $data[1] = $price;
        return response()->json($data);

    }

    public function roomdown(Request $request)
    {
        $extraroom = null;
        $manche = $request->manche;
        $defaultroom = $request->defaultroom;
        $roomnumber = $request->roomnumber;
        $defaultstar = $request->defaultstar;
        $currentprice = $request->paisa;

        $extraroom = ($roomnumber - ceil($manche / 2));

        if ($defaultstar == $currentprice) {
            if ($extraroom != 0) {
                $price = $currentprice * $extraroom;
            } else {
                $price = 0;
            }
        } else {
            $price = $currentprice * $roomnumber - $defaultstar * $defaultroom;
        }

        $data = array();
        $data[0] = $roomnumber;
        $data[1] = $price;
        return response()->json($data);
    }


    public function tour(Request $request)
    {
        $value = $request->value;
        $currentpeople = $request->currentpeople;
        $tripid = $request->tripid;
        $trip = Trips::findOrFail($tripid);
        $price = $trip->customtrip->citytour_cost;
        $totalprice = null;
        $showprice = null;

        if ($value == 0) {
            $totalprice = -($price * $currentpeople);
            $showprice = -($price * $currentpeople);
        } elseif ($value == 1) {
            $totalprice = 0;
            $showprice = $price;
        }

        $data = array();
        $data[0] = $totalprice;
        $data[1] = $showprice;
        return response()->json($data);
    }

    public function meal(Request $request)
    {
        $value = $request->value;
        $currentpeople = $request->currentpeople;
        $tripid = $request->tripid;
        $trip = Trips::findOrFail($tripid);
        $price = $trip->customtrip->meals_cost;
        $totalprice = null;
        $showprice = null;

        if ($value == 0) {
            $totalprice = -($price * $currentpeople);
            $showprice = -($price * $currentpeople);
        } elseif ($value == 1) {
            $totalprice = 0;
            $showprice = $price;
        }

        $data = array();
        $data[0] = $totalprice;
        $data[1] = $showprice;
        return response()->json($data);
    }

    public function guideup(Request $request)
    {
        $number = $request->number;
        $tripid = $request->tripid;
        $defaultguide = $request->defaultguide;
        $trip = Trips::findOrFail($tripid);

        if ($defaultguide != 0) {
            $extraguide = $number - $defaultguide;
        } else {
            $extraguide = $number;
        }

        $price = $trip->customtrip->guide_cost;
        $guideprice = $price * $extraguide;
        $data = array();
        $data[0] = $number;
        $data[1] = $tripid;
        $data[2] = $guideprice;
        return response()->json($data);
    }

    public function guidedown(Request $request)
    {
        $number = $request->number;
        $tripid = $request->tripid;
        $defaultguide = $request->defaultguide;
        $trip = Trips::findOrFail($tripid);

        if ($defaultguide != 0) {
            $extraguide = $number - $defaultguide;
        } else {
            $extraguide = $number;
        }

        $price = $trip->customtrip->guide_cost;
        $guideprice = $price * $extraguide;
        $data = array();
        $data[0] = $number;
        $data[1] = $tripid;
        $data[2] = $guideprice;
        return response()->json($data);
    }

    public function sherpaup(Request $request)
    {
        $number = $request->number;
        $tripid = $request->tripid;
        $defaultsherpa = $request->defaultsherpa;
        $trip = Trips::findOrFail($tripid);

        if ($defaultsherpa != 0) {
            $extrasherpa = $number - $defaultsherpa;
        } else {
            $extrasherpa = $number;
        }

        $price = $trip->customtrip->sherpa_cost;
        $sherpaprice = $price * $extrasherpa;
        $data = array();
        $data[0] = $number;
        $data[1] = $tripid;
        $data[2] = $sherpaprice;
        return response()->json($data);
    }

    public function sherpadown(Request $request)
    {
        $number = $request->number;
        $tripid = $request->tripid;
        $defaultsherpa = $request->defaultsherpa;
        $trip = Trips::findOrFail($tripid);

        if ($defaultsherpa != 0) {
            $extrasherpa = $number - $defaultsherpa;
        } else {
            $extrasherpa = $number;
        }

        $price = $trip->customtrip->sherpa_cost;
        $sherpaprice = $price * $extrasherpa;
        $data = array();
        $data[0] = $number;
        $data[1] = $tripid;
        $data[2] = $sherpaprice;
        return response()->json($data);
    }

    public function assistantup(Request $request)
    {
        $number = $request->number;
        $tripid = $request->tripid;
        $defaultassistant = $request->defaultassistant;
        $trip = Trips::findOrFail($tripid);

        if ($defaultassistant != 0) {
            $extraassistant = $number - $defaultassistant;
        } else {
            $extraassistant = $number;
        }

        $price = $trip->customtrip->assistant_cost;
        $assistantprice = $price * $extraassistant;

        $data = array();
        $data[0] = $extraassistant;
        $data[1] = $tripid;
        $data[2] = $assistantprice;
        return response()->json($data);

    }

    public function assistantdown(Request $request)
    {
        $number = $request->number;
        $tripid = $request->tripid;
        $defaultassistant = $request->defaultassistant;
        $trip = Trips::findOrFail($tripid);

        if ($defaultassistant != 0) {
            $extraassistant = $number - $defaultassistant;
        } else {
            $extraassistant = $number;
        }
        $price = $trip->customtrip->assistant_cost;
        $assistantprice = $price * $extraassistant;

        $data = array();
        $data[0] = $extraassistant;
        $data[1] = $tripid;
        $data[2] = $assistantprice;
        return response()->json($data);
    }

//    public function coupondiscount1(Request $request){
////	    $request->session()->forget('user.coupons2');
//	    $code = $request->coupon1;
//
//	    $actualprice =Coupons::where('code','=', $code)->first();
//	    $request->session()->push('user.coupons1', $actualprice);
//
//	    $actual = Session::get('user.coupons1');
//
//	    $adddiscount = [];
//	    foreach ($actual as $a) {
//		    $discount = round((($a->discount) / 100) * $a->trip_price);
//		    array_push($adddiscount,$discount);
//	    }
//
//	    $price = str_replace('$','',$request->totalprice1);
//	    $alldiscount =array_sum($adddiscount);
//	    $finalp = (int)$price - $alldiscount;
//	    $data = array();
//	    $data[0] = '$'.$finalp;
//	    $data[1] = $discount;
//	    $data[2] = $price;
//	    $data[3] = $code;
//	    return response ()->json($data);
//    }

//	public function coupondiscount2(Request $request){
////		$request->session()->forget('user.coupons1');
//		$code = $request->coupon2;
//
//		$actualprice =Coupons::where('code','=', $code)->first();
//		$request->session()->push('user.coupons2', $actualprice);
//
//		$actual = Session::get('user.coupons2');
//
//		$adddiscount = [];
//		foreach ($actual as $a) {
//			$discount = round((($a->discount) / 100) * $a->trip_price);
//			array_push($adddiscount,$discount);
//		}
//
//		$price = str_replace('$','',$request->totalprice2);
//		$alldiscount =array_sum($adddiscount);
//		$finalp = (int)$price - $alldiscount;
//		$data = array();
//		$data[0] = '$'.$finalp;
//		$data[1] = $discount;
//		$data[2] = $price;
//		$data[3] = $code;
//		return response ()->json($data);
//	}

    public function fixeddepbymonth(Request $request)
    {
        $date = $request->date;
        $tripId = $request->tripid;
        $trips = TripDates::where('start_date', "LIKE", $date . "-%")->where('trip_id', '=', $tripId)->get();
        $trip_news = [];
        foreach ($trips as $trip) {

            if (strtotime($trip->start_date) > strtotime('now')) {
                $trip['finish_date'] = date('Y-m-d', strtotime('-1 day', strtotime($trip->finish_date)));
                array_push($trip_news, $trip);
            }
        }
        return response()->json(["trips" => $trip_news]);
    }
}
