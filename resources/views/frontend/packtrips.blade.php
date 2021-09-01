@extends('layouts.master')
@section('title')
    {{$all->title}} | Swotah Travel and Adventure
@endsection
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="Trip| Swotah Travel and Adventure">
    <meta name="robots" content="noindex">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
    <link rel="canonical" href="{{route('show-path',$all->slug)}}">
@endsection
@section('styles')
    <style type="text/css">
        .wsh {
            background: #fc0;
        }

        .red {
            background-color: #F44336 !important;
        }

        .red i {
            color: #fff !important;
        }

        .Modern-Slider {
            margin-top:-150px !important;
        }
        .top-payment img {
            margin-top: -11px !important;
        }

    </style>
@endsection
@section('content')
    @include('layouts.navbar')
    <!-- <img class="responsive-img" src="{{url('images/tripPackages/cover/'.$all->image)}}"
         alt="{{$all->title}}"> -->
    <div class="Modern-Slider">
        <div class="inner-bg-img" style="  background:url('{{url('images/tripPackages/cover/'.$all->image)}}');background-size:cover;background-repeat: no-repeat;">
            <div class="inner-bg">
                <div class="container">
                    <div class="inner-heading">
                        <h1>
                            {{$all->title}}
                            <div class="title-bg">
                                <span class="line-bg"></span>
                                <span class="line-bg"></span>
                                <span class="line-bg"></span>
                                <span class="line-bg"></span>
                                <span class="line-bg"></span>
                            </div>
                        </h1>
                    </div>
                    <div class="cateogry_package_content">
                        <p>{{ $all->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="inner-package-list">
        <div class="container">
            <div class="row">
                @foreach($alltrips as $trip)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 mb-30">
                        <div class="inner-package-list-single">
                            <div class='package-list-img'>
                                <img src="https://www.swotahtravel.com/images/trips/thumbnail/{{$trip->cover_image}}"
                                     alt="{{$trip->name}}"
                                >
                            <!-- <img src="{{url('/images/trips/thumbnail/'.$trip->cover_image)}}" alt="{{$trip->name}}"
                                > -->
                                @if(!empty($trip->customtrip->recommended))
                                    @if($trip->customtrip->recommended == 1)
                                        <div class="ribbon">
                                            <span><i class="fa fa-fire"></i>&nbsp;Trending<b></b></span>
                                        </div>
                                    @endif
                                @endif
                                <div class="package-list-overlay">
                                    <p>Elevation : {{strtoupper($trip->altitude)}} </p>
                                    <p>Season : @if($trip->seasons != null)
                                            {{ucwords($trip->seasons)}}
                                        @endif</p>
                                    <p>Starts : {{$trip->start_location}} </p>
                                    <p>Finishes : {{$trip->finish_location}} </p>
                                    <p>Duration : {{$trip->days}} Days </p>
                                </div>
                            </div>
                            <div class="package-list-detail">
                                <div class="package-list-head">
                                    <h3><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<a
                                                href="{{route('show-path',['slug'=>$trip->slug])}}">{{$trip->name}}</a>
                                    </h3>
                                </div>
                                <div class="inner-package-description">
                                    <p>{!!str_limit($trip->description,70,'...')!!}</p>
                                </div>
                                <div class="list-icons">
                                    <ul>
                                        <a href="javascript:;" data-title="Total Views: {{$trip->views->count}}"><i
                                                    class="fa fa-eye"></i></a>
                                        <a href="/{{$trip->slug}}#fixed-departure" data-title="View Departure Date"><i
                                                    class="fa fa-calendar"></i></a>
                                        <!-- <a href="" data-title="Add to Bucket List"><i class="fa fa-heart"></i></a> -->
                                        @include('frontend.wishlist.addwishlist')
                                    </ul>
                                </div>
                                <div class="read-more-btn">
                                    <a href="/book-trip/{{$trip->id}}" data-title="Book Your Trip">Book Now</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{asset('js/bucket.js')}}"></script>
@endsection