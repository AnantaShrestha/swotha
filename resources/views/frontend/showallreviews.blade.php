@extends('layouts.master')
@section('title','View Reviews | Swotah Travel and Adventure')
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="View Reviews | Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
@section('styles')
    <style type="text/css">
        .review-person-details p {
            font-size: 12px;
        }

        .review-person-details span i {
            font-size: 11px;
        }

        .review-text p {
            font-size: 12px !important;
        }
    </style>
@endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('content')
    @include('layouts.navbar')
    <div class="container">
        <div class="section-title-black pt-30 ">
            <h2>Swotah Total Reviews</h2>
            <div class="title-bg">
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
            </div>

        </div>
    </div>
    <section class="all-review pb-30">
        <div class="container">
            <div class="review-tab-panel mb-30">
                <ul class="flex-box review-tab-list">
                    <li class="review-tab-control active btn-arrow-right"><a href="#recentReview">Rercent Review</a>
                    </li>
                    <li class="review-tab-control btn-arrow-left"><a href="#topRating">Top Rating</a></li>


                </ul>
            </div>
            <div class="inner-review-tab-panel active" id="recentReview">
                <div class="row" style="margin-left:5px;margin-right:5px;">
                    @foreach($recentreviews as $recentreview)
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-20">
                            <div class="row ml-0 mr-0 all-review-bg">
                                <div class="col-lg-4 col-md-4 col-sm-12 ">
                                    <div class="review-image allreview-image">
                                        @if($recentreview->photo!=null)
                                            <img src="{{url('images/reviewer/'.$recentreview->photo)}}"
                                                 class="reviewImg responsive-img circle lazyload"
                                                 alt="{{$recentreview->name}}">
                                        @elseif($recentreview->user_id != null && ($recentreview->user->photo != null))
                                            <img src="{{url('images/profile/'.$recentreview->user->photo)}}"
                                                 class="reviewImg responsive-img circle lazyload"
                                                 alt="{{$recentreview->name}}">
                                        @else
                                            <img src="{{url('images/user.png')}}"
                                                 class="reviewImg responsive-img circle lazyload"
                                                 alt="{{$recentreview->name}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <div class="review-person-details review-person-bg">
                                        <div class="flex-box">
                                            <div class="">
                                                <p>Name :</p>
                                            </div>
                                            <div class="">
                                                <strong style="">{{$recentreview->name}}</strong>
                                            </div>
                                        </div>
                                        @if($recentreview->trip_id != null)
                                            <div class="flex-box">
                                                <div class="">
                                                    <p>Trips :</p>
                                                </div>
                                                <div class="">
                                                    <strong style="">{{$recentreview->trip->name}}</strong>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="flex-box">
                                            <div class="">
                                                <p>Nationality :</p>
                                            </div>
                                            <div class="">
                                                <img src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/{{strtolower($recentreview->country)}}.svg"
                                                     alt="{{$recentreview->country}}"
                                                     class="reviewNationFlag">
                                            </div>
                                        </div>
                                        <div class="flex-box">
                                            <div class="">
                                                <p>Rating :</p>
                                            </div>
                                            <div class="">
                                                @for($i=1;$i<=$recentreview->overall;$i++)
                                                    <span><i class="fa fa-star"></i></span>
                                                @endfor

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-12 pl-0 pr-0">
                                    <div class="review-text">
                                        <p style="padding-bottom:0px">
                                            <b style="font-size: 15px;">“</b>
                                            {{$recentreview->review}}
                                            <b style="font-size: 15px;">”</b>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 ">
                                    <div class="review-person-details">
                                        <div class="flex-box mt-10">
                                            <div class="review-c-de">
                                                <p>Staff :</p>
                                            </div>
                                            <div>
                                                @if($recentreview->staff != 0)
                                                    @for($i=1;$i<=$recentreview->staff;$i++)
                                                        <span><i class="fa fa-star"></i></span>
                                                    @endfor
                                                @endif

                                            </div>
                                        </div>
                                        <div class="flex-box mt-10">
                                            <div class="">
                                                <p>Trasportation :</p>
                                            </div>
                                            <div class="">
                                                @if($recentreview->transportation != 0)
                                                    @for($i=1;$i<=$recentreview->transportation;$i++)
                                                        <span><i class="fa fa-star"></i></span>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-box mt-10">
                                            <div class="">
                                                <p>Accomodation :</p>
                                            </div>
                                            <div class="">
                                                @if($recentreview->accomodation != 0)
                                                    @for($i=1;$i<=$recentreview->accomodation;$i++)
                                                        <span><i class="fa fa-star"></i></span>
                                                    @endfor
                                                @endif

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="review-person-details">
                                        <div class="flex-box mt-10">
                                            <div class="">
                                                <p>Meals :</p>
                                            </div>
                                            <div class="">
                                                @if($recentreview->meal != 0)
                                                    @for($i=1;$i<=$recentreview->meal;$i++)
                                                        <span><i class="fa fa-star"></i></span>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-box mt-10">
                                            <div class="">
                                                <p>Price Value :</p>
                                            </div>
                                            <div class="">
                                                @if($recentreview->meal != 0)
                                                    @for($i=1;$i<=$recentreview->meal;$i++)
                                                        <span><i class="fa fa-star"></i></span>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-box mt-10">
                                            <div class="">
                                                <p>Guide & Porter :</p>
                                            </div>
                                            <div class="">
                                                @if($recentreview->guide != 0)
                                                    @for($i=1;$i<=$recentreview->guide;$i++)
                                                        <span><i class="fa fa-star"></i></span>
                                                    @endfor
                                                @endif


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="reviewAllPagination">
                    {{$recentreviews->links()}}
                </div>
            </div>
            <div class="inner-review-tab-panel" id="topRating">
                <div class="row" style="margin-left:5px;margin-right:5px;">
                    @foreach($reviews as $review)
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="row ml-0 mr-0 all-review-bg">
                                <div class="col-lg-4 col-md-4 col-sm-12 ">
                                    <div class="review-image">
                                        @if($review->photo!=null)
                                            <img src="{{url('images/reviewer/'.$review->photo)}}"
                                                 class="reviewImg responsive-img circle lazyload"
                                                 alt="{{$review->name}}">
                                        @elseif($review->user_id != null && ($review->user->photo != null))
                                            <img src="{{url('images/profile/'.$review->user->photo)}}"
                                                 class="reviewImg responsive-img circle lazyload"
                                                 alt="{{$review->name}}">
                                        @else
                                            <img src="{{url('images/user.png')}}"
                                                 class="reviewImg responsive-img circle lazyload"
                                                 alt="{{$review->name}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="review-person-details review-person-bg">
                                        <div class="flex-box">
                                            <div class="">
                                                <p>Name :</p>
                                            </div>
                                            <div class="">
                                                <strong style="">{{$review->name}}</strong>
                                            </div>
                                        </div>
                                        @if($review->trip_id != null)
                                            <div class="flex-box">
                                                <div class="">
                                                    <p>Trips :</p>
                                                </div>
                                                <div class="">
                                                    <strong style="">{{$review->trip->name}}</strong>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="flex-box">
                                            <div class="">
                                                <p>Nationality :</p>
                                            </div>
                                            <div class="">
                                                <img src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/{{strtolower($review->country)}}.svg"
                                                     alt="{{$review->country}}"
                                                     class="reviewNationFlag">
                                            </div>
                                        </div>
                                        <div class="flex-box">
                                            <div class="">
                                                <p>Rating :</p>
                                            </div>
                                            <div class="">
                                                @for($i=1;$i<=$review->overall;$i++)
                                                    <span><i class="fa fa-star"></i></span>
                                                @endfor

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-12 pl-0 pr-0">
                                    <div class="review-text">
                                        <p style="padding-bottom:0px">
                                            <b style="font-size: 15px;">“</b>
                                            {{$review->review}}
                                            <b style="font-size: 15px;">”</b>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 ">
                                    <div class="review-person-details">
                                        <div class="flex-box">
                                            <div class="">
                                                <p>Staff :</p>
                                            </div>
                                            <div class="col-lg-5 pl-0 pr-0">
                                                @if($review->staff != 0)
                                                    @for($i=1;$i<=$review->staff;$i++)
                                                        <span><i class="fa fa-star"></i></span>
                                                    @endfor
                                                @endif

                                            </div>
                                        </div>
                                        <div class="flex-box">
                                            <div class="">
                                                <p>Trasportation :</p>
                                            </div>
                                            <div class="col-lg-5 pl-0 pr-0">
                                                @if($review->transportation != 0)
                                                    @for($i=1;$i<=$review->transportation;$i++)
                                                        <span><i class="fa fa-star"></i></span>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-box">
                                            <div class="">
                                                <p>Accomodation :</p>
                                            </div>
                                            <div class="col-lg-5 pl-0 pr-0">
                                                @if($review->accomodation != 0)
                                                    @for($i=1;$i<=$review->accomodation;$i++)
                                                        <span><i class="fa fa-star"></i></span>
                                                    @endfor
                                                @endif

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="review-person-details">
                                        <div class="flex-box">
                                            <div class="">
                                                <p>Meals :</p>
                                            </div>
                                            <div class="col-lg-5 pl-0 pr-0">
                                                @if($review->meal != 0)
                                                    @for($i=1;$i<=$review->meal;$i++)
                                                        <span><i class="fa fa-star"></i></span>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-box">
                                            <div class="">
                                                <p>Price Value :</p>
                                            </div>
                                            <div class="col-lg-5 pl-0 pr-0">
                                                @if($review->meal != 0)
                                                    @for($i=1;$i<=$review->meal;$i++)
                                                        <span><i class="fa fa-star"></i></span>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-box">
                                            <div class="">
                                                <p>Guide & Porter :</p>
                                            </div>
                                            <div class="col-lg-5 pl-0 pr-0">
                                                @if($review->guide != 0)
                                                    @for($i=1;$i<=$review->guide;$i++)
                                                        <span><i class="fa fa-star"></i></span>
                                                    @endfor
                                                @endif


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="reviewAllPagination">
                    {{$reviews->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection