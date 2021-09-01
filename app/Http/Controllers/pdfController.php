<?php

namespace App\Http\Controllers;

use App\Trips;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class pdfController extends Controller
{
	public function makepdf($id)
	{
		$trip = Trips::where('id', $id)->first();
		
		$map = null;
		$gallery = null;
		
		if(count($trip->gallery) > 0) {
		    if(!empty($trip->map($trip)->image)) {
                $map = $trip->map($trip)->image;
            }
			$gallery = $trip->gallery->toArray();
		}
		
		$itenary = $trip->itenary->toArray();
		
		$data = array(
			'name' => $trip->name,
			'cover_image' => $trip->cover_image,
			'description' => $trip->description,
			'trip_information' => $trip->trip_information,
			'map' => $map,
			'itinerary' => $itenary,
			'gallery' => $gallery,
			'inclusions'=> $trip->is_this_trip_right,
			'complimentary' => $trip->complimentary,
			'exclusions' => $trip->exclusions,
		);
		
		
		$pdf = PDF::loadView('admin-panel.layout.itinerary', $data)->setOrientation('landscape')->setPaper('a4');
		
		if(file_exists(storage_path('trippdf/'.$trip->slug.'.pdf'))){
			unlink(storage_path('trippdf/'.$trip->slug.'.pdf'));
		}
		
		$pdf->save(storage_path('trippdf/'.$trip->slug.'.pdf'));
		
		return redirect()->back()->with('success', 'PDF generated successfully.');
	}
	
	public function bulkpdf()
	{
		$trip = Trips::all();
		
		foreach($trip as $t) {
			$map = null;
			$gallery = null;
			
			if (count($t->gallery) > 0) {
				$map = $t->map($t)->image;
				$gallery = $t->gallery->toArray();
			}
			
			$itenary = $t->itenary->toArray();
			
			$data = array(
				'name' => $t->name,
				'cover_image' => $t->cover_image,
				'description' => $t->description,
				'trip_information' => $t->trip_information,
				'map' => $map,
				'itinerary' => $itenary,
				'gallery' => $gallery,
				'inclusions' => $t->is_this_trip_right,
				'complimentary' => $t->complimentary,
				'exclusions' => $t->exclusions,
			);
			
			
			$pdf = PDF::loadView('admin-panel.layout.itinerary', $data)->setOrientation('landscape')->setPaper('a4');
			
			if (file_exists(storage_path('trippdf/' . $t->slug . '.pdf'))) {
				unlink(storage_path('trippdf/' . $t->slug . '.pdf'));
			}
			
			$pdf->save(storage_path('trippdf/' . $t->slug . '.pdf'));
		}
		
		return redirect()->back()->with('success', 'PDF generated successfully.');
	}
	
	public function downloadpdf($id){
		$trip = Trips::select('slug')->where('id', $id)->first();
		
		return response()->download(storage_path('trippdf/'.$trip->slug.'.pdf'));
	}
}
