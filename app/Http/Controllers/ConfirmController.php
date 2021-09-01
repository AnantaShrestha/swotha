<?php

namespace App\Http\Controllers;

use App\User;

class ConfirmController extends Controller
{
    /**
     * @param $code
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirm($code){
        try {
            $user = User::where('code', '=', $code)->first();
            $user->is_active = 1;
//            $user->code = null;
            $user->save();
//            session()->flash('message','Thank your for registering to Swotah Travel and Adventure');
            return redirect('/login');

        }catch (Exception $e){
            return redirect('/');
        }
//        auth()->login($user,true);

    }

}
