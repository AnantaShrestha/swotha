@extends('layouts.master')
@section('title')
    {{ucfirst(Auth::user()->name)}}
@endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('metatags')
    <link rel="shortcut icon" href="{{{ asset('images/favicon.ico') }}}">
@endsection
@section('styles')
    <style type="text/css">
        .profile-side-bar {
            background: #fafafa;
            box-shadow: 0px 0px 8px #ccc;
            padding: 15px 10px;

        }

        .fixed-profile-nav {
            /*position: sticky;
            position: -webkit-sticky;
            top: 95px;*/
        }

        .profile-image {
            width: 80px;
            height: 80px;
            background: #ccc;
            border: 5px solid #fc0;
            border-radius: 50%;
            box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            margin: 0px auto;

        }

        .display-photo img {
            width: 100%;
            height: 100%;
        }

        .acc-image img {

            width: 100%;
            height: 100%;
        }

        .profile-image {
            position: relative;
        }

        .profile-image a {
            right: 24px;
            bottom: -7px;
            position: absolute;
            background: #000;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            overflow: visible;
        }

        .profile-image a i {
            font-size: 12px;
            color: #fff;
            line-height: 25px;
        }

        .bio-background {
            background: #fff;
            box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.6);
            line-height: 35px;
            padding: 0px 15px;
            /*
              border-left:5px solid #fc0;*/
            border-bottom: 3px solid #fc0;
        }

        .icon {
            width: 30px;
        }

        .icon p {
            line-height: 35px !important;

        }

        .icon p i {
            display: block;
            font-size: 18px;
            line-height: 35px !important;
        }

        .bio-name span {
            font-size: 14px;
            line-height: 20px;
        }

        .bio-name strong {
            font-size: 14px;
        }

        .action-icon i {
            font-size: 18px;
            line-height: 35px !important;
            color: #0161ba;
        }

        .collapsible-body-input {
            display: none;
            background: #f2f2f2;
            padding: 15px 20px;
        }

        .save-control {
            width: 60%;
            line-height: 45px;
            border: 0;
            padding: 0px 10px;
            border-radius: 5px;
        }

        .center-align {
            font-size: 12px;
            font-weight: 500;
        }

        .sub-btn {
            width: 40%;
            background: #007bff;
            border: 0;
            line-height: 45px;
            color: #fff;
        }

        .oc {
            /* margin-bottom:10px;*/
        }

        .select-control {
            line-height: 45px !important;
            height: 45px;
            width: 33.33%;
            border: 0;
            padding: 0px 5px;
        }

        .account-nav {
            background: #fc0;
            box-shadow: 0px 0px 5px #000;
            /* padding: 5px 0; */
            display: block;
            overflow: hidden;
            position: sticky;
            position: -webkit-sticky;
            top: 89px;
            z-index: 1;
        }

        .account-nav ul li {
            float: left;
        }

        .account-nav ul li a {
            font-size: 13px;
            color: #111;
            padding: 15px 10px;
            font-weight: 700;
        }

        .account-nav ul li.active {
            border-bottom: 3px solid #111;
        }

        .account-nav ul li a:hover {
            border-bottom: 3px solid #111;

        }

        .account-book-image {
            margin-top: 20px;
        }

        .account-book-image img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            box-shadow: 0px 0px 5px #000;

        }

        .bg-f2f2f2 {
            background: #f2f2f2;
            padding: 15px 15px;

        }

        .trip-name h2 {
            font-size: 19px;
            color: #111;
            margin-bottom: 5px;
            font-weight: 800;
        }

        .account-tab-panel {
            display: none;

        }

        .account-tab-panel.active {
            display: block;
        }

        .trip-de ul li {
            font-size: 14px;
        }

        .trip-de ul li {
            font-size: 12px;
            margin-bottom: 5px;
        }

        .viewdetail-btn li a {
            font-size: 13px;
            color: #111;
            display: block;
            text-align: center;

        }

        .viewdetail-btn li {
            width: 49%;
            background: #fc0;
            margin-right: 1%;

        }

        .main-btn {
            margin-top: 15px;
            text-align: center;
        }

        .main-last-btn {
            font-size: 13px;
            font-weight: 800;
            background: #111;
            color: #fff;
            border-radius: 30px;
            padding: 7px 8px;
        }

        .bucket-image {
            background: #222;
        }

        .bucket-image img {
            width: 100%;
        }

        .bucket-block {
            position: relative;
        }

        .bucket-trip-name {
            background-size: cover;
            width: 100%;
            position: absolute;
            bottom: 0px;
            left: 0px;
            background: rgba(0, 0, 0, 0.5);
        }

        .bucket-trip-name h3 {
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            padding: 15px 10px;
        }

        .bucketaction-btn {
            top: 5px;
            left: 5px;
            position: absolute;
        }

        .compare-bttn {
            background: #fc0;
            padding: 0px 10px;
        }

        .compare-bttn strong {
            font-size: 12px;
            color: #111;
            line-height: 31px;
        }

        .love-bttn a {
            background: red;

        }

        .love-bttn a i {
            line-height: 31px;
            padding: 0px 10px;
        }

        .bucket-departure a {
            background: #4CAF50;

        }

        .bucket-departure a i {
            line-height: 31px;
            font-size: 12px;
            color: #fff;
            padding: 0px 10px;
        }

        .form-group label {
            font-weight: 800;
        }

        .card-btn-details {
            background: #fc0;
            padding: 10px 20px;
            color: #111;
            border: 0;
            font-weight: 600;
            border-radius: 30px;
        }

        table tr {
            font-size: 14px;
            line-height: 30px;
        }

        .update-card {
            background: #111;
            padding: 8px 15px;
            color: #fff;
            font-size: 18px;
            font-weight: 800;
            border-radius: 30px;
            box-shadow: inset 0 0 0 0 #fc0;
            -webkit-transition: ease-out 0.6s;
            -moz-transition: ease-out 0.6s;
            transition: ease-out 0.6s;
        }

        .update-card:hover {
            box-shadow: inset 400px 0 0 0 #fc0;
            color: #111;

        }


        .delete-card {
            background: red;
            padding: 8px 15px;
            color: #fff;
            font-size: 18px;
            font-weight: 800;
            border-radius: 30px;
            box-shadow: inset 0 0 0 0 #fc0;
            -webkit-transition: ease-out 0.6s;
            -moz-transition: ease-out 0.6s;
            transition: ease-out 0.6s;
        }

        .delete-card:hover {
            box-shadow: inset 400px 0 0 0 #fc0;
            color: #111;

        }

        .tabwrapper.center-block {
            margin-top: 10px;
            height: auto;
        }

        .add-btn a, .add-blog-btn a {
            font-size: 14px;
        }

        .btn.waves-effect.waves-light {
            color: #0161ba;
            font-size: 14px;
            text-align: right;
        }

        #topSecondary b {
            font-size: 12px;
        }

        .section-title-black {
            margin-bottom: 10px !important;
        }

        @media screen and (max-width: 640px) {
            .account-nav.show-account-nav {
                display: block;
            }

            .account-nav {
                display: none;

            }

            .account-nav ul li {
                float: none;
            }

            .my-profile .col-lg-8.col-md-8.col-sm-12.pr-0 {
                padding: 0px;
            }

            .col-lg-4.col-md-4.col-sm-12.pl-0.fixed-profile-nav {
                padding: 0px;
            }

        }

        @media screen and (max-width: 480px) {
            .bio-name strong {
                font-size: 12px;
            }

            .bio-name span {
                font-size: 12px;
            }
        }

        .action-icon i {
            font-size: 13px;
        }

        .sub-btn {
            font-size: 12px;
        }

        #country {
            font-size: 12px;
        }

        .collapsible-body-input .flex-box input {
            font-size: 12px;
        }
    </style>


@endsection
@section('content')
    @include('layouts.navbar')
    <?php
    $id = Auth::user()->id;
    ?>
    <section class="my-profile pt-20 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 pl-0 fixed-profile-nav">
                    <div class="profile-side-bar ">
                        <div style="text-align:center;padding-bottom: 10px">
                            @if(Auth::user()->photo)
                                <div class="profile-image">
                                    <div id="displayPhoto" class="display-photo">
                                        <img src="{{url('images/profile/'.Auth::user()->photo)}}" alt=""
                                             class="responsive-img"
                                        >
                                    </div>
                                    <a class="uploadImg" href="#upload"><i class="fas fa-upload"></i></a>
                                </div>
                            @else
                                <div class="profile-image">
                                    <div id="displayPhoto" class="acc-image">
                                        <img src="{{url('images/user.png')}}" alt="" class="responsive-img"
                                        >

                                    </div>
                                    <a class="uploadImg" href="#upload"><i class="fas fa-upload"></i></a>
                                </div>
                            @endif
                        </div>
                       <!--  <div class="inner-package-head-title mb-20">
                            <h3>Bio</h3>
                        </div>
                        <div class="oc">
                            <div id="nameMessage" class="center-align"></div>
                            <div class="bio-background flex-box">
                                <div class="icon">
                                    <p><i class="fa fa-user"></i></p>
                                </div>
                                <div class="bio-name flex">
                                    <strong>Name :</strong>&nbsp;&nbsp;&nbsp;<span
                                            id="displayName">{{ucfirst(Auth::user()->name)}}</span>
                                </div>
                                <div class="action-icon">
                                    <p data-title="Add or Update" id="action-icon"><i class="fa fa-edit"></i></p>
                                </div>
                            </div>
                            <div class="collapsible-body-input">
                                <div class="flex-box">
                                    <input type="hidden" name="table" value="user" id="table">
                                    <input placeholder="EDIT" id="name" type="text" class="validate save-control"
                                           name="name">
                                    <button class="sub-btn" id="nameSubmit">Save Changes</button>
                                </div>
                            </div>
                        </div> -->
                        <div class="oc">
                            <div id="dateMessage"></div>
                            <div class="bio-background flex-box">
                                <div class="icon">
                                    <p><i class="fa fa-calendar"></i></p>
                                </div>
                                <div class="bio-name flex">
                                    <strong>DOB :</strong>&nbsp;&nbsp;&nbsp;
                                    <?php
                                    $dob = isset(Auth::user()->details->birthday) ? (Auth::user()->details->birthday) : null;
                                    $dob = ($dob == null) ? '' : Auth::user()->details->birthday;
                                    ?>
                                    <span id="displayDate">{{$dob}}</span>
                                </div>
                                <div class="action-icon">
                                    <p data-title="Add or Update" id="action-icon"><i class="fa fa-edit"></i></p>
                                </div>
                            </div>
                            <div class="collapsible-body-input">
                                <input type="hidden" name="table" value="details" id="dobtable">
                                <div class="flex-box">
                                    <select class="validate  select-control" name="day" required id="day">
                                        <option value="" disabled selected><b>Date</b></option>
                                        @for($d = 1; $d <= 31; $d++)
                                            <option value="{{$d}}">{{$d}}</option>
                                        @endfor
                                    </select>
                                    <select class="validate select-control" name="month" required id="month">
                                        <option value="" disabled selected><b>Month</b></option>
                                        <option value="1">Jan</option>
                                        <option value="2">Feb</option>
                                        <option value="3">Mar</option>
                                        <option value="4">Apr</option>
                                        <option value="5">May</option>
                                        <option value="6">Jun</option>
                                        <option value="7">Jul</option>
                                        <option value="8">Aug</option>
                                        <option value="9">Sep</option>
                                        <option value="10">Oct</option>
                                        <option value="11">Nov</option>
                                        <option value="12">Dec</option>
                                    </select>
                                    <select class="validate select-control" name="year" required id="year">
                                        <option value="" disabled selected><b>Year</b></option>
                                        @for($d = date('Y'); $d >= 1930; $d--)
                                            <option value="{{$d}}">{{$d}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <button class="sub-btn mt-10" id="dateSubmit">Save Changes</button>
                            </div>
                        </div>
                        <div class="oc">
                            <div id="countryMessage"></div>
                            <div class="bio-background flex-box">
                                <div class="icon">
                                    <p><i class="fa fa-flag"></i></p>
                                </div>
                                <div class="bio-name flex">
                                    <strong>Nationality :</strong>&nbsp;&nbsp;&nbsp;
                                    <?php
                                    $nationality = isset(Auth::user()->details->nationality) ? (Auth::user()->details->nationality) : null;
                                    $nationality = ($nationality == null) ? '' : $nationality;
                                    ?>
                                    <span id="displayCountry">{{$nationality}}</span>
                                </div>
                                <div class="action-icon">
                                    <p data-title="Add or Update" id="action-icon"><i class="fa fa-edit"></i></p>
                                </div>
                            </div>
                            <div class="collapsible-body-input">
                                <div class="flex-box">
                                    <input type="hidden" id="countryTable" value="details">
                                    <select style="width:60%" class="validate select-control" name="country"
                                            id="country" required>
                                        <option value="" disabled selected>Select your nationality</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country['name']}}">{{$country['name']}}</option>
                                        @endforeach
                                    </select>
                                    <button class="sub-btn" id="countrySubmit">Save Changes</button>
                                </div>
                            </div>
                        </div>
                        <div class="oc">
                            <div id="addressMessage" class="center-align"></div>
                            <div class="bio-background flex-box">
                                <div class="icon">
                                    <p><i class="fa fa-map-marker"></i></p>
                                </div>
                                <div class="bio-name flex">
                                    <strong>Address :</strong>&nbsp;&nbsp;&nbsp;
                                    <?php
                                    $address = isset(Auth::user()->details->address) ? (Auth::user()->details->address) : null;
                                    $address = ($address == null) ? '' : $address;
                                    ?>
                                    <span id="displayAddress">{{$address}}</span>
                                </div>
                                <div class="action-icon">
                                    <p data-title="Add or Update" id="action-icon"><i class="fa fa-edit"></i></p>
                                </div>
                            </div>
                            <div class="collapsible-body-input">
                                <div class="flex-box">
                                    <input type="hidden" id="addressTable" value="details">
                                    <input placeholder="Address" name="address" id="address" type="text"
                                           class="validate save-control" value="@if($address != null)
                                    {{$address}} @else Enter your address @endif" required>
                                    <button class="sub-btn" id="addressSubmit">Save Changes</button>
                                </div>
                            </div>
                        </div>

                        <div class="inner-package-head-title mt-10 mb-20">
                            <h3>Contact</h3>
                        </div>
                        <div class="oc">
                            <div id="contactMessage" class="center-align"></div>
                            <div class="bio-background flex-box">
                                <div class="icon">
                                    <p><i class="fas fa-phone" aria-hidden="true"></i></p>
                                </div>
                                <?php
                                if (Auth::user()->details != null) {
                                    $phone = ((Auth::user()->details->phone != null) ? Auth::user()->details->phone : '');
                                    $phoneAct = ((Auth::user()->details->phone != null) ? 'Change' : 'Add');
                                } else {
                                    $phone = 'Add Phone Number';
                                    $phoneAct = 'Add';
                                }
                                ?>
                                <div class="bio-name flex">
                                    <strong>Contact Number:</strong>&nbsp;&nbsp;&nbsp;

                                    <span id="displayBio" style="margin-bottom:5px">{{$phone}}</span>
                                </div>
                                <div class="action-icon">
                                    <p id="action-icon"><i class="fa fa-edit"></i></p>
                                </div>
                            </div>
                            <div class="collapsible-body-input">
                                <div class="flex-box">
                                    <input type="hidden" id="contactTable" value="details">
                                    <input name="phone" id="contact" type="number" class="validate save-control"
                                           required>
                                    <button class="sub-btn" id="contactSubmit">{{$phoneAct}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="oc">
                            <div class="bio-background flex-box">
                                <div class="icon">
                                    <p><i class="fas fa-envelope" aria-hidden="true"></i></p>
                                </div>
                                <div class="bio-name flex">
                                    <strong>Mail:</strong>&nbsp;&nbsp;&nbsp;
                                    <span id="topPrimary">{{Auth::user()->email}}</span>
                                    @if(Auth::user()->is_active == 0)
                                        <a href="/profile/edit/resendprimary/{{$id}}">
                                            <button class="btn waves-effect waves-light btn">Resend Verification Link
                                            </button>
                                        </a>
                                    @endif
                                </div>
                                <div class="action-icon">
                                    <p id="action-icon"><i class="fa fa-edit"></i></p>
                                </div>
                            </div>
                            <div class="collapsible-body-input">
                                @if(Auth::user()->email != null && Auth::user()->secondary_email != null && Auth::user()->secondary_token == null)
                                    <p id="ajaxMessage" style="color:darkslategray; box-shadow: -1px 1px 5px 0px;"></p>
                                    <p> Change Primary Email. Your primary email will be used to log in.</p>
                                    <select name="primary" id="primary">
                                        <option value="{{Auth::user()->email}}" selected
                                                id="first">{{Auth::user()->email}}</option>
                                        <option value="{{Auth::user()->secondary_email}}"
                                                id="second">{{Auth::user()->secondary_email}}</option>
                                    </select>
                                @endif
                                <?php
                                //$emailAct = (Auth::user()->email != null)?'Change':'Add';
                                $secondaryAct = (Auth::user()->secondary_email != null) ? 'Change' : 'Add';

                                $email = ((Auth::user()->email) == null) ? 'No Primary Email' : (Auth::user()->email);

                                if (Auth::user()->secondary_email == null) {
                                    $secondary = 'No secondary email';
                                } elseif (Auth::user()->secondary_email != null && Auth::user()->secondary_token == null) {
                                    $secondary = Auth::user()->secondary_email . " (secondary)";
                                } elseif (Auth::user()->secondary_email != null && Auth::user()->secondary_token != '') {
                                    $secondary = 'Please verify your secondary email. ' . Auth::user()->secondary_email;
                                }
                                ?>
                                <span id="topSecondary" style="margin-bottom:5px"><b>{{$secondary}}</b></span>
                                @if(preg_match('/verify/', $secondary))
                                    <a href="/profile/edit/resend/{{$id}}">
                                        <button class="btn waves-effect waves-light btn">Resend Verification Link
                                        </button>
                                    </a>
                                @endif

                                <form action="/profile/edit/{{$id}}" method="post" class="flex-box">
                                    {{csrf_field()}}
                                    <input type="hidden" name="table" value="user">
                                    <input name="secondary" id="email" type="text" class="validate save-control"
                                           placeholder="Change Secondary Mail" required>
                                    <label for="secondary"></label><br>
                                    <button class="sub-btn">{{$secondaryAct}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 pr-0">
                    <div class="account-bar">
                        <button>Menu</button>
                    </div>
                    <div class="account-nav">
                        <ul class="account-list">
                            <li class="account-tab-control active"><a href="#bookedTrip">Booked Trips</a></li>
                            <li class="account-tab-control"><a href="#pendingtrip">Pending Trip</a></li>
                            <li class="account-tab-control"><a href="#blog">Blog</a></li>
                            <li class="account-tab-control"><a href="#bucketlist">Bucket List</a></li>
                            <li class="account-tab-control"><a href="#triponreserve">Trip on Reserve</a></li>
                            {{--<li class="account-tab-control"><a href="#fellowtraveler">Fellow Traveler(s)</a></li>--}}
                            <li class="account-tab-control"><a href="#paymentdetails">Payment Details</a></li>
                        </ul>
                    </div>

                    <div class="account-all-details">
                        <div id='bookedTrip' class="account-tab-panel active">
                            <div class="section-title-black mt-30">
                                <h2>Booked Trips</h2>
                                <div class="title-bg">
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                </div>
                            </div>
                            @if($fullPaymentTrips != null || $fullPaymentFixed != null)
                                <div class="row">
                                    @if($fullPaymentTrips != null )
                                        <div class="inner-package-head-title mb-30 col-lg-12">
                                            <h3>Normal Trips</h3>
                                        </div>
                                        @foreach($fullPaymentTrips as $book)
                                            <div class='col-lg-6 col-md-6 col-sm-12 mt-10'>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-12 pr-0">
                                                        <div class="account-book-image">
                                                            <img src="{{asset('images/trips/thumbnail/'.$book->trips->cover_image)}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-12 bg-f2f2f2">
                                                        <div class="trip-de">
                                                            <div class="trip-name">
                                                                <h2><a href="/trip/{{$book->trips->slug}}"
                                                                       style="color: black;"
                                                                       target="_blank">{{$book->trips->name}} </a></h2>
                                                            </div>
                                                            <ul>
                                                                <li><strong>Booked On
                                                                        :</strong>&nbsp;{{$book->created_at}}</li>
                                                                <li><strong>Book Id :</strong>&nbsp;{{$book->bookid}}
                                                                </li>

                                                            </ul>
                                                            <ul class="viewdetail-btn flex-box">
                                                                <li><a href="/paidtripsinvoice/{{$book->bookid}}">View
                                                                        Invoice</a></li>
                                                                <li><a href="#fullPaymentTrips{{$book->bookid}}">View
                                                                        Details</a></li>
                                                            </ul>
                                                            @if($book->is_posted($book->bookid) == false)
                                                                {{--              <div class="main-btn">--}}
                                                                {{--                <a href="" class="main-last-btn">Post to Fellow Travelers</a>--}}
                                                                {{--              </div>--}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if($fullPaymentFixed != null )
                                        <div class="inner-package-head-title mb-30 col-lg-12">
                                            <h3>Fixed Departure Trips</h3>
                                        </div>
                                        @foreach($fullPaymentFixed as $book)
                                            <div class='col-lg-6 col-md-6 col-sm-12 mt-10'>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-12 pr-0">
                                                        <div class="account-book-image">
                                                            <img src="https://www.swotahtravel.com/images/trips/thumbnail/Mera-Peak.jpg">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-12 bg-f2f2f2">
                                                        <div class="trip-de">
                                                            <div class="trip-name">
                                                                <h2><a href="/trip/{{$book->trips->trips->slug}}"
                                                                       style="color: black;"
                                                                       target="_blank">{{$book->trips->trips->name}}</a>
                                                                </h2>
                                                            </div>
                                                            <ul>
                                                                <li><strong>Booked On
                                                                        :</strong>&nbsp;{{$book->created_at}}</li>
                                                                <li><strong>Book Id :</strong>&nbsp;{{$book->bookid}}
                                                                </li>

                                                            </ul>
                                                            <ul class="viewdetail-btn flex-box">
                                                                <li><a href="/paidtripsinvoice/{{$book->bookid}}">View
                                                                        Invoice</a></li>
                                                                <li><a href="#fullPaymentTrips{{$book->bookid}}">View
                                                                        Details</a></li>
                                                            </ul>
                                                            @if($book->is_posted($book->bookid) == false)
                                                                {{--              <div class="main-btn">--}}
                                                                {{--                <a href="" class="main-last-btn">Post to Fellow Travelers</a>--}}
                                                                {{--              </div>--}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @else
                                <p style="text-align: center;font-size: 15px;"> No any booked trips found. </p>
                            @endif
                        </div>
                        {{--end of booked trip--}}
                        {{--pending trips--}}
                        <div id="pendingtrip" class="account-tab-panel">
                            <div class="section-title-black mt-30">
                                <h2>Pending Trips</h2>
                                <div class="title-bg">
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                </div>
                            </div>
                            @if($datebooks != null || $fixedbooks != null)
                                <div clas="row">
                                    @if($datebooks != null )
                                        <div class="inner-package-head-title mb-30 col-lg-12">
                                            <h3>Normal Trips</h3>
                                        </div>
                                        @foreach($datebooks as $book)
                                            <div class='col-lg-6 col-md-6 col-sm-12 mt-10'>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-12 pr-0">
                                                        <div class="account-book-image">
                                                            <img src="{{asset('images/trips/thumbnail/'.$book->trips->cover_image)}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-12 bg-f2f2f2">
                                                        <div class="trip-de">
                                                            <div class="trip-name">
                                                                <h2><a href="/trip/{{$book->trips->slug}}"
                                                                       style="color: black;"
                                                                       target="_blank">{{$book->trips->name}} </a></h2>
                                                            </div>
                                                            <ul>
                                                                <li><strong>Booked On
                                                                        :</strong>&nbsp;{{$book->created_at}}</li>
                                                                <li><strong>Book Id :</strong>&nbsp;{{$book->bookid}}
                                                                </li>

                                                            </ul>
                                                            <ul class="viewdetail-btn flex-box">
                                                                <li><a href="/paidtripsinvoice/{{$book->bookid}}">View
                                                                        Invoice</a></li>
                                                                <li><a href="#datebooks{{$book->bookid}}}">View
                                                                        Details</a></li>
                                                            </ul>
                                                            @if($book->is_posted($book->bookid) == false)
                                                                <div class="main-btn">
                                                                    @if($book->document == '')
                                                                        <div class="center-align">
                                                                            <a class="waves-effect waves-light btn modal-trigger"
                                                                               href="#pend{{$book->id}}"><i
                                                                                        class="material-icons left"
                                                                                        style="color:white;">
                                                                                    attach_file</i>Upload Document</a>
                                                                        </div>
                                                                    @else
                                                                        <div style="text-align: center">
                                                                            <button class="btn center-aligned docs">
                                                                                Documents are being reviewed!
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if($fixedbooks != null )
                                        <div class="inner-package-head-title mb-30 col-lg-12">
                                            <h3>Fixed Departure Trips</h3>
                                        </div>
                                        @foreach($fixedbooks as $book)
                                            <div class="col-lg-6 col-md-6 col-sm-12 mt-10">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-12 pr-0">
                                                        <div class="account-book-image">
                                                            <img src="{{asset('images/trips/thumbnail/'.$book->trips->trips->cover_image)}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-12 bg-f2f2f2">
                                                        <div class="trip-name">
                                                            <h2><a href="/trip/{{$book->trips->trips->slug}}"
                                                                   style="color: black;"
                                                                   target="_blank">{{$book->trips->trips->name}}</a>
                                                            </h2>
                                                        </div>
                                                        <ul>
                                                            <li><strong>Booked On :</strong>&nbsp;{{$book->created_at}}
                                                            </li>
                                                            <li><strong>Book Id :</strong>&nbsp;{{$book->bookid}}</li>

                                                        </ul>
                                                        <ul class="viewdetail-btn flex-box">
                                                            <li><a href="/invoice/{{$book->bookid}}">View Invoice</a>
                                                            </li>
                                                            <li><a href="#fixedbooks{{$book->bookid}}">View Details</a>
                                                            </li>
                                                        </ul>
                                                        @if($book->is_posted($book->bookid) == false)
                                                            <div class="main-btn">
                                                                @if($book->document == '')
                                                                    <div class="center-align">
                                                                        <a class="waves-effect waves-light btn modal-trigger"
                                                                           href="#pend{{$book->id}}"><i
                                                                                    class="material-icons left"
                                                                                    style="color:white;">
                                                                                attach_file</i>Upload Document</a>
                                                                    </div>
                                                                @else
                                                                    <div style="text-align: center">
                                                                        <button class="btn center-aligned docs">
                                                                            Documents are being reviewed!
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @else
                                <p style="text-align: center;font-size: 15px;"> No any pending trips found. </p>
                            @endif
                        </div>
                        {{--end of pending trip--}}
                        {{--blog--}}
                        <div id="blog" class="account-tab-panel">
                            <div class="section-title-black mt-30">
                                <h2>Blog</h2>
                                <div class="title-bg">
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                </div>
                            </div>
                            <div class="add-btn" style="display:block;text-align:center">
                                <a href="/blog/create" class="add-blog-btn">Add Blog</a>
                            </div>
                        </div>
                        {{--end of blog--}}
                        {{--bucket--}}
                        <div id="bucketlist" class="account-tab-panel">
                            <div class="section-title-black mt-30">
                                <h2>Your Bucket list </h2>
                                <div class="title-bg">
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                </div>
                            </div>
                            @if(count($wishes))
                                <div class="row">
                                    @foreach($wishes as $wish)
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 mt-20">

                                            <div class="bucket-block">
                                                <div class="bucket-image">
                                                    <a href="/trip/{{$wish->trips->slug}}" style="display:block;">
                                                        <img src="{{asset('images/trips/thumbnail/'.$wish->trips->cover_image)}}">
                                                    </a>
                                                </div>
                                                <div class="bucket-trip-name">
                                                    <h3>{{$wish->trips->name}} </h3>
                                                </div>
                                                <div class="bucketaction-btn">
                                                    <div class="flex-box">
                                                        <div class="compare-bttn">
                                                            <input title="Compare" class="filled-in compareCheckbox"
                                                                   type="checkbox" id="{{$wish->trip_id}}"
                                                                   onchange="compareTo('{{$wish->trip_id}}',this)"/>&nbsp;<strong>Compare</strong>
                                                        </div>

                                                        <div class="love-bttn">
                                                            <a href="/removewish/{{$wish->id}}"
                                                               class="heart-btn"
                                                               data-position="bottom" data-delay="10"
                                                               data-tooltip="Remove from Bucket list"
                                                               style="right:60px;bottom:10px;">
                                                                <i class="fa fa-heart"
                                                                   style="color:white;font-size:12px"></i>
                                                            </a>
                                                        </div>
                                                        <div class="bucket-departure">
                                                            <a href="/{{$wish->trips->slug}}#fixed-departure"
                                                               data-title="View Departure Dates"><i
                                                                        class="fa fa-calendar"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p style="text-align: center;font-size: 15px;"> No any bucket list found. </p>
                            @endif

                        </div>
                        {{--end of bucket--}}
                        {{--Trip on Reserve--}}
                        <style type="text/css">
                            .trip-reserve {
                                display: block;

                            }

                            .tripreserve-image {
                                background: #ddd;
                                height: 170px;
                            }

                            .tripreserve-image a {
                                display: block;
                            }

                            .tripreserve-image a img {
                                width: 100%;
                                height: 100%;
                            }

                            .trip-shadow {
                                background: #fff;
                                box-shadow: 0px 0px 5px #000;
                            }

                            .reservetrip-name {
                                padding: 0px 10px;
                            }

                            .reservetrip-name h3 a {
                                font-size: 16px;
                                margin-top: 15px;
                                color: #111;
                                font-weight: 800;
                                display: block;
                            }

                            .hold-details {
                                margin-top: 10px;
                                padding: 0px 10px;
                            }

                            .hold-details ul li strong {
                                font-size: 12px;
                            }

                            .hold-details ul li span {
                                font-size: 12px;
                            }

                            .expire-date-hold {
                                padding: 0px 10px;
                                margin-top: 10px;

                            }

                            .expire-date-hold p {
                                background: #fc0;
                                color: #111;
                                font-size: 12px;
                                text-align: center;
                                padding: 5px 0;
                            }

                            .reserve-book {
                                padding: 0px 10px;
                                margin-top: 10px;
                            }

                            .btn-book-reserve {
                                background: #0161ba;
                                border: 0px;
                                padding: 5px 5px;
                                font-size: 12px;
                                color: #fff;
                                display: block;
                                width: 100%;
                                box-shadow: inset 0 0 0 0 #fc0;
                                -webkit-transition: ease-out 0.6s;
                                -moz-transition: ease-out 0.6s;
                                transition: ease-out 0.6s;

                            }

                            .btn-book-reserve:hover {
                                box-shadow: inset 400px 0 0 0 #fc0;
                                color: #111;
                            }

                            .btn-reserve-cancle {
                                background: #ff0000;
                                border: 0px;
                                padding: 5px 5px;
                                font-size: 12px;
                                color: #fff;
                                display: block;
                                width: 100%;
                                text-align: center;
                            }

                            .btn-reserve-cancle:hover {
                                color: #fff;
                            }

                            .reserve-form {
                                width: 50%;
                            }

                            .reserve-cancel {
                                width: 50%;
                            }
                        </style>
                        <div id="triponreserve" class="account-tab-panel">
                            <div class="section-title-black mt-30">
                                <h2>Trip on Reserve</h2>
                                <div class="title-bg">
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                    <span class="line-bg"></span>
                                </div>
                            </div>
                            <div class="trip-reserve mt-30">
                                @if(count($holds))
                                    <div class="row">
                                        @foreach($holds as $hold)
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <div class="trip-shadow">
                                                    <div class="tripreserve-image">
                                                        <a href="/{{$hold->trips->trips->slug}}"><img
                                                                    src="https://www.swotahtravel.com/images/trips/thumbnail/annapurna round trekking.JPG"></a>
                                                    <!-- <img src="{{url('images/trips/thumbnail/'.$hold->trips->trips->cover_image)}}"> -->
                                                    </div>
                                                    <div class="reservetrip-name">
                                                        <h3>
                                                            <a href="/{{$hold->trips->trips->slug}}">{{$hold->trips->trips->name}}</a>
                                                        </h3>
                                                    </div>
                                                    <div class="hold-details">
                                                        <ul>
                                                            <li><strong>Hold
                                                                    on:</strong>&nbsp;<span>{{$hold->date}}</span></li>
                                                            <li>
                                                                <strong>Seats:</strong>&nbsp;<span>{{$hold->seats}}</span>
                                                            </li>
                                                            <li>
                                                                <strong>Departure</strong>&nbsp;<span>{{date('Y-m-d', strtotime($hold->trips->start_date))}}</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="expire-date-hold">
                                                        <p>The reserve expires within&nbsp;<span
                                                                    id="demo{{$hold->id}}"></span></p>
                                                        <script>
                                                            // var countDownDate = new Date("Sep 5, 2018 15:37:25").getTime();
                                                            var countDownDate{{$hold->id}} = new Date("{{date('M d, Y H:i:s',strtotime($hold->date.'+77 hours 40 minutes'))}}").getTime();

                                                            // Update the count down every 1 second
                                                            var x = setInterval(function () {
                                                                // Get todays date and time
                                                                var now = new Date().getTime();

                                                                // Find the distance between now an the count down date
                                                                var distance = countDownDate{{$hold->id}} - now;
                                                                //alert(distance)

                                                                // Time calculations for days, hours, minutes and seconds
                                                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                                                // Output the result in an element with id="demo"
                                                                document.getElementById("demo{{$hold->id}}").innerHTML = days + "d " + hours + "h "
                                                                    + minutes + "m " + seconds + "s ";

                                                                // If the count down is over, write some text
                                                                if (distance < 0) {
                                                                    clearInterval(x);
                                                                    document.getElementById("demo{{$hold->id}}").innerHTML = "0";
                                                                }
                                                            }, 1000);

                                                        </script>
                                                    </div>
                                                    <div class='reserve-book'>
                                                        <div class="flex-box">
                                                            <form action="/holdbook/{{$hold->id}}" method="get"
                                                                  id="form" class="reserve-form">

                                                                <button class="btn-book-reserve" type="submit">
                                                                    Book Now
                                                                </button>

                                                            </form>
                                                            <div class="reserve-cancel">
                                                                <a class="btn-reserve-cancle" type="submit"
                                                                   style="background-color: red"
                                                                   href="/hold/destroy/{{$hold->id}}">
                                                                    Cancel Reserve
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                @else
                                    <p style="text-align: center;font-size: 20px;"> No any Reserved trips found. </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{--end of trip on reserve--}}
                    {{--fellowtraveler--}}
                    {{--<div id="fellowtraveler" class="account-tab-panel">--}}
                    {{--     <div class="section-title-black mt-30">--}}
                    {{--        <h2>Fellow Traveler(s)</h2>--}}
                    {{--        <div class="title-bg">--}}
                    {{--          <span class="line-bg"></span>--}}
                    {{--          <span class="line-bg"></span>--}}
                    {{--          <span class="line-bg"></span>--}}
                    {{--          <span class="line-bg"></span>--}}
                    {{--          <span class="line-bg"></span>--}}
                    {{--        </div>--}}
                    {{--    </div>--}}
                    {{--</div>--}}
                    {{--endfellowtraveler--}}
                    {{--payment-details--}}
                    <div id="paymentdetails" class="account-tab-panel">
                        <div class="section-title-black mt-30">
                            <h2>Payment Details </h2>
                            <div class="title-bg">
                                <span class="line-bg"></span>
                                <span class="line-bg"></span>
                                <span class="line-bg"></span>
                                <span class="line-bg"></span>
                                <span class="line-bg"></span>
                            </div>
                        </div>
                        <div class="add-btn" style="display:block;text-align:center">
                            <a href="#" class="card-btn">Add New Card</a>
                        </div>

                        {{--add new card pop--}}
                        <div id="cardPop" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title">Add New Card</h1>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                                    </div>
                                    <form class="col s12" action="/profile/payment/store" style="margin-bottom:0px">

                                        <div class="modal-body">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="row">
                                                <div class='col-lg-6 col-md-6 col-sm-12'>
                                                    <div class="form-group">
                                                        <label>Card Type <span class="red">*</span></label>
                                                        <input type="text" name="card_type" class="form-control"
                                                               placeholder="Card Type">
                                                    </div>
                                                </div>
                                                <div class='col-lg-6 col-md-6 col-sm-12'>
                                                    <div class="form-group">
                                                        <label>Card Number <span class="red">*</span></label>
                                                        <input type="number" name="card_number" class="form-control"
                                                               placeholder="Card Number" required>
                                                    </div>
                                                </div>
                                                <div class='col-lg-6 col-md-6 col-sm-12'>
                                                    <div class="form-group">
                                                        <label>Card Holder Name <span class="red">*</span></label>
                                                        <input type="text" name="card_holder_name" class="form-control"
                                                               placeholder="Card Holder Name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Card Expiry Date <span class="red">*</span></label>
                                                        <input id="" type="date" class="form-control"
                                                               name="card_expiry_date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="card-btn-details">Add Details</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        {{--end of add new card--}}
                        @if(count($paymentDetails)>0)
                            <div class="tabwrapper center-block mb-20 mt-10">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <p style="text-align: center;font-size: 15px;margin-bottom:10px"> The following
                                        payment methods are associated with your account.</p>
                                    @foreach ($paymentDetails as $key=>$payDetails)

                                        <div class="faqs panel panel-default">
                                            <div class="panel-heading active" role="tab" id="{{$payDetails->id}}">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                       href="#collapse{{$payDetails->id}}" aria-expanded="true"
                                                       aria-controls="collapse{{$payDetails->id}}">
                                                        <i class="fa fa-credit-card" style="font-size:18px"></i>&nbsp;&nbsp;{{$payDetails->card_type}} {{$payDetails->card_number}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse{{$payDetails->id}}"
                                                 class="panel-collapse collapse in @if($key==0) show @endif"
                                                 role="tabpanel" aria-labelledby="{{$payDetails->id}}">
                                                <div class="panel-body">
                                                    <table style="width:100%">
                                                        <tr>
                                                            <td style="width:40%"><strong>Card Type</strong>&nbsp;<i
                                                                        class="fas fa-arrow-right"></i></td>
                                                            <td>{{$payDetails->card_type}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Card number</strong>&nbsp;<i
                                                                        class="fas fa-arrow-right"></i></td>
                                                            <td>{{$payDetails->card_number}}</td>

                                                        </tr>
                                                        <tr>
                                                            <td><strong>Card Holder Name</strong>&nbsp;<i
                                                                        class="fas fa-arrow-right"></i></td>
                                                            <td>{{$payDetails->card_holder_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Expiry date</strong>&nbsp;<i
                                                                        class="fas fa-arrow-right"></i></td>
                                                            <td>{{$payDetails->card_expiry_date}}</td>
                                                        </tr>
                                                    </table>
                                                    <div class="paymentdetailsBtns right-align"><br>
                                                        <a href="" onclick="editCard({{$payDetails->id}})"
                                                           class="update-card" style="">Update</a>
                                                        <a href="/profile/payment/delete/{{$payDetails->id}}"
                                                           class="delete-card">Delete</a>
                                                        {{--card-edit modal--}}
                                                        <div id="editcardPop{{$payDetails->id}}" class="modal fade"
                                                             role="dialog">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title">Update New Card</h1>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal">&times;
                                                                        </button>

                                                                    </div>
                                                                    <form class="col s12"
                                                                          action="/profile/payment/update/{{$payDetails->id}}"
                                                                          style="margin-bottom:0px">

                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="_token"
                                                                                   value="{{csrf_token()}}">
                                                                            <div class="row">
                                                                                <div class='col-lg-6 col-md-6 col-sm-12'>
                                                                                    <div class="form-group">
                                                                                        <label>Card Type <span
                                                                                                    class="red">*</span></label>
                                                                                        <input type="text"
                                                                                               name="card_type"
                                                                                               class="form-control"
                                                                                               value="{{$payDetails->card_type}} "
                                                                                               placeholder="Card Type">
                                                                                    </div>
                                                                                </div>
                                                                                <div class='col-lg-6 col-md-6 col-sm-12'>
                                                                                    <div class="form-group">
                                                                                        <label>Card Number <span
                                                                                                    class="red">*</span></label>
                                                                                        <input type="number"
                                                                                               name="card_number"
                                                                                               class="form-control"
                                                                                               value="{{$payDetails->card_number}}"
                                                                                               placeholder="Card Number"
                                                                                               required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class='col-lg-6 col-md-6 col-sm-12'>
                                                                                    <div class="form-group">
                                                                                        <label>Card Holder Name <span
                                                                                                    class="red">*</span></label>
                                                                                        <input type="text"
                                                                                               name="card_holder_name"
                                                                                               class="form-control"
                                                                                               value="{{$payDetails->card_holder_name}}"
                                                                                               placeholder="Card Holder Name">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label>Card Expiry Date <span
                                                                                                    class="red">*</span></label>
                                                                                        <input value="{{$payDetails->card_expiry_date}}"
                                                                                               id="" type="date"
                                                                                               class="form-control"
                                                                                               name="card_expiry_date">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="card-btn-details">Update
                                                                                Details
                                                                            </button>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{--end of card edit modal--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        @else
                            <p style="text-align: center;font-size: 15px;margin-bottom: 10px;"> No any payment methods
                                are associated with your account yet.</p>
                        @endif
                    </div>
                    {{--end of payment details--}}
                </div>
            </div>
        </div>
    </section>
    <div id="modal20" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <a class="modal-action close btn center" type="button" data-dismiss="modal" style="width:100%;">Click
                        to select another trip </a>
                </div>
            </div>
        </div>
    </div>
    <div id="modal2" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body" style="text-align:center">
                    You have selected two trips. You can compare these trips or add another. <br><br>
                    <a class="modal-action close  btn center" type="button" data-dismiss="modal" style="width:100%;">Add
                        another trip</a>
                    <span class="CompareOr">OR</span>
                    <a href="javascript:ViewComparison();" class="modal-action close  btn center" type="button"
                       data-dismiss style="width:100%;">Compare Trips</a>
                </div>
            </div>
        </div>
    </div>
    {{----------------------modals--------------------------------}}
    <div id="uploadModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" style="width:400px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Please choose a picture</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="photoUpload" action="/profile/edit/{{Auth::user()->id}}" method="post"
                      enctype="multipart/form-data">
                    <div class="modal-body">
                        <p style="color:red; text-align:center">Please select image of size less than 5 MB.</p>
                        <input type="hidden" name="table" value="user">
                        <div class="form-group">
                            <input type="file" class="form-control" id="photo2" name="photo" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Upload
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/compare.js')}}"></script>
    <script type="text/javascript">
        $('.account-bar button').on('click', function () {
            $('.account-nav').toggleClass('show-account-nav');
            $('.account-tab-control').on('click', function () {
                $('.account-nav').removeClass('show-account-nav')
            });
        });
    </script>
    <script type="text/javascript">
        $('.card-btn').on('click', function () {
            $('#cardPop').modal('show');
        });

        function editCard(id) {
            $('#editcardPop' + id).modal('show');
        }

        $(".account-list li").click(function (e) {
            e.preventDefault();
            let href = $(this).find('a');
            let id = href.attr('href');
            $(".account-list li").removeClass("active");
            $(this).addClass("active");
            $(".account-tab-panel.active").removeClass("active").fadeOut(200);
            $(id).fadeIn(500).addClass("active");


        });


        $('#primary').on('change', function () {
            var primary = $('#primary').val();
            $.ajax({
                type: "POST",
                async: false,
                url: "/profile/ajax/edit/{{Auth::user()->id}}",
                data: {
                    '_method': 'POST',
                    '_token': $('input[name=_token]').val(),
                    'primary': primary,
                },
                success: function (data) {
                    $('#ajaxMessage').html('<strong>' + data[0] + '</strong>');
                    $('#ajaxMessage').css("color", "red");
                    var first = $('#first').text();
                    $('#topPrimary').html('<strong>' + data[1] + ' (primary) <strong>');
                    $('#topSecondary').html('<strong>' + data[2] + ' (secondary) <strong>');
                }
            });
        });

        $('.uploadImg').on('click', function () {
            $('#uploadModal').modal('show');
        });
        $("form#photoUpload").submit(function (e) {

            $('#displayPhoto').fadeIn(1000);
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                async: false,
                url: "/profile/edit/{{Auth::user()->id}}",
                data: formData,
                success: function (data) {
                    $('#displayPhoto').html('<img src="' + data[0] + '" alt="" class="responsive-img"');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $('.oc').each(function () {
            let actionIcon = $(this).find('#action-icon');
            let formInput = $(this).find('.collapsible-body-input');
            $(actionIcon).on('click', function () {
                formInput.toggle();
                /* actionIcon.html('<p class="close"><i class="fa fa-times" style="color:red"></i></p>')*/
            });

        });


        $('#nameSubmit').on('click', function () {
            var name = $('#name').val();
            var table = $('#table').val();
            $.ajax({
                type: "POST",
                async: false,
                url: "/profile/edit/{{Auth::user()->id}}",
                data: {
                    '_method': 'POST',
                    '_token': $('input[name=_token]').val(),
                    'table': table,
                    'name': name,
                },
                success: function (data) {
                    $('#nameMessage').html('<span>' + data[0] + '</span>');
                    $('#nameMessage').fadeIn();
                    $('#nameMessage').css("color", "green");
                    $('#nameMessage').delay(2000).fadeOut();
                    $('#displayName').text(data[1]);
                    $('#displayName').css("font-weight", "normal");
                    $(document).prop('title', data[1]);
                }
            });
        });

        //Ajax Call to change date
        $('#dateSubmit').on('click', function () {
            var day = $('#day').val();
            var month = $('#month').val();
            var year = $('#year').val();
            var table = $('#dobtable').val();
            // alert(table);
            $.ajax({
                type: "POST",
                async: false,
                url: "/profile/edit/{{Auth::user()->id}}",
                data: {
                    '_method': 'POST',
                    '_token': $('input[name=_token]').val(),
                    'table': table,
                    'day': day,
                    'month': month,
                    'year': year,
                },
                success: function (data) {
                    // alert(data.join(' '));
                    $('#dateMessage').html('<span>' + data[0] + '</span>');
                    $('#dateMessage').fadeIn();
                    $('#dateMessage').css("color", "green");
                    $('#dateMessage').delay(2000).fadeOut();
                    $('#displayDate').text(data[1]);
                    $('#displayDate').css("font-weight", "normal");
                }
            });
        });
        //Ajax Call to change nationality
        $('#countrySubmit').on('click', function () {
            var table = $('#countryTable').val();
            var country = $('#country').val();
            $.ajax({
                type: "POST",
                async: false,
                url: "/profile/edit/{{Auth::user()->id}}",
                data: {
                    '_method': 'POST',
                    '_token': $('input[name=_token]').val(),
                    'table': table,
                    'country': country,
                },
                success: function (data) {
                    $('#countryMessage').html('<span>' + data[0] + '</span>');
                    $('#countryMessage').fadeIn();
                    $('#countryMessage').css("color", "green");
                    $('#countryMessage').delay(2000).fadeOut();
                    $('#displayCountry').text(data[1]);
                    $('#displayCountry').css("font-weight", "normal");
                }
            });
        });


        //Ajax Call to change address
        $('#addressSubmit').on('click', function () {
            var table = $('#addressTable').val();
            var address = $('#address').val();
            $.ajax({
                type: "POST",
                async: false,
                url: "/profile/edit/{{Auth::user()->id}}",
                data: {
                    '_method': 'POST',
                    '_token': $('input[name=_token]').val(),
                    'table': table,
                    'address': address,
                },
                success: function (data) {
                    $('#addressMessage').html('<span>' + data[0] + '</span>');
                    $('#addressMessage').fadeIn();
                    $('#addressMessage').css("color", "green");
                    $('#addressMessage').delay(2000).fadeOut();
                    $('#displayAddress').text(data[1]);
                    $('#displayAddress').css("font-weight", "normal");
                }
            });
        });


        //Ajax Call to change Languages
        $('#languageSubmit').on('click', function () {
            var table = $('#languageTable').val();
            var languages = $('#language').val();
            $.ajax({
                type: "POST",
                async: false,
                url: "/profile/edit/{{Auth::user()->id}}",
                data: {
                    '_method': 'POST',
                    '_token': $('input[name=_token]').val(),
                    'table': table,
                    'languages': languages,
                },
                success: function (data) {
                    $('#languageMessage').html('<span>' + data[0] + '</span>');
                    $('#languageMessage').fadeIn();
                    $('#languageMessage').css("color", "green");
                    $('#languageMessage').delay(2000).fadeOut();
                    $('#displayLanguage').text(data[1]);
                    $('#displayLanguage').css("font-weight", "normal");
                }
            });
        });


        //Ajax Call to change Interests
        $('#interestSubmit').on('click', function () {
            var table = $('#interestTable').val();
            var interests = $('#interest').val();
            $.ajax({
                type: "POST",
                async: false,
                url: "/profile/edit/{{Auth::user()->id}}",
                data: {
                    '_method': 'POST',
                    '_token': $('input[name=_token]').val(),
                    'table': table,
                    'interests': interests,
                },
                success: function (data) {
                    $('#interestMessage').html('<span>' + data[0] + '</span>');
                    $('#interestMessage').fadeIn();
                    $('#interestMessage').css("color", "green");
                    $('#interestMessage').delay(2000).fadeOut();
                    $('#displayInterest').text(data[1]);
                    $('#displayInterest').css("font-weight", "normal");
                }
            });
        });

        //Ajax Call to change Bio
        $('#bioSubmit').on('click', function () {
            var table = $('#bioTable').val();
            var bio = $('#bio').val();
            $.ajax({
                type: "POST",
                async: false,
                url: "/profile/edit/{{Auth::user()->id}}",
                data: {
                    '_method': 'POST',
                    '_token': $('input[name=_token]').val(),
                    'table': table,
                    'bio': bio,
                },
                success: function (data) {
                    $('#bioMessage').html('<span>' + data[0] + '</span>');
                    $('#bioMessage').fadeIn();
                    $('#bioMessage').css("color", "green");
                    $('#bioMessage').delay(2000).fadeOut();
                    $('#displayBio').text(data[1]);
                    $('#displayBio').css("font-weight", "normal");
                }
            });
        });


        //Ajax Call to change Phone
        $('#contactSubmit').on('click', function () {
            var table = $('#contactTable').val();
            var contact = $('#contact').val();
            $.ajax({
                type: "POST",
                async: false,
                url: "/profile/edit/{{Auth::user()->id}}",
                data: {
                    '_method': 'POST',
                    '_token': $('input[name=_token]').val(),
                    'table': table,
                    'contact': contact,
                },
                success: function (data) {
                    $('#contactMessage').html('<span>' + data[0] + '</span>');
                    $('#contactMessage').fadeIn();
                    $('#contactMessage').css("color", "green");
                    $('#contactMessage').delay(2000).fadeOut();
                    $('#displayContact').text(data[1]);
                    $('#displayContact').css("font-weight", "normal");
                }
            });
        });


    </script>
@endsection
