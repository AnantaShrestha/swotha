<?php

namespace App\Http\Controllers\Auth;


use App\Helper\VerifyRecaptcha;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        $users = "user";
        $code = str_random(55);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'is_active' => $data['is_active'],
            'role' => $users,
            'password' => bcrypt($data['password']),
            'code' => $code
        ]);
        return $user;
    }

    public function register(Request $request)
    {
        $validatedData = $this->validator($request->all());
        $token = $request->get('g-recaptcha-response');
        $captchaValidated = VerifyRecaptcha::checkRecaptcha($token);

        if ($validatedData->fails()) {
            return redirect('/')
                ->with(['message' => $validatedData->errors()->get("email")[0], 'alert-type' => 'error']);
        }

        if (!$captchaValidated) {
            return redirect('/')
                ->with(['message' => "You are not HUMAN !", 'alert-type' => 'error']);
        }

        $user = $this->create($request->all());
        if ($user) {
            //Mail::to($user)->later(10, new Registration($user));
//            Session::flash();

            $message = $user->email . " has been registered to Swotah Travel Website";
            $subject = "Received message from: " . $user->name;

            /*  $job = (new SendEnquiryEmail($subject, $message))
                  ->delay(Carbon::now()->addSeconds(10));

              dispatch($job);*/

            return redirect('/')->with([
                'message' => 'Thank you for registering with us.An email has been sent to your email ' . $user->email . ' Please  verify your email, If you still have not received an email,please check your spam.',
                'alert-type' => 'success'
            ]);
        }
    }

}