@extends('layouts.master')
@section('title'){{$member->fullname}} | Swotah Travel and Adventure @endsection

@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="{{$member->fullname}} | Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
@section('styles')
    {{--End of meta tags--}}
    <style type="text/css">

        .package-list-head
        h3 {
            text-align: center;
            font-size: 15px;
        }

        .pkdetail-header {
            background: #111111;
        }

        .pk-details-title {
            padding-top: 10px !important;
        }


    </style>
@endsection
@section('content')
    @include('layouts.navbar')
    <section class="single-team-inner-page">
        <div class="container">
            <div class="section-title-black">
                <h2>Our Team Member</h2>
                <div class="title-bg">
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                </div>

            </div>
            <div class="single-team-content">
                <div class="single-team-flex">
                    <div class="single-team-image">
                        <img src="https://www.swotahtravel.com/images/teampics/thumbnail/{{$member->photo}}"
                             alt="{{$member->fullname}}">
                    <!-- <img  data-src="{{url('images/teampics/thumbnail/'.$member->photo)}}" alt="{{$member->fullname}}"> -->
                    </div>
                    <div class="single-team-details">
                        <h1>{{$member->fullname}}</h1><br>
                        <p><b>-{{$member->position}}</b></p>
                        @if($member->dob )
                            <?php $now = time();
                            $dob = strtotime($member->dob);
                            $age = round(($now - $dob) / (60 * 60 * 24 * 365));
                            ?>
                            <p class="age">Age : {{$age}} Years</p>
                        @endif
                        <p class="content ">{!! $member->memberdetails !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection