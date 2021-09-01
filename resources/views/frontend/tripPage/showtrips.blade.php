@extends('layouts.master')
@section('title')
    @if(!empty($trip->seotrip)){{$trip->seotrip->meta_title}} @else  {{$trip->name}} @endif
@endsection
@section('innertop','inner-top')
@section('metatags')
    <meta name="title" content="@if(!empty($trip->seotrip)){{$trip->seotrip->meta_title}} @endif">
    <meta name="description" content="@if(!empty($trip->seotrip)){{$trip->seotrip->meta_description}} @endif">
    <meta name="keywords" content="@if(!empty($trip->seotrip)){{$trip->seotrip->keywords}} @endif">
    <link rel="canonical" href="{{route('show-path',$trip->slug)}}">
@endsection
@section('seocontents')
    <meta property="og:url" content="https://www.swotahtravel.com/{{$trip->slug}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="@if(!empty($trip->seotrip)){{$trip->seotrip->meta_title}} @endif"/>
    <meta property="og:description" content="@if(!empty($trip->seotrip)){{$trip->seotrip->meta_description}} @endif"/>
    <meta property="og:image" content="{{url('images/trips/cover/'.$trip->cover_image)}}"/>

    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="https://www.swotahtravel.com">
    <meta name="twitter:title" content="Swotah Travel and Adventure">
    <meta name="twitter:description" content="@if(!empty($trip->seotrip)){{$trip->seotrip->meta_description}} @endif">
    <meta name="twitter:image" content="{{url('images/trips/cover/'.$trip->cover_image)}}">
@endsection
@section('styles')
    <style type="text/css">

        .package-list-head h3 {
            text-align: center;
            font-size: 14px;
        }


        .pk-details-title {
            padding-top: 10px !important;
        }

        .love-block a {

            padding: 5px 7px;

        }

        .love-block a i {
            color: #fff;
            font-size: 15px;
        }

        .wsh {
            background: #fc0 !important;
        }

        .red {
            background-color: #F44336 !important;
        }

        .expanb-btn {
            float: right;
            position: relative;
            top: 7px;
            right: 5px;
        }

        .switch {
            display: inline-block;
            position: relative;
            width: 130px;
            height: 40px;
            border-radius: 20px;
            transition: background 0.28s cubic-bezier(0.4, 0, 0.2, 1);
            vertical-align: middle;
            cursor: pointer;
            font-size: 12px;
            line-height: 40px;
            padding-left: 30px;
            padding-right: 10px;
            color: #111;
            border: 1px solid #111;
        }

        .switch::before {
            content: '';
            position: absolute;
            top: 8px;
            left: 2px;
            width: 22px;
            height: 22px;
            background: #fc0;
            border-radius: 50%;
            transition: left 0.28s cubic-bezier(0.4, 0, 0.2, 1), background 0.28s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .switch:active::before {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.28), 0 0 0 20px rgba(128, 128, 128, 0.1);
        }

        input:checked + .switch {
            background: #fff;
            padding-left: 10px;
        }

        input:checked + .switch::before {
            left: 107px;
            background: #fc0;
        }

        input:checked + .switch:active::before {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.28), 0 0 0 20px rgba(0, 150, 136, 0.2);
        }

        .top-payment img {
            margin-top: -11px !important;
        }

    </style>
@endsection
@section('content')
    @include('layouts.navbar')
    <section id="package-trip-tap">
        <div class="container">
            <ul class="package-tabs flex-box">

                <li><a class="scroll__to" href="#tripfacts"><span><i class="fas fa-lightbulb"></i>&nbsp;&nbsp;<b>Trip Facts</b></span></a>
                </li>
                <li><a class="scroll__to" href="#gallery"><span><i
                                    class="fas fa-image"></i>&nbsp;&nbsp;<b>Gallery</b></span></a></li>
                <li><a class="scroll__to" href="#faq-itinerary"><span><i class="fas fa-map-signs"></i>&nbsp;&nbsp;<b>Itinerary / Faqs</b></span></a>
                </li>
                <li><a class="scroll__to fixed-departure" href="#fixed-departure"><span><i class="fas fa-plane-departure"></i>&nbsp;&nbsp;<b>Departure</b></span></a>
                </li>
                <li><a class="scroll__to" href="#review-form"><span><i class="fas fa-comments"></i>&nbsp;&nbsp;<b>Reviews</b></span></a>
                </li>
            </ul>
        </div>
    </section>

    <section id="overviewed" class="inner-package-content pt-15 pb-30">

        <div class="row ml-0 mr-0">
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="inner-pack-content">
                    <div class="inner-pack-image">
                        <img data-src="{{url('images/trips/cover/'.$trip->cover_image)}}"
                             src="https://www.swotahtravel.com/images/trips/cover/{{$trip->cover_image}}"
                             alt="{{$trip->name}}">
                    <!-- <img src="{{url('images/trips/cover/'.$trip->cover_image)}}"
                             data-src="{{url('images/trips/cover/'.$trip->cover_image)}}" alt="{{$trip->name}}"> -->
                        @if(!empty($trip->customtrip->recommended))
                            @if($trip->customtrip->recommended == 1)
                                <div class="ribbon">
                                    <span><i class="fa fa-fire"></i>&nbsp;Trending<b></b></span>
                                </div>
                            @endif
                        @endif

                        <div class="inner-package-action">
                            <ul class="flex-box">
                                @if(file_exists(storage_path('trippdf/'.$trip->slug.'.pdf')))
                                    <li> @if(!Auth::user())

                                            <a href="/login"
                                               data-title="Please Login to download this trip as pdf."
                                            >Download Itinerary
                                            </a>
                                        @elseif(Auth::user() && Auth::user()->is_active == 0)
                                            <a href="/profile/edit/resendprimary/{{Auth::user()->id}}"
                                               class=""
                                               data-title="Please verify your account to download this trip as pdf."
                                            >Download Itinerary
                                            </a>
                                        @else
                                            <a href='/trip-pdf/{{$trip->id}}'
                                               class=""
                                               data-title="Download Trip Details as PDF">
                                                Download Itinerary
                                            </a>
                                        @endif
                                    </li>
                                @endif
                                @if(!empty($trip->customtrip->showcustom))
                                    @if($trip->customtrip->showcustom == 1)
                                        <li><a @if(!Auth::user())  title="Please login to customize the trip"
                                               @endif href="/custom-trip/{{$trip->id}}">Price Customization</a></li>
                                    @endif
                                @endif
                                <li class="love-block">
                                    @if(!Auth::user())
                                        <a href="/wish/{{$trip->id}}"
                                           class="wsh"
                                           data-position="bottom" data-delay="10"
                                           data-title="Please Login to add your trip to Bucket List">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    @else
                                        @if(!Auth::user())
                                            <a class="red"
                                               id="{{$trip->id}}" data-id="{{$trip->id}}"
                                               data-name="{{Auth::user()->is_active}}"
                                               data-value="{{$trip->id}}" data-position="top" data-delay="10"
                                               data-title="Remove from Bucket list"><i
                                                        class="fa fa-heart"></i></a>
                                        @else
                                            @if(!empty($trip->wish) && $trip->wish->user_id == Auth::user()->id)
                                                <a class="red"
                                                   id="{{$trip->id}}" data-id="{{$trip->id}}"
                                                   data-name="{{Auth::user()->is_active}}"
                                                   data-value="{{$trip->id}}" data-position="top"
                                                   data-delay="10" data-title="Remove from Bucket list"><i
                                                            class="fa fa-heart"></i></a>
                                            @else
                                                <a class="wsh"
                                                   id="{{$trip->id}}"
                                                   data-id="{{$trip->id}}"
                                                   data-name="{{Auth::user()->is_active}}"
                                                   data-value="{{$trip->id}}" data-position="top"
                                                   data-delay="10" data-title="Add to Bucket list"><i
                                                            class="fa fa-heart"></i>
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                </li>

                            </ul>
                        </div>
                        <div class="inner-package-box">
                            <div class="inner-package-box-border">
                                <div class="package-star">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                </div>
                                <div class="inner-package-price mt-10">
                                    <p>Price Start From</p>
                                    <strong>@if(!empty($trip->priceDate())) $ {{$trip->priceDate()}} @else
                                            $ {{$trip->price}} @endif</strong>
                                </div>
                                <div class="btn-action-button">
                                    <a href="javascript:;" id="" class="btn-enquiry enquiryPop">Quick Enquiry</a>

                                    <a href="javascript:;" class="btn-enquiry bookNowPop">Book Now</a>
                                </div>
                                <div class="see-discount">
                                    @if(Auth::user() && Auth::user()->is_active == 1)
                                        @if(!empty($trip->customtrip->group_discount))
                                            <p><a href="#" class="seegroupdiscount">Click to see Group Discount</a>
                                            </p>
                                        @endif

                                    @else
                                        <p>
                                            @if(!Auth::user())
                                                <br> Please <a class="verify-login1" href="/login">login</a>
                                                your account to see Group Discount.
                                            @elseif(Auth::user()->is_active != 1)
                                                <br> Please <a class="verify-login1"
                                                               href="/profile/edit/resendprimary/{{Auth::user()->id}}"
                                                >verify</a>
                                                your account to see Group Discount.</p>
                                    @endif
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="inner-tab-panel">
                        <ul class="flex-box tab-list">
                            <li class="tab-control active"><a href="#inner-tab-1">Guide(s)</a></li>
                            <li class="tab-control"><a href="#inner-tab-2">Porter(s)</a></li>
                            <li class="tab-control"><a href="#inner-tab-3">Entrance Fees</a></li>
                            <li class="tab-control"><a href="#inner-tab-4">Meal(s)</a></li>
                            <li class="tab-control"><a href="#inner-tab-5">Transportation</a></li>
                            <li class="tab-control"><a href="#inner-tab-6">Accommodation</a></li>
                            <li class="tab-control"><a href="#inner-tab-7">City Tour(s)</a></li>

                        </ul>
                    </div>
                    <div class="inner-package-tab-panel active" id="inner-tab-1">
                        <p>@if($trip->customtrip->guide_cost > 0 ) Yes
                            (Included) @else No (Not Included) @endif</p>
                    </div>
                    <div class="inner-package-tab-panel" id="inner-tab-2">
                        <p>@if($trip->customtrip->porter_cost > 0 ) Yes
                            (Included) @else No (Not Included) @endif</p>
                    </div>
                    <div class="inner-package-tab-panel" id="inner-tab-3">
                        <p>@if($trip->customtrip->entrancefee == 1) Yes
                            (Included) @else No (Not Included) @endif</p>
                    </div>
                    <div class="inner-package-tab-panel" id="inner-tab-4">
                        <?php
                        $breakfast = 0;
                        $lunch = 0;
                        $dinner = 0;

                        foreach ($trip->itenary as $it) {
                            $meals = explode(',', $it->meals_included);
                            foreach ($meals as $meal) {
                                if (strtoupper($meal) == 'BREAKFAST') {
                                    $breakfast++;
                                } elseif (strtoupper($meal) == 'DINNER') {
                                    $dinner++;
                                } elseif (strtoupper($meal) == 'LUNCH') {
                                    $lunch++;
                                } else {
                                    continue;
                                }
                            }
                        }?>
                        @if($breakfast!=0)
                            <div class="row">
                                <div class="col s4">
                                    Breakfast: {{$breakfast}}
                                </div>

                                <div class="col s4">
                                    Lunch: {{$lunch}}
                                </div>

                                <div class="col s4">
                                    Dinner: {{$dinner}}
                                </div>
                            </div>
                        @else
                            <div class="row" style="text-align: center;">
                                No meals are available in inclusion
                            </div>
                        @endif
                    </div>
                    <div class="inner-package-tab-panel" id="inner-tab-5">
                        <div class="row">
                            @foreach(explode(",",$trip->transportation) as $transport)
                                <div class="col-3 col-sm-3 col-md-3">
                                    {{$transport}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="inner-package-tab-panel" id="inner-tab-6">
                        <?php
                        $hotel = 0;
                        $guesthouse = 0;
                        $teahouse = 0;
                        $lodge = 0;
                        $cottage = 0;
                        $camping = 0;
                        $homestay = 0;
                        foreach ($trip->itenary as $it) {
                            $acco = explode(',', $it->accomodation);
                            foreach ($acco as $a) {
                                if (strtolower($a) == 'hotel') {
                                    $hotel++;
                                }
                                if (strtolower($a) == 'guesthouse' or strtolower($a) == 'guest house') {
                                    $guesthouse++;
                                }
                                if (strtolower($a) == 'tea house' or strtolower($a) == 'teahouse') {
                                    $teahouse++;
                                }
                                if (strtolower($a) == 'lodge') {
                                    $lodge++;
                                }
                                if (strtolower($a) == 'cottage') {
                                    $cottage++;
                                }
                                if (strtolower($a) == 'camping') {
                                    $camping++;
                                }
                                if (strtolower($a) == 'homestay' or strtolower($a) == 'home stay') {
                                    $homestay++;
                                }
                            }
                        }
                        ?>
                        @if($hotel!=0 || $lodge!=0 || $teahouse!=0 || $cottage!=0 || $camping!=0 || $guesthouse!=0 || $homestay!=0)
                            <div class="row">
                                @if($hotel!=0)
                                    <div class="col s4">
                                        Hotel: {{$hotel}}&nbsp;Night(s)
                                    </div>
                                @endif

                                @if($lodge!=0)
                                    <div class="col s4">
                                        Lodge: {{$lodge}}&nbsp;Night(s)
                                    </div>
                                @endif

                                @if($teahouse!=0)
                                    <div class="col s4">
                                        Teahouse: {{$teahouse}}&nbsp;Night(s)
                                    </div>
                                @endif

                                @if($cottage!=0)
                                    <div class="col s4">
                                        Cottage: {{$cottage}}&nbsp;Night(s)
                                    </div>
                                @endif

                                @if($camping!=0)
                                    <div class="col s4">
                                        Camping(Tent): {{$camping}}&nbsp;Night(s)
                                    </div>
                                @endif

                                @if($guesthouse!=0)
                                    <div class="col s4">
                                        Guesthouse: {{$guesthouse}}&nbsp;Night(s)
                                    </div>
                                @endif
                                @if($homestay!=0)
                                    <div class="col s4">
                                        Home Stay: {{$homestay}}&nbsp;Night(s)
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="row" style="text-align: center;">
                                No accommodation are available in inclusion
                            </div>
                        @endif
                    </div>
                    <div class="inner-package-tab-panel" id="inner-tab-7">
                        <p>@if($trip->customtrip->citytour_cost !=0 or $trip->customtrip->citytour_cost != null)
                                Yes (Included)
                            @else
                                No (Not Included)
                            @endif</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
                <div class="inner-package-head-title mb-30">
                    <h3>{{$trip->name}}</h3>
                </div>
                <div class="package-category-description control-over">
                    <p class="moredescriptionscroll">{!! $trip->description !!}</p>
                </div>
                <div class="trip-details mt-20">
                    <div class="row ml-0 mr-0" style="border:1px solid #111">
                        <div class="bg-ddd col-lg-6 col-md-col-md-6"
                             style="border-right:1px solid #111;border-bottom:1px solid #111">
                            <div class="flex-box">
                                <div class="table-head">
                                    <h1>Trip Code</h1>
                                </div>
                                <div class="flex"></div>
                                <div class="table-content">
                                    <p>{{$trip->code}} </p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-ddd col-lg-6 col-md-col-md-6" style="border-bottom:1px solid #111">
                            <div class="flex-box">
                                <div class="table-head">
                                    <h1>Starts</h1>
                                </div>
                                <div class="flex"></div>
                                <div class="table-content">
                                    <p>{{$trip->start_location}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-fafafa col-lg-6 col-md-col-md-6"
                             style="border-right:1px solid #111;border-bottom:1px solid #111">
                            <div class="flex-box">
                                <div class="table-head">
                                    <h1>Finishes</h1>
                                </div>
                                <div class="flex"></div>
                                <div class="table-content">
                                    <p>{{$trip->finish_location}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-fafafa col-lg-6 col-md-col-md-6" style="border-bottom:1px solid #111">
                            <div class="flex-box">
                                <div class="table-head">
                                    <h1>Duration</h1>
                                </div>
                                <div class="flex"></div>
                                <div class="table-content">
                                    <p> {{$trip->days}} Days</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-ddd col-lg-6 col-md-col-md-6"
                             style="border-right:1px solid #111;border-bottom:1px solid #111">
                            <div class="flex-box">
                                <div class="table-head">
                                    <h1>Difficulty</h1>
                                </div>
                                <div class="flex"></div>
                                <div class="table-content">
                                    @if($trip->physical_rating == 1)
                                        <p>Easy</p>
                                    @elseif($trip->physical_rating == 2)
                                        <p>Moderate</p>
                                    @elseif($trip->physical_rating  == 3)
                                        <p>Hard</p>
                                    @elseif($trip->physical_rating  == 4)
                                        <p>Very Hard</p>
                                    @elseif($trip->physical_rating  == 5)
                                        <p>Severe</p>
                                    @elseif($trip->physical_rating  == 6)
                                        <p>Very Severe</p>
                                    @else
                                        <p>Extreme</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="bg-ddd col-lg-6 col-md-col-md-6" style="border-bottom:1px solid #111">
                            <div class="flex-box">
                                <div class="table-head">
                                    <h1>Group-Size</h1>
                                </div>
                                <div class="flex"></div>
                                <div class="table-content">
                                    <p>{{$trip->min_group_size}} - {{$trip->max_group_size}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-fafafa col-lg-6 col-md-col-md-6"
                             style="border-right:1px solid #111;border-bottom:1px solid #111">
                            <div class="flex-box">
                                <div class="table-head">
                                    <h1>Age</h1>
                                </div>
                                <div class="flex"></div>
                                <div class="table-content">
                                    <p> Minimum {{$trip->ages}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-fafafa col-lg-6 col-md-col-md-6" style="border-bottom:1px solid #111">
                            <div class="flex-box">
                                <div class="table-head">
                                    <h1>Seasons</h1>
                                </div>
                                <div class="flex"></div>
                                <div class="table-content">
                                    <p>{{$trip->seasons}}  </p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-ddd col-lg-6 col-md-col-md-6"
                             style="border-right:1px solid #111;border-bottom:1px solid #111">
                            <div class="flex-box">
                                <div class="table-head">
                                    <h1>Elevation</h1>
                                </div>
                                <div class="flex"></div>
                                <div class="table-content">
                                    <p>{{strtoupper($trip->altitude)}}
                                        m/ {{round(strtoupper($trip->altitude * 3.28084),1)}}ft </p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-ddd col-lg-6 col-md-col-md-6" style="border-bottom:1px solid #111">
                            <div class="flex-box">
                                <div class="table-head">
                                    <h1>Trip View</h1>
                                </div>
                                <div class="flex"></div>
                                <div class="table-content">
                                    <p> {{$trip->views->count}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-fafafa col-lg-6 col-md-col-md-6"
                             style="border-right:1px solid #111;border-bottom:1px solid #111">
                            <div class="flex-box">
                                <div class="table-head">
                                    <h1>Activities</h1>
                                </div>
                                <div class="flex"></div>
                                <div class="table-content">
                                    @foreach($trip->themes as $venture)
                                        <p>{{$venture->theme_name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="bg-fafafa col-lg-6 col-md-col-md-6" style="border-bottom:1px solid #111">
                            <div class="flex-box">
                                <div class="table-head">
                                    <h1>Travel Style</h1>
                                </div>
                                <div class="flex"></div>
                                <div class="table-content">
                                    <p>{{$trip->styles->name}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-ddd col-lg-12 col-md-col-md-12"
                             @if($trip->special_discount != 0) style="border-bottom:1px solid #111" @endif>
                            <div class="flex-box">
                                <div class="table-head">
                                    <h1>Trip popularity</h1>
                                </div>

                                <div class="flex"></div>
                                <div class="table-content">
                                    <?php $popularityno = $trip->poplularity; ?>
                                    @for($m=0; $m < $popularityno; $m++)
                                        <span class="full-color-star"><i class="fas fa-star"></i></span>
                                    @endfor

                                    <?php $no_popularityno = 9 - $popularityno; ?>
                                    @for($m=0; $m < $no_popularityno; $m++)
                                        <span class="full-color-star"><i class="far fa-star"></i></span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        @if($trip->special_discount != 0)
                            <div class="bg-fafafa col-lg-12 col-md-col-md-12">
                                <div class="flex-box">
                                    <div class="table-head">
                                        <h1 style="font-size:12px;color:Red">Special Discount</h1>
                                    </div>

                                    <div class="flex"></div>
                                    <div class="table-content">
                                        <span style="font-size:12px;color:Red;font-weight: bolder;line-height:26px">{{$trip->special_discount}} %</span>
                                    </div>
                                </div>
                            </div>

                        @endif

                    </div>

                </div>
            </div>

        </div>
    </section>

    <section id="tripfacts" class="pb-30 page-scroll">
        <div class="container">
            <div class="row ml-0 mr-0">
                <div class="col-lg-6 col-md-6 col-sm-12 pl-0">
                    <div class="trip-facts" id="scroll-style">
                        <div class="inner-package-head-title mb-30">
                            <h3>TRIP FACTS</h3>
                        </div>
                        <div class="facts-content">
                            <p>{!! $trip->trip_information !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                    <div class="trip-facts">
                        <div class="inner-package-head-title mb-30">
                            <h3>Why this Trip</h3>
                        </div>
                        <div class="facts-content">
                            <p>{{($trip->why_this_trip)}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-30 trip-notes ">
                    <h4>Trip Notes</h4>
                    <?php  $string = explode(":", $trip->trip_notes); ?>
                    <ul>
                        @foreach ($string as $str)
                            <li>{{$str}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="location-gallery page-scroll" id="gallery">
        <div class="container">
            <div class="row ml-0 mr-0">
                <div class="col-lg-6 col-md-6 col-sm-12 pl-0">
                    <div class="inner-package-head-title mb-20">
                        <h3>Location</h3>
                    </div>
                    <div class="location-image">
                        @if(count($trip->gallery) > 0)
                            <?php $count = 1; ?>
                            @foreach($trip->gallery as $gallery)
                                @if($gallery->map != 0)
                                    <img data-src="{{url('images/gallery/'.$gallery->image)}}"
                                         src="https://www.swotahtravel.com/images/gallery/{{$gallery->image}}"
                                         alt="{{$trip->name}} map">
                                <!-- <img src="{{url('images/gallery/'.$gallery->image)}}" data-src="{{url('images/gallery/'.$gallery->image)}}"
                                    alt="{{$trip->name}} map"> -->
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                    <div class="inner-package-head-title mb-20">
                        <h3>Gallery</h3>
                    </div>
                    <div id="gallery-slider" class="owl-carousel">
                        @if(count($trip->gallery) > 0)
                            @foreach($trip->gallery as $gallery)
                                @if($gallery->map == 0)
                                    <div class="gallery-item">
                                        <div class="single-gallery">
                                            <img src="https://www.swotahtravel.com/images/gallery/{{$gallery->image}}"
                                                 alt="gallery" id="galleryimg" alt="{{$trip->name}}">
                                        <!-- <img data-src="{{url('images/gallery/'.$gallery->image)}}" alt="gallery" id="galleryimg" alt="{{$trip->name}}"> -->
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-itinerary page-scroll" id="faq-itinerary">
        <div class="container">
            <div class="row ml-0 mr-0">
                <div class="col-lg-7 col-md-7 col-sm-12 pl-0 ">
                    <div class="inner-package-head-title mb-20">
                        <h3>
                            <b class="itenirary-head">Brief Itinerary</b>
                            <div class="expanb-btn">
                                <input type="checkbox" value="1" hidden="hidden" id="itenary">
                                <label class="switch" for="itenary" title="Expand All">Expand All</label>
                            </div>
                        </h3>

                    </div>

                    <div class="tabwrapper center-block itenary-over control-over">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            @foreach($trip->itenary as $it)
                                <?php $content = explode(':', $it->description)?>
                                <div class="itinerary panel panel-default">
                                    <div class="panel-heading active" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion"
                                               href="#collapse<?php echo($it->day); ?>" aria-expanded="true"
                                               aria-controls="collapseOne">
                                                DAY {{$it->day+1}}
                                                : {{strtoupper($content[0])}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse<?php echo($it->day); ?>" class="panel-collapse collapse in"
                                         role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">

                                        <span>
                                                {{str_replace($content[0].":", "", $it->description)}}
                                            <?php $meals = explode(',', $it->meals_included)?>
                                            <?php $highlights = explode(',', $it->included_activities)?>
                                            <?php $accomodation = explode(',', $it->accomodation)?>
                                                <br>
                                                <div class="row">
                                                    <div class="col l4 s12">
                                                            <h4 class="titleHeadFour">Meal:</h4>
                                                            <ul>
                                                                @if(!empty($meals) && count($meals))
                                                                    @foreach($meals as $meal)
                                                                        <li> {{$meal}}</li>
                                                                    @endforeach
                                                                @else
                                                                    No meals
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="col l4 s12">
                                                            <h4 class="titleHeadFour">Accommodation:</h4>
                                                            <ul>
                                                                @if(!empty($accomodation) && count($accomodation) > 0)
                                                                    @foreach($accomodation as $acc)
                                                                        <li> {{$acc}}</li>
                                                                    @endforeach
                                                                @else
                                                                    No accommodation
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="col l4 s12">
                                                            <h4 class="titleHeadFour">Activities:</h4>
                                                            <ul>
                                                                @if(!empty($highlights) && count($highlights) > 0)
                                                                    @foreach($highlights as $high)
                                                                        <li> {{$high}}</li>
                                                                    @endforeach
                                                                @else
                                                                    No Activities
                                                                @endif
                                                            </ul>
                                                        </div>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 pr-0">
                    <div class="inner-package-head-title mb-20">
                        <h3>FAQS</h3>
                    </div>
                    @if(count($trip->faq) > 0)
                        <div class="tabwrapper center-block itenary-over control-over">
                            @foreach($trip->faq as $faq)
                                <?php $a = explode('?', $faq->trip_faq)?>
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="faqs panel panel-default">
                                        <div class="panel-heading active" role="tab" id="faqsOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapse<?php echo($faq->id)?>" aria-expanded="true"
                                                   aria-controls="collapsefaqsOne">
                                                    {{$a[0].' ?'}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse<?php echo($faq->id)?>" class="panel-collapse collapse in"
                                             role="tabpanel" aria-labelledby="faqsOne">
                                            <div class="panel-body">
                                                {{$a[1]}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p> No FAQS</p>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </section>
    @if(count($trip->extraPackages))
        <section class="option_activities page-scroll" id="optional-activities">
            <div class="container">
                <div class="section-title-black">
                    <h2 class="">Optional Activities</h2>
                    <div class="title-bg">
                        <span class="line-bg"></span>
                        <span class="line-bg"></span>
                        <span class="line-bg"></span>
                        <span class="line-bg"></span>
                        <span class="line-bg"></span>
                    </div>
                </div>
                <div class="row">
                    @foreach($trip->extraPackages as $package)
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 mb-30">
                            <div class="inner-package-list-single">
                                <div class='package-list-img'>
                                    <img src="https://www.swotahtravel.com/images/trips/extraPackages/thumbnail/{{$package->image}}"
                                         alt="{{ucfirst($package->title)}} ">
                                <!-- <img data-src="{{url('images/trips/extraPackages/thumbnail/'.$package->image)}}"
                                                 alt="{{ucfirst($package->title)}} "> -->

                                </div>
                                <div class="package-list-detail">
                                    <div class="package-list-head">
                                        <h3><a href="#">{{ucfirst($package->title)}} </a>
                                            <span>
                                            @if(Auth::user() && (Auth::user()->is_active == 1))
                                                    <p> - USD $ {{$package->price}}</p>
                                                @endif
                                        </span>
                                        </h3>
                                    </div>
                                    @if(Auth::user() && (Auth::user()->is_active == 0))
                                        <div class="read-more-btn">

                                            Please <a class="verify-login"
                                                      href="/profile/edit/resendprimary/{{Auth::user()->id}}"
                                            >Verify</a>
                                            your account to see the price.
                                        </div>
                                    @elseif(!Auth::user())
                                        <div class="read-more-btn">
                                            Please <a class="verify-login" href="/login"
                                                      style="">Login</a>
                                            your account to see the price.
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if(count($trip->date) > 0)
        <section class="departure-table pt-30 pb-30" id="fixed-departure">
            <div class="container">
                <div class="section-title-black">
                    <h2 class="">Fixed Departures </h2>
                    <div class="title-bg">
                        <span class="line-bg"></span>
                        <span class="line-bg"></span>
                        <span class="line-bg"></span>
                        <span class="line-bg"></span>
                        <span class="line-bg"></span>
                    </div>
                </div>
                <div class="select-date">
                    <div class="row date-haru">
                        @foreach($tripdatess as $tripdate)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6 col-xs-6 mb-10 single-date-haru">
                                <div class="fixed-months">
                                    <a class="tripdate" data-id="{{$tripdate->new_date}}" data-tripid="{{$trip->id}}">
                                        {{substr($tripdate->month_one,0,3)}} {{$tripdate->year}}
                                        [Trips:{{$tripdate->data}}]
                                    </a>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="fixed-departure-table fixed-months-body">
                    @if(!empty($tripdatess))
                        @if(count($tripdatess) > 0)
                            <table id="fixeddep">
                                <thead>
                                <tr>
                                    <th>Departure Date</th>
                                    <th>Finish Date</th>
                                    <th>Seats Availability</th>
                                    {{--                                    @if(Auth::user())--}}
                                    <th>Price</th>
                                    {{--                                    @endif--}}
                                    <th>Reserve</th>
                                    <th>Book</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        @else
                            <h5 class="text-center">No any Fixed Departures Available !</h5>
                        @endif
                    @endif
                </div>
            </div>
        </section>
    @endif
    @include('layouts.reviewForm')
    @include('layouts.nayareview')
    @include('layouts.enquiry')
    @if(Auth::user() && Auth::user()->is_active == 1)
        @if(!empty($trip->customtrip->group_discount))
            <div id="discountModal" class="modal fade" role="dialog">
                <div class="modal-dialog  modal-dialog-centered" style="width:450px">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Group Discount</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <?php
                            $totalrange = explode(',', str_replace(' ', '', $trip->customtrip->group_discount));
                            $total = count($totalrange);
                            $price = null;
                            foreach ($totalrange as $item) {
                                $price = explode('=', $item);
                            }
                            $discount = $price[1];
                            $result = array();
                            foreach ($totalrange as $item) {
                                $price = explode('=', $item);
                                if ($price[1] != 0) {
                                    $result[$price[1]][] = $item;
                                }
                            }
                            ?>
                            <table class="centered group_discount">
                                <?php
                                foreach ($result as $res){
                                if(count($res) > 1){
                                ?>
                                <tr>
                                    <td class="groupSize"> Group Size:
                                        <?php
                                        $first = reset($res); $man = explode('=', $first);
                                        echo $man[0];

                                        ?>-<?php $last = end($res); $men = explode('=', $last);
                                        echo $men[0];
                                        ?>&nbsp;
                                    </td>
                                    <td class="dis-arrow">
                                        <i style="font-size:24px;color:#fc0" class="fa fa-arrow-right"
                                           aria-hidden="true"></i>
                                    </td>
                                    <td class="usdprice">USD $
                                        <?php
                                        $last = end($res);
                                        $percen = explode('=', str_replace('%', '', $last));
                                        $disprice = ($trip->price - (floor($percen[1] / 100 * $trip->price)));
                                        echo $disprice;
                                        ?>
                                        /person
                                    </td>
                                </tr>
                                <?php
                                }
                                }
                                ?>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        @endif
    @endif
@endsection
@section('scripts')
    <script src="{{asset('js/plugin/nicescroll.js')}}"></script>
    <script src="{{asset('js/plugin/showtrip.js')}}"></script>
@endsection