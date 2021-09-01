<?php

namespace App\Http\Controllers;


use App\Http\Requests\TripDatesCreateRequest;
use App\TripDates;
use App\Trips;
use Illuminate\Http\Request;

class TripDateController extends Controller
{
    public function create(Request $request){

        $info = $request->all();
        $trip = $info['trip_id'];
//        dd($trip);
        return view('admin-panel.TripDates.create',compact('trip'));
    }
    public function show($id){
        $dates = TripDates::where('trip_id','=',$id)->get();
        $trip = Trips::find($id);
        return view('admin-panel/TripDates/showdates',compact('dates','trip'));
    }
    public function edit(Request $request, $id){
        $date = TripDates::find($id);
        $start = date('m/d/Y',strtotime($date->start_date));
        $end = date('m/d/Y',strtotime($date->finish_date));

        return view('admin-panel/TripDates/editdates',compact('date','start','end'));
    }
    public function update(Request $request,$id){
//        dd($id);
        $input = $request->all();
        $date = TripDates::find($id);

        $start = date('Y-m-d',strtotime($input['start_date']));
        $input['start_date'] = $start;
        $trips = Trips::find($input['trip_id']);

        $input['finish_date'] = date('Y-m-d',strtotime($input['start_date']. " + ".$trips->days." days" ));
//        dd($date);
        $date->update($input);
        return redirect('backend/tripdates/'.$date->trip_id);
    }
    public function store(TripDatesCreateRequest $request){
        $input = $request->all();
//        dd($input);
        $input['start_date'] =  date('Y-m-d', strtotime($input['start_date']));
//        $input['finish_date'] =  date('Y-m-d', strtotime($input['finish_date']));
//        dd($input);
        $trips = Trips::find($input['trip_id']);
        $input['finish_date'] = date('Y-m-d',strtotime($input['start_date']. " + ".$trips->days." days" ));

        TripDates::create($input);

        $dates = TripDates::where('trip_id','=',$input['trip_id'])->get();
//        dd($trips->dates);
        if($trips->dates==null){
            $date = [];
            $count = 0;
            foreach($dates as $d){
                $date[$count++] =  $d->start_date;

            }
            $dat = implode(',',$date);
            $trips->dates = $dat;

            $trips->save();
        }else{
            $date = explode(',',$trips->dates);
            $count = count($date);
            $count1 = $count+1;
            foreach ($dates as $d){
                $date[$count1++] = $d->start_date;
            }
            $dat = implode(',',$date);
            $trips->dates = $dat;
            $trips->save();
        }


//        dd($date);


        return redirect('/backend/trips/'.$input['trip_id']);
    }
    public function destroy($id){
        $date = TripDates::find($id);
        $date->delete();
        return redirect()->back()->with('success', 'Date deleted successfully.');
    }

}
