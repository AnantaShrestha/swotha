<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/
	
	use AuthenticatesUsers;
	
	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo='/';
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		session(['url.intended' => url()->previous()]);
		$this->redirectTo = session()->get('url.intended');

		$this->middleware('guest')->except('logout');
	}
	
	public function redirectToProvider()
	{
		return Socialite::driver('facebook')->redirect();
	}
	/**
	 * Obtain the user information from Facebook.
	 *
	 * @return Response
	 */
	public function handleProviderCallback()
	{
		try {
            $user = Socialite::driver('facebook')->stateless()->user();
        } catch (\Exception $e) {
			return redirect('/login/facebook');
		}
		
		$authUser = $this->findorCreateUser($user);
		
		if($authUser =='hasUser'){
			$currentUser = User::where('password',$user->id)->first();
			Auth::login($currentUser, true);
//			$notification = array(
//		    'message','Congratulations!, You are now logged In, Enjoy our services!',
//		    'alert-type','success'
//			);
	    return redirect('/profile/'.Auth::user()->name)->with('message', 'Congratulations! You are now logged In, Enjoy our services');
	    
		}elseif ($authUser == 'usedEmail'){
			$notification = array(
				'message','Your email has already been used, please use another method to register!',
				'alert-type','error'
			);
			return redirect('/')->with($notification);
		}elseif ($authUser == 'noEmail'){
			$notification = array(
				'message','Your Facebook Account doesn\'t have email, please use another method to register!',
				'alert-type','error'
			);

			return redirect('/')->with($notification);
		}else{
			$currentUser = User::where('password',$user->id)->first();
			Auth::login($currentUser, true);
//			$notification = array(
//				'message' =>'Thank You for your registration! An email has been sent to your email '.$currentUser->email. '. Please  verify!',
//				'alert-type'=>'success',
//			);
//            $notification = array(
//                'message','Congratulations!, You are now logged In, Enjoy your services!',
//                'alert-type','success'
//            );
//			 return redirect('/profile/'.Auth::user()->name)->with($notification);
            return redirect('/profile/'.Auth::user()->name)->with('message', 'Congratulations!, You are now logged In, Enjoy our services!');
//			return redirect()->back()->with('success', $notification);
		}
	}
	
	private function findorCreateUser($facebookUser){
		$authUser = User::where('password',$facebookUser->id)->first();
		$emailUser = User::where('email',$facebookUser->email)->first();
		$notemail = $facebookUser->email;
		if($authUser){
			return 'hasUser';
		}
		elseif ($emailUser){
			return 'usedEmail';
		}elseif($notemail == ''){
			return 'noEmail';
		}
		else {
			$role = 'user';
			$code = str_random(55);
			$is_active = 1;
			$arrContextOptions=['ssl'=>['verify_peer'=>false,'verify_peer_name'=>false]];
			$fbUrl = 'https://graph.facebook.com/'.$facebookUser->id.'/picture?type=large';
			$file = 'profile_'.$facebookUser->id.'.jpg';
			Image::make(file_get_contents($fbUrl,
				false, stream_context_create($arrContextOptions)))->save(public_path('images/profile/'.$file));
			
			$regiser = User::create([
				'name' => $facebookUser->name,
				'email' => $facebookUser->email,
				'password' => $facebookUser->id,
				'role' =>$role,
				'is_active'=>$is_active,
				'code'=>$code,
				'photo'=>$file
			
			]);
			
//			Mail::to($regiser)->later(5,new Registration($regiser));
			return $regiser;
		}
	}
}