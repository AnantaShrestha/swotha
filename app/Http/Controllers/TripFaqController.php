<?php

namespace App\Http\Controllers;

use App\TripFaq;
use Illuminate\Http\Request;

class TripFaqController extends Controller
{
    public function create(Request $request){
        $input = $request->all();
        $trip_id = $input['trip_id'];
        return view('admin-panel.Trips.faq.create',compact('trip_id'));
    }
    public function store(Request $request){
        $input = $request->all();
        foreach ($input as $key => $val){
            if($key!="_token"){
                foreach ($input[$key] as $value){
                    if($key == "trip_id"){
                        $trip_id[] = $value;
                    }else if($key == "trip_faq"){
                        $trip_faq[] = $value;
                    }
                }
            }
        }
        for($i = 0; $i < sizeof($trip_id); $i++){
            $faq[] = array(
                "trip_id" => $trip_id[$i],
                "trip_faq" => $trip_faq[$i]
            );

        }
        $t = $input['trip_id'];
        TripFaq::insert($faq);
       return redirect('/backend/trips/'.$t[0]);

    }
    public function show($id){
       $trip_faq =  TripFaq::where('trip_id','=',$id)->get();
       return view('admin-panel.Trips.faq.show',compact('trip_faq'));
    }
    public function edit($id){
        $faq = TripFaq::find($id);
        return view('admin-panel.Trips.faq.faq',compact('faq'));
    }
    public function update(Request $request,$id){
        $faq = TripFaq::find($id);
        $input = $request->all();
        $faq->update($input);
        return redirect('/backend/trips/'.$input['trip_id']);

    }
    public function destroy($id){
        $faq = TripFaq::findOrFail($id);
        $faq->delete();
        return redirect()->back();
    }
}
