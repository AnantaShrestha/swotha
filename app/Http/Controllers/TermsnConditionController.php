<?php

namespace App\Http\Controllers;

use App\Helper\PasswordChecker;
use App\TermsnCondition;
use Illuminate\Http\Request;

class TermsnConditionController extends Controller
{
    public function index(){
        $termsDetails = TermsnCondition::where('selected' , 1)->first();
    	return view('frontend.termsandpolicy.termsandcondition', compact('termsDetails'));
    }

    public function view(){
        $termsDetails = TermsnCondition::all();
    	return view('admin-panel.termsnpolicy.termsandcondition.index' , compact('termsDetails'));
    }

    public function create(){
    	return view('admin-panel.termsnpolicy.termsandcondition.add');
    }

    public function store(Request $request){
        $input = $request->all();
        $termsDetails = new TermsnCondition;

        $this->validate(request(), [
            'terms_details' => 'required '
        ]);

        $termsDetails->terms_details = $input['terms_details'];

        $termsDetails->save();

        return redirect('/backend/terms-and-condition/');
    }

    public function show($id){
        $termsDetails = TermsnCondition::findOrFail($id);
        return view('admin-panel.termsnpolicy.termsandcondition.show' , compact('termsDetails'));
    }   

     public function delete(Request $request,$id){
        $termsDetails = TermsnCondition::findOrFail($id);

         $result = PasswordChecker::checkpass($request->input('password'));

         if($result == true){
            $termsDetails->delete();
             return redirect('/backend/terms-and-condition/')->with('success', 'Items deleted successfully.');
         } else {
             return redirect('/backend/terms-and-condition/')->with('error', 'The password you entered is incorrect.');
         }

    }

     public function edit($id){
        $termsDetails = TermsnCondition::findOrFail($id);
        return view('admin-panel.termsnpolicy.termsandcondition.edit' , compact('termsDetails'));
    }  

    public function update(Request $request , $id){
        $input = $request->all();
        $termsDetails = TermsnCondition::findOrFail($id);

        $termsDetails->terms_details = $input['terms_details'];

        $termsDetails->save();

        return redirect('/backend/terms-and-condition/');
    }

     public function selected($id){

        $termsD = TermsnCondition::where('selected', 1)->update(['selected' => 0]);
       

        $termsDetails = TermsnCondition::findOrFail($id);
        $termsDetails->selected = "1";
        $termsDetails->save();

        return redirect('/backend/terms-and-condition/');
    }   


}
