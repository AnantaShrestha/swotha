<?php

namespace App\Http\Controllers;

use App\Helper\PasswordChecker;
use App\Reviews;
use App\Trips;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index(){
        $reviews = Reviews::latest()->get();
         return view('admin-panel.Review.index',compact('reviews'));
    }
    public function show($id){
        $review = Reviews::findorFail($id);
         return view('admin-panel.Review.show',compact('review'));
    }
    public function edit($id){
        $review = Reviews::findorFail($id);
        return view('admin-panel.Review.edit',compact('review'));
    }
    public function update(Request $request, $id){
        $review = Reviews::findorFail($id);
        $review->update($request->all());
        return redirect('/backend/review');
    }
    public function approve(Request $request){
        $input = $request->all();
        $id = $input['id'];
        $review = Reviews::findOrFail($id);
        $trip_id = $review->trip_id;

        if($trip_id != 0){
            $rate = Reviews::where('trip_id','=',$trip_id)->avg('total_rating');
            $trips = Trips::find($trip_id);
            $trips->ratings = $rate;
            $trips->save();
        }

        //dd($rate);
        $review->is_accepted = 1;
        $review->save();
        return redirect('/backend/review');
    }
    public function destroy($id){
        Reviews::destroy($id);
        return redirect('/backend/review');
    }
    
    public function deleteReview(Request $request, $id){
	    $input = $request->all();
	    $result = PasswordChecker::checkpass($input['password']);
	
	    if($result == true){
		    $review = Reviews::where('id', $id)->first();
		
		    if(is_null($review)){
			    return redirect('/backend/review')->with('error', 'The review you are trying to delete doesn\'t exist.');
		    }
		    
		    $review->delete();
		    return redirect('/backend/review')->with('success', 'Review Deleted Successfully.');
	    } else {
		    return redirect('/backend/review')->with('error', 'The password you entered is incorrect.');
	    }
    }

    public function deleteFeadback(Request $request, $id){
        $input = $request->all();
        $result = PasswordChecker::checkpass($input['password']);
    
        if($result == true){
            $review = Reviews::where('id', $id)->first();
        
            if(is_null($review)){
                return redirect('/backend/review')->with('error', 'The feadback you are trying to delete doesn\'t exist.');
            }
            
            $review->recomendation_scale = null;
            $review->improve_area = null;
            $review->suggestion = null;
            
            $review->save();
            return redirect('/backend/review')->with('success', 'Feadback Deleted Successfully.');
        } else {
            return redirect('/backend/review')->with('error', 'The password you entered is incorrect.');
        }
    }

    public function instantImageReview(Request $request ,$id){
        $input = $request->all();
//      dd($input);
        $image = $input['photo'];
//      dd($image);
        if($image == null){
            $notification = array(
                'message' => 'Please upload the image.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }

        $this->validate(request(), [
            'photo' => 'required | image| max:2000',
        ]);

        $image = $request->file('photo');
        $name = time() . rand(0, 999) . '.'
            . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/reviewer');

        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $image = $request->photo->move($destinationPath, $name);

        Reviews::where('id',$id)->update(['photo'=>$name]);

        $notification = array(
            'message' => 'Your image has been uploaded successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }


}

