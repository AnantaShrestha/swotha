@extends('layouts.master')
@section('title')
    {{$theme->theme_name}} | Swotah Travel and Adventure
@endsection
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="{{$theme->theme_name}} | Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
    <link rel="canonical" href="{{route('show-path',$theme->slug)}}">
@endsection
{{--End of meta tags--}}
{{--External css--}}
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

        .top-payment img {
            margin-top: -11px !important;
        }

        .compare-checkbox {

            opacity: 1;
            transition: 0.8s;
            display: inline-block;
        }

        /*.package-list-head h3 {

          display: block;
          text-align: center;
        }*/
    </style>
@endsection
{{--end of content--}}
{{--Start of content section--}}
@section('content')
    {{--Navbar--}}
    @include('layouts.navbar')
    <div class="Modern-Slider">
        <div class="inner-bg-img">

            <div class="inner-bg" style="  background:url('{{url('images/tripPackages/cover/'.$theme->image)}}');background-size:cover;background-repeat: no-repeat;">
                <div class="container">
                    <div class="inner-heading">
                        <h1>
                            {{$theme->theme_name}}
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
                        <p>{{$theme->description}} /p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="inner-package-list">
        <div class="container">
            <div class="row">
                @foreach($theme->trips as $trip)
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
    <section class="extra-service" style="background:#f2f2f2;padding:30px 0">
        <div class="container">
            <div class="section-title-black">
                <h2> Extra Service</h2>
                <div class="title-bg">
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                </div>
            </div>
            <div class="extra-block">
                <ul>
                    <div class="row" style="border:5px solid #fc0;padding:30px">
                        @foreach($theme->equipments as $equipment)
                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <li class="collection-item dismissable">
                                    <div>{{ucfirst($equipment->name)}}</div>
                                </li>
                            </div>
                        @endforeach
                    </div>
                </ul>
            </div>
        </div>
    </section>
   <!--  @include('layouts.reviewForm')
    @include('layouts.nayareview') -->
    <div id="modal20" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-body">
                    <a class="modal-action close btn center" type="button" data-dismiss="modal" style="width:100%;">Click
                        to select another trip </a>
                </div>

            </div>

        </div>
    </div>

    <div id="modal2" class="modal fade" role="dialog">
        <div class="modal-dialog">
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
@endsection
@section('scripts')
    <script src="{{asset('js/bucket.js')}}"></script>
    <script src="{{asset('js/compare.js')}}"></script>
@endsection
