<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Bookings;
use App\Details;
use App\HoldDates;
use App\Mail\PrimaryVerify;
use App\Mail\SecondaryVerify;
use App\TrekkingPartners;
use App\TripBookings;
use App\User;
use App\UserPaymentDetails;
use App\WishList;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;


class UserProfileController extends Controller
{
	public function index(){
	$userid = Auth::user()->id;
	
	/*clear the cache*/
	Artisan::call('cache:clear');
	Artisan::call('view:clear');
	
	$trekpartners_trips = TrekkingPartners::where('user_id',$userid)->get();
	// dd($trekpartners_trips);

	$wishes = WishList::where('user_id','=',$userid)->get();
//    dd($wishes);

	$fixedbook = Bookings::where('user_id','=',$userid)->get();
	
	$fixedbooks = [];
	$fullPaymentFixed = [];
	if($fixedbook) {
		foreach ($fixedbook as $b) {
			if ($b->payment != null) {
				if ($b->payment->status == "pending") {
					array_push($fixedbooks, $b);
				} elseif ($b->payment->status == "fullpaid" || $b->payment->status == "halfpaid") {
					$fullPaymentFixed[] = $b;
				}
			}
		}
	}
	$datebook = TripBookings::where('user_id','=',$userid)->get();
	
	$datebooks = [];
	$fullPaymentTrips = [];
	if($datebook) {
		foreach ($datebook as $b) {
			if ($b->payment != null) {
				if ($b->payment->status == "pending") {
					array_push($datebooks, $b);
				} elseif ($b->payment->status == "fullpaid" || $b->payment->status == "halfpaid") {
					$fullPaymentTrips[] = $b;
				}
			}
		}
	}

	$blogs = Articles::where('user_id', Auth::user()->id)->get();
	
	// $blogs = Articles::where([
	// 	['user_id', Auth::user()->id],
	// 	['is_published', 1],
	// ])->get();

	$holds = HoldDates::where('user_id','=',$userid)
        ->where('is_confirmed','=',1)->Where('booked','!=',1)->get();
 

	
//    foreach ($datebooks as $d){
//       echo  $d->trips->name;
//       echo  $d->trips->slug;
//       echo  $d->trips->cover_image;
//       echo  $d->created_at;
//       echo '<br>';
//    }

//    foreach ($datebooks as $db){
//        foreach ($db->tbdetail as $person){
//            echo $person->name.'<hr>';
//        }
//    }

//    $bokdetails = TripBookingDetail::all();

//   dd($bokdetails);

//
//    foreach ($bokdetails as $b){
//        if ($b->tripbookings->user_id == $userid){
//            dd($b);
//        }
//    }


//    foreach ($datebooks as $db){
//        echo 'Trip:'.$db->trip_id.'<br>';
//        echo 'Book:'.$db->start_date.'<br>';
//        echo 'Book:'.$db->tripbookings->name.'<br>';
////
////        foreach ($db as $d){
////            echo $d->tripbookings->id.'<hr>';
////        }
//    }
//    dd($datebooks);

//    foreach ($hold as $s){
//        echo $s->date.'<br>';
//    echo $s->trips->trips->name.'<br>';
//    }

//    foreach ($book as $d){
//        echo $d->trip_id.'<br>';
//    }

//    $count= 0;
//    foreach ($book as $b){
////         echo  $b->bdetail->name.'<br><br>';
//         foreach ($b->bdetail as $sd){
//             echo $sd->bid.'-';
//             echo $sd->name.'<br><br><hr>';
//         }
//         $count++;
//    }
//    dd($count);

//        $tripsId = array();
//
//        foreach ($books as $book){
//            if(!in_array($book->trip->trip_id, $tripsId, true)){
//                array_push($tripsId, $book->trip->id);
//            }
//        }
//
//        $uniqueTrip = array_unique($tripsId);
//
//        $Bookedtrips = Trips::find($uniqueTrip);
		$path = storage_path() . "/json/country.json";
		if (!File::exists($path)) {
			throw new Exception("Invalid File");
		}
		$file = File::get($path);
		$countries = \GuzzleHttp\json_decode($file,true);
			
		$paymentDetails = UserPaymentDetails::where('user_id','=',$userid)->get();

		return view('frontend.userprofile.profile',
            compact('countries','wishes','holds','fixedbooks','datebooks',
                'fullPaymentFixed', 'fullPaymentTrips', 'blogs','paymentDetails','trekpartners_trips'));
	}
	
	public function update(Request $request, $id){
		$input = $request->all();
		
		if($input['table'] == 'user'){
		   if(isset($input['name'])){
				$this->validate(request(), [
					'name' => 'required|string|max:30',
				]);
				
				$user = User::where('id', $id)->first();
				$user->name = ucfirst($input['name']);
				$user->save();
				
				$data = array();
				$data[0] = 'Name Changed Successfully.';
				$data[1] = $user->name;
				return response()->json($data);
			
		   } else if(isset($input['secondary'])){
			   $user = User::where('id', $id)->first();
			   
			   $checkIfTaken = User::where('email', $input['secondary'])->first();
			   
			   if($checkIfTaken != null){
				   $notification = array(
					   'message' => "The email address ".$input['secondary']." is already taken.",
					   'alert-type' => 'error',
				   );
				   return redirect()->back()->with($notification);
			   }
			
			   $checkIfTaken = User::where('secondary_email', $input['secondary'])->first();
			
			   if($checkIfTaken != null){
				   $notification = array(
					   'message' => "The email address ".$input['secondary']." is already taken.",
					   'alert-type' => 'error',
				   );
				   return redirect()->back()->with($notification);
			   }
			   
			   $this->validate(request(), [
					'secondary' => 'required|email|unique:users,email,'.$user->email.',email'
				]);
		
				$input = $request->all();
				
			   if($user->secondary_email == $input['secondary']){
				   $notification = array(
					   'message' => $input['secondary']." is already an secondary email.",
					   'alert-type' => 'error',
				   );
					return redirect()->back()->with($notification);
			   } elseif($user->email == $input['secondary']) {
				   $notification = array(
					   'message' => "The email is already in use as an primary email.",
					   'alert-type' => 'error',
				   );
			   	    return redirect()->back()->with($notification);
			   } elseif($input['secondary'] != $user->email && $input['secondary'] != $user->secondary_email){
			   	    $field = 'secondary_email';
			   	    $value = $input['secondary'];
					
			   	    $code = str_random(55);
			   	    
			   	    $user = User::where('id', $id)->first();
			   	    
			   	    $user->secondary_token = $code;
			   	    
			   	    $user->secondary_email = $input['secondary'];
			   	    
			   	    $user->save();
			   	    //kaam garena
			   	    
			   	    
			   	    Mail::to($input['secondary'])->send(new SecondaryVerify($user));
			   	    
				   $notification = array(
					   'message' => 'Please verify your secondary email! A verification link has been sent to ' . $input['secondary'],
					   'alert-type' => 'success',
				   );
				   
				   return redirect()->back()->with($notification);
			   }
			   
		   } elseif(isset($input['oldPassword'])){
		   	    if($input['newPassword'] != $input['confirmNewPassword']){
			        $notification = array(
				        'message' => 'Password and Confirm Password do not match.',
				        'alert-type' => 'error',
			        );
			        
			        return redirect()->back()->with($notification);
		        }
		   	
			   $this->validate(request(), [
				   'oldPassword' => 'required',
				   'newPassword' => 'required|min:6',
				   'confirmNewPassword' => 'required|min:6|same:newPassword'
			   ]);
			   
			   $oldPass = User::select('password')->where('id', $id)->first();
			   if(Hash::check($input['oldPassword'], $oldPass->password)){
				   $field = 'password';
				   $value = bcrypt($input['newPassword']);
				
				   $notification = array(
					   'message' => 'Password Changed Successfully.',
					   'alert-type' => 'success',
				   );
			   } else{
				   $notification = array(
					   'message' => 'Incorrect Password.',
					   'alert-type' => 'error',
				   );
					return redirect()->back()->with($notification);
			   }
		   } elseif(isset($input['photo'])){
				
			   $data = array();
			   
			   if($request->hasFile('photo')) {

			   	   $this->validate(request(), [
			   		   'photo' => 'required | image| max:5000'
			   	   ]);

				   $image = $request->file('photo');
				   $name = time() . rand(0, 999) . '.'
					   . $request->photo->getClientOriginalExtension();
				   $destinationPath = public_path('/images/profile');
				
				   if (!is_dir($destinationPath)) {
					   mkdir($destinationPath, 0777, true);
				   }
				
				   $image = $request->photo->move($destinationPath, $name);
				
				   if (!$image) {
					   $data[0] = 'Ooops! We can\'t upload image at this moment. Sorry for the inconvenience! Please try again later!';
					   return response()->json($data);
				   }
				   
				   $user = User::where('id', $id)->first();
				   if($user->photo != null){
				   	    if(file_exists(public_path('/images/profile/'.$user->photo))){
				   	    	unlink(public_path('/images/profile/'.$user->photo));
				        }
				   }
				   $user->photo = $name;
				   $user->save();
				
				   $data[0] = url('images/profile/'.$name);
				   
				   $notification = array(
				   		'message' => 'Your profile has been uploaded successfully.',
				   		'alert-type' => 'success',
				   	);
				   	return redirect()->back()->with($notification);
			   } else {
			   
			   }
		   }
	
			$user = User::where('id', $id)->first();
			$user->$field = $value;
			$user->save();
			return redirect()->back()->with($notification);
			
		} else if($input['table'] == 'details'){
			if(isset($input['day'])){
				$this->validate(request(), [
					'day' => 'required',
					'month' => 'required',
					'year' => 'required'
				]);
				
				$dob = $input['day'].'-'.$input['month'].'-'.$input['year'];
				
				$dob = date('d-m-Y', strtotime($dob));
				
				$details = Details::where('user_id', $id)->first();
				
				if($details == null){
					$details = new Details();
					$details->user_id = Auth::user()->id;
				}
				$details->birthday = $dob;
				$details->save();
				
				$data = array();
				$data[0] = 'Your date of birth has been changed successfully.';
				$data[1] = $details->birthday;
				
				return response()->json($data);
				
			} elseif(isset($input['address'])){
				$this->validate(request(), [
					'address' => 'required'
				]);
				
				$details = Details::where('user_id', $id)->first();
				
				if($details == null){
					$details = new Details();
					$details->user_id = Auth::user()->id;
				}
				
				$details->address = $input['address'];
				$details->save();
				
				$data = array();
				$data[0] = 'Your address has been updated successfully.';
				$data[1] = $details->address;
				
				return response()->json($data);
				
			} elseif(isset($input['contact'])){
				$this->validate(request(), [
					'contact' => 'required|numeric'
				]);
				
				$details = Details::where('user_id', $id)->first();
				
				if($details == null){
					$details = new Details();
					$details->user_id = Auth::user()->id;
				}
				
				$details->phone = $input['contact'];
				$details->save();
				
				$data = array();
				$data[0] = 'Your phone number has been updated successfully.';
				$data[1] = $details->phone;
				
				return response()->json($data);
			} elseif(isset($input['country'])){
				$this->validate(request(), [
					'country' => 'required'
				]);
				
				$details = Details::where('user_id', $id)->first();
				
				if($details == null){
					$details = new Details();
					$details->user_id = Auth::user()->id;
				}
				
				$details->nationality = $input['country'];
				$details->save();
				
				$data = array();
				$data[0] = 'Your nationality has been updated successfully.';
				$data[1] = $details->nationality;
				
				return response()->json($data);
			} elseif(isset($input['languages'])) {
				$this->validate(request(), [
					'languages' => 'required'
				]);
				
				$details = Details::where('user_id', $id)->first();
				
				if ($details == null) {
					$details = new Details();
					$details->user_id = Auth::user()->id;
				}
				
				$details->languages = $input['languages'];
				$details->save();
				
				$data = array();
				$data[0] = 'Language Details Updated Successfully.';
				$data[1] = $details->languages;
				
				return response()->json($data);
			} elseif(isset($input['interests'])) {
				$this->validate(request(), [
					'interests' => 'required'
				]);
				
				$details = Details::where('user_id', $id)->first();
				
				if ($details == null) {
					$details = new Details();
					$details->user_id = Auth::user()->id;
				}
				
				$details->interests = $input['interests'];
				$details->save();
				
				$data = array();
				$data[0] = 'Interests Updated Successfully.';
				$data[1] = $details->interests;
				
				return response()->json($data);
			} elseif(isset($input['bio'])) {
				$this->validate(request(), [
					'bio' => 'required'
				]);
				
				$details = Details::where('user_id', $id)->first();
				
				if ($details == null) {
					$details = new Details();
					$details->user_id = Auth::user()->id;
				}
				
				$details->bio = $input['bio'];
				$details->save();
				
				$data = array();
				$data[0] = 'Bio Updated Successfully.';
				$data[1] = $details->bio;
				
				return response()->json($data);
			}
		}
	}
	
	public function makePrimary(Request $request, $id){
		$input = $request->all();
		$user  = User::where('id', $id)->first();
		$primary = $user->email;
		$secondary = $user->secondary_email;
		
		if($input['primary'] == $primary){
			$msg = $input['primary']." is already an primary email.";
			$data = array();
			$data[0] = $msg;
			$data[1] = $user->email;
			$data[2] = $user->secondary_email;
			return response()->json($data);
		} else {
			$user->email = $secondary;
			$user->secondary_email = $primary;
			$user->save();
			
			$data = array();
			$msg = $user->email." is now your primary email. Your primary email will be used during login.";
			$data[0] = $msg;
			$data[1] = $user->email;
			$data[2] = $user->secondary_email;
			return response()->json($data);
		}
	}

//    public function bookdetails($id){
//        $userid = Auth::user()->id;
//        $sabaibooks = Bookings::where('user_id','=',$userid)
//            ->where('trip_id','=',$id)
//            ->get();
//
//        foreach ($sabaibooks as $s){
//            echo $s->people.'<hr>';
//        }
//
////       foreach ($sabaibooks as $onepeople){
////           echo $onepeople->id.'<br>';
////       }
//
//
//        $peopleId = array();
//
//        foreach ($sabaibooks as $book){
//            if(!in_array($book->id, $peopleId, true)){
//                array_push($peopleId, $book->id);
//            }
//        }
//        dd($peopleId);
////        foreach ($peopleId as $p) {
////            $people_details = BookingDetail::where('bid','=',$p)->get();
////            echo $people_details.'<br><hr>';
////        }
//    }

	public function submitdocument(Request $request)
	{
		$input = $request->all();
//		dd($input);
		$image = $input['document'];
//		dd($image);
		if($image == null){
			$notification = array(
				'message' => 'Please upload the Document.',
				'alert-type' => 'error',
			);
			return redirect()->back()->with($notification);
		}

		$this->validate(request(), [
			'document' => 'required | image| max:2000',
		]);


		$ext = $image->getClientOriginalExtension();
//		dd($ext);
		$filename = 'doc'.$input['bookid'].'.'.$ext;
		$input['document'] = $filename;
		TripBookings::where('bookid','=',$input['bookid'])->update(['document'=>$filename]);
		Image::make(Request::capture()->file('document'))->save( public_path('images/bankdocuments/' . $filename ));
		
		$notification = array(
			'message' => 'Your document has been successfully uploaded.',
			'alert-type' => 'success',
		);
		return redirect()->back()->with($notification);
	}
	public function submitdocuments(Request $request)
	{
		$input = $request->all();
		
		$image = $input['document'];
//		dd($image);
		if($image == null){
			$notification = array(
				'message' => 'Please upload the Document.',
				'alert-type' => 'error',
			);
			return redirect()->back()->with($notification);
		}

		$this->validate(request(), [
			'document' => 'required | image| max:2000',
		]);	


		$ext = $image->getClientOriginalExtension();
//		dd($ext);
		$filename = 'doc'.$input['bookid'].'.'.$ext;
		$input['document'] = $filename;
		Bookings::where('bookid','=',$input['bookid'])->update(['document'=>$filename]);
		Image::make(Request::capture()->file('document'))->save( public_path('images/bankdocuments/' . $filename ));
		
		$notification = array(
			'message' => 'Your document has been uploaded successfully.',
			'alert-type' => 'success',
		);
		return redirect()->back()->with($notification);
	}
	
	public function resendVerification($id){
		$user = User::where('id', $id)->first();
		
		if($user == null){
			return redirect('/');
		}
		
		$code = str_random(55);
		
		$user->secondary_token = $code;
		$user->save();
		
		Mail::to($user->secondary_email)->send(new SecondaryVerify($user));
		
		$notification = array(
			'message' => 'Please verify your secondary email! An email has been sent to your email ' . $user->secondary_email . '. Please  verify!',
			'alert-type' => 'success',
		);
		
		return redirect()->back()->with($notification);
		
	}
	
	public function resendPrimary($id){
		$user = User::where('id', $id)->first();
		
		if($user == null){
			return redirect('/');
		}
		
		$code = str_random(55);
		
		$user->code = $code;
		$user->save();
		
		Mail::to($user->email)->send(new PrimaryVerify($user));
		
		$notification = array(
			'message' => 'Please verify your primary email! A verification link has been sent to ' . $user->email,
			'alert-type' => 'success',
		);
		
		return redirect()->back()->with($notification);
	}


	public function paymentadd(Request $request){
		$userid = Auth::user()->id;

		$input = $request->all();

		$paymentDetails = new UserPaymentDetails;

		$paymentDetails->user_id = $userid;
		$paymentDetails->card_type = $input['card_type'];
		$paymentDetails->card_number = $input['card_number'];
		$paymentDetails->card_holder_name = $input['card_holder_name'];
		$paymentDetails->card_expiry_date = $input['card_expiry_date'];

		$paymentDetails->save();

		   $notification = array(
			   'message' => 'Payment details added successfully',
			   'alert-type' => 'success',
		   );
		   
		   return redirect()->back()->with($notification);

	}

	public function paymentupdate(Request $request , $id){
		$input = $request->all();

		$paymentDetails = UserPaymentDetails::find($id);

		$paymentDetails->card_type = $input['card_type'];
		$paymentDetails->card_number = $input['card_number'];
		$paymentDetails->card_holder_name = $input['card_holder_name'];
		$paymentDetails->card_expiry_date = $input['card_expiry_date'];

		$paymentDetails->save();

		   $notification = array(
			   'message' => 'Payment details updated successfully ',
			   'alert-type' => 'success',
		   );
		   
		   return redirect()->back()->with($notification);

	}

	public function paymentdelete(Request $request, $id){
		$input = $request->all();

		$paymentDetails = UserPaymentDetails::where('id','=',$id)->first();

		$paymentDetails->delete();

		   $notification = array(
			   'message' => 'Payment details deleted successfully ',
			   'alert-type' => 'success',
		   );
		   
		   return redirect()->back()->with($notification);
	}
}

