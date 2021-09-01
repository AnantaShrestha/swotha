<?php

namespace App\Http\Controllers;

use App\Helper\PasswordChecker;
use App\Http\Requests\StylesCreateRequest;
use App\Http\Requests\StylesEditRequest;
use App\Styles;
use App\TravelStyles;
use Illuminate\Http\Request;

class StyleController extends Controller
{
	public function index(){
		$styles = TravelStyles::all();
		return view('admin-panel.Styles.index',compact('styles'));
	}
	
	public function create(){
		return view('admin-panel.Styles.createStyles');
	}
	
	public function store(StylesCreateRequest $request){
		TravelStyles::create($request->all());
		return redirect('/backend/styles');
	}
	
	public function edit($id){
		$styles = TravelStyles::findOrFail($id);
		return view('admin-panel.Styles.editStyles',compact('styles'));
	}
	
	public function update(StylesEditRequest $request, $id){
		$styles = TravelStyles::findorFail($id);
		// dd($request->all());
		$styles->update($request->all());
		return redirect('/backend/styles');
	}
	
	public function destroy(Request $request, $id){
		$input = $request->all();
		$result = PasswordChecker::checkpass($input['password']);
		
		if($result == true){
			$style = TravelStyles::findOrFail($id);
			$style->delete();
			return redirect('/backend/styles')->with('success', 'Style deleted successfully.');
		} else {
			return redirect('/backend/styles')->with('error', 'The password you entered is incorrect.');
		}
		
	}
	
	
}
