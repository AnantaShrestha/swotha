<?php

namespace App\Http\Controllers;

use App\Helper\PasswordChecker;
use App\Mail\ActivateUser;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function index(){
		$users = User::orderBy('id', 'desc')->get();
		return view('admin-panel.User.index',compact('users'));
	}
	
	public function edit($id){
		$user = User::findOrFail($id);
		return view('admin-panel.User.editUsers',compact('user'));
	}
	
	public function update(Request $request, $id){
		$user = User::findOrFail($id);
		$user->update($request->all());
		return redirect('/backend/users');
	}
	
	public function destroy(Request $request, $id){
		$input = $request->all();
		$result = PasswordChecker::checkpass($input['password']);
		
		if($result == true){
			$user = User::findOrFail($id);
			$user->delete();
			return redirect('/backend/users')->with('success', 'User Deleted Successfully.');
		} else {
			return redirect('/backend/users')->with('error', 'The password you entered is incorrect.');
		}
		
	}
	
	public function changestatus( Request $request){
		$input = $request->all();
		
		if($input['action'] == 'deactivate') {
			$user = User::findOrFail($input['id']);
			$user->is_active = $input['is_active'];
			$user->save();
			return redirect('/backend/users')->with('success', $user->name.' is deactivated successfully.');;
		}else{
			$user = User::findOrFail($input['id']);
			$user->is_active = $input['is_active'];
			$user->save();
			\Mail::to($user)->later(5, new ActivateUser($user));
			
			return redirect('/backend/users')->with('success', $user->name.' is activated and mail is sent successfully');;
		}
		
	}
}
