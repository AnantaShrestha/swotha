<?php

namespace App\Http\Controllers;


use App\Coupons;
use App\Equipment;
use App\ExtraPackage;
use App\Mail\TInvoice;
use App\TExtraServices;
use App\Themes;
use App\TPayment;
use App\TripBookedActivities;
use App\TripBookingDetail;
use App\TripBookings;
use App\Trips;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class TripBookingController extends Controller
{
    public function book($id){
        if(Auth::user()->is_active != 1){
            if(Auth::user()->is_active != 1){
                $notification = array(
                    'message' =>'Sorry the account is not activated yet!. Click the verification link sent at '
                        .Auth::user()->email.' to activate your account',
                    'alert-type'=>'error',
                );
                return redirect()->back()->with($notification);
            }
        }
       $trip = Trips::find($id);
       return view('frontend.booking.tripbook.step1', compact('trip'));
    }
    public function custom($id){
        if(Auth::user()->is_active != 1){
            if(Auth::user()->is_active != 1){
	            $notification = array(
		            'message' =>'Sorry, your account has not been activated yet. Please click the verification link from your email ('
			            .Auth::user()->email.') to activate your account. Thank You!',
		            'alert-type'=>'error',
	            );
                return redirect()->back()->with($notification);
            }
        }
        $trip = Trips::find($id);
        return view('frontend.tripPage.custom', compact('trip'));
    }


    public function step2(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['bookid'] = time();
        $request->session()->put('form1.value', $input);
        $input = Session::get('form1.value');
        $path = storage_path() . "/json/country.json";
        if (!File::exists($path)) {
            throw new Exception("Invalid File");
        }
        $file = File::get($path);
        $countries = \GuzzleHttp\json_decode($file, true);
        return view('frontend.booking.tripbook.step2', compact('input', 'countries'));

       }
    public function step3(Request $request)
    {
        $input = $request->all();
//        dd($input);
        $request->session()->put('form2.value', $input);
        $input = Session::get('form2.value');
//        dd($input);
        $bid = $input['bid'];
        $trip_id = $input['trip_id'];
        $trip = Trips::find($trip_id);
        $id = [];
        $count = 0;
        foreach ($trip->themes as $theme) {
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
	
	    $request->session()->forget('users.tripcoupons1'.Auth::user()->id);
        
        return view('frontend.booking.tripbook.step3', compact('bid', 'trip', 'trip_id',
	        'equipment_id', 'equipment_name', 'equipment_price','extrapackages'));

        }

    public function step4(Request $request){
            $input = $request->all();
//            dd($input);
            if ($input['isempty'] == 1) {
                $extra = 0;
                $trip_id = $input['trip_id'];
                $input1 = Session::get('form1.value');
                $trip = Trips::find($trip_id);
                $start_date = strtotime($input1['startdate']);
                $year = strtotime('-1 year ago');
                $_100days = strtotime('-100 day ago');
                $_60days = strtotime('-60 day ago');
                $discount = 0;
                $full = 1;
                $confirm = 100;

                if ($start_date < strtotime(Carbon::now()->format('Y-m-d'))) {
                    session('message', 'The trip has already departed');
                    return redirect()->back();
                }
                if ($start_date >= $year) {
                    $confirm = 15;
                    $discount = 10;

                }
                if ($start_date >= $_100days and $start_date < strtotime('-364 day ago')) {
                    $confirm = 20;
                    $discount = 5;
                }
                if ($start_date >= $_60days and $start_date < strtotime('-99 day ago')) {
                    $confirm = 25;
                    $discount = 0;

                }
                if ($start_date >= strtotime('-30 day ago') and $start_date < strtotime('-59 day ago')) {
                    $confirm = 50;
                    $discount = 0;

                }
                if ($start_date < strtotime('-30 day ago')) {
                    $confirm = 100;
                    $discount = 0;
                }

               
//              dd($input2);
	            $input2 = Session::get('form2.value');
//                dd($input2);
	            $people = $input2['number'];
	
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
	
	            $request->session()->put('mero1.trip', $full);
	            $request->session()->put('mero1.extra', $extra);
	            $request->session()->put('mero1.name', $name);
	            $request->session()->put('mero1.trip', $trip);
	            $request->session()->put('mero1.confirm', $confirm);
	            $request->session()->put('mero1.discount', $discount);
	            $request->session()->put('mero1.groupdiscount', $groupdiscount);
	            $request->session()->put('mero1.startdate', $start_date);
	
	            if(isset($input['extrapac'])){
		            $pac_id = $input['extrapac'];
		            $packages = ExtraPackage::findOrFail($pac_id);
		            $request->session()->put('form3.packs', $packages);
	            }
	            
                return view('frontend.booking.tripbook.invoice', compact('full', 'extra',
	                'groupdiscount', 'start_date','name', 'trip','confirm', 'discount','packages'));

            } else {

                $equipment_name = [];
                $equipment_price = [];
                $equipment_quantity = [];
                foreach ($input as $key => $val) {
                    if ($key != "_token" and $key != "trip_id" and $key != "bid" and $key != "isempty") {
                        foreach ((array)$input[$key] as $value) {
                            if ($key == "equipment_name") {
                                $equipment_name[] = $value;
                            } elseif ($key == "equipment_price") {
                                $equipment_price[] = $value;
                            } elseif ($key == "equipment_quantity") {
                                $equipment_quantity[] = $value;
                            } elseif ($key == "equipment_id") {
                                $equipment_id[] = $value;
                            } else {
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
                $trip = Trips::find($trip_id);
                $input1 = Session::get('form1.value');
                $start_date = strtotime($input1['startdate']);
                $year = strtotime('-1 year ago');
                $_100days = strtotime('-100 day ago');
                $_60days = strtotime('-60 day ago');
                $discount = 0;
                $full = 1;
                $confirm = 100;
                if ($start_date < strtotime(Carbon::now()->format('Y-m-d'))) {
                    session()->flash('message', 'Sorry! The trip has already been departed');
                    return redirect()->back();
                }
                if ($start_date >= $year) {
                    $confirm = 15;
                    $discount = 10;
                }
                if ($start_date >= $_100days and $start_date < strtotime('-364 day ago')) {

                    $confirm = 20;
                    $discount = 5;
                }
                if ($start_date >= $_60days and $start_date < strtotime('-99 day ago')) {
                    $confirm = 25;
                    $discount = 0;
                }
                if ($start_date >= strtotime('-30 day ago') and $start_date < strtotime('-59 day ago')) {
                    $confirm = 50;
                    $discount = 0;
                }
                if ($start_date < strtotime('-30 day ago')) {
                    $confirm = 100;
                    $discount = 0;
                }


                $input2 = Session::get('form2.value');
//              dd($input2);
	            $people = $input2['number'];
	
	            $price = null;
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
	
	            $request->session()->put('mero1.trip', $full);
	            $request->session()->put('mero1.extra', $extra);
	            $request->session()->put('mero1.name', $name);
	            $request->session()->put('mero1.trip', $trip);
	            $request->session()->put('mero1.confirm', $confirm);
	            $request->session()->put('mero1.discount', $discount);
	            $request->session()->put('mero1.groupdiscount', $groupdiscount);
	            $request->session()->put('mero1.startdate', $start_date);
	
	
	            if(isset($input['extrapac'])){
		            $pac_id = $input['extrapac'];
		            $request->session()->put('form3.packs', $pac_id);
		            $packages = ExtraPackage::findOrFail($pac_id);
	            }
	            
                return view('frontend.booking.tripbook.invoice', compact('full',
	                'groupdiscount', 'start_date','extra', 'name', 'trip','confirm', 'discount','packages'));

            }

    }
	public function tripcoupondiscount1(Request $request){
		$request->session()->forget('users.tripcoupons2'.Auth::user()->id);
		$input = $request->all();
		$full = Session::get('mero1.trip');
		$extra = Session::get('mero1.extra');
		$name = Session::get('mero1.name');
		$trip = Session::get('mero1.trip');
		$confirm = Session::get('mero1.confirm');
		$discount= Session::get('mero1.discount');
		$groupdiscount = Session::get('mero1.groupdiscount');
		$start_date = Session::get('mero1.startdate');
		
		$code = $input['coupon1'];
		
		if (empty($code)){
			$couponused1 = 1;
			$request->session()->flash('message', 'Empty Coupon Value');
			$request->session()->flash('alert-type', 'error');
			
			return view('frontend.booking.tripbook.invoice',compact('full','extra','trip',
				'name','start_date','confirm','discount','groupdiscount','couponused1'));
		}
		
		if($code) {
			$actualprice = Coupons::where('code', '=', $code)->first();
			if($actualprice) {
				
				if($actualprice->created_at->addMonths(18)->isPast()){
					$request->session()->flash('message', 'Your coupon has already been expired.');
					$request->session()->flash('alert-type', 'error');
					
					return view('frontend.booking.tripbook.invoice',compact('full','extra','trip',
						'name','start_date','confirm','discount','groupdiscount','couponused1'));
				}
				
				if($actualprice->redeemed == 1){
					$request->session()->flash('message', 'The Coupon your entered is already Used');
					$request->session()->flash('alert-type', 'error');
					$couponused1 = 1;
					
					return view('frontend.booking.tripbook.invoice',compact('full','extra','trip',
						'name','start_date','confirm','discount','groupdiscount','couponused1'));
				}
				$id = $actualprice->id;
			}else{
				$request->session()->flash('message', 'Coupon not found');
				$request->session()->flash('alert-type', 'error');
				$couponused1 = 1;
				
				return view('frontend.booking.tripbook.invoice',compact('full','extra','trip',
					'name','start_date','confirm','discount','groupdiscount','couponused1'));
			}
			
			$request->session()->push('users.tripcoupons1'.Auth::user()->id, $id);
			$couponused1 = 1;
		}else{
			$couponused1 = 0;
		}
		
		if($actualprice->trip_price >= $trip->price){
			$coudiscount = round(($actualprice->discount/100) * $trip->price);
		}else{
			$coudiscount = $actualprice->discountamount;
		}
		$request->session()->flash('message', 'You have received coupon discount worth $ '.$coudiscount);
		$request->session()->flash('alert-type', 'success');
		
		return view('frontend.booking.tripbook.invoice',compact('full','extra','trip',
			'name','start_date','confirm','discount','groupdiscount','couponused1'));
	}
	
	
    public function confirm(Request $request)
    {
        $input = $request->all();
//        dd($input);
        $input1 = Session::get('form1.value');
        $a = new TripBookings();
        $a->user_id = Auth::user()->id;
        $a->trip_id = $input1['trip_id'];
        $a->people = $input1['no_of_travellers'];
        $a->start_date = Carbon::parse($input1['startdate'])->format('Y-m-d');
        $a->bookid = $input1['bookid'];
        $a->save();

        $input0 = Session::get('form2.value');
        $number = $input0['number'];
        $bid = $input0['bid'];
        foreach ($input0 as $key => $val) {
            if ($key != "_token" and $key != "number" and $key != "bid" and $key != "trip_id") {
                foreach ((array)$input0[$key] as $value) {
                    if ($key == "title") {
                        $title[] = $value;
                    } else if ($key == "fname") {
                        $fname[] = $value;
                    } else if ($key == "mname") {
                        $mname[] = $value;
                    } else if ($key == "lname") {
                        $lname[] = $value;
                    } else if ($key == "email") {
                        $email[] = $value;
                    } else if ($key == "dd") {
                        $dd[] = $value;
                    } else if ($key == "mm") {
                        $mm[] = $value;
                    } else if ($key == "year") {
                        $year[] = $value;
                    }  else if ($key == "contactno") {
                        $contactno[] = $value;
                    } else if ($key == "paddress") {
                        $paddress[] = $value;
                    } else if ($key == "taddress") {
                        $taddress[] = $value;
                    } else if ($key == "country") {
                        $country[] = $value;
                    } else if ($key == "state") {
                        $state[] = $value;
                    } else if ($key == "town") {
                        $town[] = $value;
                    } else if ($key == "zip") {
                        $zip[] = $value;
                    } else if ($key == "passportno") {
                        $passportno[] = $value;
                    } else if ($key == "doi") {
                        $doi[] = $value;
                    } else if ($key == "insurance") {
                        $insurance[] = $value;
                    } else if ($key == "ic") {
                        $ic[] = $value;
                    } else if ($key == "icn") {
                        $icn[] = $value;
                    } else if ($key == "ipn") {
                        $ipn[] = $value;
                    } else if ($key == "feedback") {
                        $feedback[] = $value;
                    } else {
                        continue;
                    }
                }
            }
        }

        for ($i = 0; $i < $number; $i++) {
            if (!empty($mname[$i])) {
                $b = ucfirst($mname[$i]) . ' ';
            } else {
                $b = '';
            }
            $a = ucfirst($title[$i]) . '.' . ' ' . ucfirst($fname[$i]) . ' ' . $b . ucfirst($lname[$i]);
            $d = $year[$i].'-'.$mm[$i].'-'.$dd[$i];
            $dob = $d;

            $c = '1/1/' . $year[$i];
            $doi = date('Y-m-d', strtotime($c));
            $details[] = array(
                "bid" => $bid,
                "name" => $a,
                "email" => $email[$i],
                "dob" => $dob,
                "contactno" => $contactno[$i],
                "paddress" => $paddress[$i],
                "taddress" => $taddress[$i],
                "country" => $country[$i],
                "state" => $state[$i],
                "town" => $town[$i],
                "zip" => $zip[$i],
                "passportno" => $passportno[$i],
                "doi" => $doi,
                "insurance" => $insurance[$i],
                "ic" => $ic[$i],
                "icn" => $icn[$i],
                "ipn" => $ipn[$i],
                "feedback" => $feedback[$i]
            );
        }

        TripBookingDetail::insert($details);
        //to store
        $equipments = Session::get('form3.value');
        if($equipments != 0 or null) {
            TExtraServices::insert($equipments);
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
		    TripBookedActivities::insert($p);
	    }
        

        $payment = new TPayment();
        if ($input['chosen'] == 'fullpayment') {
            $payment->bid = $input['bid'];
            $payment->status = $input['status'];
            $payment->date = Carbon::now()->format('Y-m-d');
            $payment->chosen = $input['chosen'];
            $payment->paid_amount = $input['full_pay'];
            $payment->due_amount = $input['full_due'];
        }
        
        if ($input['chosen'] == 'confirm') {
            $payment->bid = $input['bid'];
            $payment->status = $input['status'];
            $payment->date = Carbon::now()->format('Y-m-d');
            $payment->chosen = $input['chosen'];
            $payment->paid_amount = $input['confirm_pay'];
            $payment->due_amount = $input['confirm_due'];
        }
        $payment->save();
	
	    

        $trip = Trips::find($input['trip_id']);
//      dd($tripdate);
        $name = TripBookingDetail::where('bid', '=', $input['bid'])->first();

        $equipments = TExtraServices::where('bid', '=', $input['bid'])
	        ->where('equipment_quantity','!=',0)->get();
        
        $extra = count($equipments);
	    if($input['chosen'] == 'confirm') {
		    $discount = 0;
	    }else{
		    $discount = $input['discount'];
	    }
	    
	    $gdiscount = $input['gdiscount'];
	    $sdiscount = $input['sdiscount'];
	
	    $tripbooking = TripBookings::where('bookid','=',$input['bid'])->first();
	
	
	    $coupon1discount = Session::get('users.tripcoupons1'.Auth::user()->id);
	
	    $allcoupons = null;
	
	    if($coupon1discount != null){
		    $allcoupons = Coupons::findOrFail($coupon1discount);
	    }else{
		    $allcoupons = null;
	    }
	
	    $codiscount = [];
	    $coamount = [];
	
	    if(!empty($allcoupons)) {
		    foreach ($allcoupons as $coupon) {
			    $cdis = $coupon->discount;
			    array_push($codiscount, $cdis);
			    if($coupon->trip_price >= $trip->price){
				    $camount = round(($coupon->discount/100) * $trip->price);
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
	
	    $packs = TripBookedActivities::where('bid','=',$input1['bookid'])->get();
	
	    $data = array(
            'trip' => $trip, 'name' => $name, 'equipments' => $equipments,'gdiscount'=>$gdiscount, 'sdiscount'=>$sdiscount,
            'discount' => $discount, 'extra' => $extra, 'payment' => $payment,'tripbooking'=>$tripbooking,
		    'disper'=>$totaldiscountpercentage,
		    'disamo'=>$totaldiscountamount,
		    'allpacks'=>$packs
        );
	
	    $request->session()->forget('form1.value');
	    $request->session()->forget('form2.value');
	    $request->session()->forget('form3.value');
	    $request->session()->forget('form3.packs');
	    
	    $pdf = PDF::loadView('frontend.InvoiceTemplate.pending.invoice', $data)
		    ->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);

        $pdf->save(storage_path('Invoices/Pending/invoice#' . $input['bid'] . ".pdf"));
        
	    $pdf1 = PDF::loadView('frontend.InvoiceTemplate.paid.invoice', $data)
		    ->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);
	
	    $pdf1->save(storage_path('Invoices/Paid/invoice#' . $input['bid'] . ".pdf"));
	    
        $user = Auth::user();
        Mail::to($user)->later(5,new TInvoice($user, $trip, $tripbooking, $input['bid']));
	
	    $request->session()->forget('users.tripcoupons1'.Auth::user()->id);
	    
	    $notification = array(
		    'message' =>'Thank You for booking a trip with us! Please find the invoice with bank account details at '.Auth::user()->email,
		    'alert-type'=>'success',
	    );
	    return redirect('/')->with($notification);

    }
}
