@extends('layouts.master')
@section('title')
    <title> Find Travel Partner | Swotah Travel and Adventure</title>
@endsection
@section('metatags')
    <meta name="title" content="Partners for trekking in Nepal|Trekking partners|Find traveling partner">
    <meta name="keywords" content="Partners for trekking in Nepal, Trekking partners Nepal, Find traveling partner in Nepal, Nepal Trekking friend finder, Everest Trekking partner
    Partners for trekking in Nepal, Trekking partners Nepal, Find traveling companion in Nepal, Nepal Trekking friend finder, Everest Trekking buddies">

    <meta name="descriptions" content="Planning to trek with partner? find like minded people from around the world to trek with. Get a companion for your adventures in Nepal.
    Find friend Trekker for Everest, Annapurna, Langtang and many more destinations">
@endsection

@section('styles')
    <link rel="stylesheet" href="{{url('css/frontend/index.css')}}">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans"/>
    <style>
        .stc{
            background-color:#FAFAFA;
            margin-top: 80px;
            height:60px;
        }
        /*card-image margin*/
        h1{

            font-family:'Dosis', sans-serif;
            font-size:40px ;
            padding:10px ;

            text-align: center;
        }


        .tableBtn{
            padding:2px 10px;
            font-size: 14px;
            color: white;
            background:#00B1FF ;
        }
        /*Image Caption*/

        .mid h2 {
            font-family: 'Roboto', sans-serif;
            font-weight: 900;
            color: white;
            text-transform: uppercase;
            margin: 0;
            position: absolute;
            left:20%;
            top:-10%;
            font-size: 2rem;
            transform: translate(-50%, -50%);
            font: bold 24px/45px Helvetica, Sans-Serif;
            letter-spacing: -1px;
            background: rgb(0, 0, 0); /* fallback color */
            background: rgba(0, 0, 0, 0.4);
        }


        .img-cap{
            width: 300px;
            height: auto;
            object-fit: cover;
        }


        .card-container {
            width: 400px;
            margin-left: auto;
            margin-right: auto;

        }

        /*image overlay*/
        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-image:url({{url('/images/map.jpg')}});
            opacity: 0.8;
            background-size: cover;

            overflow: hidden;
            width: 100%;
            height: 0;
            transition: .5s ease;
        }
        .card:hover .overlay {
            height: 100%;
        }


       .imago{
            width: 50px;
            height: 50px;
        }
        .imago1{
            width: 160px;
            height: 70px;
            margin-left:-15px;
        }
        html.lb-disable-scrolling {
            overflow: hidden;
            /* Position fixed required for iOS. Just putting overflow: hidden; on the body is not enough. */
            position: fixed;
            height: 100vh;
            width: 100vw;
        }

        .lightboxOverlay {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 9999;
            background-color: black;
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
            opacity: 0.8;
            display: none;
        }

        .lightbox {
            position: absolute;
            left: 0;
            width: 100%;
            z-index: 10000;
            text-align: center;
            line-height: 0;
            font-weight: normal;
        }

        .lightbox .lb-image {
            display: block;
            height: auto;
            max-width: inherit;
            max-height: none;
            border-radius: 3px;

            /* Image border */
            border: 4px solid white;
        }

        .lightbox a img {
            border: none;
        }

        .lb-outerContainer {
            position: relative;
            *zoom: 1;
            width: 250px;
            height: 250px;
            margin: 0 auto;
            border-radius: 4px;

            /* Background color behind image.
               This is visible during transitions. */
            background-color: white;
        }

        .lb-outerContainer:after {
            content: "";
            display: table;
            clear: both;
        }

        .lb-loader {
            position: absolute;
            top: 43%;
            left: 0;
            height: 25%;
            width: 100%;
            text-align: center;
            line-height: 0;
        }

        .lb-cancel {
            display: block;
            width: 32px;
            height: 32px;
            margin: 0 auto;
            background: url('images/loading.gif') no-repeat;
        }

        .lb-nav {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 10;
        }

        .lb-container > .nav {
            left: 0;
        }

        .lb-nav a {
            outline: none;
            background-image: url('data:image/gif;base64,R0lGODlhAQABAPAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==');
        }

        .lb-prev, .lb-next {
            height: 100%;
            cursor: pointer;
            display: block;
        }

        .lb-nav a.lb-prev {
            width: 34%;
            left: 0;
            float: left;
            background: url('images/prev.png') left 48% no-repeat;
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
            opacity: 0;
            -webkit-transition: opacity 0.6s;
            -moz-transition: opacity 0.6s;
            -o-transition: opacity 0.6s;
            transition: opacity 0.6s;
        }

        .lb-nav a.lb-prev:hover {
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
            opacity: 1;
        }

        .lb-nav a.lb-next {
            width: 64%;
            right: 0;
            float: right;
            background: url('images/next.png') right 48% no-repeat;
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
            opacity: 0;
            -webkit-transition: opacity 0.6s;
            -moz-transition: opacity 0.6s;
            -o-transition: opacity 0.6s;
            transition: opacity 0.6s;
        }

        .lb-nav a.lb-next:hover {
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
            opacity: 1;
        }

        .lb-dataContainer {
            margin: 0 auto;
            padding-top: 5px;
            *zoom: 1;
            width: 100%;
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
        }

        .lb-dataContainer:after {
            content: "";
            display: table;
            clear: both;
        }

        .lb-data {
            padding: 0 4px;
            color: #ccc;
        }

        .lb-data .lb-details {
            width: 85%;
            float: left;
            text-align: left;
            line-height: 1.1em;
        }

        .lb-data .lb-caption {
            font-size: 13px;
            font-weight: bold;
            line-height: 1em;
        }

        .lb-data .lb-caption a {
            color: #4ae;
        }

        .lb-data .lb-number {
            display: block;
            clear: left;
            padding-bottom: 1em;
            font-size: 12px;
            color: #999999;
        }

        .lb-data .lb-close {
            display: block;
            float: right;
            width: 30px;
            height: 30px;
            background: url('images/close.png') top right no-repeat;
            text-align: right;
            outline: none;
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=70);
            opacity: 0.7;
            -webkit-transition: opacity 0.2s;
            -moz-transition: opacity 0.2s;
            -o-transition: opacity 0.2s;
            transition: opacity 0.2s;
        }

        .lb-data .lb-close:hover {
            cursor: pointer;
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
            opacity: 1;
        }


    </style>
    <style>

        @media only screen and (min-width: 200px) and (max-width: 699px) {
            .slide-grp
            {
                position:relative;
                z-index:3;
                top:70%;

            }
        }


        @media only screen and (min-width:501px) {
            #search1-box {
                position: relative;
                width: 50%;
                left: 25%;

            }
        }

        @media only screen and (max-width:500px){
            #search1-box {
                position: relative;
                width: 75%;
                left: 12%;
            }
        }

        #search1-form
        {
            height: 48px;
            border: 1px solid #999;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            background-color: #fff;
            overflow: hidden;
        }
        #search1-text
        {
            font-size: 14px;
            color: #ddd;
            border-width: 0;
            background: transparent;
        }
        #search1-box input[type="text"]
        {
            width: 90%;
            color: #333;
            outline: none;
        }
        #search1-button {
            position: absolute;
            top: 0;
            right: 0;
            height: 48px;
            width: 80px;
            font-size: 14px;
            color: #fff;
            text-align: center;
            line-height: 42px;
            border-width: 0;
            background-color:#008EB0;
            -webkit-border-radius: 0px 5px 5px 0px;
            -moz-border-radius: 0px 5px 5px 0px;
            border-radius: 0px 5px 5px 0px;
            cursor: pointer;
        }
        @media only screen and (min-width:269px) and (max-width:500px) {
            #search1-button {
                position: absolute;
                top: 0;
                right: 0;
                height: 48px;
                width: 52px;
                font-size: 10px;
                color: #fff;
                text-align: center;
                line-height: 42px;
                border-width: 0;
                background-color: #008EB0;
                -webkit-border-radius: 0px 5px 5px 0px;
                -moz-border-radius: 0px 5px 5px 0px;
                border-radius: 0px 5px 5px 0px;
                cursor: pointer;
            }
            #search1-text {
                font-size: 10px;
                margin-left: -10px;
                color: #ddd;
                border-width: 0;
                background: transparent;
            }
        }
        @media only screen and (min-width:501px) and (max-width:700px) {
            #search1-button {
                position: absolute;
                top: 0;
                right: 0;
                height: 48px;
                width: 60px;
                font-size: 10px;
                color: #fff;
                text-align: center;
                line-height: 42px;
                border-width: 0;
                background-color: #008EB0;
                -webkit-border-radius: 0px 5px 5px 0px;
                -moz-border-radius: 0px 5px 5px 0px;
                border-radius: 0px 5px 5px 0px;
                cursor: pointer;
            }
            #search1-text {
                font-size: 10px;
                margin-left: -10px;
                color: #ddd;
                border-width: 0;
                background: transparent;
            }
        }

        .slider .slides li .caption{
            color: #008EB0;
            margin-top: -80px;
            text-transform: uppercase;
        }

        .slider .slides{
            background-color: transparent;
        }

        .ven{
            padding: 0;
            width: 100%;
        }

        .centerma{
            text-align: center;
            position: relative;
            top: -200px;
            letter-spacing: 0.4em;
            color: #fff;
            text-transform: uppercase;
            font-weight: 600;
        }

        .ven:hover .centerma h3{
            -webkit-animation: flipInX 0.8s linear both;
            animation: flipInX 0.8s linear both;
            transform: rotateY(180deg);
        }

        .ven:hover{
            opacity:0.8;

        }
        /*.ven:hover .tuppo{*/
        /*display: inline-block;*/
        /*animation: ease-in;*/
        /*animation-delay: 10s;*/
        /*animation-direction: normal;*/
        /*}*/

        .tuppo{
            display: inline-block;
            border-bottom: 23px solid #fff;
            border-left: 30.5px solid transparent;
            border-right: 30.5px solid transparent;
            position: relative;
            color: white;
            left: 45%;
            top: -164px;
        }
        .row{
            margin-bottom: 0px;
        }


        .btn-floating.halfway-fab .but1{
            position: absolute;
            right: 40px;
            bottom: -20px;
        }

        .btn-floating.halfway-fab .but2{
            position: absolute;
            right: 30px;
            bottom: -20px;
        }

        /*added from home page*/



        @media only screen and (min-width: 700px) {
            .slide-grp
            {

                position:relative;
                z-index:9;
                top:60%!important;

            }

        }

        /*Search Box*/

        @media only screen and (min-width:501px) {
            #search1-box {
                position: relative;
                width: 50%;
                left: 25%;

            }
        }

        @media only screen and (max-width:500px){
            #search1-box {
                position: relative;
                width: 80%;
                left: 12%;
            }
        }

        #search1-form
        {
            height: 48px;
            border: 1px solid #999;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            background-color: #fff;
            overflow: hidden;
        }
        #search1-text
        {
            font-size: 14px;
            color: #ddd;
            border-width: 0;
            background: transparent;
        }
        #search1-box input[type="text"]
        {
            width: 90%;
            color: #333;
            outline: none;
        }
        #search1-button {
            position: absolute;
            top: 0;
            right: 0;
            height: 48px;
            width: 80px;
            font-size: 14px;
            color: #fff;
            text-align: center;
            line-height: 42px;
            border-width: 0;
            background-color:#008EB0;
            -webkit-border-radius: 0px 5px 5px 0px;
            -moz-border-radius: 0px 5px 5px 0px;
            border-radius: 0px 5px 5px 0px;
            cursor: pointer;
        }
        @media only screen and (min-width:269px) and (max-width:500px) {
            #search1-button {
                position: absolute;
                top: 0;
                right: 0;
                height: 48px;
                width: 52px;
                font-size: 10px;
                color: #fff;
                text-align: center;
                line-height: 42px;
                border-width: 0;
                background-color: #008EB0;
                -webkit-border-radius: 0px 5px 5px 0px;
                -moz-border-radius: 0px 5px 5px 0px;
                border-radius: 0px 5px 5px 0px;
                cursor: pointer;
            }
            #search1-text {
                font-size: 10px;
                margin-left: -10px;
                color: #ddd;
                border-width: 0;
                background: transparent;
            }
        }
        @media only screen and (min-width:501px) and (max-width:700px) {
            #search1-button {
                position: absolute;
                top: 0;
                right: 0;
                height: 48px;
                width: 60px;
                font-size: 10px;
                color: #fff;
                text-align: center;
                line-height: 42px;
                border-width: 0;
                background-color: #008EB0;
                -webkit-border-radius: 0px 5px 5px 0px;
                -moz-border-radius: 0px 5px 5px 0px;
                border-radius: 0px 5px 5px 0px;
                cursor: pointer;
            }
            #search1-text {
                font-size: 10px;
                margin-left: -10px;
                color: #ddd;
                border-width: 0;
                background: transparent;
            }
        }

        .slider .slides li .caption{
            color: #008EB0;
            margin-top: -80px;
            text-transform: uppercase;
        }


        #search1-text{
            border-radius: 0px!important;
            border:2px solid white!important;
        }

        #search1-text:hover{
            background: rgba(225,225,225,0.8);
        }

        .formContent:hover .searchBtn{
            background: tomato!important;
            padding:3px 40px;
            transition-timing-function:ease-in-out;
            transition: 0.6s;
        }

        .searchBtn{
            padding:3px 20px;
        }

        #search1-text::placeholder {
            font-weight: bolder;
            font-family: 'Merriweather', serif;
            color:gray;
        }

        #search1-text:-ms-input-placeholder { /* Internet Explorer 10-11 */
            font-weight: bolder;
            font-family: 'Merriweather', serif;
            color:#4B4B4B;
        }

        #search1-text::-ms-input-placeholder { /* Microsoft Edge */
            font-weight: bolder;
            font-family: 'Merriweather', serif;
            color:gray;
        }

        @media only screen and (min-width: 768px) {
            .slider .caption h3{
                font-size:140%;
                margin-top:15%;
            }


            #search1-text::placeholder {
                font-size:12px;
            }

            #search1-text:-ms-input-placeholder { /* Internet Explorer 10-11 */
                font-size:12px;
            }

            #search1-text::-ms-input-placeholder { /* Microsoft Edge */
                font-size:12px;
            }

            .slide-grp{
                top:48%!important;
            }


        }

        @media screen and (max-width: 992px){
            .mobileViewTableContent{
                display: none;
            }

        }


        @media (max-width: 767px) and (min-width: 600px) {
            .slider .caption h3{
                font-size:120%;
                margin-top:22%;
            }


            #search1-text::placeholder {
                font-size:10px;
            }

            #search1-text:-ms-input-placeholder { /* Internet Explorer 10-11 */
                font-size:10px;
            }

            #search1-text::-ms-input-placeholder { /* Microsoft Edge */
                font-size:10px;
            }

            .slide-grp{
                top:52%!important;
            }

            .tableBtn{
                padding:2px 8px;
                font-size: 15px;
                color: white;
            }


        }

        @media only screen and (max-width: 600px) {
            .slider .caption h3{
                font-size:100%;
                margin-top:32%;
            }


            #search1-text::placeholder {
                font-size:6px;
                padding: 0px;
            }

            #search1-text:-ms-input-placeholder { /* Internet Explorer 10-11 */
                font-size:6px;
                padding: 0px;
            }

            #search1-text::-ms-input-placeholder { /* Microsoft Edge */
                font-size:6px;
                padding: 0px;
            }

            .slide-grp{
                top:60%!important;
            }

        }

    .imageTable td, .imageTable th{
        padding: 0px;
    }

    .pot{
        font-size:15px ;
        padding: 10px;
    }

    @media only screen and (max-width:992px){
        .pot{
            border-bottom: 1px solid #4F4F4F;
        }
    }

    </style>
@endsection
@section('content')
    @include('layouts.navbar')
    <div style="martin-top:-20px;">
        <div class="parallax-container valign-wrapper ParallexContent" id="aboutus">
            <div class="container">
                <h2 class="titlepa" style="text-align: center;">Find Fellow Travelers
                </h2>

                <div class="slide-grp"  >
                    <div id='search1-box'>
                        <form action="{{route('search')}}" id='search1-form'>
                            <div class="formContent homesearchBox">
                                <input id='search1-text' name='q' placeholder="Search and Compare all of our trips"  style="color:black;" />
                                <button id='search1-button' class="searchBtn" type='submit' style="width:auto;height:auto;">
                                    <span>Search</span>
                                </button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="arrow"></div>
            <div class="parallax">
                <img class="responsive-img lazyload" data-src="{{url('images/trippartner_cover.jpg')}}" alt="Cover image">
            </div>
        </div>
    </div>
    @if(count($allTrips)>0)
    <div class="containerPadding" style="width: 90%;margin:auto;">
        <div class="row">
            <h1  class="titleHeadtwo"> <span>Available Trips for Partners</span> </h1>
        @foreach($allTrips as $trip)
                <div class="col l3 m6 s12">
                    <a href="/partner/destination/{{$trip->trip_id}}">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img data-src="{{url('/images/trips/thumbnail/'.$trip->trip->cover_image)}}" class="img-cap lazyload" alt=" {{ucwords($trip->trip->name)}}">
                                <div class="overlay">
                                <span class="card-title">
                                    <p  class="flow-text" style="font-size: 18px;">
                                        <table class="imageTable">
                                            <tr>
                                                <td>Fixed trips: </td>
                                                <td> &nbsp;&nbsp;{{$trip->totalTrips($trip->trip_id)}}</td>
                                            </tr>

                                            <tr>
                                                <td> Duration: </td>
                                                <td> &nbsp;&nbsp;{{$trip->trip->days}} days</td>
                                            </tr>

                                            <tr>
                                                <td> Max altitude: </td>
                                                <td> &nbsp;&nbsp;{{$trip->trip->altitude}}m</td>
                                            </tr>
                                        </table>
                                     </p>

                                </span>
                                </div>
                            </div>
                            <div class="card-container" style="padding: 10px;background: #4B4B4B;width: 100%;">

                                <span class="card-title activator" style="color: white;text-align: center;">
                                    {{ucwords($trip->trip->name)}}
                                </span>

                            </div>

                        </div>

                    </a>
                </div>
            @endforeach
        </div>
        <div class="ctc">
            <h2  class="titleHeadtwo"> <span>Partner Wanted Posts</span> </h2>
            <table class="striped highlight centered responsive-table" style="background-color: white;border:1px solid #e0e0e0;">
                <thead style="background-color: #4F4F4F;color: white;">
                <tr>
                    <th scope="col" class="pot">Traveller</th>
                    <th scope="col" class="pot">Nationality</th>
                    <th scope="col" class="pot">Trip Name</th>
                    <th scope="col" class="pot">Departure Date</th>
                    <th scope="col" class="pot">Price range</th>
                    <th scope="col" class="pot">Status</th>
                    <th scope="col" class="pot">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($departures as $post)
                    <tr>
                        <td data-label="Traveller" class="pot">
                            <?php
                            $photo = 'default.jpg';
                            if($post->user->photo != null){
                                $photo = $post->user->photo;
                            }
                            ?>
                            <a title="View Profile" href="/partner/profile/{{$post->user->id}}">
                                <img data-src="{{url('/images/profile/'.$photo)}}" class="circle imago mobileViewTableContent lazyload" alt="{{$post->user->name}}">
                                <p class="hide-on-med-and-down"> </p>
                                <span class="trippartnerTableContent">{{$post->user->name}}</span>
                            </a>
                        </td>
                        <td data-label="Nationality" class="pot">
                            <?php
                            if(!is_null($post->user->details) && $post->user->details->nationality != ''){
                                $country_code = $post->countryCode($post->user->details->nationality);
                            } else {
                                $country_code = null;
                            }
                            ?>
                            @if(isset($post->user->details) && ($post->user->details->nationality != null))
                                <img data-src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/{{strtolower($country_code)}}.svg" class="mobileViewTableContent lazyload" style="width: 30px;height: 30px;" alt="nationality flag image">
                                <p class="hide-on-med-and-down"> </p>
                                <span  class="trippartnerTableContent">{{$post->user->details->nationality}}</span>
                            @endif
                        </td>
                        <td data-label="Trip Name" class="pot">
                            <a href="/trip/{{$post->trip->slug}}">
                                <img data-src="{{url('/images/trips/thumbnail/'.$post->trip->cover_image)}}" class="imago1 mobileViewTableContent lazyload" alt="{{$post->trip->name}}">
                                <p class="hide-on-med-and-down"> </p>
                                <span  class="trippartnerTableContent">{{$post->trip->name}}</span>

                            </a>
                        </td>

                        <td data-label="Departure Date" class="pot">
                            <span class="trippartnerTableContent">
                                <?php
                                if(!is_null($post->tripdate_id)){
                                    if(!is_null($post->tripdate->start_date)){
                                        $startDate = $post->tripdate->start_date;
                                        echo date('M d, Y', strtotime($startDate));
                                    }

                                } else{
                                    if(!is_null($post->bookingDetail->start_date)) {
                                        $startDate = $post->bookingDetail->start_date;
                                        echo date('M d, Y', strtotime($startDate));
                                    }
                                }
                                ?>
                            </span>
                        </td>
                        <?php
                        if($post->book_id == 0){
                            $href = '/book/'.$post->tripdate_id;
                        } else {
                            $href = '/trip/book/'.$post->trip_id;
                        }
                        ?>

                        <td data-label="Price range" class="pot">
                            <?php
                            if($post->book_id == 0){
                                $price = $post->tripdate->price;
                            } else {
                                $price = $post->trip->price;
                            }
                            ?>
                            <span class="trippartnerTableContent">${{$price}}</span>
                        </td>

                        <td data-label="Status" class="pot">
                           <span class="trippartnerTableContent"> <a href="{{$href}}" class=" waves-effect waves-light tableBtn @if(($post->book_id == 0) && ($post->tripdate->remainingseats >= 10)) #008EB0 @elseif(($post->book_id == 0) && ($post->tripdate->remainingseats >= 5))
                                    #d5d50b @elseif(($post->book_id == 0) && ($post->tripdate->remainingseats > 0)) red @endif@endif"> Book&nbsp;Now</a> </span>
                        </td>

                        <td data-label="Action" class="pot">
                           <span class="trippartnerTableContent">  <a class=" waves-effect waves-light tableBtn" href="/partner/showDetail/{{$post->id}}">Reply</a> </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
        <div class="containerPadding">
            <h2  class="titleHeadtwo"> <span>Partner Wanted Posts</span> </h2>
            <p style="text-align: center;"> Currently there is no any post available related to partners. </p>
        </div>
    @endif
    <div style="margin-top:40px;"> </div>
    @include('layouts.footer1')
@endsection