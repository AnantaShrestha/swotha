@extends('layouts.master')
@section('title')
    <title>Swotah Travel and Adventure | Trekking packages for Nepal,
        Trekking costs in nepal
    </title>
@endsection
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="Trip| Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans"/>
    <style>
        span .rectangle {
            position: absolute;
            top: 35px;
            left: -3px;
            z-index: 1;
            width: 100px;
            padding: 4px 10px;
        }

        #recomend {
            /*color:red;*/
        }

        .btn:hover {
            background-color: #1999b7;
        }

        .card-container {
            position: relative;
            flex-wrap: wrap;
            overflow: hidden;
            padding-top: 15px;
            padding-bottom: 15px;
            display: flex;
            justify-content: center;
        }

        .tripCard {
            /*min-width: px;*/
            width: 420px;
            position: relative;
            margin: 10px 10px;
            height: 350px;
            border-radius: 7px;
            background-size: cover;
            background: rgba(0, 0, 0, 0.7);
            box-shadow: 5px 5px 10px 1px rgba(0, 0, 0, 0.3);
            transition: 0.2s all linear;
            border: 1px solid rgba(128, 128, 128, 0.15);
            box-sizing: border-box;
        }


        /*@media only screen and (max-width: 1350px) {*/
        /*.tripCard{*/
        /*width: 420px;*/
        /*}*/

        /*}*/

        @media only screen and (max-width: 1335px) and (min-width: 1200px) {
            .tripCard {
                width: 374px;
            }

        }

        @media only screen and (max-width: 1200px) and (min-width: 977px) {
            .tripCard {
                width: 460px;
            }

        }


        @media only screen and (max-width: 896px)and (min-width: 816px) {
            .tripCard {
                width: 380px;
                /*height:338px;*/
            }

        }

        @media only screen and (max-width: 816px)and (min-width: 756px) {
            .tripCard {
                width: 350px;
                /*height: 334px;*/
            }

        }

        @media only screen and (max-width: 756px) {
            .tripCard {
                width: 600px;
            }

        }


        .tripCard .card-social {
            position: absolute;
            height: 55px;
            width: 100%;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
            top: 275px;
        }

        .tripCard .card-social ul {
            padding: 0;
            margin: auto -20px;;
            list-style: none;

            width: 100%;
            height: 100%;
            display: flex;
            justify-content: space-around;
        }

        .tripCard .card-social ul li {
            height: 100%;

            line-height: 75px;
            font-size: 1.5em;
            color: rgba(255, 255, 255, 0.85);
            text-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
        }

        .tripCard .card-social ul li:hover {
            text-shadow: 7px 7px 5px rgba(0, 0, 0, 0.7);
            transition: all 0.1s linear;
        }

        .tripCard .card-image {
            width: 100%;
            height: 275px;
            position: relative;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
        }

        .tripCard .card-info {
            position: relative;
            width: 100%;
            height: 35px;
            line-height: 35px;
            top: -265px;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            font-family: "Open Sans";
            color: rgba(255, 255, 255, 0.85);
        }

        .tripCard .card-info .tripCard-title {
            line-height: 20px;
            height: 45px;
            position: relative;
            top: 0px;
            text-align: center;
            /*font-size: 25px;*/
            font-size: medium;
            margin-top: -10px;

            background: rgba(0, 0, 0, 0.6);
            box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.3);
        }

        .tripCard .card-info .card-detail {
            height: 220px;
            background: rgba(0, 0, 0, 0.6);
            position: relative;
            top: 5px;
            padding: 5px 20px 0px 20px;
            opacity: 0;
            transform: scaleY(0);
            transform-origin: center top;
            box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.3);
        }

        .tripCard .card-info .card-detail p {
            line-height: 15px !important;
            font-size: 20px !important;
        }

        .tripCard:hover {
            box-shadow: 10px 10px 10px 1px rgba(0, 0, 0, 0.3);
        }

        .tripCard:hover .card-info .card-title {
            box-shadow: 10px 10px 10px 1px rgba(0, 0, 0, 0.3);
            transition: 0.3s all linear;
        }

        .tripCard:hover .card-info .card-detail {
            opacity: 1;
            box-shadow: 10px 10px 10px 1px rgba(0, 0, 0, 0.3);
            transition: 0.35s all linear;
            transition-delay: 0.1s;
            transform: scaleY(1);
        }

        .parallax-container {
            min-height: 420px;
            line-height: 0;
            height: auto;
            color: rgba(255, 255, 255, .9);
        }

        .red {
            color: red;
        }

    </style>
@endsection
@section('content')
    @include('layouts.navbar')
    <div class="valign-wrapper">
        <h3></h3>
    </div>
    <div class="row">
        <div class="card-container">
            @if(!empty($trips))
                @foreach($trips as $trip)
                    <a href="/{{$trip->slug}}">
                        <div class="tripCard">
                            <div class="card-image">
                                <img src="{{url('/images/trips/thumbnail/'.$trip->cover_image)}}" alt="" width="100%"
                                     height="100%">
                            </div>
                            <div class="card-info">
                                <div class="card-title">
                                    <div class="valign-wrapper" style="">
                                        <i class="small material-icons">place</i>
                                        {{$trip->name}}
                                    </div>
                                    <span>
                                    @if(!empty($trip->customtrip->recommended))
                                            @if($trip->customtrip->recommended == 1)
                                                <div class="rectangle center-align hbb" style="">
                                                <i class="shine"></i>
                                                <span id="recomend" style="font-size: 14px">Trending</span>
                                            </div>
                                            @endif
                                        @endif
                                </span>
                                </div>
                                <div class="card-detail">
                                    <p>
                                        Elevation: {{strtoupper($trip->altitude)}}
                                    </p>
                                    <p>
                                        Season:@if($trip->seasons != null)
                                            {{ucwords($trip->seasons)}}
                                        @endif
                                    </p>
                                    <p>
                                        Starts:{{$trip->start_location}}
                                    </p>
                                    <p>
                                        Finishes:{{$trip->finish_location}}
                                    </p>
                                    <p>
                                        Duration:{{$trip->days}} Days
                                    </p>
                                </div>
                            </div>
                            <div class="card-social">
                                <ul>
                                    <li>
                                        <a class="bucket sbutton tooltipped"
                                           data-position="" data-delay="10"
                                           data-tooltip="Total views:{{$trip->views->count}}">
                                            <i class="fa fa-eye" style="color: whitesmoke" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/{{$trip->slug}}#departures" class=" bucket sbutton tooltipped"
                                           data-position="" data-delay="10" data-tooltip="View Departure Dates"><i
                                                    class="fa fa-calendar" style="color: whitesmoke"
                                                    aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        @if(!Auth::user())
                                            <a href="/wish/{{$trip->id}}" class="bucket sbutton tooltipped"
                                               data-position=""
                                               data-delay="10" data-tooltip="Add to Bucket list">
                                                <i class="fa fa-heart" style="color: whitesmoke" aria-hidden="true"></i>
                                            </a>
                                        @else
                                            @if(!Auth::user())
                                                <a class="bucket white sbutton tooltipped"
                                                   id="{{$trip->id}}" data-id="{{$trip->id}}"
                                                   data-name="{{Auth::user()->is_active}}"
                                                   data-value="{{$trip->id}}" data-position=""
                                                   data-delay="10" data-tooltip="Remove from Bucket list">
                                                    <i class="fa fa-heart" style="color: #ff2330"
                                                       aria-hidden="true"></i>
                                                </a>
                                            @else
                                                @if(!empty($trip->wish) && $trip->wish->user_id == Auth::user()->id)
                                                    <a class="bucket rmv sbutton red btn-floating tooltipped"
                                                       id="{{$trip->id}}" data-id="{{$trip->id}}"
                                                       data-name="{{Auth::user()->is_active}}"
                                                       data-value="{{$trip->id}}"
                                                       data-position="bottom"
                                                       data-delay="10" data-tooltip="Remove from Bucket list">
                                                        <i class="fa fa-heart" style="color: whitesmoke"
                                                           aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    <a class="bucket btn-small wsh sbutton btn-floating tooltipped"
                                                       id="{{$trip->id}}"
                                                       data-id="{{$trip->id}}" data-name="{{Auth::user()->is_active}}"
                                                       data-value="{{$trip->id}}" data-position="bottom"
                                                       data-delay="10" data-tooltip="Add to Bucket list">
                                                        <i class="fa fa-heart" style="color: whitesmoke"
                                                           aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        @endif
                                    </li>
                                    <li>
                                        <a href="/book-trip/{{$trip->id}}"
                                           class="waves-effect waves-light btn tooltipped"
                                           style="text-shadow: none;"
                                           data-position="" data-delay="10" data-tooltip="Book Your Trip">
                                            Book Now
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <h3>NO RESULT FOUND</h3>
            @endif
        </div>
    </div>
@endsection
