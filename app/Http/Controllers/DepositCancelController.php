<?php

namespace App\Http\Controllers;
use App\DepositCancel;
use App\Helper\PasswordChecker;
use Illuminate\Http\Request;

class DepositCancelController extends Controller
{
    public function index(){
        $depositDetails = DepositCancel::where('selected' , 1)->first();
    	return view('frontend.termsandpolicy.depositandcancel', compact('depositDetails'));
    }

    public function view(){
        $depositDetails = DepositCancel::all();
    	return view('admin-panel.termsnpolicy.depositandcancel.index' , compact('depositDetails'));
    }

    public function create(){
    	return view('admin-panel.termsnpolicy.depositandcancel.add');
    }

    public function store(Request $request){
        $input = $request->all();
        $depositDetails = new DepositCancel;

        $depositDetails->deposit_details = $input['deposit_details'];

        $depositDetails->save();

        return redirect('/backend/deposit-and-cancellation-policy/');
    }

    public function show($id){
        $depositDetails = DepositCancel::findOrFail($id);
        return view('admin-panel.termsnpolicy.depositandcancel.show' , compact('depositDetails'));
    }   

     public function delete(Request $request, $id){
        $depositDetails = DepositCancel::findOrFail($id);

        $result = PasswordChecker::checkpass($request->input('password'));

         if($result == true){
             $depositDetails->delete();
             return redirect('/backend/deposit-and-cancellation-policy/')->with('success', 'Items deleted successfully.');
         } else {
             return redirect('/backend/deposit-and-cancellation-policy/')->with('error', 'The password you entered is incorrect.');
         }

    }

     public function edit($id){
        $depositDetails = DepositCancel::findOrFail($id);
        return view('admin-panel.termsnpolicy.depositandcancel.edit' , compact('depositDetails'));
    }  

    public function update(Request $request , $id){
        $input = $request->all();
        $depositDetails = DepositCancel::findOrFail($id);

        $depositDetails->deposit_details = $input['deposit_details'];

        $depositDetails->save();

        return redirect('/backend/deposit-and-cancellation-policy/');
    }

     public function selected($id){

        $termsD = DepositCancel::where('selected', 1)->update(['selected' => 0]);


         $depositDetails = DepositCancel::findOrFail($id);
        $depositDetails->selected = "1";
        $depositDetails->save();

        return redirect('/backend/deposit-and-cancellation-policy/');
    }
}
