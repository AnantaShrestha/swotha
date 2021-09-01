@extends('layouts.master')
@section('title','Compare Trips')
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('styles')
    <style type="text/css">
        .top-payment img {
            margin-top: -11px !important;
        }
    </style>
@endsection
@section('content')
    @include('layouts.navbar')
    <section class="inner-package-list">
        <div class="container">
            <div class="row">
                @if(count($trips) == 2)
                 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                    @for ($i = 0; $i < count($trips); $i++)
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 mb-30">
                            <div class="inner-package-list-single">
                                <div class='package-list-img'>
                                    <a href="/{{$trips[$i]->slug}}">
                                        <img title="view details" class="responsive-img tran_scale"
                                             src="{{url('images/trips/'.$trips[$i]->cover_image)}}" alt=""
                                        >

                                    </a>
                                    @if(!empty($trips[$i]->customtrip->recommended))
                                        @if($trips[$i]->customtrip->recommended == 1)
                                            <div class="ribbon">

                                                <span><i class="fa fa-fire"></i>&nbsp;Trending<b></b></span>
                                            </div>
                                        @endif
                                    @endif

                                </div>
                                <div class="package-list-detail">
                                    <div class="inner-package-description">
                                        <ul>
                                            <li class="flex-box"><strong>Trip Name</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i><span>{{$trips[$i]->name}}</span></li>
                                            <li class="flex-box"><strong>Price</strong><i class="fa fa-arrow-right flex"
                                                                                          aria-hidden="true"></i><span> USD {{$trips[$i]->price}}</span>
                                            </li>
                                            <li class="flex-box"><strong>Inclusions</strong><i
                                                        class="fa fa-arrow-right flex" aria-hidden="true"></i><span>@if($trips[$i]->customtrip->porter_cost != 0)
                                                        | Porter @endif
                                                    @if($trips[$i]->customtrip->guide_cost != 0) | Guide  @endif
                                                    @if($trips[$i]->customtrip->sherpa_cost != 0) | Sherpa  @endif
                                                    @if($trips[$i]->customtrip->assistant_cost != 0)| Assistant @endif
                                                    @if($trips[$i]->customtrip->meal_cost != 0)| Meals @endif</span>
                                            </li>
                                            <li class="flex-box"><strong>Elevation</strong><i
                                                        class="fa fa-arrow-right flex" aria-hidden="true"></i><span> {{$trips[$i]->altitude}}m</span>
                                            </li>
                                            <li class="flex-box"><strong>Duration</strong><i
                                                        class="fa fa-arrow-right flex" aria-hidden="true"></i><span>{{$trips[$i]->days}} days</span>
                                            </li>
                                            <li class="flex-box"><strong>Venture</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i><span>{{$trips[$i]->ventures}}</span>
                                            </li>
                                            <li class="flex-box"><strong>Region</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i><span>{{$trips[$i]->regions}}</span></li>
                                            <li class="flex-box"><strong>Country</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i><span>{{$trips[$i]->Country}}</span></li>
                                            <li class="flex-box"><strong>Difficulty</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i> @if($trips[$i]->physical_rating == 1)
                                                    <span>Easy</span>
                                                @elseif($trips[$i]->physical_rating == 2)
                                                    <span>Moderate</span>
                                                @elseif($trips[$i]->physical_rating  == 3)
                                                    <span>Hard</span>
                                                @elseif($trips[$i]->physical_rating  == 4)
                                                    <span>Very Hard</span>
                                                @elseif($trips[$i]->physical_rating  == 5)
                                                    <span>Severe</span>
                                                @elseif($trips[$i]->physical_rating  == 6)
                                                    <span>Very Severe</span>
                                                @else
                                                    <span>Extreme</span>
                                                @endif</li>
                                            <li class="flex-box"><strong>Special Discount</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i>@if($trips[$i]->special_discount == 0)
                                                    <span>No Discount</span>
                                                @else
                                                    <span>{{$trips[$i]->special_discount}}%</span>
                                                @endif</li>
                                            <li class="flex-box"><strong>Travel Style</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i> @if($trips[$i]->style == "Comfortable")

                                                    <span style="background: #008EB0;padding: 2px 5px;color: white;margin-right: -4px;">Comfortable/</span>

                                                @elseif($trips[$i]->style == "Luxury")

                                                    <span style="background: #008EB0;padding: 2px 5px;color: white;margin-right: -4px;">Luxury</span>
                                                @else
                                                    <span style="background: #008EB0;padding: 2px 5px;color: white;margin-right: -4px;">Budget</span>
                                                    <br>

                                                @endif</li>
                                            <li class="flex-box"><strong>popularity Level</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i><span><?php $popularityno = $trips[$i]->poplularity; ?>
                                                    @for($m=0; $m < $popularityno; $m++)
                                                        <i class="fa fa-star" aria-hidden="true"
                                                           style="color: #FF9517; font-size: 16px;"></i>
                                                    @endfor

                                                    <?php $no_popularityno = 9 - $popularityno; ?>
                                                    @for($m=0; $m < $no_popularityno; $m++)
                                                        <i class="far fa-star"
                                                           style="color: #111; font-size: 16px;"></i>
                                                    @endfor</span></li>
                                            <li class="flex-box"><strong>Group Size</strong><i
                                                        class="fa fa-arrow-right flex" aria-hidden="true"></i><span>Min-{{$trips[$i]->min_group_size}},
                                            Max-{{$trips[$i]->max_group_size}} </span></li>
                                            <li class="flex-box"><strong>Start Location</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i><span> {{$trips[$i]->start_location}} </span>
                                            </li>
                                            <li class="flex-box"><strong>End Location</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i><span> {{$trips[$i]->finish_location}} </span>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="list-icons">
                                        <ul>
                                            <a href="javascript:;" data-title="Total Views: {{$trips[$i]->views->count}}"><i
                                                        class="fa fa-eye"></i></a>
                                            <a href="/{{$trips[$i]->slug}}#fixed-departure" data-title="View Departure Date"><i
                                                        class="fa fa-calendar"></i></a>
                                            @if(!Auth::user())
                                                <a href="/wish/{{$trips[$i]->id}}" data-title="Add to Bucket List"><i
                                                            class="fa fa-heart"></i></a>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="read-more-btn">
                                        <a href="/book-trip/{{$trips[$i]->id}}">Book Now</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endfor
                     <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                @else
                    @for ($i = 0; $i < count($trips); $i++)
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 mb-30">
                            <div class="inner-package-list-single">
                                <div class='package-list-img'>
                                    <a href="/{{$trips[$i]->slug}}">
                                        <img title="view details" class="responsive-img tran_scale"
                                             src="{{url('images/trips/'.$trips[$i]->cover_image)}}" alt=""
                                             style=" width: 100%; border-radius:6px ; cursor: pointer">

                                    </a>
                                    @if(!empty($trips[$i]->customtrip->recommended))
                                        @if($trips[$i]->customtrip->recommended == 1)
                                            <div class="ribbon">

                                                <span><i class="fa fa-fire"></i>&nbsp;Trending<b></b></span>
                                            </div>
                                        @endif
                                    @endif

                                </div>
                                <div class="package-list-detail">

                                    <div class="inner-package-description">
                                        <ul>
                                            <li class="flex-box"><strong>Trip Name</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i><span>{{$trips[$i]->name}}</span></li>
                                            <li class="flex-box"><strong>Price</strong><i class="fa fa-arrow-right flex"
                                                                                          aria-hidden="true"></i><span> USD {{$trips[$i]->price}}</span>
                                            </li>
                                            <li class="flex-box"><strong>Inclusions</strong><i
                                                        class="fa fa-arrow-right flex" aria-hidden="true"></i><span>@if($trips[$i]->customtrip->porter_cost != 0)
                                                        | Porter @endif
                                                    @if($trips[$i]->customtrip->guide_cost != 0) | Guide  @endif
                                                    @if($trips[$i]->customtrip->sherpa_cost != 0) | Sherpa  @endif
                                                    @if($trips[$i]->customtrip->assistant_cost != 0)| Assistant @endif
                                                    @if($trips[$i]->customtrip->meal_cost != 0)| Meals @endif</span>
                                            </li>
                                            <li class="flex-box"><strong>Elevation</strong><i
                                                        class="fa fa-arrow-right flex" aria-hidden="true"></i><span> {{$trips[$i]->altitude}}m</span>
                                            </li>
                                            <li class="flex-box"><strong>Duration</strong><i
                                                        class="fa fa-arrow-right flex" aria-hidden="true"></i><span>{{$trips[$i]->days}} days</span>
                                            </li>
                                            <li class="flex-box"><strong>Venture</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i><span>{{$trips[$i]->ventures}}</span>
                                            </li>
                                            <li class="flex-box"><strong>Region</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i><span>{{$trips[$i]->regions}}</span></li>
                                            <li class="flex-box"><strong>Country</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i><span>{{$trips[$i]->Country}}</span></li>
                                            <li class="flex-box"><strong>Difficulty</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i> @if($trips[$i]->physical_rating == 1)
                                                    <span>Easy</span>
                                                @elseif($trips[$i]->physical_rating == 2)
                                                    <span>Moderate</span>
                                                @elseif($trips[$i]->physical_rating  == 3)
                                                    <span>Hard</span>
                                                @elseif($trips[$i]->physical_rating  == 4)
                                                    <span>Very Hard</span>
                                                @elseif($trips[$i]->physical_rating  == 5)
                                                    <span>Severe</span>
                                                @elseif($trips[$i]->physical_rating  == 6)
                                                    <span>Very Severe</span>
                                                @else
                                                    <span>Extreme</span>
                                                @endif</li>
                                            <li class="flex-box"><strong>Special Discount</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i>@if($trips[$i]->special_discount == 0)
                                                    <span>No Discount</span>
                                                @else
                                                    <span>{{$trips[$i]->special_discount}}%</span>
                                                @endif</li>
                                            <li class="flex-box"><strong>Travel Style</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i> @if($trips[$i]->style == "Comfortable")

                                                    <span style="background: #008EB0;padding: 2px 5px;color: white;margin-right: -4px;">Comfortable/</span>

                                                @elseif($trips[$i]->style == "Luxury")

                                                    <span style="background: #008EB0;padding: 2px 5px;color: white;margin-right: -4px;">Luxury</span>
                                                @else
                                                    <span style="background: #008EB0;padding: 2px 5px;color: white;margin-right: -4px;">Budget</span>
                                                    <br>

                                                @endif</li>
                                            <li class="flex-box"><strong>popularity Level</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i><span><?php $popularityno = $trips[$i]->poplularity; ?>
                                                    @for($m=0; $m < $popularityno; $m++)
                                                        <i class="fa fa-star" aria-hidden="true"
                                                           style="color: #FF9517; font-size: 16px;"></i>
                                                    @endfor

                                                    <?php $no_popularityno = 9 - $popularityno; ?>
                                                    @for($m=0; $m < $no_popularityno; $m++)
                                                        <i class="far fa-star"
                                                           style="color: #111; font-size: 16px;"></i>
                                                    @endfor</span></li>
                                            <li class="flex-box"><strong>Group Size</strong><i
                                                        class="fa fa-arrow-right flex" aria-hidden="true"></i><span>Min-{{$trips[$i]->min_group_size}},
                                            Max-{{$trips[$i]->max_group_size}} </span></li>
                                            <li class="flex-box"><strong>Start Location</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i><span> {{$trips[$i]->start_location}} </span>
                                            </li>
                                            <li class="flex-box"><strong>End Location</strong><i
                                                        class="fa fa-arrow-right flex"
                                                        aria-hidden="true"></i><span> {{$trips[$i]->finish_location}} </span>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="list-icons">
                                        <ul>
                                            <a href="javascript:;" data-title="Total Views: {{$trips[$i]->views->count}}"><i
                                                        class="fa fa-eye"></i></a>
                                            <a href="/{{$trips[$i]->slug}}#fixed-departure" data-title="View Departure Date"><i
                                                        class="fa fa-calendar"></i></a>
                                            @if(!Auth::user())
                                                <a href="/wish/{{$trips[$i]->id}}" data-title="Add to Bucket List"><i
                                                            class="fa fa-heart"></i></a>
                                            @else
                                                <a class="btn-small
                                                @if(!Auth::user())
                                                        wsh
                                                @else
                                                @if(!empty($trips[$i]->wish) && $trips[$i]->wish->user_id == Auth::user()->id)
                                                        rmv red

                                                @else
                                                        wsh
                                                    @endif
                                                @endif
                                                        "
                                                   data-position="top" id="{{$trips[$i]->id}}"
                                                   data-id="{{$trips[$i]->id}}"
                                                   data-name="id" data-value="{{$trips[$i]->id}}"
                                                   data-title="Add to Bucket List">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="read-more-btn">
                                        <a href="/book-trip/{{$trips[$i]->id}}">Book Now</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>
@endsection
