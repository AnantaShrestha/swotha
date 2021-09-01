<?php

namespace App\Http\Controllers;

use App\TripDates;
use Illuminate\Http\Request;

class DealsController extends Controller
{
    public function index(){
        $trips = TripDates::with('trips')->where('discount', '!=', NULL)
            ->where('start_date', '>', date('Y-m-d'))
            ->orderBy('start_date', 'asc')->paginate(50);
        return view('admin-panel.Deals.index',compact('trips'));
    }

    public function indexfixed(Request $request)
    {
        $query = null;

        if ($request->has('tripname')) {
            $query = $request->input('tripname');
        }

        $trips = TripDates::with('trips')->where('discount', '=', NULL)
            ->where('start_date', '>', date('Y-m-d'))
            ->orderBy('start_date', 'asc')
            ->whereHas('trips', function ($q) use ($query) {
                $q->where('name', 'LIKE', "$query%");
            })
            ->paginate(50);

        return view('admin-panel.Deals.index',compact('trips'));
    }
    public function edit($id){
        return view('admin-panel.Deals.edit',compact('id'));
    }
    public function update(Request $request, $id){
        $dates = TripDates::findorFail($id);
        $dates->update($request->all());
        return redirect('/backend/deal');
    }
    public function destroy($id){
        $dates = TripDates::findOrFail($id);
        $dates->discount = null;
        $dates->save();
        return redirect('/backend/deal');

    }
    
    //To increase the remaining seats by super-admin which is performed via ajax call
    public function changeSeats(Request $request){
    	$input = $request->all();
    	
    	if(isset($input['tripId'])){
    		$remainingSeats = TripDates::where('id', $input['tripId'])->first();
    		
    		if(is_null($remainingSeats)){
    			return response(null);
		    }
		    
		    if(isset($input['do']) && $input['do']=='increase') {
			    $remainingSeats->remainingseats++;
		    } elseif(isset($input['do']) && $input['do'] == 'decrease'){
			    $remainingSeats->remainingseats--;
		    }
    		
    		$remainingSeats->save();
    		
    		$data = array();
    		$data[0] = $remainingSeats->remainingseats;
    		$data[1] = $input['tripId'];
    		return response()->json($data);
    		
	    } else {
    		return response(null);
	    }
    }
}
