<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AboutBookingController extends Controller
{
    public function book()
    {
        $booking = About::where('ref', '=', 'booking')->first();
        return view('admin-panel.about.booking.booking', compact('booking'));
    }

    public function bookcreate()
    {
        return view('admin-panel.about.booking.bookingcreate');
    }

    public function bookstore(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
        Image::make(Request::capture()->file('cover_image'))->save(public_path('/images/about/' . $filename));
        Image::make($image)->resize(1920, 810)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(425, 245)->save(public_path('/images/about/thumbnail/' . $filename));
        About::create($input);
        return redirect('/backend/about/booking');
    }

    public function bookedit(Request $request)
    {
        $input = $request->all();
        $booking = About::find($input['id']);
        return view('admin-panel.about.booking.bookingedit', compact('booking'));
    }

    public function bookupdate(Request $request)
    {
        $input = $request->all();
        $booking = About::find($input['id']);
        $booking->update($input);
        return redirect('/backend/about/booking');
    }

    public function bookcoveredit(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
//        $why = About::find($input['id']);
        return view('admin-panel.about.booking.bookingcoveredit', compact('id'));
    }

    public function bookcoverupdate(Request $request)
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
        return redirect('/backend/about/booking');
    }

    //csr
    public function csr()
    {
        $csr = About::where('ref', '=', 'csr')->first();
        return view('admin-panel.about.csr.csr', compact('csr'));
    }

    public function csrcreate()
    {
        return view('admin-panel.about.csr.csrcreate');
    }

    public function csrstore(Request $request)
    {
        $input = $request->all();
        $image = $input['cover_image'];
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $input['cover_image'] = $filename;
        Image::make(Request::capture()->file('cover_image'))->save(public_path('/images/about/' . $filename));
        Image::make($image)->resize(1920, 810)->save(public_path('/images/about/cover/' . $filename));
        Image::make($image)->resize(435, 660)->save(public_path('/images/about/thumbnail/' . $filename));
        About::create($input);
        return redirect('/backend/about/csr');
    }

    public function csredit(Request $request)
    {
        $input = $request->all();
        $csr = About::find($input['id']);
        return view('admin-panel.about.csr.csredit', compact('csr'));
    }

    public function csrupdate(Request $request)
    {
        $input = $request->all();
        $csr = About::find($input['id']);
        $csr->update($input);
        return redirect('/backend/about/csr');
    }

    public function csrcoveredit(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
//        $why = About::find($input['id']);
        return view('admin-panel.about.csr.csrcoveredit', compact('id'));
    }

    public function csrcoverupdate(Request $request)
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
        return redirect('/backend/about/csr');
    }
}
