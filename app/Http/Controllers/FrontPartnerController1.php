<?php

namespace App\Http\Controllers;

use App\Bookings;
use App\Comments;
use App\PartnerRequirements;
use App\Replies;
use App\TrekkingPartners;
use App\TripBookings;
use App\TripDates;
use App\Trips;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FrontPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $allTrips = TrekkingPartners::select('trip_id', DB::raw('count(*) as total'))->groupBy('trip_id')->get();
        $departures = TrekkingPartners::limit(10)->get();
        return view('frontend.trekkingpartner.index', compact('allTrips', 'departures'));
    }

    public function showPosts($id)
    {
        $trip = Trips::select('name', 'id', 'cover_image')->where('id', $id)->first();

        $allPosts = TrekkingPartners::where('trip_id', $id)->get();
        return view('frontend.trekkingpartner.posts', compact('allPosts', 'trip'));
    }


    public function showDetail($id)
    {
        $post = TrekkingPartners::where('id', $id)->first();

        $comments = Comments::where('post_id', $post->id)->get();

        return view('frontend.trekkingpartner.postdetails', compact('post', 'comments'));
    }

    public function showProfile($id)
    {
        $user = User::where('id', $id)->first();

        $totalBookings = 0;

        $totalBookings += Bookings::where('user_id', $id)->count();
        $totalBookings += TripBookings::where('user_id', $id)->count();

        return view('frontend.trekkingpartner.profile', compact('user', 'totalBookings'));
    }

    public function post(Request $request, $id)
    {
        $input = $request->all();

        if (!isset($input['description']) || $input['description'] == null) {
            $notification = array(
                'message' => 'Description is required while posting the trip to trekking partner,',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }
        if (!isset($input['nationalities']) || $input['nationalities'] == null) {
            $notification = array(
                'message' => 'Nationality is required while posting the trip to trekking partner,',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        if (!isset($input['age']) || $input['age'] == null) {
            $notification = array(
                'message' => 'Age is required while posting the trip to trekking partner,',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }

        if (!isset($input['gender']) || $input['gender'] == null) {
            $notification = array(

                'message' => 'Gender is required while posting the trip to trekking partner,',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }
        $partner = new TrekkingPartners();

        if ($input['is_custom'] == 0) {
            $tripdate = TripDates::where('id', $id)->first();

            if (is_null($tripdate)) {
                $notification = array(
                    'message' => 'Sorry for your inconvenience. This trip can\'t be posted to trekking partners. Please contact admin.',
                    'alert-type' => 'error',
                );

                return redirect()->back()->with($notification);
            }


            $partner->tripdate_id = $id;
            $partner->trip_id = $tripdate->trip_id;

        } else {
            $trip = Trips::where('id', $id)->first();

            if (is_null($trip)) {
                $notification = array(
                    'message' => 'Sorry for your inconvenience. This trip can\'t be posted to trekking partners. Please contact admin.',
                    'alert-type' => 'error',
                );

                return redirect()->back()->with($notification);
            }

            $partner->trip_id = $id;
            $partner->book_id = $input['book_id'];
        }

        $partner->user_id = Auth::user()->id;
        $partner->save();

        $requirements = new PartnerRequirements();

        $requirements->post_id = $partner->id;
        $requirements->description = $input['description'];
        $requirements->age = $input['age'];
        $requirements->nationalities = $input['nationalities'];
        $requirements->gender = $input['gender'];
        $requirements->save();

        $notification = array(
            'message' => 'Successfully posted to trip partners.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function comment(Request $request, $id)
    {
        $input = $request->all();

        if (!isset($input['comment']) && $input['comment'] == null) {
            $notification = array(
                'message' => 'Comment can\'t be empty.',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        $comment = new Comments();
        $comment->post_id = $id;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $input['comment'];
        $comment->save();

        return redirect()->back();
    }

    public function editComment(Request $request, $id)
    {
        $comment = Comments::where('id', $id)->first();

        if (is_null($comment)) {
            $notification = array(
                'message' => 'The comment you are trying to edit is either already deleted by admin or does not exist.',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        $comment->comment = $request->comment;
        $comment->save();

        $notification = array(
            'message' => 'Comment Updated Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function reply(Request $request, $id)
    {
        $input = $request->all();

        if (!isset($input['reply']) && $input['reply'] == null) {
            $notification = array(
                'message' => 'Reply can\'t be empty.',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        $reply = new Replies();

        $reply->comment_id = $id;
        $reply->user_id = Auth::user()->id;
        $reply->reply = $input['reply'];
        $reply->save();

        $notification = array(
            'message' => 'Reply posted successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function editReply(Request $request, $id)
    {
        $reply = Replies::where('id', $id)->first();

        if (is_null($reply)) {
            $notification = array(
                'message' => 'The reply you are trying to edit is either already deleted by admin or does not exist.',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        $reply->reply = $request->reply;
        $reply->save();

        $notification = array(
            'message' => 'Reply updated successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }

    public function deletePost($id)
    {
        $post = TrekkingPartners::where('id', $id)->first();

        if (is_null($post)) {
            $notification = array(
                'message' => 'The post you are trying to delete is either already deleted by admin or does not exist.',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        $post->delete();

        return redirect('/')->with('success', 'Your post on trekking partners has been deleted.');
    }

    public function deleteComment($id)
    {
        $comment = Comments::where('id', $id)->first();

        $comment->delete();

        $notification = array(
            'message' => 'Your comment has been deleted.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function deleteReply($id)
    {
        $reply = Replies::where('id', $id)->first();

        $reply->delete();

        $notification = array(
            'message' => 'Your reply has been deleted.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
