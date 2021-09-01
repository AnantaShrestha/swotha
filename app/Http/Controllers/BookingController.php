<?php

namespace App\Http\Controllers;

use App\BookedActivities;
use App\BookingDetail;
use App\Bookings;
use App\Coupons;
use App\Equipment;
use App\ExtraPackage;
use App\ExtraServices;
use App\HoldDates;
use App\Mail\Invoice;
use App\Payment;
use App\Themes;
use App\TripDates;
use App\Trips;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class BookingController extends Controller
{
	
    public function check($id){
        if(Auth::user()->is_active != 1){
            $notification = array(
                'message' =>'Sorry, your account has not been activated yet. Please click the verification link from your email ('
                    .Auth::user()->email.') to activate your account. Thank You!',
                'alert-type'=>'error',
            );
            return redirect()->back()->with($notification);
        }
        
        $tripdate = TripDates::find($id);

        $start_date = strtotime($tripdate->start_date);
        $year = strtotime('-1 year ago');
        $_100days = strtotime('-100 day ago');
        $_60days = strtotime('-60 day ago');

        if($start_date < strtotime(Carbon::now()->format('Y-m-d'))){
            
            session()->put('message','The trip has already been departed');
            return redirect()->back();
        }
        if($start_date >= $year){
            return view('frontend.booking.book1',compact('tripdate','id'));
        }
        if($start_date > $_100days and $start_date < strtotime('-364 day ago')){
            return view('frontend.booking.book1',compact('tripdate','id'));
        }
        if($start_date > $_60days and $start_date < strtotime('-99 day ago')){
            return view('frontend.booking.book1',compact('tripdate','id'));
        }
        if($start_date < strtotime('-30 day ago')){
            return view('frontend.booking.book1',compact('tripdate','id'));
        }
        return view('frontend.booking.book1',compact('tripdate','id'));
    }
    public function step2(Request $request){

        $input = $request->all();
        // dd($input);
        
        $input['user_id'] = Auth::user()->id;
        $input['bookid'] = time();
        $request->session()->put('form1.value', $input);
        $input = Session::get('form1.value');
//        dd($input);

//        $a = new Bookings();
//        $a->user_id = Auth::user()->id;
//        $a->trip_id = $input['id'];
//        $a->people = $input['no_of_travellers'];
//        $a->bookid = time();
//        $a->save();
        $path = storage_path() . "/json/country.json";
        if (!File::exists($path)) {
            throw new Exception("Invalid File");
        }
        $file = File::get($path);
        $countries = \GuzzleHttp\json_decode($file,true);
//        dd($countries);

        return view('frontend.booking.book2',compact('input','countries'));

    }
    public function step3(Request $request){

        $input = $request->all();
        $request->session()->put('form2.value', $input);
        $input = Session::get('form2.value');
        
        $bid = $input['bid'];
        $trip_id = $input['trip_id'];

        $tripdates = TripDates::find($trip_id);

        $trip = Trips::find($tripdates->trips->id);
        $id = [];
        $count = 0;
        foreach ($trip->themes as $theme){
            $id[$count++] = $theme->id;
        }
        $themes = Themes::find($id);
        $equipment_name = [];
        $equipment_price = [];
        $equipment_id = [];
        $items = [];
        $count = 0;
        foreach ($themes as $theme) {
            foreach ($theme->equipments as $equip) {
                $items[$count++] = $equip->id;
//
            }
        }
        $uniqueitems = array_unique($items);
        $allequipments = Equipment::findOrfail($uniqueitems);
//        dd($allequipments);

        $count = 0;
        foreach ($allequipments as $equip) {
            $equipment_name[$count] = $equip->name;
            $equipment_price[$count] = $equip->price;
            $equipment_id[$count] = $equip->id;
            $count++;
        }
        
        $extrapackages = $trip->extraPackages;
	    $request->session()->forget('users.coupons1'.Auth::user()->id);
        return view('frontend.booking.book3',compact('bid','trip','trip_id','equipment_id','equipment_name','equipment_price', 'extrapackages'));
    }
    
    public function step4(Request $request){
    	
        $input = $request->all();
        
        if($input['isempty'] == 1){
	        $extra = 0;
            $trip_id = $input['trip_id'];
	        $tripdate = TripDates::find($trip_id);
	        $trip = Trips::find($tripdate->trip_id);
            $start_date = strtotime($tripdate->start_date);

            $year = strtotime('-1 year ago');

            $_100days = strtotime('-100 day ago');
            $discount  = 0;
            $book = 0;
	        $full = 1;
            $confirm = 100;

            if($start_date < strtotime(Carbon::now()->format('Y-m-d'))){
               session()->put('message','The trip has already been departed');
                return redirect()->back();
            }
            
            if($start_date >= $year){
	            $discount = 10;
            }
            if($start_date >= $_100days and $start_date < strtotime('-364 day ago')){
	            $discount = 5;
            }
            if($start_date < strtotime('-99 day ago')){
	            $discount = 0;
            }

            $input2 = Session::get('form2.value');
	        $people = $input2['number'];
//
	        $totalrange = explode(',', $trip->customtrip->group_discount);
	
	        foreach ($totalrange as $item) {
		        $price = explode('=', $item);
	        }
	        
	        $person = $price[0];
	        $dis =$price[1];
	
	        $price = null;
	
	        if($people >= $person){
		        $groupdiscount = str_replace('%','', $dis);
	        }
	
	        foreach ($totalrange as $item) {
		        $price = explode('=', $item);
		
		        if($people == 1){
			        $groupdiscount = 0;
			        continue;
		        }elseif($price[0] == $people){
			        $groupdiscount = str_replace('%','', $price[1]);
			        continue;
		        }
	        }
	        
//	        dd($groupdiscount);
            foreach ($input2 as $key => $val){
                if($key!="_token" and $key != "number" and $key !="bid" and $key != "trip_id"){
                    foreach((array) $input2[$key] as $value){
                        if($key == "title"){
                            $title[] = $value;
                        }elseif($key == "fname"){
                            $fname[] = $value;
                        }else if($key == "mname"){
                            $mname[] = $value;
                        } else if($key == "lname"){
                            $lname[]= $value;
                         }
                        }
                     }
                    }


            if(!empty($mname[0])) {
             $b = ucfirst($mname[0]) . ' ';}
             else
                 {$b = '';}
	        $name = ucfirst($title[0]).'.'.''.ucfirst($fname[0]).' '.$b.ucfirst($lname[0]);
	        
	        $request->session()->put('mero.trip', $full);
	        $request->session()->put('mero.extra', $extra);
	        $request->session()->put('mero.name', $name);
	        $request->session()->put('mero.trip', $trip);
	        $request->session()->put('mero.tripdate', $tripdate);
	        $request->session()->put('mero.book', $book);
	        $request->session()->put('mero.confirm', $confirm);
	        $request->session()->put('mero.discount', $discount);
	        $request->session()->put('mero.groupdiscount', $groupdiscount);
	
	
	        if(isset($input['extrapac'])){
		        $pac_id = $input['extrapac'];
		        $packages = ExtraPackage::findOrFail($pac_id);
		        $request->session()->put('form3.packs', $packages);
	        }
	        
            return view('frontend.booking.invoice1',compact('full','extra','name','trip',
                'tripdate','book','confirm','discount','groupdiscount','packages'));

        }
        else{
        	
            $equipment_name = [];
            $equipment_price = [];
            $equipment_quantity = [];
            foreach ($input as $key => $val){
                if($key!="_token" and $key != "trip_id" and $key !="bid" and $key != "isempty") {
                    foreach ((array) $input[$key] as $value) {
                        if($key == "equipment_name"){
                            $equipment_name[] = $value;
                        }elseif ($key == "equipment_price"){
                            $equipment_price[] = $value;
                        }elseif($key == "equipment_quantity"){
                            $equipment_quantity[] = $value;
                        }elseif($key == "equipment_id"){
                            $equipment_id[] = $value;
                        } else{
                            continue;
                        }
                    }
                }
            }

	        $number = array_sum($equipment_quantity);
            if($number != 0){
		        for ($i = 0; $i < count($equipment_name); $i++) {
			        $flag[$i] = false;
			        if($equipment_quantity[$i] != 0){
				        $flag[$i] = true;
			        }
			        if($flag[$i] == true) {
				        $equipments[] = array(
					        'bid' => $input['bid'],
					        "equipment_name" => $equipment_name[$i],
					        'equipment_price' => $equipment_price[$i],
					        'equipment_quantity' => $equipment_quantity[$i]
				        );
			        }
		        }
	        }else{
            	$equipments = 0;
	        }
	        
	        if($equipments != 0) {
		        $request->session()->put('form3.value', $equipments);
		        $extra = 1;
	        }else{
		        $extra = 0;
	        }
	     
            $trip_id = $input['trip_id'];
//            dd($trip_id);
            $tripdate = TripDates::find($trip_id);
            $trip = Trips::find($tripdate->trip_id);
            $start_date = strtotime($tripdate->start_date);
            $year = strtotime('-1 year ago');
            $_100days = strtotime('-100 day ago');
            $_60days = strtotime('-60 day ago');
            $discount  = 0;
            $book = 0;
            $possible_book = 0;
            $full = 1;
            $confirm = 100;

            
            if($start_date >= $year){
                $book = 10;
                $confirm = 15;
                $discount = 10;
                $possible_book = 1;
            }
            if($start_date >= $_100days and $start_date < strtotime('-364 day ago')){
                $book = 10;
                $confirm = 20;
                $discount = 5;
                $possible_book = 1;
            }
            if($start_date >= $_60days and $start_date < strtotime('-99 day ago')){
                $book = 10;
                $confirm = 25;
                $discount = 0;
                $possible_book = 1;
            }
            if($start_date >= strtotime('-30 day ago') and $start_date < strtotime('-59 day ago') ){
                $book = 10;
                $confirm = 50;
                $discount = 0;
                $possible_book = 1;
            }
            if($start_date < strtotime('-30 day ago')){
                $possible_book = 0;
                $confirm = 100;
                $discount = 0;
            }

            $input2 = Session::get('form2.value');
	        $people = $input2['number'];
//            dd($input2);
	
	        $totalrange = explode(',', $trip->customtrip->group_discount);
	
	        foreach ($totalrange as $item) {
		        $price = explode('=', $item);
	        }
	        $person = $price[0];
	        $dis =$price[1];
	
	        $price = null;
	
	        if($people >= $person){
		        $groupdiscount = str_replace('%','', $dis);
	        }
	
	        foreach ($totalrange as $item) {
		        $price = explode('=', $item);
		
		        if($people == 1){
			        $groupdiscount = 0;
			        continue;
		        }elseif($price[0] == $people){
			        $groupdiscount = str_replace('%','', $price[1]);
			        continue;
		        }
	        }
	        
//	        dd($groupdiscount, $people);
            foreach ($input2 as $key => $val){
                if($key!="_token" and $key != "number" and $key !="bid" and $key != "trip_id"){
                    foreach((array) $input2[$key] as $value){
                        if($key == "title"){
                            $title[] = $value;
                        }elseif($key == "fname"){
                            $fname[] = $value;
                        }else if($key == "mname"){
                            $mname[] = $value;
                        } else if($key == "lname"){
                            $lname[]= $value;
                        }
                    }
                }
            }
            
            if(!empty($mname[0])) {
                $b = ucfirst($mname[0]) . ' ';}
            else
            {$b = '';}
            $name = ucfirst($title[0]).'.'.''.ucfirst($fname[0]).' '.$b.ucfirst($lname[0]);
	
	        $request->session()->put('mero.trip', $full);
	        $request->session()->put('mero.extra', $extra);
	        $request->session()->put('mero.name', $name);
	        $request->session()->put('mero.trip', $trip);
	        $request->session()->put('mero.tripdate', $tripdate);
	        $request->session()->put('mero.book', $book);
	        $request->session()->put('mero.confirm', $confirm);
	        $request->session()->put('mero.discount', $discount);
	        $request->session()->put('mero.groupdiscount', $groupdiscount);
	
	        if(isset($input['extrapac'])){
		        $pac_id = $input['extrapac'];
		        $request->session()->put('form3.packs', $pac_id);
		        $packages = ExtraPackage::findOrFail($pac_id);
	        }
	        
	        return view('frontend.booking.invoice1',compact('full','extra','trip',
                'name','tripdate','book','confirm','discount','possible_book','groupdiscount','packages'));

        }
    }
	
	public function coupondiscount1(Request $request){
		$input = $request->all();
//		dd($input);
		$full = Session::get('mero.trip');
		$extra = Session::get('mero.extra');
		$name = Session::get('mero.name');
		$trip = Session::get('mero.trip');
		$tripdate = Session::get('mero.tripdate');
		$book = Session::get('mero.book');
		$confirm = Session::get('mero.confirm');
		$discount = Session::get('mero.discount');
		$pac_id = Session::get('form3.packs');
		if(!empty($pac_id)) {
			$packages = ExtraPackage::findOrFail($pac_id);
		}
		
//		dd($discount);
		$groupdiscount = Session::get('mero.groupdiscount');
		$code = $input['coupon1'];
		
		$coupon1discount = Session::get('users.coupons1'.Auth::user()->id);

		if($coupon1discount != null) {
			$all = array_unique($coupon1discount);
			$coupid = Coupons::where('code', '=', $code)->first();
			
			
			if (in_array($coupid->id, $all)) {
				$couponused1 = 0;
				$request->session()->put('message', 'You have already used this coupon');
				return view('frontend.booking.invoice1', compact('full', 'extra', 'trip',
					'name', 'tripdate', 'book', 'confirm', 'discount', 'groupdiscount', 'couponused1', 'packages'));
			}
		}
		
		$coudiscount = null;
		
		if (empty($code)){
			$couponused1 = 1;
			$request->session()->put('message', 'Empty Coupon Value');
			
			return view('frontend.booking.invoice1',compact('full','extra','trip',
				'name','tripdate','book','confirm','discount','groupdiscount','couponused1','packages'));
		}
		
		if($code) {
			$actualprice = Coupons::where('code', '=', $code)->first();
			if($actualprice) {
				if($actualprice->created_at->addMonths(18)->isPast()){
					$couponused1 = 1;
					$request->session()->put('message', 'Your coupon has already been expired.');
					return view('frontend.booking.invoice1',compact('full','extra','trip',
						'name','tripdate','book','confirm','discount','groupdiscount','couponused1','packages'));
				}
				
				if($actualprice->redeemed == 1){
					$request->session()->put('message', 'Coupon already Used');
					$couponused1 = 1;
					return view('frontend.booking.invoice1',compact('full','extra','trip',
						'name','tripdate','book','confirm','discount','groupdiscount','couponused1','packages'));
				}
				$id = $actualprice->id;
			}else{
				$request->session()->put('message', 'Coupon not found');
				$couponused1 = 1;
				return view('frontend.booking.invoice1',compact('full','extra','trip',
					'name','tripdate','book','confirm','discount','groupdiscount','couponused1','packages'));
			}
			
			$request->session()->push('users.coupons1'.Auth::user()->id, $id);
			$couponused1 = 1;
		}else{
			$couponused1 = 0;
		}
		
		if($actualprice->trip_price >= $tripdate->trips->price){
			$coudiscount = round(($actualprice->discount/100) * $tripdate->trips->price);
			$remainamount = $actualprice->discountamount - $coudiscount;
			
			if($remainamount > 0){
				$coudiscount = round(($actualprice->discount/100) * $tripdate->trips->price);
				
			}else{
				$coudiscount = $actualprice->discountamount;
			}
			
		}else{
			$coudiscount = $actualprice->discountamount;
		}
		
		if($remainamount > 0){
			
			$request->session()->put('message', 'You have received coupon discount worth $ '.$coudiscount.' and you can use remaining $'.$remainamount.' for another booking using same coupon');
			
			return view('frontend.booking.invoice1',compact('full','extra','trip',
				'name','tripdate','book','confirm','discount','groupdiscount','couponused1','packages'));
			
		}else{
			
			$request->session()->put('message', 'You have received coupon discount worth $ '.$coudiscount);
			return view('frontend.booking.invoice1',compact('full','extra','trip',
				'name','tripdate','book','confirm','discount','groupdiscount','couponused1','packages'));
		}
		
	}
	
	
    public function confirm(Request $request){
        $input = $request->all();
//        dd($input);
        //save form1 value to database -- bookings
        $input1 = Session::get('form1.value');
        $a = new Bookings();
        $a->user_id = Auth::user()->id;
        $a->trip_id = $input1['trip_id'];
        $a->people = $input1['no_of_travellers'];
        $a->bookid = $input1['bookid'];
        $a->save();
        //save form2 value to database --- bookingsdetails
        $input2 = Session::get('form2.value');
        $number = $input2['number'];
        $bid = $input2['bid'];
        foreach ($input2 as $key => $val){
            if($key!="_token" and $key != "number" and $key !="bid" and $key != "trip_id"){
                foreach((array) $input2[$key] as $value){
                    if($key == "title"){
                        $title[] = $value;
                    }else if($key == "fname"){
                        $fname[] = $value;
                    }else if($key == "mname"){
                        $mname[] = $value;
                    } else if($key == "lname"){
                        $lname[] = $value;
                    }else if($key == "email"){
                        $email[] = $value;
                    }else if($key == "dd"){
                        $dd[] = $value;
                    }else if($key == "mm"){
                        $mm[] = $value;
                    }else if($key == "year"){
                        $year[] = $value;
                    }else if($key == "contactno"){
                        $contactno[] = $value;
                    }else if($key == "paddress"){
                        $paddress[] = $value;
                    }else if($key == "taddress"){
                        $taddress[] = $value;
                    }else if($key == "country"){
                        $country[] = $value;
                    }else if($key == "state"){
                        $state[] = $value;
                    }else if($key == "town"){
                        $town[] = $value;
                    }else if($key == "zip"){
                        $zip[] = $value;
                    }else if($key == "passportno"){
                        $passportno[] = $value;
                    }else if($key == "doi"){
                        $doi[] = $value;
                    }else if($key == "insurance"){
                        $insurance[] = $value;
                    }else if($key == "ic"){
                        $ic[] = $value;
                    }else if($key == "icn"){
                        $icn[] = $value;
                    }else if($key == "ipn"){
                        $ipn[] = $value;
                    }else if($key == "feedback"){
                        $feedback[] = $value;
                    }else{
                        continue;
                    }
                }
            }
        }
        for($i = 0; $i < $number; $i++){
            if(!empty($mname[$i])) {
                $b = ucfirst($mname[$i]) . ' ';} else {$b = '';}
            $a = ucfirst($title[$i]).'.'.' '.ucfirst($fname[$i]).' '.$b.ucfirst($lname[$i]);
            $d = $year[$i].'-'.$mm[$i].'-'.$dd[$i];
            $dob = $d;
            $c = '1/1/'.$year[$i];
            $doi = date('Y-m-d', strtotime($c));

            $details[] = array(
                "bid" => $bid,
                "name" => $a,
                "email" => $email[$i],
                "dob" => $dob,
                "contactno"=>$contactno[$i],
                "paddress" => $paddress[$i],
                "taddress" => $taddress[$i],
                "country"=>$country[$i],
                "state"=>$state[$i],
                "town"=>$town[$i],
                "zip"=>$zip[$i],
                "passportno"=>$passportno[$i],
                "doi" => $doi,
                "insurance"=> $insurance[$i],
                "ic" => $ic[$i],
                "icn" => $icn[$i],
                "ipn" => $ipn[$i],
                "feedback"=>$feedback[$i]
            );
        }
          dd($details);
        BookingDetail::insert($details);

        //insert the equipments details
        $equipments = Session::get('form3.value');
//        dd($equipments);
        if($equipments != null) {
            ExtraServices::insert($equipments);
        }
        
        $pac_id = Session::get('form3.packs');
        if(!empty($pac_id)){
        	$packages = ExtraPackage::findOrFail($pac_id);
        	foreach ($packages as $package){
        		$p[] = array(
        			'bid' => $input1['bookid'],
        			'title'=>$package->title,
        			'price'=>$package->price
		        );
	        }
	        BookedActivities::insert($p);
        }
        
        //decrease the remaining seats
        $inputdate = $input['trip_date'];

        $dates = date("Y-m-d",strtotime($inputdate));
        $tripdates = TripDates::where('id','=',$input['trip_id'])
            ->where('start_date','=', $dates)
            ->first();
        $remainseat = $tripdates->remainingseats;
		//cODE HO
//	    dd($input['bid']);
        $tr = Bookings::where('bookid','=',$input['bid'])->first();
    
        $bookedseats = $tr->people;
        
	    if(!isset($input1['is_hold'], $input1['hold_id'])){
		    $updateseats = $remainseat - $bookedseats;
		    TripDates::where('id', '=', $input['trip_id'])->update(['remainingseats' => $updateseats]);
	    } else {
		    HoldDates::where('id', $input1['hold_id'])->delete();
	    }

        $payment = new Payment();
        if($input['chosen'] == 'fullpayment'){
            $payment->bid = $input['bid'];
            $payment->status = $input['status'];
            $payment->date = Carbon::now()->format('Y-m-d');
            $payment->chosen = $input['chosen'];
            $payment->paid_amount = $input['full_pay'];
            $payment->due_amount = $input['full_due'];
        }
        
        if($input['chosen'] == 'confirm'){
            $payment->bid = $input['bid'];
            $payment->status = $input['status'];
            $payment->date = Carbon::now()->format('Y-m-d');
            $payment->chosen = $input['chosen'];
            $payment->paid_amount = $input['confirm_pay'];
            $payment->due_amount = $input['confirm_due'];
        }
        $payment->save();
        

        $tripdate = TripDates::find($input['trip_id']);
        $name = BookingDetail::where('bid','=',$input['bid'])->first();

        $equipments = ExtraServices::where('bid','=',$input['bid'])
	        ->where('equipment_quantity','!=',0)->get();
        $extra = count($equipments);
        
	    if($input['chosen'] == 'confirm') {
		    $discount = 0;
	    }else{
		    $discount = $input['discount'];
	    }
	    $booking = Bookings::where('bookid','=',$input['bid'])->first();
	    
	    $gdiscount = $input['gdiscount'];
	    $sdiscount = $input['sdiscount'];
	    $ldiscount = $input['ldiscount'];
	    
	    $coupon1discount = Session::get('users.coupons1'.Auth::user()->id);
	    
	    $allcoupons = null;
	    
	    if($coupon1discount != null) {
		    $allcoupo = Coupons::findOrFail($coupon1discount);
		    $allcoupons = $allcoupo->where('partial_used','=',0);
	    }
	    else{
	    	$allcoupons = null;
	    }
	    
	    $codiscount = [];
	    $coamount = [];
	    
	    if(!empty($allcoupons)) {
		    foreach ($allcoupons as $coupon) {
			    $cdis = $coupon->discount;
			    array_push($codiscount, $cdis);
			    if($coupon->trip_price >= $tripdate->price){
				    $camount = round(($coupon->discount/100) * $tripdate->price);
			    }else{
				    $camount = $coupon->discountamount;
			    }
			    array_push($coamount, $camount);
			    $coupon->update(['redeemed'=>1]);
		    }
		    $totaldiscountpercentage = array_sum($codiscount);
		    $totaldiscountamount = array_sum($coamount);
	    }else{
		    $totaldiscountpercentage = null;
		    $totaldiscountamount = null;
	    }
	    
	    $packs = BookedActivities::where('bid','=',$input1['bookid'])->get();
//	    dd($packs);
	    
//	    if(!empty($packs)){
//	    	$allpacks = $packs;
//	    }else{
//	    	$allpacks = 0;
//	    }
	    
        $data = array(
            'tripdate'=> $tripdate, 'name'=>$name,'equipments' => $equipments,
	        'discount' => $discount, 'extra' => $extra, 'payment' => $payment,
	        'booking' =>$booking, 'gdiscount'=>$gdiscount, 'sdiscount'=>$sdiscount, 'ldiscount'=>$ldiscount,
	        'disper'=>$totaldiscountpercentage,
	        'disamo'=>$totaldiscountamount,
	        'allpacks'=>$packs
        );
//        dd($data);
//        dd($tripdate, $name, $equipments, $discount, $extra, $payment, $booking);
	    $request->session()->forget('form1.value');
	    $request->session()->forget('form2.value');
	    $request->session()->forget('form3.value');
	    $request->session()->forget('form3.packs');
	    
        $pdf = PDF::loadView('frontend.InvoiceTemplate.pending.invoice1', $data)
	        ->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);
//	    return $pdf->download('invoice.pdf');
//	    PDF::loadHTML($html)->setPaper('a4')->setOrientation('landscape')->setOption('margin-bottom', 0)->save('myfile.pdf')
        $pdf->save(storage_path('Invoices/Pending/invoice#'.$input['bid'].".pdf"));
	
	    $pdf1 = PDF::loadView('frontend.InvoiceTemplate.paid.invoice1', $data)
		    ->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);
	
	    $pdf1->save(storage_path('Invoices/Paid/invoice#' . $input['bid'] . ".pdf"));
	    
        $user = Auth::user();
        Mail::to($user)->later(5, new Invoice($user,$tripdate,$input['bid']));
	
	    $request->session()->forget('users.coupons1'.Auth::user()->id);
	    $notification = array(
		    'message' =>'Thank You for booking a trip with us! Please find the invoice with bank account details at '.Auth::user()->email,
		    'alert-type'=>'success',
	    );
	    
	    return redirect('/')->with($notification);
    }
    
}
