<?php

namespace App\Http\Controllers;

use App\CustomTrip;
use App\Trips;
use Illuminate\Http\Request;

class CustomTripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $trip_id = $request->input('trip_id');
        return view('admin-panel.customtrip.create', compact('trip_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        CustomTrip::create($input);
        return redirect('/backend/trips');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trips $trip){
        return view('admin-panel.Trips.showTrips',compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $value = CustomTrip::findOrFail($id);
        return view('admin-panel.customtrip.edit', compact('value'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $trip = CustomTrip::findOrFail($id);
        $trip->update($request->all());
        return redirect('backend/trips');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $custom = CustomTrip::findOrFail($id);
        $custom->delete();
        return redirect('backend/trips');
    }
}
