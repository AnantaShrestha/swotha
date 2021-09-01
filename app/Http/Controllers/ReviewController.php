<?php

namespace App\Http\Controllers;

use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
use App\Helper\VerifyRecaptcha;
use App\Mail\NotifyAdmin;
use App\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $token = $request->get('g-recaptcha-response');
        $captchaValidated = VerifyRecaptcha::checkRecaptcha($token);
        if($captchaValidated) {
            $input = $request->all();
            $total_ratings = 0;
            $rating_value = 0;
            if (!empty($input['staff'])) {
                $rating_value += $input['staff'];
                $total_ratings++;
            }
            if (!empty($input['value'])) {
                $rating_value += $input['value'];
                $total_ratings++;
            }

            if (!empty($input['meal'])) {
                $rating_value += $input['meal'];
                $total_ratings++;
            }
            if (!empty($input['accomodation'])) {
                $rating_value += $input['accomodation'];
                $total_ratings++;
            }
            if (!empty($input['transportation'])) {
                $rating_value += $input['transportation'];
                $total_ratings++;
            }
            if (!empty($input['guide'])) {
                $rating_value += $input['guide'];
                $total_ratings++;
            }

            if ($total_ratings != 0) {
                $average_rating = ($rating_value / $total_ratings);
                $input['overall'] = $average_rating;
            }

            // for experience about the trip or just a plain review about experience with the team or company
            if ($input['review0'] == null) {
                $input['review'] = '-';
            } elseif ($input['review0'] != null) {
                $input['review'] = $input['review0'];
            }

            if (Auth::user()) {
                $input['user_id'] = Auth::user()->id;
            }

            if (empty($input['recomendation_scale'])) {
                $input['recomendation_scale'] = null;
                $input['improve_area'] = null;
                $input['suggestion'] = null;
            } else if ($input['recomendation_scale'] <= 5) {
                if (empty($input['improve_area'])) {
                    $input['improve_area'] = null;
                } else {
                    $improveArea = $input['improve_area'];
                    $saveimprove = implode(",", $improveArea);
                    $input['improve_area'] = $saveimprove;
                }

                if (empty($input['suggestion'])) {
                    $input['suggestion'] = null;
                }
            } else if ($input['recomendation_scale'] > 5) {
                $input['suggestion'] = null;
                $input['improve_area'] = null;
            }

            Reviews::create($input);

            $name = $input['name'];

            $message = 'Review: Overall Rating: ' . $input['overall'] . ' , Review Message: ' . $input['review'];

            $subject = 'Review Recieved from ' . $name;

            Mail::to('info@swotahtravel.com')->later(10, new NotifyAdmin($subject, $message));

            $notification = array(
                'message' => 'Thank you very much for taking time to review us! Your invaluable review will help us grow.',
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


    public function changeimage(Request $request)
    {
        $input = $request->all();
        $data = array();
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = time() . rand(0, 999) . '.'
                . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/reviewer');

            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // if(!Auth::user()) {
            $image = $request->photo->move($destinationPath, $name);
            // }

            if (!$image) {
                $data[0] = 'Ooops! We can\'t upload image at this moment. Sorry for the inconvenience! Please try again later!';
                return response()->json($data);
            }
            $data[0] = url('images/reviewer/' . $name);
            $data[1] = $name;

        }else{
            $data[0] = $input;

        }
        return response()->json($data);
    }
}
