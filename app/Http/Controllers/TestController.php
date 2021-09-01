<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

//use Illuminate\Http\Response;

class TestController extends Controller
{
	public function test(){
		return Response::make(file_get_contents(storage_path('terms/SwotahBookingTermss.pdf')), 200, [
			'Content-Type' => 'application/pdf',
			'Content-Disposition' => 'inline; filename=SwotahBookingTerms.pdf'
		]);
	}
	public function invoice($id){
		$filename = 'Invoices/Pending/invoice#'.$id.'.pdf';
		$path = storage_path($filename);
		
		return Response::make(file_get_contents($path), 200, [
			'Content-Type' => 'application/pdf',
			'Content-Disposition' => 'inline; filename="' . $filename . '"'
		]);
	}
	
	public function paidinvoice($id){
		$filename = 'Invoices/Paid/invoice#'.$id.'.pdf';
		$path = storage_path($filename);
		
		return Response::make(file_get_contents($path), 200, [
			'Content-Type' => 'application/pdf',
			'Content-Disposition' => 'inline; filename="' . $filename . '"'
		]);
	}
	
	public function onlinepaidtripsinvoice($id){
		$filename = 'onlinepayment/invoice_number#'.$id.'.pdf';
		$path = storage_path($filename);
		
		return Response::make(file_get_contents($path), 200, [
			'Content-Type' => 'application/pdf',
			'Content-Disposition' => 'inline; filename="' . $filename . '"'
		]);
	}
	
	
	public function showbrochure(){

//        return Response::make(file_get_contents(storage_path('pdf/swotah_e-brochure.pdf')), 200, [
//            'Content-Type' => 'application/pdf',
//            'Content-Disposition' => 'inline; filename=swotah_e-brochure.pdf'
//        ]);
		return response()->download(storage_path('pdf/swotah_e-brochure.pdf'));
	}
	
	public function tripsinvoice($id){
		$filename = 'Invoices/Pending/invoice#'.$id.'.pdf';
		$path = storage_path($filename);
		
		return Response::make(file_get_contents($path), 200, [
			'Content-Type' => 'application/pdf',
			'Content-Disposition' => 'inline; filename="' . $filename . '"'
		]);
	}
	
	public function paidtripsinvoice($id){
		$filename = 'Invoices/Paid/invoice#'.$id.'.pdf';
		$path = storage_path($filename);
		
		return Response::make(file_get_contents($path), 200, [
			'Content-Type' => 'application/pdf',
			'Content-Disposition' => 'inline; filename="' . $filename . '"'
		]);
	}
	
	public function forgot(){
		return view('auth.forgot');
	}
	public function confirmationlink(Request $request){
		$users = User::where('email','=',$request->email)->get();
		$user = (object) $users[0];
		
		Mail::to($user)->send(new PasswordReset($user));
		flash()->overlay('A confirmation link has been sent to'.$user->email.'. Click on the confirmation link to reset your password','Thank You!');
		return redirect('/login');
		
	}
	public function resetpassword($id){
		$user = User::findOrFail($id);
		return view('auth.resetpassword',compact('user'));
	}
	public function reset(Request $request){
		$user = User::where('id', $request->user_id)->first();
		
		if(is_null($user)){
			$notification = array(
				'message' =>'User not found.',
				'alert-type'=>'error',
			);
			
			return redirect('/')->with($notification);
		}
		
		$user->password = bcrypt($request->password);
		$user->update($user);
		flash()->overlay('your password has been updated sucessfully','Thanks!');
		return redirect('/login');
	}
	public function confirm($code){
		$user = User::where('code', '=', $code)->first();
		
		if(is_null($user)){
			$notification = array(
				'message' =>'Your link has been expired.',
				'alert-type'=>'error',
			);
			
			return redirect('/')->with($notification);
		}
		
		$user->is_active = 1;
//            $user->code = null;
		$user->save();
//            session()->flash('message','Thank your for registering to Swotah Travel and Adventure');
		$notification = array(
			'message' =>'Thank your for confirming the registration! We hope you enjoy our services.',
			'alert-type'=>'success',
		);
		
		return redirect('/')->with($notification);
	}
	
	public function secondaryVerify($code){
		$user = User::where('secondary_token', $code)->first();
		
		if(is_null($user)){
			$notification = array(
				'message' =>'Your link has been expired.',
				'alert-type'=>'error',
			);
			
			return redirect('/')->with($notification);
		}
		
		if(count($user)){
			$name = $user->name;
			$user = User::where('secondary_token','=',$code)->update(['secondary_token'=>null]);
//            flash()->overlay('Your secondary email has been verified.','Congrats!');
			$notification = array(
				'message' =>'Your secondary email has been verified. Congrats!',
				'alert-type'=>'success',
			);
			$url = '/profile/'.$name;
			return redirect($url)->with($notification);
		} else {
			return redirect('/');
		}
	}
}