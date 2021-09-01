<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Helper\PasswordChecker;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class AgencyController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$agencies = Agency::all();
		return view('admin-panel.Agencies.index', compact('agencies'));
	}
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function create()
	{
		$path = storage_path() . "/json/country.json";
		if (!File::exists($path)) {
			throw new Exception("Invalid File");
		}
		$file = File::get($path);
		$countries = \GuzzleHttp\json_decode($file,true);
		
		return view('auth.agentRegister', compact('countries'));
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate(request(), [
			'companyname' => 'required|max:50',
			'registration_number' => 'required|unique:agencies,agency_number|max:50',
			'country' => 'required',
			'agencyaddress' => 'required',
			'acity' => 'required',
			'apostalcode' => 'required',
			'agencyemail' => 'required|unique:agencies,agency_email',
			'ampassword' => 'required|min:6',
			'amconfirmPassword' => 'required|min:6|same:ampassword',
			'agencypublicphone' => 'required|unique:agencies,agency_public_phone',
			'aphonenumber' => 'required|unique:agencies,private_number',
			'amfirstname' => 'required',
			'amlastname' => 'required',
			'amemail' => 'required|unique:users,email',
			'document' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
		]);
		
		$code = str_random(50);
		
		$name = $request->amfirstname . " " . ((isset($request->middle_name)
				&& $request->middle_name != '') ? $request->middle_name : "")
			. $request->amlastname;
		
		$user = User::create([
			'name' => ucwords($name),
			'email' => $request->amemail,
			'is_active' => 1,
			'role' => 'agent',
			'password' => bcrypt($request->ampassword),
			'code' => $code
		]);
		
		if ($request->hasFile('document')) {
			$image = $request->file('document');
			$name = time() . rand(0, 999) . '.'
				. $request->document->getClientOriginalExtension();
			$destinationPath = public_path('/documents');
			
			if (!is_dir($destinationPath)) {
				mkdir($destinationPath, 0777, true);
			}
			
			$image = $request->document->move($destinationPath, $name);
			
			if (!$image) {
				return redirect()->back()->with('error', 'Can\'t upload image at this moment. Please try again later.');
			}
		}
		Mail::to($user)->send(new Registration($user));
		$notification = array(
			'message' => 'Thank You for your registration! An email has been sent to your email ' . $user->email . '. Please  verify!',
			'alert-type' => 'success',
		);
		return redirect('/')->back()->with($notification);
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$agency = Agency::where('id', $id)->first();
		$userInfo = User::where('id', $agency->user_id)->first();
		
		return view('admin-panel.Agencies.showAgency', compact('agency', 'userInfo'));
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
	public function destroy(Request $request , $id)
	{
		$input = $request->all();
		$result = PasswordChecker::checkpass($input['password']);
		
		if($result == true){
			$agency = Agency::findOrFail($id);
			$agency->delete();
			return redirect()->back()->with('success', 'Agency Deleted Successfully.');
		} else {
			return redirect()->back()->with('error', 'The Password You Entered is incorrect.');
		}
	}
}