@extends('layouts.master')
@section('title')
    <title>
        @if($title != null) 
            {{$title->content}} 
        @else
            Swotah Travel and Adventure 
        @endif
    </title>
@endsection

@section('metatags')
    <meta name="title" content="Swotah Travel and Adventure">
    <meta name="description" content="@if($description!=null) {{$description->content}} @endif">
    <meta name="keywords" content="@if($keywords!=null) {{$keywords->content}} @endif">
@endsection

@section('styles')
    <link rel="stylesheet" href="{{url('css/frontend/index.min.css')}}">
    
    <style>
        .card-info, .card__meta a {
            display: inline-flex;
            vertical-align: middle;
            line-height: 2;
            font-size: 1rem;
        }
        .card__meta i.small {
            font-size: 1.5rem;
        }
        .card .card-content .card-title {
            line-height: 34px;
        }
        .card .card-content {
            padding: 0px;
            /*height: 262px;*/
        }
        .card__content{
            margin-top: -15%;
            height: 100%;
            width: 100%
        }
        .tname{
            padding: 0px 0px;
            margin-left: -15px;
            font-weight: bold;
            font-size: 20px;
        }

        .card .card-action{
            background-color:lightgrey;
            border: none;
        }


        .sbutton{
            top: -65px;
            right: -20px;
        }

        .card__content:hover .packname{
            -webkit-animation: flipInX 0.8s linear both;
            animation: flipInX 1.4s linear both;
            transform: rotateX(180deg);
            text-shadow:#333 1px 1px 2px;
        }

        .card__content:hover .card .card-content{
            background-color: red;
        }
        .packname{
            text-align: center;
            padding: 1px 25px;
            text-transform: uppercase;
            color: #fff;
            left: 0%;
            font-size: 60px;
            position: relative;
            bottom: -220px;
        }


        p {
            line-height: 2rem;
            font-size: 22px;
        }

        h3{
            text-transform: uppercase;
        }
        .img-tero{
            height: 78px; border-radius: 15%;
            border-bottom-right-radius:unset;
            border-top-left-radius: unset;
        }
        .titlepa {
            background-color: black;
            opacity: 0.7;
            display: inline-block;
            text-align: center;
            position: relative;
            border-radius: 68px;
            padding: 0 10px;
            font-size: 2.15rem;
        }


        @media only screen and (max-width:520px ) {
            .titlepa{
                font-size: 1.40rem;
            }
            .container-fluid{
                margin-top: 2%;
            }

            p {
                line-height: 2rem;
                font-size: 16px;
            }
        }
        .merocon{
            margin-top:12%
        }

        .slider::-webkit-input-placeholder {
            color: blue;
            font-weight: bolder!important;
        }

        /*.slider{*/
            /*height: 600px!important;*/
        /*}*/


        .slider .caption h3{
            clear: both;
            font-family: 'Merriweather', serif;
            text-transform: none;
            padding:8px;
        }

        .slider .caption h3 span{
            background:rgba(0,0,0,0.6);
            color:white;
            padding:4px 8px;
            line-height:35px;
            font-weight: bolder
        }

        .slider ul{
            z-index: 100!important;
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
            }

            .sliderCaption{
                position: absolute;
                top:62%!important;
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
                top:68%!important;
            }
        }

        @media (max-width: 767px) and (min-width: 600px) {
            .slider .caption h3{
                font-size:120%;
            }

            .sliderCaption{
                position: absolute;
                top:58%!important;
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
                top:66%!important;
            }
        }

        @media only screen and (max-width: 600px) {

            .slider .caption h3{
                font-size:100%;
            }

            .sliderCaption{
                position: absolute;
                top:56%!important;
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
                top:66%!important;
            }
        }


    </style>

@endsection
@section('content')
    {{--Navbar--}}
    @include('layouts.navbar')
    @if($video == null)
        <div >
            <div class="slider" >
                <div class="slide-grp"  >
                    <div id='search1-box'>
                        <form action="{{route('search')}}" id='search1-form'>
                            <div class="formContent homesearchBox">
                                <input id='search1-text' name='q' placeholder='@if($searchbar!=null) {{$searchbar->content}} @endif' type='text' onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = '@if($searchbar!=null) {{$searchbar->content}} @endif'" />
                                <button id='search1-button' class="searchBtn" type='submit' style="width:auto;height:auto;">
                                    <span>Search</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <ul class="slides" >
                    @foreach($coverImages as $image)
                        <li >
                            <img class="responsive-img lazyload" data-src="{{url('/images/coverImage/'.$image->image)}}" alt="Swotah Travel" title="Swotah travel" style="position: relative;"> 
                            <div class="caption center-align sliderCaption" >
                                <h3>
                                    <span style="text-transform: uppercase;">
                                        {{$image->title}} 
                                    </span>  
                                </h3>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        
        {{--End of slider--}}
    @else
        <video class="responsive-video" autoplay loop>
            <source src="{{url('images/coverImage/'.$video->image)}}" type="video/mp4">
        </video>
    @endif

    {{--<div class="parallax-container valign-wrapper ParallexContent" id="aboutus">--}}
        {{--<div class="container" style="margin-top:85px;">--}}

            {{--<h2 class="travelGreedingHead">--}}
                {{--<span style="text-align: justify;"> {{$parallaxes[0]->title}} </span>--}}
            {{--</h2>--}}

            {{--<div class="travelGreeding" style="font-weight: bolder;text-align: center;">--}}
                {{--{{$parallaxes[0]->description}}--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="arrow"></div>--}}
        {{--<div class="parallax">--}}
            {{--<img data-src="{{url('images/coverImage/'.$parallaxes[0]->image)}}" alt="Swotah Travel and Adventure" title="Swotah travel" class="lazyload">--}}
        {{--</div>--}}
    {{--</div>--}}
    @include('frontend.indexlayout.trippackages')
    {{--<div class="parallax-container valign-wrapper ParallexContent" id="aboutus">--}}
        {{--<div class="container" style="margin-top:85px;">--}}

            {{--<h2 class="travelGreedingHead">--}}
                {{--<span style="text-align: center;"> {{$parallaxes[1]->title}} </span>--}}
            {{--</h2>--}}

            {{--<div class="travelGreeding" style="font-weight: bolder;text-align: center;">--}}
                {{--{{$parallaxes[1]->description}}--}}
            {{--</div>--}}

        {{--</div>--}}

        {{--<div class="arrow"></div>--}}
        {{--<div class="parallax">--}}
            {{--<img data-src="{{url('images/coverImage/'.$parallaxes[1]->image)}}" alt="Swotah Travel and Adventure" title="Swotah travel" class="lazyload">--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="container-fluid">
        @include('frontend.indexlayout.new1slider')
    </div>
    {{--@include('frontend.indexlayout.populardest')--}}
    <div class="parallax-container valign-wrapper ParallexContent" id="aboutus">
        <div class="container" style="margin-top:85px;">
            <h2 class="travelGreedingHead">
                <span style="text-align: center;"> {{$parallaxes[3]->title}} </span>
            </h2>

            <div class="travelGreeding" style="text-align: center;">
                {{$parallaxes[3]->description}}
            </div>

        </div>
        <div class="arrow"></div>
        <div class="parallax">
            <img data-src="{{url('images/coverImage/'.$parallaxes[3]->image)}}" alt="Swotah Travel and Adventure"  class="lazyload">
        </div>

    </div>
    @include('frontend.indexlayout.lastminute')
    <div style="clear: both;"></div>
    @include('frontend.indexlayout.blogs')
    @include('layouts.reviewForm')

    <!--<div class="container">
        {{--@include('layouts.reviewForm')--}}
    </div> -->
    @include('layouts.nayareview')
    @include('frontend.indexlayout.recentviewed')
    @include('layouts.footer1')
@endsection


