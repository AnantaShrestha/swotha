@extends('layouts.master')
@section('title')
    <title>Swotah Travel and Adventure | Trekking packages for Nepal,
        Trekking costs in nepal
    </title>
@endsection
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="description" content="Swotah Travel and Adventure is an Adventure Company in Kathmandu, Nepal.If Nepal's on top of your bucket list,
         let us help you inspire, plan and prepare better!">
    <meta property="og:description" content="Swotah Travel and Adventure is an Adventure Company in Kathmandu, Nepal.If Nepal's on top of your bucket list,
         let us help you inspire, plan and prepare better!">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, nepal trekking packages,
    trekking guide in nepal,short treks in nepal,nepal trekking companies,trekking in nepal costs, trekking in nepal himalaya
    trekking in nepal best time of year, trekking in himalaya, bucket list,Nepal travel, Adventure, Mountains, Tours">
@endsection
{{--End of meta tags--}}
{{--External css--}}
@section('styles')
    {{--<link rel="stylesheet" href="{{url('css/frontend/index.css')}}">--}}
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans"/>
@endsection
{{--end of content--}}
{{--Start of content section--}}
@section('content')
    <?php
        /*$response = json_decode(file_get_contents('https://api.fixer.io/latest?base=USD'));
        dd($response->rates->AUD);*/
    ?>
    {{--Navbar--}}
    @include('layouts.navbar')
    {{--Navbar End--}}
    {{--Index page image and video--}}
    @if($video == null)
        <div class="slider">
            <div class="slide-grp">
                <!--     <Search form> -->
                <div id='search1-box'>
                    <form action="{{route('search')}}" id='search1-form'>
                        <input id='search1-text' name='q' placeholder='' type='text'/>
                        <button id='search1-button' type='submit'>
                            <span>Search</span>

                        </button>
                    </form>
                </div>
                <!--     </form> -->
            </div>
            <ul class="slides">
                @foreach($coverimageone as $image)
                    <li>
                        <img class="responsive-img" src="{{url('/images/coverImage/'.$image->image)}}"> <!-- random image -->
                        <?php
                        $class1 = "right-align"; $class2 ="center-align"; $class3="left-align";
	                    $ran = array($class1, $class2, $class3);
                        $class = array_random($ran);
                        ?>

                        <div class="caption @if(!empty($ran)){{$class}} @endif">
                            <h3 style="clear: both; display: inline-block; color: black; font-weight: 600;
                             padding:8px; font-family: 'Dosis', sans-serif;">{{$image->title}}</h3>
                            <br>
                        </div>
                    </li>
                @endforeach
            </ul>

            {{--{!! $image->description !!}--}}
        </div>
        {{--End of slider--}}
    @else
        <video class="responsive-video" autoplay loop>
            <source src="{{url('images/coverImage/'.$video->image)}}" type="video/mp4">
        </video>
    @endif

    <div class="container" style="text-align: center;background-color:#e1e9f0;">
        <h1 class="s-fon">POPULAR DESTINATION</h1>
    </div>
    <p class="center-align s-fon2"> Some of the most beautiful and popular trips.</p>
    <div class="row" id="items">
        @foreach($featuredTrips as $ft)
            <div class="col l4 m6 s12">
                <a href="/trip/{{$ft->slug}}">
                    <div class="card indexproducts z-depth-5 waves-effect waves-block waves-light">
                        <div class="card-image indexprodimage">
                                    <span>
                                     <div style="position: absolute;">
                                     @if(!empty($ft->customtrip->recommended))
                                             @if($ft->customtrip->recommended == 1)
                                                 <div class="rectangle center-align">
                                                         <i class="shine"></i>
                                                         <span id="recomend">Trending</span>
                                                     </div>
                                             @endif
                                         @endif
                                     </div>
                                    </span>
                            <img src="images/trips/thumbnail/{{$ft->cover_image}}" style=" border-bottom:red;"
                                 alt="{{$ft->name}}">
                            <span class="card-title hbb imc" style="padding:5px;">{{$ft->name}}</span>
                            @if(!Auth::user())
                                <a href="/wish/{{$ft->id}}"
                                   class="btn-small btn-floating halfway-fab waves-effect waves-light  push tooltipped hbb"
                                   data-position="bottom" data-delay="10" data-tooltip="Add to Bucket list" >
                                    <i class="material-icons">favorite</i>
                                </a>
                            @else
                                @if(!Auth::user())
                                    <a class="btn-small wsh btn-floating  halfway-fab waves-effect waves-light push tooltipped hbb"
                                       id="{{$ft->id}}" data-id="{{$ft->id}}" data-name="{{Auth::user()->is_active}}"
                                       data-value="{{$ft->id}}" data-position="bottom"
                                       data-delay="10" data-tooltip="Remove from Bucket list" > <i
                                                class="material-icons">favorite</i></a>
                                @else
                                    @if(!empty($ft->wish) && $ft->wish->user_id == Auth::user()->id)
                                        <a class="btn-small rmv red btn-floating  halfway-fab waves-effect waves-light push tooltipped hbb"
                                           id="{{$ft->id}}" data-id="{{$ft->id}}"
                                           data-name="{{Auth::user()->is_active}}" data-value="{{$ft->id}}"
                                           data-position="bottom"
                                           data-delay="10" data-tooltip="Remove from Bucket list"> <i
                                                    class="material-icons">favorite</i></a>
                                    @else
                                        <a class="btn-small wsh  btn-floating  halfway-fab waves-effect waves-light push tooltipped hbb"
                                           id="{{$ft->id}}"
                                           data-id="{{$ft->id}}" data-name="{{Auth::user()->is_active}}"
                                           data-value="{{$ft->id}}" data-position="bottom"
                                           data-delay="10" data-tooltip="Add to Bucket list"><i class="material-icons">favorite</i>
                                        </a>
                                    @endif
                                @endif
                            @endif
                            <a href="/trip/{{$ft->slug}}#departures"
                               class="btn-small  btn-floating  halfway-fab waves-effect waves-light tooltipped hbb"
                               data-position="bottom" data-delay="10" data-tooltip="View Departure Dates"><i
                                        class="material-icons">date_range</i>
                            </a>
                            <a id="one"
                               class="btn-small  btn-floating  halfway-fab waves-effect waves-light pusheye tooltipped hbb"
                               data-position="bottom" data-delay="10" data-tooltip="Total views:{{count($ft->views)}}">
                                <img src="{{url('images/eyes.png')}}" alt="views">
                            </a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="parallax-container" style="position: relative; height:500px;">
        <div class="parallax"><img src="{{url('images/coverImage/'.((isset($parallax[1]))?$parallax[1]:'para1.jpg'))}}" alt="swotah"></div>
    </div>
    <div class="container" style="text-align: center;background-color:#e1e9f0;">
        <h1 class="s-fon">HIDDEN GEMS</h1>
    </div>
    <p class="center-align s-fon2">Beautiful yet overlooked destinations</p>
    <div class="row" id="items">
        @foreach($latestOffers as $lo)
            <div class="col l4 m6 s12">
                <a href="/trip/{{$lo->slug}}">
                    <div class="card indexproducts z-depth-5 waves-effect waves-block waves-light">
                        <div class="card-image indexprodimage">
                                <span>
                                    <div style="position: absolute;">
                                     @if(!empty($lo->customtrip->recommended))
                                            @if($lo->customtrip->recommended == 1)
                                                <div class="rectangle center-align">
                                                         <i class="shine"></i>
                                                         <span id="recomend">Trending</span>
                                                     </div>
                                            @endif
                                        @endif
                                    </div>
                                </span>
                            <img src="images/trips/thumbnail/{{$lo->cover_image}}" alt="{{$lo->name}}">
                            <span class="card-title hbb imc" style="padding:5px">{{$lo->name}}</span>
                            @if(!Auth::user())
                                <a href="/wish/{{$lo->id}}"
                                   class="btn-small btn-floating halfway-fab waves-effect waves-light   push tooltipped hbb"
                                   data-position="bottom" data-delay="10" data-tooltip="Add to Bucket list">
                                    <i class="material-icons">favorite</i>
                                </a>
                            @else
                                @if(!Auth::user())
                                    <a class="btn-small wsh btn-floating  halfway-fab waves-effect waves-light push tooltipped hbb"
                                       id="{{$lo->id}}" data-id="{{$lo->id}}" data-name="{{Auth::user()->is_active}}"
                                       data-value="{{$lo->id}}" data-position="bottom"
                                       data-delay="10" data-tooltip="Remove from Bucket list"> <i
                                                class="material-icons">favorite</i></a>
                                @else
                                    @if(!empty($lo->wish) && $lo->wish->user_id == Auth::user()->id)
                                        <a class="btn-small rmv red btn-floating  halfway-fab waves-effect waves-light push tooltipped "
                                           id="{{$lo->id}}" data-id="{{$lo->id}}"
                                           data-name="{{Auth::user()->is_active}}" data-value="{{$lo->id}}"
                                           data-position="bottom"
                                           data-delay="10" data-tooltip="Remove from Bucket list"> <i
                                                    class="material-icons">favorite</i></a>
                                    @else
                                        <a class="btn-small wsh  btn-floating  halfway-fab waves-effect waves-light push tooltipped hbb"
                                           id="{{$lo->id}}"
                                           data-id="{{$lo->id}}" data-name="{{Auth::user()->is_active}}"
                                           data-value="{{$lo->id}}" data-position="bottom"
                                           data-delay="10" data-tooltip="Add to Bucket list"><i class="material-icons">favorite</i>
                                        </a>
                                    @endif
                                @endif
                            @endif

                            <a href="/trip/{{$lo->slug}}#departures"
                               class="btn-small btn-floating  halfway-fab waves-effect waves-light  tooltipped hbb"
                               data-position="bottom" data-delay="10" data-tooltip="View Departure Dates"><i
                                        class="material-icons">date_range</i>
                            </a>

                            <a id="one"
                               class="btn-small  btn-floating  halfway-fab waves-effect waves-light pusheye tooltipped hbb"
                               data-position="bottom" data-delay="10" data-tooltip="Total views:{{count($lo->views)}}">
                                <img src="{{url('images/eyes.png')}}" alt="views">
                            </a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    {{--End of Hidden Gems--}}
    {{--Beyond the borders--}}
    {{-- <div class="container">
         <div class="title-wrapper1">
                 <span class="title teal">
                     <strong class="flow-text" style="color: white;"><b>BEYOND THE BORDER</b></strong>
                     <!--Padding is optional-->
                 </span>
         </div>--}}
    <div class="parallax-container" style="position: relative; height:500px">
        <div class="parallax"><img src="{{url('images/coverImage/'.((isset($parallax[2]))?$parallax[2]:'para2.png'))}}" alt="swotah"></div>
    </div>
    <div class="container" style="text-align: center;background-color:#e1e9f0;">
        <h1 class="s-fon">BEYOND THE BORDERS</h1>
    </div>
    <p class="center-align s-fon2">Exotic Destinations Outside Nepal</p>
    </div>
    <div class="row" id="items">
        @foreach($beyondBorders as $lo)
            <div class="col l4 m6 s12">
                <a href="/trip/{{$lo->slug}}">
                    <div class="card indexproducts z-depth-5 waves-effect waves-block waves-light">
                        <div class="card-image indexprodimage">
                                <span>
                                    <div style="position: absolute;">
                                     @if(!empty($lo->customtrip->recommended))
                                            @if($lo->customtrip->recommended == 1)
                                                <div class="rectangle center-align">
                                                         <i class="shine"></i>
                                                         <span id="recomend">Trending</span>
                                                     </div>
                                            @endif
                                        @endif
                                    </div>
                                    </span>
                            <img src="images/trips/thumbnail/{{$lo->cover_image}}" alt="{{$lo->name}}">
                            <span class="card-title hbb imc" style="padding:5px">{{$lo->name}}</span>
                            @if(!Auth::user())
                                <a href="/wish/{{$lo->id}}"
                                   class="btn-small btn-floating halfway-fab waves-effect waves-light   push tooltipped hbb"
                                   data-position="bottom" data-delay="10" data-tooltip="Add to Bucket list">
                                    <i class="material-icons">favorite</i>
                                </a>
                            @else
                                @if(!Auth::user())
                                    <a class="btn-small wsh btn-floating  halfway-fab waves-effect waves-light push tooltipped hbb"
                                       id="{{$lo->onetrip->id}}" data-id="{{$lo->id}}" data-name="{{Auth::user()->is_active}}"
                                       data-value="{{$lo->id}}" data-position="bottom"
                                       data-delay="10" data-tooltip="Remove from Bucket list"{{--style="background-color:#17B3DE"--}}> <i
                                                class="material-icons">favorite</i></a>
                                @else
                                    @if(!empty($lo->wish) && $lo->wish->user_id == Auth::user()->id)
                                        <a class="btn-small rmv red btn-floating  halfway-fab waves-effect waves-light push tooltipped hbb"
                                           id="{{$lo->id}}" data-id="{{$lo->id}}"
                                           data-name="{{Auth::user()->is_active}}" data-value="{{$lo->id}}"
                                           data-position="bottom"
                                           data-delay="10" data-tooltip="Remove from Bucket list"> <i
                                                    class="material-icons">favorite</i></a>
                                    @else
                                        <a class="btn-small wsh  btn-floating  halfway-fab waves-effect waves-light push tooltipped hbb"
                                           id="{{$lo->id}}"
                                           data-id="{{$lo->id}}" data-name="{{Auth::user()->is_active}}"
                                           data-value="{{$lo->id}}" data-position="bottom"
                                           data-delay="10" data-tooltip="Add to Bucket list"><i class="material-icons">favorite</i>
                                        </a>
                                    @endif
                                @endif
                            @endif

                            <a href="/trip/{{$lo->slug}}#departures"
                               class="btn-small  btn-floating  halfway-fab waves-effect waves-light  tooltipped hbb"
                               data-position="bottom" data-delay="10" data-tooltip="View Departure Dates"><i
                                        class="material-icons">date_range</i>
                            </a>
                            <a id="one"
                               class="btn-small  btn-floating  halfway-fab waves-effect waves-light pusheye tooltipped hbb"
                               data-position="bottom" data-delay="10" data-tooltip="Total views:{{count($lo->views)}}">
                                <img src="{{url('images/eyes.png')}}" alt="views">
                            </a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    {{--end of beyound the borders--}}
    <div class="parallax-container" style="position: relative; height:500px;">
        <div class="parallax"><img src="{{url('images/coverImage/'.((isset($parallax[3]))?$parallax[3]:'para3.jpg'))}}" alt="swotah"></div>
    </div>
    {{--Start of  Last minute deal--}}
    {{-- <div class="container">
         <div class="title-wrapper1">
                 <span class="title teal">
                     <strong class="flow-text" style="color: white;"><b>LAST MINUTE DEALS</b></strong>
                     <!--Padding is optional-->
                 </span>
         </div>--}}
    <div class="container" style="text-align: center;background-color:#e1e9f0;">

        <h1 class="s-fon">LAST MINUTE DEALS</h1>

    </div>
    <p class="center-align s-fon2" >The trips with earliest departure dates and with discounts</p>

    </div>
    <table class="highlight centered bordered responsive-table">
        <thead style="border-bottom: 1px solid teal;">
        <tr>
            <th>Trip Name</th>
            <th class="hide-on-med-and-down"></th>
            <th>Seats Availability</th>
            <th>Departure Date</th>
            <th>
                Price
                <select name="currency" id="currencyChange">
                    <option value="AUD">AUD</option>
                    <option value="BGN">BGN</option>
                    <option value="BRL">BRL</option>
                    <option value="CAD">CAD</option>
                    <option value="CNY">CNY</option>
                    <option value="CHF">CHF</option>
                    <option value="CZK">CZK</option>
                    <option value="DKK">DKK</option>
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                    <option value="HRK">HRK</option>
                    <option value="HKD">HKD</option>
                    <option value="HUF">HUF</option>
                    <option value="IDR">IDR</option>
                    <option value="ILS">ILS</option>
                    <option value="INR">INR</option>
                    <option value="ISK">ISK</option>
                    <option value="JPY">JPY</option>
                    <option value="KRW">KRW</option>
                    <option value="MXN">MXN</option>
                    <option value="MYR">MYR</option>
                    <option value="NOK">NOK</option>
                    <option value="NZD">NZD</option>
                    <option value="PHP">PHP</option>
                    <option value="PLN">PLN</option>
                    <option value="RON">RON</option>
                    <option value="RUB">RUB</option>
                    <option value="SEK">SEK</option>
                    <option value="SGD">SGD</option>
                    <option value="THB">THB</option>
                    <option value="TRY">TRY</option>
                    <option value="ZAR">ZAR</option>
                </select>
                <div class="loadingStatus hide">
                    <img src="{{url('/images/currency.gif')}}" alt="Loading"> Just a moment...
                </div>
            </th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($lastDeal))
            @foreach($lastDeal as  $deal)
                <tr>
                    <td style="text-align:left;"><a class="waves-effect waves-light  "
                                                    style="color: white;background-color:#008EB0;padding: 10px;text-align: justify;left: 25px;"
                                                    href="/trip/{{$deal->trips->slug}}"> <b> {{$deal->trips->name}}</b> </a></td>
                    <td class="hide-on-med-and-down">
                        <div class="">
                            <div class="card-image">
                                <a href="/trip/{{$deal->trips->slug}}">
                                    <img src="{{url('images/trips/thumbnail/'.$deal->trips->cover_image)}}"
                                         style="height: 78px;" alt="{{$deal->trips->name}}">
                                </a>
                            </div>
                        </div>
                    </td>
                    <td><span class="tooltipped" style="padding:10px; color:white;
                                background-color: @if($deal->remainingseats >= 10) #008EB0 @elseif($deal->remainingseats >= 5)
                                #d5d50b @else red @endif" data-tooltip="@if($deal->remainingseats >= 10)
                                There are good number of seats available. Be one of the first ones to book the trip for this date!
                                @elseif($deal->remainingseats >= 5)
                                Only limited seats are available for this departure date. Please make sure to book or hold as soon as possible!
                                @else The number of seats for this trip is almost full or may not be available. Please leave an enquiry for more details!
                               @endif" data-position="top"> Available </span></td>
                    <td style="font-weight: bold;font-size: 17px;color:black;">
                        {{$deal->start_date}}
                    </td>
                    <td><span class="oldPrice">
                            <strike style="margin-left:25px">$ <span class="originalPrice">{{$deal->trips->price}}</span></strike>
                            <span class="oldConverted" style="color:green;"></span>
                        </span>
                        <br/>
                        <span style="color:#D8343D;font-size:20px; font-weight: 600;" class="newPrice">
                            <i class="fa fa-fire" aria-hidden="true"></i> $ <span class="price">{{round($deal->price - (($deal->discount/100)*$deal->price))}}</span>
                            <span class="newConverted" style="color:green"></span>
                        </span>
                    </td>
                    @if(strtotime($deal->start_date) > strtotime('-1 month ago'))
                        <td>
							<?php
							if(Auth::user()){
								$seats = \App\HoldDates::where([
									['user_id', '=', Auth::user()->id],
									['is_confirmed', '=', 1],
								])->get();
								$singleTotal = 0;
								$allTotal = 0;
								$temp = 0;
								foreach($seats as $seat){
									if($deal->id == $seat->trip_id){
										if(strtotime($seat->trips->start_date) == strtotime($deal->start_date)){
											$singleTotal += $seat->seats;
										}
									}

									$allTotal += $seat->seats;
								}
							}
							?>
                            @if($deal->remainingseats > 0)
                                @if((Auth::user()))
                                    <a class="waves-effect waves-light btn modal-trigger tooltipped" href="#hold{{$deal->id}}"
                                       data-tooltip="Please note that if seats are available, you can hold up to 7 seats of any
                                    particular trip, and 14 seats in total, at a given period of time.">Hold</a>
                                @else
                                    <div class="center-align" style="margin-bottom: 15px;margin-top: 15px;">
                                        <a class="waves-effect waves-light btn hbb " href="/login" style="line-height: 40px" title="Login to Hold">Hold</a>
                                    </div>
                                @endif
                            @endif
                            {{--this is change--}}
                            <div id="hold{{$deal->id}}" class="modal" style="border: 4px solid #17B3DE;width:22%;overflow: visible;">
                                <div class="modal-content" >
                                    <form action = "/hold/{{$deal->id}}" method="post" id="form">
                                        {{csrf_field()}}
                                        <p style="color:green">Please note that if seats are available, you can hold up to 7 seats of any particular trip, and 14 seats in total, at a given period of time.</p>
                                        <input type="hidden" name = 'deal_id' value="{{$deal->id}}">
                                        <div class="input-field row" style="background-color:
                                    white;border-radius: 5px; height: 46px;">
                                            <select name="seats" id="seats">
                                                <option selected disabled="disabled">Select No. Of Seats to hold</option>
												<?php
												if($deal->remainingseats > 7){
													$seats = 7;
												} else {
													$seats = $deal->remainingseats;
												}
												?>
                                                @for($i=1; $i<=7; $i++)
                                                    <option value="{{$i}}"
                                                    @if(Auth::user() && (((($singleTotal+$i) > 7))|| ((($allTotal+$i)) > 14) || ($i > $deal->remainingseats)))
                                                        {{'disabled'}}
                                                            @endif
                                                    >{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="row center-align">
                                            <button type="submit"
                                                    class="waves-effect waves-light btn" name="submit"
                                                    @if(Auth::user() && (($allTotal+1) > 14 || ($singleTotal+1) > 7)))
                                                    {{'disabled'}}
                                                    @endif
                                            >
                                                Continue</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </td>
                    @else
                        <td></td>
                    @endif
                    @if($deal->remainingseats)
                        <td><a href="/book/{{$deal->id}}" class="waves-effect waves-light btn hbb">Book</a></td>
                    @else
                        <td><a href="#enq-btn" class="waves-effect waves-light btn hbb">Enquire</a></td>
                    @endif
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <section id="reviews" class="scrollspy">
        {{--@include('layouts.review')--}}
        @include('layouts.indexEnquiry')
    </section>
    {{--End of Last minute deals--}}
    {{--<div class="clear"></div>--}}
    <div class="parallax-container" style="position: relative; height:500px">
        <div class="parallax"><img src="{{url('images/coverImage/'.((isset($parallax[4]))?$parallax[4]:'para6.jpg'))}}"></div>
    </div>
    {{--Start of of  Blogs--}}
    @if(!empty($allblogs))
        <div class="container" style="text-align: center;background-color:#e1e9f0;">
            <h1 class="s-fon">BLOGS</h1>
        </div>
        <div class="row" id="items">
            @foreach($allblogs as $blog)
                <div class="col l4 m6 s12">
                    <a href="/blogs/show/{{$blog->slug}}">
                        <div class="card indexproducts z-depth-5 waves-effect waves-block waves-light">
                            <div class="card-image indexprodimage">
                                <img src="{{url('images/blogs/thumbnail/'.$blog->cover_image)}}" alt="{{$blog->title}}">
                                <span class="card-title hbb imc" style="padding:5px">{{ucfirst($blog->title)}}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    @include('layouts.recentTrips')
    @include('layouts.reviewForm')
    @include('layouts.nayareview')
    @include('layouts.footer1')
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $("#lightSlider").lightSlider({
                item: 3,
                auto: true,
                keypress: true,
                loop: false,
                slideMove: 1,
                easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
                speed: 1000,
                pager: true,
                responsive: [
                    {
                        breakpoint: 800,
                        settings: {
                            item: 3,
                            slideMove: 1,
                            slideMargin: 6
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            item: 1,
                            slideMove: 1
                        }
                    }
                ]
            });

        });
        $(document).ready(function(){
            $('.parallax').parallax();

        // $(document).ready(function(){
        //     $('.slider').slider({
        //         indicators: false,
        //         transition:1500,
        //         interval:3000,
        //         height:960
        //     });
        // });
        //

        const mq = window.matchMedia( "(min-width: 600px)" );
        if (mq.matches) {
            const mq1 = window.matchMedia( "(min-width: 1000px)" );
            if(mq1.matches){
                const mq2 = window.matchMedia( "(min-width: 1450px)" );

                if(mq2.matches){
                    $('.slider').slider({
                        indicators: true,
                        transition:4000,
                        interval:8000,
                        height:900
                    });
                }else{
                    $('.slider').slider({
                        indicators: true,
                        transition:4000,
                        interval:8000,
                        height:700
                    });
                }
            }else{
                $('.slider').slider({
                    indicators: true,
                    transition:4000,
                    interval:8000,
                    height:660
                });
            }


        } else {
                $('.slider').slider({
                    indicators: true,
                    transition:4000,
                    interval:8000,
                    height:400
                });

        }
        });

        $('#currencyChange').on('change', function(){

            $('#currencyChange').addClass('hide');
            $('.loadingStatus').removeClass('hide');

            var toConvert = $('#currencyChange').val();
            $.ajax({
                type: "POST",
                async: false,
                url: "/currency/convert",
                data: {
                    '_method': 'POST',
                    '_token': $('input[name=_token]').val(),
                    'toConvert': toConvert,
                },
                success: function(data){
                    //Converting the original price
                    $('.originalPrice').each(function(){
                        var price = $(this).html();
                        var convertedPrice = Math.round(price * data[0]);
                        $(this).closest('.oldPrice').find('.oldConverted').html(" <strike>"+data[1]+" "+convertedPrice+"</strike>");
                    });


                    //Converting the discounted price
                    $('.price').each(function(){
                        var price = $(this).html();
                        var convertedPrice = Math.round(price * data[0]);
                        $(this).closest('.newPrice').find('.newConverted').html(" &nbsp;&nbsp;"+data[1]+" "+convertedPrice+"</strike>");
                    });

                    $('.loadingStatus').addClass('hide');
                    $('#currencyChange').removeClass('hide');

                }
            });
        });

    </script>
@endsection