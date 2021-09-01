<?php

namespace App\Http\Controllers;

use App\TripItenaries;
use App\Trips;
use Illuminate\Http\Request;

class ItenaryController extends Controller
{
    public function create(Request $request){
        $info  = $request->all();
        $id = $info['trip_id'];
        $trip = Trips::findOrFail($id);
        //return $trip->days;
//        for($i=0;$i<$trip->days;$i++){
//            return $i;
//        }

        return view('admin-panel.Itenaries.createItenary',compact('trip'));
    }
    public function createone(Request $request){
        $info = $request->all();
        $trip_id = $info['trip_id'];
        return view('admin-panel.Itenaries.addone', compact('trip_id'));
    }

    public function saveone(Request $request){
        $input = $request->all();
//        dd($input);
        $trip_id = $input['trip_id'];
        $day = $input['day']-1;
        $input['day'] = $day;

        $check = TripItenaries::where('trip_id','=',$trip_id)
                                ->where('day','=',$day)->first();
        if($check){
            $message = "Day already exists";
            return view('admin-panel.Itenaries.addone', compact('message','trip_id'));
        }else{

            TripItenaries::create($input);
            return redirect('/backend/trips/');
        }


    }
    public function edit($id){
        $itenary = TripItenaries::find($id);
        return view('admin-panel.Itenaries.edit',compact('itenary'));
    }
    public function store(Request $request)
    {
        $inputs = $request->all();
//        dd($inputs);
        foreach ($inputs as $key => $val){
           if($key!="_token"){
               foreach ($inputs[$key] as $value){
                   if($key == "trip_id"){
                       $trip_id[] = $value;
                   }else if($key == "day"){
                       $day[] = $value;
                   }else if($key == "description"){
                       $description[] = $value;
                   }else if($key == "accomodation"){
                       $accomodation[] = $value;
                   }else if($key == "included_activities"){
                       $included_activities[] = $value;
                   }else{
                       $meals_included[] = $value;
                   }
               }
            }
        }

        for($i = 0; $i < count($day); $i++){
            $itenary[] = array(
                "trip_id" => $trip_id[$i],
                "day" => $day[$i],
                "description" => $description[$i],
                "accomodation" => $accomodation[$i],
                "included_activities" => $included_activities[$i],
                "meals_included" => $meals_included[$i],
            );

        }
       
        TripItenaries::insert($itenary);
        return redirect()->back();


//        TripItenaries::create($itenary);

//        return "Hello";


//        foreach ($inputs as $input)
//        {
//
//            $itenary[] = new TripItenaries(array(
//                'trip_id'=>$input('trip_id')
//                'semi_written_test'=>$input['written'],
//                'semi_reading_test'=>$input['read'],
//                'semi_class_activity'=>$input['activity'],
//                'semi_homework'=>$input['homework'],
//                'semi_total'=>$input['total'],
//                'student_id'=>$input['studentId'],
//            ));
//        }
//        dd($itenary);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id){
//        $it = TripItenaries::select('trip_id')->where ('id','=',$id);
        $itenary = TripItenaries::findOrFail($id);
        $input = $request->all();
        $input['day'] = $input['day'] - 1;
        $itenary->update($input);
        $tripid = $itenary->trip_id;
        return redirect('/backend/trips/');

    }
    public function destroy($id)
    {
        $itenary = TripItenaries::findOrFail($id);
//        $tripid = $itenary->trips->id;
//
//        $itenary->where('day','>',$itenary->day-1)
//            ->where('trip_id','=',$tripid)
//            ->increment('day');

        $itenary->delete();

        return redirect()->back();
    }
}
