@extends('layouts.master')
@section('title'){{$about->aboutname}} | Swotah Travel and Adventure @endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="Team members | Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
{{--End of meta tags--}}
@section('styles')
    <style type="text/css">
        .package-list-head,
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
    <section class="inner-page-heading-title pt-60">
        <div class="container">
            <div class="section-title-black">
                <h2>{{$team->aboutname}} </h2>
                <div class="title-bg">
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                </div>
            </div>
        </div>
    </section>
    <section class="our-team pb-60">
        <div class="container">
            <p>
                {!! $team->content !!}

            </p>
        </div>
    </section>
    <section class="team-list pb-30">
        <div class="container">
            <div class="row">
                @foreach($departments as $department)
                    @foreach($department->members as $mem)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 pl-0 mb-30">
                            <div class="sigle-team">
                                <div class="team-image">
                                    <img class="te-img"
                                         src="https://www.swotahtravel.com/images/teampics/thumbnail/{{$mem->photo}}"
                                         alt="{{$mem->fullname}}">
                                <!-- <img class="te-img"
                         data-src="{{url('images/teampics/thumbnail/'.$mem->photo)}}"
                         alt="{{$mem->fullname}}"> -->
                                    <div class="team-overlay">
                                        <h3>{{$mem->fullname}}</h3>
                                        @if($mem->dob )
                                            <?php $now = time();
                                            $dob = strtotime($mem->dob);
                                            $age = round(($now - $dob) / (60 * 60 * 24 * 365));
                                            ?>
                                            <P>Age: {{$age}} years</P>
                                        @endif
                                        <a href="/our-team/member-{{$mem->id}}" class="team-read-more">Read More</a>
                                    </div>
                                </div>
                                <div class="team-personal-details">
                                    <h3>{{$mem->fullname}}</h3>
                                    <p>- {{$mem->position}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
@endsection