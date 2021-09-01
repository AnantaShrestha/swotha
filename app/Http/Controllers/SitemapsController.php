<?php

namespace App\Http\Controllers;
use App\Helper\PasswordChecker;
use App\Sitemaps;
use Illuminate\Http\Request;

class SitemapsController extends Controller
{
    public function index(){
        $sitemapsDetails = Sitemaps::all();
    	return view('frontend.sitemaps.index', compact('sitemapsDetails'));
    }

    public function view(){
        $sitemapsDetails = Sitemaps::all();
    	return view('admin-panel.sitemaps.index' , compact('sitemapsDetails'));
    }

    public function create(){
    	return view('admin-panel.sitemaps.add');
    }

    public function store(Request $request){
        $input = $request->all();
        $sitemapsDetails = new Sitemaps;

        $sitemapsDetails->sitemap_title = $input['sitemap_title'];
        $sitemapsDetails->sitemap_description = $input['sitemap_description'];
        $sitemapsDetails->sitemap_link = $input['sitemap_link'];

        if ($request->hasFile('sitemap_image')) {
            $image = $input['sitemap_image'];
            $name = str_slug($input['sitemap_title'].'-'.time()).'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/sitemaps/');

            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $image->move($destinationPath, $name);

            $input['sitemap_image'] = $name;
            $sitemapsDetails->sitemap_image = $input['sitemap_image'];
        }

        $sitemapsDetails->save();

        return redirect('/backend/sitemaps/');
    }

    public function show($id){
        $sitemapsDetails = Sitemaps::findOrFail($id);
        return view('admin-panel.sitemaps.show' , compact('sitemapsDetails'));
    } 

     public function delete(Request $request, $id){
        $sitemapsDetails = Sitemaps::findOrFail($id);

         $result = PasswordChecker::checkpass($request->input('password'));

         if($result == true){
             $sitemapsDetails->delete();
             return redirect('/backend/sitemaps/')->with('success', 'Items deleted successfully.');
         } else {
             return redirect('/backend/sitemaps/')->with('error', 'The password you entered is incorrect.');
         }

    }

     public function edit($id){
        $sitemapsDetails = Sitemaps::findOrFail($id);
        return view('admin-panel.sitemaps.edit' , compact('sitemapsDetails'));
    }  

    public function update(Request $request , $id){
        $input = $request->all();
        $sitemapsDetails = Sitemaps::findOrFail($id);

        $sitemapsDetails->sitemap_title = $input['sitemap_title'];
        $sitemapsDetails->sitemap_description = $input['sitemap_description'];
        $sitemapsDetails->sitemap_link = $input['sitemap_link'];

        if ($request->hasFile('sitemap_image')) {
            $image = $input['sitemap_image'];
            $name = str_slug($input['sitemap_title'].'-'.time()).'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/sitemaps/');

            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $image->move($destinationPath, $name);

            $input['sitemap_image'] = $name;
            $sitemapsDetails->sitemap_image = $input['sitemap_image'];
        }

        $sitemapsDetails->save();

        return redirect('/backend/sitemaps/');
    }

     public function selected($id){


        Sitemaps::where('selected', 1)->update(['selected' => 0]);

        $sitemapsDetails = Sitemaps::findOrFail($id);
        $sitemapsDetails->selected = "1";
        $sitemapsDetails->save();

        return redirect('/backend/sitemaps/');
    }
}
