<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Helper\PasswordChecker;
use App\Helper\VerifyRecaptcha;
use App\Jobs\SendEnquiryEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$contacts = Contact::latest()->get();
        return view('admin-panel.contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $token = $request->get('g-recaptcha-response');
        $captchaValidated = VerifyRecaptcha::checkRecaptcha($token);

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);

        if($captchaValidated) {
            $input = $request->all();

            $contact = Contact::create([
                'name' => ucwords($input['name']),
                'email' => $input['email'],
                'phone' => $input['phone'],
                'subject' => $input['subject'],
                'message' => $input['message']
            ]);

            $message = $input['message'];
            $subject = "Received message from: " . $input['name'];

            $job = (new SendEnquiryEmail($subject, $message))
                ->delay(Carbon::now()->addSeconds(10));

            dispatch($job);

            $notification = array(
                'message' => 'Thank you for contacting us. We will get back to you as soon as possible.',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'You are not HUMAN !',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
	    $input = $request->all();
	    $result = PasswordChecker::checkpass($input['password']);
	
	    if($result == true){
		    $contact = Contact::findOrFail($id);
		    $contact->delete();
		    return redirect()->back()->with('success', 'Message Deleted Successfully.');
	    } else {
		    return redirect()->back()->with('error', 'The Password You Entered is incorrect.');
	    }
    }
    
    public function deleteMultiple(Request $request){
	    if(!isset($request->deleteMultiple)){
		    return redirect()->back()->with('error', 'Please select at least one contact to delete.');
	    }
	    
	    $result = PasswordChecker::checkpass($request->password);
	
	    if(!$result){
		    return redirect()->back()->with('error', 'The password you entered is incorrect.');
	    }
	
	    $count = 0;
	    foreach($request->deleteMultiple as $id){
		    Contact::find($id)->delete();
		    $count++;
	    }
	
	    return redirect()->back()->with('success', $count.' contacts deleted successfully.');
    }
}
