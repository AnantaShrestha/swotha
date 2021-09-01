@extends('layouts.master')

@section('title')
    <title>  Travel Partner Profile | Swotah Travel and Adventure</title>
@endsection

@section('metatags')
    <meta name="title" content=" Travel Partner Profile | Swotah Travel and Adventure">
    <meta name="description" content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection

@section('styles')
    <link rel="stylesheet" href="{{url('css/frontend/index.css')}}">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans"/>
    <style>
          .top-payment img {
    margin-top: -11px !important;
}
        .con-one{
            background-color:#ebebeb;
            margin-top: 94px;
            height:125px;
        }
           
        .p-img{
            margin-top:30px;
            margin-left:-7px;
            height:70px;
            width:70px;
        }
        h1 {
            font-size:16px;
        }
        h2{
            font-size:12px;
            margin-top: -20px;
            margin-left: 10px;
        }
        .p-fon{
            margin-top: 26px;
        }


        p{
            text-align: justify;
            overflow:hidden;
            display:-webkit-box;
            -webkit-line-clamp:10;
            -webkit-box-orient:vertical;
        }
        td{
            padding: 6px 5px;
        }
        .s-fons{
            font-family: "Courier New", Courier, monospace;
            color:grey;
        }
        .men{
            margin-left:-3px;
        }
        .p-msg{
            margin-top:525px;
        }
        @media only screen and (min-width:700px) {
            .p-img{
                margin-left:-14px;
                margin-top: 47px;
                height: 121px;
                width: 121px;
            }
            .men{
                margin-top: 21px;
                margin-left:50px;
            }
            h1 {
                font-size:20px;
            }
        }
        @media only screen and (min-width:985px){
            .p-img{
                margin-left:35px;
                margin-top: 47px;
                height: 121px;
                width: 121px;
            }
            .men{
                margin-top: 21px;
                margin-left:75px;
            }
            h1 {
                font-size:20px;
            }
        }


    </style>
@endsection

@section('content')
    @include('layouts.navbar2')

    <div class="containerPadding">
        <div class="paddedContainer">
            <div class="row"> <br> <br> <br>
                <h1  class="titleHeadtwo" style="margin-top:30px;"> <span class="reviewTitle" > {{$user->name}} </span> </h1>
                <div id="meetOurTeam">

                    <div class="card row">
                        <div class="col l4 m4 s12" style="padding: 20px;text-align: center;">
                           @if($user->photo)
                               <img data-src="{{url('/images/profile/'.$user->photo)}}" class="responsive-img lazyload"  style="width: 200px;height:200px;border-radius:200px;border:2px solid gray;" alt="{{$user->name}}">
                           @else 
                               <img data-src="{{url('/images/person.jpg')}}" style="width: 140px;height:140px;padding: 20px;" alt="{{$user->name}}" class="lazyload">
                           @endif
                            
                        </div>
                        <div class=" col l8 m8 s12">
                            <div class="card-content">
                               
                                <table class="bordered">
                                    @if($user->name != null)
                                        <tr>
                                            <td style="font-weight:bolder;">Name</td>
                                            <td>{{$user->name}}</td>
                                        </tr>
                                    @endif
                                    
                                    @if(isset($user->details))

                                        @if($user->details->address != null)
                                            <tr>
                                                <td style="font-weight:bolder;">Address</td>
                                                <td>{{$user->details->address}}</td>
                                            </tr>
                                        @endif
                                        @if($user->details->languages != null)
                                            <tr>
                                                <td style="font-weight:bolder;">Languages Known</td>
                                                <td>{{$user->details->languages}}</td>
                                            </tr>
                                        @endif
                                        @if($user->details->interests != null)
                                            <tr>
                                                <td style="font-weight:bolder;">Interests</td>
                                                <td>{{$user->details->interests}}</td>
                                            </tr>
                                        @endif
                                    @endif
                                    <tr>
                                        <td style="font-weight:bolder;">Joined</td>
                                        <td>{{date('Y-m-d', strtotime($user->created_at))}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bolder;">Stats</td>
                                        <td>{{$totalBookings}} trips booked</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bolder;">Bio</td>
                                        <td>
                                            @if(isset($user->details) && ($user->details->bio != null))
                                                {{$user->details->bio}}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            
                        </div>

                    </div>

                </div> <br><br><br>
            </div>
        </div>
    </div>


    @include('layouts.footer1')
@endsection