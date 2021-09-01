<?php

namespace App\Http\Controllers;

use App\Coupons;
use App\Helper\PasswordChecker;
use App\Mail\CouponCode;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CouponController extends Controller
{
    public function index(){
    	$coupons = Coupons::latest()->get();
    	return view('admin-panel.coupon.index', compact('coupons'));
    }
    
    public function destroy(Request $request, $id){
	    $input = $request->all();
	    $result = PasswordChecker::checkpass($input['password']);
	
	    if($result == true){
		    $coupon = Coupons::findOrFail($id);
		    $coupon->delete();
		    return redirect()->back()->with('success', 'Promo code Destroyed Successfully.');
	    } else {
		    return redirect()->back()->
		    with('error', 'The Password You Entered is incorrect.');
	    }
    }
    
    public function add(Request $request){
    	$input = $request->all();
    	$user = User::where('email', $input['email'])->first();

    	if($user == null){
    	    $user = $input['email'];
    	    $user_id = null;
    	    $name = $user;
    	    $email = $user;
        }else{
            $user_id = $user->id;
            $name = $user->name;
            $email = NULL;
        }

	    $amount = round(($input['discount']/100)*$input['price']);
	    $random_code = str_random(8);
	
	    Coupons::create([
		    'user_id' => $user_id,
		    'trip_price' => $input['price'],
		    'discount' => $input['discount'],
		    'code' => $random_code,
		    'redeemed'=>0,
		    'discountamount'=>$amount,
            'email'=>$email,
	    ]);
	
	    $code = array();
	    $code[0] = $random_code;
	
	    $date = Carbon::now();
	    $date->addMonths(18);
	    $date = date('Y-m-d', strtotime($date));
	
	    Mail::to($user)->send(new CouponCode($name, $code, $input['discount'], $amount, $date));
	
	    $notification = array(
		    'message' => "Coupon Created Successfully.",
		    'alert-type' => 'success',
	    );
	    
	    return redirect()->back()->with($notification);
    }
    
    public function deleteMultiple(Request $request){
	    if(!isset($request->deleteMultiple)){
		    return redirect()->back()->with('error', 'Please select at least one enquiry to delete.');
	    }
	
	    $result = PasswordChecker::checkpass($request->password);
	
	    if(!$result){
		    return redirect()->back()->with('error', 'The password you entered is incorrect.');
	    }
	
	    $count = 0;
	    foreach($request->deleteMultiple as $id){
		    Coupons::find($id)->delete();
		    $count++;
	    }
	
	    return redirect()->back()->with('success', $count.' Promo code deleted successfully.');
    }
}
