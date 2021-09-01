<?php

namespace App\Http\Controllers;

use App\SearchSeo;
use Illuminate\Http\Request;

class SearchSeoController extends Controller
{
	public function index(){
		$searchbar = SearchSeo::where('what','=',1)->first();
		$title = SearchSeo::where('what','=',2)->first();
		$description = SearchSeo::where('what','=',3)->first();
		$keywords = SearchSeo::where('what','=',4)->first();
		
		return view('admin-panel.searchbarseo.index', compact('searchbar','title','description','keywords'));
	}
	public function changesearchbar(Request $request){
		$con = $request->con;
		$nature = $request->nature;
		
		$searchbar = SearchSeo::where('what','=',1)->first();
		
		if(!empty($searchbar)){
			$searchbar->update(['content'=>$con]);
		}else {
			$seosearch = new SearchSeo();
			$seosearch->content = $con;
			$seosearch->what = $nature;
			$seosearch->save();
		}
		
		$data = array();
		$data[0] = $con;
		return response ()->json ($data);
	}
	
	public function changetitle(Request $request){
		$con = $request->con;
		$nature = $request->nature;
		
		$searchbar = SearchSeo::where('what','=',$nature)->first();
		
		if(!empty($searchbar)){
			$searchbar->update(['content'=>$con]);
		}else {
			$seosearch = new SearchSeo();
			$seosearch->content = $con;
			$seosearch->what = $nature;
			$seosearch->save();
		}
		
		$data = array();
		$data[0] = $con;
		return response ()->json ($data);
	}

}
