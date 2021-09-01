<?php

namespace App\Http\Controllers;

use App\Bookings;
use App\HoldDates;
use App\Mail\CancelBooking;
use App\Mail\ConfirmHold;
use App\Mail\HoldCancel;
use App\Payment;
use App\TripDates;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HoldController extends Controller
{
	
	public function index(){
		$holdDates = HoldDates::orderBy('id', 'desc')->get();
		$tripDates = TripDates::all();
		return view('admin-panel.holds.index',compact('holdDates','tripDates'));
	}
	
	public function destroy($id){
		$hold = HoldDates::where('id', $id)->first();
		
		if(isset($hold->trips)){
			$hold->trips->remainingseats = $hold->trips->remainingseats + $hold->seats;
			$hold->trips->save();
			$seats = $hold->seats;
			$hold->delete();
			$message = 'Hold deleted and '.$seats.' seats added to '. $hold->trips->trips->name.' trip.';
		} else {
			$hold->delete();
			$seats = 0;
			$message = 'Hold deleted successfully. Could not find the associated trip. The trip may not exist.';
		}
		
		return redirect()->back()->with('success', $message);
	}
	
	public function hold(Request $request, $id){
		$input = $request->all();
		if(Auth::user()->is_active == 0){
			if(Auth::user()->is_active != 1){
				$notification = array(
					'message' =>'Sorry the account is not activated yet!. Click the verification link sent at '
						.Auth::user()->email.' to activate your account',
					'alert-type'=>'error',
				);
				return redirect()->back()->with($notification);
			}
		}
		
//		dd($input['seats']);
		if(!isset($input['seats']) || $input['seats'] == null){
			$notification = array(
				'message' =>'Please select number of seats to be hold',
				'alert-type'=>'error',
			);
			return redirect()->back()->with($notification);
		}
		
		$tripdates = TripDates::findOrFail($id);
		
		//User can hold 7 seats from a trip and 14 seats total from all trips
		$holdinfo = HoldDates::where([['user_id', Auth::user()->id], ['is_confirmed', 1]])->get();
		
		$totalSeats = 0;
		$maxSeats = 0;
		foreach($holdinfo as $holds){
			if($holds->trip_id == $input['deal_id']){
				$totalSeats += $holds->seats;
			}
			
			$maxSeats += $holds->seats;
		}
		
		//Checking for the maximum holds in a single seat which is 7.
		if($totalSeats >= 7){
			$notification = array(
				'message' =>'You have already hold 7 seats of this trip which is the maximum limit for hold.',
				'alert-type'=>'error',
			);
			
			return redirect()->back()->with($notification);
		} elseif(($totalSeats + $input['seats']) > 7) {
			$seats = 7 - $totalSeats;
			$notification = array(
				'message' =>'You can only hold '.$seats.' seats of this trip.',
				'alert-type'=>'error',
			);
			
			return redirect()->back()->with($notification);
		}
		
		//Checking for the max limit of hold which is 14
		if($maxSeats >= 14){
			$notification = array(
				'message' =>'You have already hold 14 seats. Please book or cancel previous holds to be able to hold again.',
				'alert-type'=>'error',
			);
			
			return redirect()->back()->with($notification);
		} elseif(($maxSeats + $input['seats']) > 14){
			$seats = 14 - $maxSeats;
			$notification = array(
				'message' =>'You can only hold '.$seats.' seats of this trip because you have already hold a total of '.$maxSeats,
				'alert-type'=>'error',
			);
			
			return redirect()->back()->with($notification);
		}
		
		$hold = new HoldDates();
		$hold->seats = $input['seats'];
		$hold->user_id = Auth::user()->id;
		$hold->trip_id = $tripdates->id;
		$hold->confirmation = str_random(55);
		$hold->is_confirmed = 0;
		$hold->seats = $input['seats'];
		$hold->date = Carbon::now();
		$hold->save();
		$user = Auth::user();
		$trips = $hold->trips->id;
		
		$trip = TripDates::find($trips);
//        dd($trips,$trip);
		
		Mail::to($user)->later(60, new ConfirmHold($user,$hold,$trip));
		$notification = array(
			'message' =>'You\'ve requested to hold the seat(s) for this date. We have sent you an email at '.Auth::user()->email.' for the confirmation.',
			'alert-type'=>'success',
		);
		return redirect()->back()->with($notification);
	}
	public function confirm($confirmation){
		$confirmHold = HoldDates::where([['confirmation','=',$confirmation], ['is_confirmed', 0]])->first();
		
		if(is_null($confirmHold)){
			return redirect('/');
		}
		
		//Check if anyone has booked seat before confirmation. OR . Check the remaining seats
		
		$remainingSeats = $confirmHold->trips->remainingseats;
		
		if($confirmHold->seats > $remainingSeats){
			$notification = array(
				'message' =>"Oooopss...We are sorry but It seems like the seats are no longer available. Somebody must have booked it or put it on 'Hold' just now. We recommend you to enquire the company for this or you can try to hold or book the seats again in few hours. Thank You!",
				'alert-type'=>'error',
			);
			
			return redirect('/')->with($notification);
		}
		
		//User can hold 7 seats from a trip and 14 seats total from all trips
		$holdinfo = HoldDates::where([['user_id', Auth::user()->id], ['is_confirmed', 1]])->get();
		
		$totalSeats = 0;
		$maxSeats = 0;
		foreach($holdinfo as $holds){
			if($holds->trip_id == $confirmHold->trip_id){
				$totalSeats += $holds->seats;
			}
			
			$maxSeats += $holds->seats;
		}
		
		//Checking for the maximum holds in a single seat which is 7.
		if($totalSeats >= 7){
			$notification = array(
				'message' =>'You have already hold 7 seats of this trip which is the maximum limit for hold.',
				'alert-type'=>'error',
			);
			
			return redirect()->back()->with($notification);
		} elseif(($totalSeats + $confirmHold->seats) > 7) {
			$seats = 7 - $totalSeats;
			$notification = array(
				'message' =>'You can only hold '.$seats.' seats of this trip.',
				'alert-type'=>'error',
			);
			
			if(Auth::user()) {
				return redirect('/profile/' . Auth::user()->name)->with($notification);
			} else {
				return redirect('/')->back()->with($notification);
			}
		}
		
		//Checking for the max limit of hold which is 14
		if($maxSeats >= 14){
			$notification = array(
				'message' =>'You have already hold 14 seats. Please book or cancel previous holds to be able to hold again.',
				'alert-type'=>'error',
			);
			
			return redirect()->back()->with($notification);
		} elseif(($maxSeats + $confirmHold->seats) > 14){
			$seats = 14 - $maxSeats;
			$notification = array(
				'message' =>'You can only hold '.$seats.' seats of this trip because you have already hold a total of '.$maxSeats.' seats',
				'alert-type'=>'error',
			);
			
			return redirect('/')->with($notification);
		}
		
		$today = Carbon::now();
		$endDate = Carbon::parse($confirmHold->date);
		
		$hours = $endDate->diffInHours($today);
		if($hours > 72){
			
			$confirmHold->delete();
			
			$notification = array(
				'message' =>'Your hold has been expired. Please hold again.',
				'alert-type'=>'error',
			);
			
			if(Auth::user()) {
				return redirect('/profile/' . Auth::user()->name)->with($notification);
			} else {
				return redirect('/')->with($notification);
			}
		}
		
		
		
		$tripdate = TripDates::findOrFail($confirmHold->trip_id);
		
		$startDate = Carbon::parse($tripdate->start_date);
		$hours = $startDate->diffInHours($today);
		
		if($hours < 720){
			$notification = array(
				'message' =>'Sorry '.Auth::user()->name.'. Cannot hold the trip as the trip is departing in less than 30 days.',
				'alert-type'=>'error',
			);
			
			if(Auth::user()) {
				return redirect('/profile/' . Auth::user()->name)->with($notification);
			} else {
				return redirect('/')->with($notification);
			}
		}
		
		$hours = $hours - 720;
		
		$expire = ($hours >= 72)?72:$hours;

//        dd($date,strtotime($tripinfo->trips->start_date));
		$notification = array(
			'message' =>'Thank you for reserving the seat(s). The reserved seat(s) will be released automatically in '.$expire.' hours. Please make sure that you book the trip wiithin '.$expire.' hours',
			'alert-type'=>'success',
		);
		
		$confirmHold->is_confirmed = 1;
		$confirmHold->save();
		$remainingSeats = $tripdate->remainingseats - $confirmHold->seats;
		$tripdate->remainingseats = $remainingSeats;
		$tripdate->save();
		if(Auth::user()) {
			return redirect('/profile/'.Auth::user()->name.'#hold')->with($notification);
		} else {
			return redirect('/')->with($notification);
		}
	}
	
	public function cancelHold($id){
		$hold = HoldDates::where('id', $id)->first();
		if(isset($hold->trips)){
			$hold->trips->remainingseats = $hold->trips->remainingseats + $hold->seats;
			$hold->trips->save();
//			$seats = $hold->seats;
			$hold->delete();
		} else {
			$hold->delete();
		}
		
		$notification = array(
			'message' =>' Your hold has been cancelled',
			'alert-type'=>'success',
		);
		
		return redirect()->back()->with($notification);
	}
	
	public function cancelReply(Request $request, $id){
		$input = $request->all();
		$hold = HoldDates::where('id', $id)->first();
		$user = $hold->user;
		$name = ucfirst($user->name);
		$message = $input['message'];
		if(!empty($hold->trips)){
			$hold->trips->remainingseats = $hold->trips->remainingseats + $hold->seats;
			$hold->trips->save();
		}
		
//		dd($hold->trips);
		Mail::to($user->email)->later(20, new HoldCancel($name,$message));
		
		$notification = array(
			'message' =>'Hold Cancellation Message Sent And Hold Deleted Successfully.',
			'alert-type'=>'success',
		);
		$hold->delete();
		return redirect()->back()->with($notification);
	}
	
	public function deleteMultiple(Request $request){
		$input = $request->all();
		$count = 0;
		foreach($input['delete'] as $id){
			$holdDelete = HoldDates::where('id', $id)->delete();
			if($holdDelete){
				$count++;
			}
		}
		
		return redirect()->back()->with('success', $count.' holds deleted successfully.');
	}
	
	public function holdthetrip($id){
		
		$date_now = strtotime(Carbon::now()->format('Y-m-d H:i:s'));
		
		$fixeddepartures = Payment::where('status','!=','canceled')
			->orWhere('status','!=','halfpayment')
			->orWhere('status','!=','fullpayment')
			->get();
//		if(!empty($fixeddepartures)) {
//			foreach ($fixeddepartures as $fixeddeparture) {
//				$date_3 = strtotime($fixeddeparture->date);
//				$date_3 = strtotime("+3 minutes", $date_3);
//				if($date_now > $date_3){
//					Payment::where('bid', '=', $fixeddeparture->bid)->update(['status' => 'canceled']);
//					$booking = Bookings::where('bookid', '=', $fixeddeparture->bid)->first();
//
//					$trip = TripDates::where('trip_id', '=', $booking->trips->trip_id)
//						->where('start_date', '=', date('Y-m-d', strtotime($booking->trips->start_date)))->first();
//
//					$tripseats = $trip->remainingseats;
//					$people = $booking->people;
//					$updateseats = $tripseats + $people;
//
//					$input['remainingseats'] = $updateseats;
//
//					TripDates::where('id', '=', $trip->id)->update(['remainingseats' => $updateseats]);
//
//					$user = $booking->user;
//					$tripdate = $booking->trips;
//
//					Mail::to($user)->send(new CancelBooking($user, $tripdate));
//				}
//			}
//		}
		
		
		$tripdates = TripDates::findorFail($id);
		
		$seats = \App\HoldDates::where([
			['user_id', '=', Auth::user()->id],
			['is_confirmed', '=', 1],
		])->get();
		
		$singleTotal = 0;
		$allTotal = 0;
		
		foreach ($seats as $seat) {
			if ($tripdates->id == $seat->trip_id) {
				if (strtotime($seat->trips->start_date) == strtotime($tripdates->start_date)) {
					$singleTotal += $seat->seats;
				}
			}
			$allTotal += $seat->seats;
		}
	
		if ($tripdates->remainingseats > 7) {
			$seats = 7;
		} else {
			$seats = $tripdates->remainingseats;
		}
		return view('frontend.tripPage.holdthetrip', compact('tripdates','seats', 'allTotal','singleTotal'));
	}
}

