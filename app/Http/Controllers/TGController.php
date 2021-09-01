<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class TGController extends Controller
{
    public function travelguide()
    {
        return view('admin-panel.about.travelguide.index');
    }

    //beforeyoucome
    public function byc()
    {
        $byc = About::where('ref', '=', 'byc')->first();
        return view('admin-panel.about.travelguide.beforeyoucome.byc', compact('byc'));
    }

    public function byccreate()
    {
        return view('admin-panel.about.travelguide.beforeyoucome.byccreate');
    }

    public function bycstore(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
        Image::make(Request::capture()->file('cover_image'))->save(public_path('/images/about/' . $filename));
        Image::make($image)->resize(1920, 810)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(425, 245)->save(public_path('/images/about/thumbnail/' . $filename));
        About::create($input);
        return redirect('/backend/about/byc');
    }

    public function bycedit(Request $request)
    {
        $input = $request->all();
        $byc = About::find($input['id']);
        return view('admin-panel.about.travelguide.beforeyoucome.bycedit', compact('byc'));
    }

    public function bycupdate(Request $request)
    {
        $input = $request->all();
        $byc = About::find($input['id']);
        $byc->update($input);
        return redirect('/backend/about/byc');
    }

    public function byccoveredit(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
//        $why = About::find($input['id']);
        return view('admin-panel.about.travelguide.beforeyoucome.byccoveredit', compact('id'));
    }

    public function byccoverupdate(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $id = $input['id'];
        $cities = About::findorFail($id);
        File::delete(public_path('images/about/cover/' . $cities->cover_image));
        File::delete(public_path('images/about/thumbnail/' . $cities->cover_image));
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
//        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/cities/' . $filename ) );
        Image::make($image)->resize(1920, 810)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(435, 245)->save(public_path('/images/about/thumbnail/' . $filename));
        $cities->cover_image = $input['cover_image'];
        $cities->save();
        return redirect('/backend/about/byc');
    }

    //nepalatglance
    public function nag()
    {
        $nag = About::where('ref', '=', 'nag')->first();
        return view('admin-panel.about.travelguide.nepalatglance.nag', compact('nag'));
    }

    public function nagcreate()
    {
        return view('admin-panel.about.travelguide.nepalatglance.nagcreate');
    }

    public function nagstore(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
        Image::make(Request::capture()->file('cover_image'))->save(public_path('/images/about/' . $filename));
        Image::make($image)->resize(1920, 810)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(425, 245)->save(public_path('/images/about/thumbnail/' . $filename));
        About::create($input);
        return redirect('/backend/about/nag');
    }

    public function nagedit(Request $request)
    {
        $input = $request->all();
        $nag = About::find($input['id']);
        return view('admin-panel.about.travelguide.nepalatglance.nagedit', compact('nag'));
    }

    public function nagupdate(Request $request)
    {
        $input = $request->all();
        $nag = About::find($input['id']);
        $nag->update($input);
        return redirect('/backend/about/nag');
    }

    public function nagcoveredit(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
//        $why = About::find($input['id']);
        return view('admin-panel.about.travelguide.nepalatglance.nagcoveredit', compact('id'));
    }

    public function nagcoverupdate(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $id = $input['id'];
        $cities = About::findorFail($id);
        File::delete(public_path('images/about/cover/' . $cities->cover_image));
        File::delete(public_path('images/about/thumbnail/' . $cities->cover_image));
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
//        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/cities/' . $filename ) );
        Image::make($image)->resize(1920, 810)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(435, 245)->save(public_path('/images/about/thumbnail/' . $filename));
        $cities->cover_image = $input['cover_image'];
        $cities->save();
        return redirect('/backend/about/nag');
    }

    //nepalvisa
    public function nav()
    {
        $nav = About::where('ref', '=', 'nav')->first();
        return view('admin-panel.about.travelguide.nepalvisa.nav', compact('nav'));
    }

    public function navcreate()
    {
        return view('admin-panel.about.travelguide.nepalvisa.navcreate');
    }

    public function navstore(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
        Image::make(Request::capture()->file('cover_image'))->save(public_path('/images/about/' . $filename));
        Image::make($image)->resize(1920, 810)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(425, 245)->save(public_path('/images/about/thumbnail/' . $filename));
        About::create($input);
        return redirect('/backend/about/nav');
    }

    public function navedit(Request $request)
    {
        $input = $request->all();
        $nav = About::find($input['id']);
        return view('admin-panel.about.travelguide.nepalvisa.navedit', compact('nav'));
    }

    public function navupdate(Request $request)
    {
        $input = $request->all();
        $team = About::find($input['id']);
        $team->update($input);
        return redirect('/backend/about/nav');
    }

    public function navcoveredit(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
//        $why = About::find($input['id']);
        return view('admin-panel.about.travelguide.nepalvisa.navcoveredit', compact('id'));
    }

    public function navcoverupdate(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $id = $input['id'];
        $cities = About::findorFail($id);
        File::delete(public_path('images/about/cover/' . $cities->cover_image));
        File::delete(public_path('images/about/thumbnail/' . $cities->cover_image));
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
//        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/cities/' . $filename ) );
        Image::make($image)->resize(1920, 810)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(435, 245)->save(public_path('/images/about/thumbnail/' . $filename));
        $cities->cover_image = $input['cover_image'];
        $cities->save();
        return redirect('/backend/about/nav');
    }

    //trip_grade
    public function tg()
    {
        $tg = About::where('ref', '=', 'tg')->first();
        return view('admin-panel.about.travelguide.tripgrade.tg', compact('tg'));
    }

    public function tgcreate()
    {
        return view('admin-panel.about.travelguide.tripgrade.tgcreate');
    }

    public function tgstore(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
        Image::make(Request::capture()->file('cover_image'))->save(public_path('/images/about/' . $filename));
        Image::make($image)->resize(1920, 810)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(425, 245)->save(public_path('/images/about/thumbnail/' . $filename));
        About::create($input);
        return redirect('/backend/about/tg');
    }

    public function tgedit(Request $request)
    {
        $input = $request->all();
        $tg = About::find($input['id']);
        return view('admin-panel.about.travelguide.tripgrade.tgedit', compact('tg'));
    }

    public function tgupdate(Request $request)
    {
        $input = $request->all();
        $tg = About::find($input['id']);
        $tg->update($input);
        return redirect('/backend/about/tg');
    }

    public function tgcoveredit(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
//        $why = About::find($input['id']);
        return view('admin-panel.about.travelguide.tripgrade.tgcoveredit', compact('id'));
    }

    public function tgcoverupdate(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $id = $input['id'];
        $cities = About::findorFail($id);
        File::delete(public_path('images/about/cover/' . $cities->cover_image));
        File::delete(public_path('images/about/thumbnail/' . $cities->cover_image));
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
//        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/cities/' . $filename ) );
        Image::make($image)->resize(1920, 810)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(435, 245)->save(public_path('/images/about/thumbnail/' . $filename));
        $cities->cover_image = $input['cover_image'];
        $cities->save();
        return redirect('/backend/about/tg');
    }

    //insurance
    public function insurance()
    {
        $insurance = About::where('ref', '=', 'insurance')->first();
        return view('admin-panel.about.travelguide.insurance.insurance', compact('insurance'));
    }

    public function insurancecreate()
    {
        return view('admin-panel.about.travelguide.insurance.insurancecreate');
    }

    public function insurancestore(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
        Image::make(Request::capture()->file('cover_image'))->save(public_path('/images/about/' . $filename));
        Image::make($image)->resize(1920, 810)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(425, 245)->save(public_path('/images/about/thumbnail/' . $filename));
        About::create($input);
        return redirect('/backend/about/insurance');
    }

    public function insuranceedit(Request $request)
    {
        $input = $request->all();
        $insurance = About::find($input['id']);
        return view('admin-panel.about.travelguide.insurance.insurancecoveredit', compact('insurance'));
    }

    public function insuranceupdate(Request $request)
    {
        $input = $request->all();
        $insurance = About::find($input['id']);
        $insurance->update($input);
        return redirect('/backend/about/insurance');
    }

    public function insurancecoveredit(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
//        $why = About::find($input['id']);
        return view('admin-panel.about.travelguide.insurance.insurancecoveredit', compact('id'));
    }

    public function insurancecoverupdate(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $id = $input['id'];
        $cities = About::findorFail($id);
        File::delete(public_path('images/about/cover/' . $cities->cover_image));
        File::delete(public_path('images/about/thumbnail/' . $cities->cover_image));
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
//        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/cities/' . $filename ) );
        Image::make($image)->resize(1920, 810)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(435, 245)->save(public_path('/images/about/thumbnail/' . $filename));
        $cities->cover_image = $input['cover_image'];
        $cities->save();
        return redirect('/backend/about/insurance');
    }

    //guide
    public function guide()
    {
        $guide = About::where('ref', '=', 'guide')->first();
        return view('admin-panel.about.travelguide.guide.guide', compact('guide'));
    }

    public function guidecreate()
    {
        return view('admin-panel.about.travelguide.guide.guidecreate');
    }

    public function guidestore(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
        Image::make(Request::capture()->file('cover_image'))->save(public_path('/images/about/' . $filename));
        Image::make($image)->resize(1920, 810)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(425, 245)->save(public_path('/images/about/thumbnail/' . $filename));
        About::create($input);
        return redirect('/backend/about/guide');
    }

    public function guideedit(Request $request)
    {
        $input = $request->all();
        $guide = About::find($input['id']);
        return view('admin-panel.about.travelguide.guide.guideedit', compact('guide'));
    }

    public function guideupdate(Request $request)
    {
        $input = $request->all();
        $team = About::find($input['id']);
        $team->update($input);
        return redirect('/backend/about/guide');
    }

    public function guidecoveredit(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
//        $why = About::find($input['id']);
        return view('admin-panel.about.travelguide.guide.guidecoveredit', compact('id'));
    }

    public function guidecoverupdate(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $id = $input['id'];
        $cities = About::findorFail($id);
        File::delete(public_path('images/about/cover/' . $cities->cover_image));
        File::delete(public_path('images/about/thumbnail/' . $cities->cover_image));
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
//        Image::make(Request::capture()->file('cover_image'))->save( public_path('/images/cities/' . $filename ) );
        Image::make($image)->resize(1920, 810)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(435, 245)->save(public_path('/images/about/thumbnail/' . $filename));
        $cities->cover_image = $input['cover_image'];
        $cities->save();
        return redirect('/backend/about/guide');
    }


}
