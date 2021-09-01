@extends('layouts.master')

@section('title')
    <title> Find Travel Partner | Swotah Travel and Adventure</title>
@endsection

@section('metatags')
    <meta name="title" content="Find Travel Partner | Swotah Travel and Adventure">
    <meta name="description" content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection

@section('styles')
    <link rel="stylesheet" href="{{url('css/frontend/index.css')}}">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans"/>
    <style>
        /*for heading*/
        .stc{
            background-color:#ebebeb;
            margin-top: 80px;
        }
        h1{
            font-family:'Passion One', cursive;
            font-size:40px ;
            padding:10px ;
            margin-left:30px;
        }
        h2{
            font-size: 22px;
            text-align: Center;
            padding:17px;
        }
        th{
            font-family:'Dosis', sans-serif;
            font-size:17px ;
            padding: 0px 43px;
        }
        .pot{
            font-size:15px ;
            padding: 15px;
        }

        @media only screen and (max-width:992px){
            .pot{
                border-bottom: 1px solid #4F4F4F;
            }
        }

        .valign-wrapper{
            margin-top: 13px;
            height:35px;

        }
        .nepflag{
            width: 18px;
            margin-left:14px;
        }
        .imago{
            width: 40px;
            height: 40px;
            margin-left:-35px;
        }
        .tripdetail{
            height:auto;
            /*width: 331px;*/

        }
        .tripimage{
            height: 68px;
            width: 104px;
            padding: 5px;
        }

        .trippartnerSideTable tr td{
            padding:  5px 20px!important;
        }

        .tableBtn{
            padding:2px 10px;
            font-size: 14px;
            color: white;
            background:#00B1FF ;
        }
    </style>

@endsection
@section('content')
    @include('layouts.navbar2')
    <div class="containerPadding" >
        <h1  class="titleHeadtwo" style="margin-top: 60px;"> <span class="reviewTitle"> {{$trip->name}} </span> </h1>
        <div class="row">
            <div class="col l8 m7 s12">
                <div class="" style="padding: 0px 20px 20px;">
                    <div class="responsive-table">
                        <table class="striped highlight centered responsive-table" style="background-color: white;border:1px solid #e0e0e0;">
                            <thead style="background-color: #4F4F4F;color: white;">
                                <tr>
                                    <th class="pot">Name</th>
                                    <th class="pot">Departure Date</th>
                                    <th class="pot">Average Price</th>
                                    <th class="pot" style="padding:17px 10px">Comment</th>
                                </tr>
                            </thead>
                            <tbody>
    							<?php $count = 1; ?>
                                @foreach($allPosts as $post)
                                    <tr>
                                        <td class="pot">
                                            <div class="hide-on-med-and-down">
                                                    <?php
                                                    if(!is_null($post->user->details) && $post->user->details->nationality != ''){
                                                        $country_code = $post->countryCode($post->user->details->nationality);
                                                    } else {
                                                        $country_code = null;
                                                    }
                                                    ?>
                                                    <img data-src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/{{strtolower($country_code)}}.svg" alt="nationality flag image" class="nepflag lazyload">
                                                </div>
                                             <a title="View Profile" href="/partner/profile/{{$post->user->id}}">
                                                    <span class="black-text">{{ucwords($post->user->name)}}</span>
                                            </a>
                                        </td>
                         
                                       <?php
                                            if(!is_null($post->tripdate_id)){
                                            	$startDate = $post->tripdate->start_date;
                                            } else {
                                            	$startDate = $post->bookingDetail->start_date;
                                            }
                                        ?>
                                        <td class="pot">{{date('M d, Y', strtotime($startDate))}}</td>
                                        <?php
                                            if($post->book_id == 0){
                                            	$price = $post->tripdate->price;
                                            } else {
                                            	$price = $post->trip->price;
                                            }
                                        ?>
                                        <td class="pot">${{$price}}</td>
                                        <td class="pot">
                                            <a class="trippartnerTableContent waves-effect waves-light tableBtn" href="/partner/showDetail/{{$post->id}}">Comment</a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="col l4 m5 s12" style="padding: 0px 20px;position: sticky;top:40px;">
                <div class="card con " style="margin-top: -21px;">
                    <h2 style="background: black;color: white;font-size: 18px;padding: 5px;">TRIP DETAILS</h2>
                     <table class="bordered trippartnerSideTable">
                       
                        <tr>
                            <td class="s-fons">Days</td>
                            <td>{{$post->trip->days}} </td>
                        </tr>
                        <tr>
                            <td class="s-fons">Start Location</td>
                            <td>{{$post->trip->start_location}}</td>
                        </tr>
                        <tr>
                            <td class="s-fons">Finish Location</td>
                            <td>{{$post->trip->finish_location}}</td>
                        </tr>
                        <tr>
                            <?php
                            switch ($post->trip->physical_rating) {
                                case 1:
                                    $difficulty = 'easy';
                                    break;
                                case 2:
                                    $difficulty = 'moderate';
                                    break;
                                case 3:
                                    $difficulty = 'hard';
                                    break;
                                case 4:
                                    $difficulty = 'Severe';
                                    break;
                                case 5:
                                    $difficulty = 'Very Severe';
                                    break;
                                default:
                                    $difficulty = 'Extreme';
                            }
                            ?>
                            <td class="s-fons">Difficulty</td>
                            <td>{{ucwords($difficulty)}}</td>
                        </tr>
                        <tr>
                            <td class="s-fons">Min-age</td>
                            <td>{{$post->trip->ages}}</td>
                        </tr>
                        <tr>
                            <td class="s-fons">Max-Altitude</td>
                            <td>{{$post->trip->altitude}} m</td>
                        </tr>
                       
                    </table>

                    <div style="padding: 20px;text-align: center;">
                        <a href="/trip/{{$post->trip->slug}}" target="_blank" class="trippartnerTableContent waves-effect waves-light tableBtn">View Trip </a>
                    </div>
                </div>
               
            </div>          

        </div><br><br><br>
    </div>



    @include('layouts.footer1')


@endsection