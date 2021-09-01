@extends('layouts.master')
@section('title')
    Reserve the Trip | Swotah Travel and Adventure
@endsection

@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="Contact Us | Swotah Travel and Adventure">
    <meta name="description" content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('css/frontend/contact.css')}}">
    {{--<link rel="stylesheet" href="{{url('css/frontend/index.min.css')}}">--}}
    <style type="text/css">
        .top-payment img {
            margin-top: -11px !important;
        }
        .hold-form
        {
            width:25%;
            margin:0px auto;
            background:#fff;
            box-shadow: 0px 0px 5px #000;
            padding:15px;
        }

    </style>
@endsection
@section('content')
    @include('layouts.navbar')
    <div class="container">
        <div class="section-title-black mt-30">
          <h2>Reserve The Trip </h2>
          <div class="title-bg">
            <span class="line-bg"></span>
            <span class="line-bg"></span>
            <span class="line-bg"></span>
            <span class="line-bg"></span>
            <span class="line-bg"></span>
          </div>
         </div>
    </div>
    <div class="hold-trip mb-30">
        <div class="container">
            <div class="hold-form">
                 <p style="color:green;font-size:12px;margin-bottom:10px">Please note that if seats
                                are
                                available, you can hold up to 7 seats of any
                                particular trip, and 14 seats in total, at a
                                given period of time.</p>
                <form action="/hold/{{$tripdates->id}}"
                              method="post"
                              id="form" style="margin-bottom:0px">
                            {{csrf_field()}}
                             <input type="hidden" name='deal_id'
                                   value="{{$tripdates->id}}">
                            <div class="form-group" >
                                 <select onchange="changeval()" name="seats"
                                        id="seats" class="form-control">
                                    <option value="null" selected disabled>
                                        Select No. of Seats
                                    </option>
                                    @for($i = 1; $i <= $seats; $i++)
                                        <option value="{{$i}}"
                                                @if(Auth::user() && (((($singleTotal+$i) > 7))|| (($allTotal+$i)) > 14) || ($i > $tripdates->remainingseats)))
                                                {{'disabled'}}
                                                @endif
                                        >{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                             <button type="submit"
                                        class="btn btn-primary waves-effect waves-light"
                                        name="submit"
                                        @if(Auth::user() && (($allTotal+1) > 14 || ($singleTotal+1) > 7))
                                        {{'disabled'}}
                                        @endif
                                >Continue
                                </button>
                </form>
            </div>
        </div>
    </div>
@endsection
