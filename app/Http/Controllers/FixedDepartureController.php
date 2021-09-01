<?php

namespace App\Http\Controllers;

use App\TripDates;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Http\Request;


class FixedDepartureController extends Controller
{
    public function index(Request $request){

        $dates = TripDates::all();
        $sort_by = ($request->has('sort_by')) ? $request->input('sort_by') : 'start_date';
        $sort_order = ($request->has('sort_order')) ? $request->input('sort_order') : 'asc';
        $search = ($request->has('search')) ? trim($request->input('search')) : '';

//      dd($sort_by, $sort_order, $search);
        $id = [];
        $count = 0;
        foreach ($dates as $date){
            if(strtotime($date->start_date) > strtotime('now') and $date->discount == null) {
                $id[$count++] = $date->id;
            }
        }
        
        if($sort_by == 'name' || $sort_by == 'days'){
	        $allfixed = TripDates::join('trips', 'tripdates.trip_id', '=', 'trips.id')
		        ->orderBy('trips.'.$sort_by, $sort_order)
		        ->groupBy('tripdates.trip_id')
		        ->select('tripdates.*')
		        ->paginate(20);
        }else {
            $allfixed = TripDates::orderBy($sort_by, $sort_order)->whereIn('id', $id)->paginate(20);
        }
        if(!empty($search)){
            $trips = (new \App\Trips)->where('name','LIKE',"%{$search}%")->get();
            
            foreach ($trips as $trip){
                $allfixed = $trip->date()->paginate(20);
            }
        }
        return view('frontend.tripPage.fixed-departures-simple', compact('allfixed'));
    }

    public function search(Request $request)
    {
        $input = $request->all();
        $text = $input['text'];
        if (is_null($input['text']))
        {
            $dates = TripDates::all();
            $id = [];

            $count = 0;
            foreach ($dates as $date){
                if(strtotime($date->start_date) > strtotime('now') and $date->discount == null) {
                    $id[$count++] = $date->id;
                }
            }
            $allfixed = TripDates::orderBy('start_date','asc')->whereIn('id',$id)->paginate(20);

            return view('frontend.tripPage.fixed-departures-simple', compact('allfixed'));
        }
        else
        {
            $trips = (new \App\Trips)->where('name','LIKE',"%{$input['text']}%")->get();
            $allfixed1 =[];
            foreach ($trips as $trip){
                $allfixed1 = $trip->date;
            }
            return view('frontend.tripPage.fixed-departures-simple',compact('allfixed1','text'));
        }
    }

	public function pdfview(Request $request)
	{
		$pdf = PDF::loadView('frontend.InvoiceTemplate.in')->setOrientation('landscape')->setPaper('a4');
		return $pdf->download('invoice.pdf');
	}
    
}
