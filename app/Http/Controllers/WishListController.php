<?php

namespace App\Http\Controllers;

use App\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index(){
        if(Auth::user()->is_active == 0){
           session()->flash('message','Sorry the account is not activated yet!. Click the verification link sent at '.Auth::user()->email.' to activate your account');
            return redirect()->back();
        }
        $userid = Auth::user()->id;
        $wishes = WishList::where('user_id','=',$userid)->get();
        return view('frontend.wishlist.index',compact('wishes'));
    }
    public function addtowishlist($id){
        if(Auth::user()->is_active == 0){
           session()->flash('message','Sorry the account is not activated yet!. Please click the verification link to activate your account which is sent at '.Auth::user()->email);
            return redirect()->back();
        }
        $user = Auth::user()->id;
        $wishlist = new WishList();
        $wishlist->user_id = $user;
        $wishlist->trip_id = $id;
        $wishlist->save();
//         session()->flash('message','Added to BucketList Sucessfully');
        return redirect('/');
    }
    public function  addwish(Request $request){
        if(Auth::user()->is_active == 0){
         $message='Sorry the account is not activated yet!. Please click the verification link to activate your account which is sent at '.Auth::user()->email;
         return response()->json(['message'=>$message]);
            
        }
        $user = Auth::user()->id;
        $wishlist = new WishList();
        $wishlist->user_id = $user;
        $wishlist->trip_id = $request->id;

        $wishlist->save();
        $data = array();
        $data[0] = WishList::where('user_id','=', Auth::user()->id)->count();
        $data[1] = $request->id;
        $data[2] = 'Remove from Bucket list';

        return response ()->json ($data);

    }
    public function  removewish($id){
        if(Auth::user()->is_active == 0){
           session()->flash('message','Sorry the account is not activated yet!. Click the verification link sent at '.Auth::user()->email.' to activate your account');
            return redirect()->back();
        }
        WishList::find($id)->delete();
        return redirect()->back();

    }
    public function  remove(Request $request){
        if(Auth::user()->is_active == 0){
           session()->flash('message','Sorry the account is not activated yet!. Click the verification link sent at '.Auth::user()->email.' to activate your account');
            return redirect()->back();
        }
//        dd('Here');
        $wish = WishList::where('trip_id','=',$request->id);
        $wish->delete();


        $data = array();
        $data[0] = WishList::where('user_id','=',Auth::user()->id)->count();
        $data[1] = $request->id;
        $data[2] = 'Add to Bucket list';
        return response ()->json ( $data );

    }

}
