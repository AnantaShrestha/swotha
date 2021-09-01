<?php

namespace App\Http\Controllers;

use App\BrochureRequest;
use App\Enquiry;
use App\Helper\PasswordChecker;
use App\Helper\VerifyRecaptcha;
use App\Jobs\SendEnquiryEmail;
use App\Mail\EnquiryReply;
use App\Mail\SendBrochure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class EnquiryController extends Controller
{
    public function store(Request $request){
        $token = $request->get('g-recaptcha-response');
        $captchaValidated = VerifyRecaptcha::checkRecaptcha($token);
        if($captchaValidated) {
            $input = $request->all();
            $inquiry = new Enquiry;
            $inquiry->name = $input['name'];
            $inquiry->email = $input['email'];
            $inquiry->nationality = $input['nationality'];
            $inquiry->message = $input['interest'];
            $inquiry->trip_id = $input['trip_id'];
            $inquiry->save();

            $request->session()->flash("message", "Thank you for submitting your inquiry. You'll hear from us within 48 hours");
            $request->session()->flash('alert-type', 'success');
            $name = $input['name'];
            $message = 'Message: ' . $input['interest'];
            $subject = 'Enquiry Received from ' . $name;

            $job = (new SendEnquiryEmail($message, $subject))
                ->delay(Carbon::now()->addSeconds(10));

            dispatch($job);
            return redirect()->back();
        } else {
            $notification = array(
                'message' => 'You are not HUMAN !',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
    }
    public function brochurestore(Request $request){

        $token = $request->get('g-recaptcha-response');
        $captchaValidated = VerifyRecaptcha::checkRecaptcha($token);

        if(!$captchaValidated) {
            $notification = array(
                'message' => 'You are not HUMAN !',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        $input = $request->all();
	    $user = BrochureRequest::create($input);
        $email = $input['email'];

        Mail::to($email)->later(10, new SendBrochure($user));
        $request->session()->flash("message", "We've sent a link for downloading a brochure. Please check your email!");
	    $request->session()->flash('alert-type', 'success');
        return redirect()->back();

    }

    public function deleteBrochures(Request $request){
	    if(!isset($request->deleteMultiple)){
		    return redirect()->back()->with('error', 'Please select at least one brochure request to delete.');
	    }

	    $result = PasswordChecker::checkpass($request->password);

	    if(!$result){
		    return redirect()->back()->with('error', 'The password you entered is incorrect.');
	    }

	    $count = 0;
	    foreach($request->deleteMultiple as $id){
		    BrochureRequest::find($id)->delete();
		    $count++;
	    }

	    return redirect()->back()->with('success', $count.' brochure requests deleted successfully.');
    }

    public function reply(Request $request){
    	$input = $request->all();
    	$name = $input['name'];
    	$email = $input['email'];
    	$id = $input['id'];
    	$message = $input['message'];

	    $inquiry = Enquiry::findOrFail($id);
	    $inquiry->reply_message = $message;
	    $inquiry->save();

    	Mail::to($email)->send(new EnquiryReply($name, $message));

	    /*$request->session()->flash('message', 'Email sent successfully.');
	    $request->session()->flash('alert-type', 'success');*/
    	return redirect('/backend/enquiry')->with('success', 'Email Sent Successfully.');

    }

    public function deleteBrochureRequest(Request $request, $id){
	    $result = PasswordChecker::checkpass($request->password);

	    if(!$result){
		    return redirect()->back()->with('error', 'The password you entered is incorrect.');
	    }

	    $brochure = BrochureRequest::find($id);

	    if(is_null($brochure)){
		    return redirect()->back()->with('error', 'The Brochure Request you are trying to delete is either already deleted or does not exist.');
	    }

	    $brochure->delete();
	    return redirect()->back()->with('success', 'Brochure Request deleted successfully.');
    }

    public function show(){
       $enquiries = Enquiry::all();
       $brochures = BrochureRequest::all();
       return view('admin-panel.enquiry.showEnquiry',compact('enquiries','brochures'));
    }
    public function view($id){
        $enquiry = Enquiry::findOrFail($id);
//        dd($enquiry->trip);
        return view('admin-panel.enquiry.view',compact('enquiry'));
    }

    public function delete(Request $request, $id){
    	$result = PasswordChecker::checkpass($request->password);

    	if(!$result){
    		return redirect()->back()->with('error', 'The password you entered is incorrect.');
	    }

	    $enquiry = Enquiry::find($id);

    	if(is_null($enquiry)){
		    return redirect()->back()->with('error', 'The enquiry you are trying to delete is either already deleted or does not exist.');
	    }

	    $enquiry->delete();
        return redirect()->back()->with('success', 'Enquiry deleted successfully.');
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
			Enquiry::find($id)->delete();
			$count++;
		}

		return redirect()->back()->with('success', $count.' enquiries deleted successfully.');
	}


}
