@extends('layouts.master')
@section('title')
    {{$trip->name}}
@endsection
@section('metatags')
@endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('styles')
    <style type="text/css">
        hr {
            margin: 3px 0px;
        }

        .top-payment img {

            margin-top: -11px !important;
        }

        .strong {
            font-size: 12px;
            font-weight: 600;
            line-height: 40px;
        }

        .afterclickbtn {
            border: 0;
            background: #111;
            padding: 5px 17px;
            color: #fff;
            font-weight: 800;
        }

        .star-rating label {
            color: #bbb;
            font-size: 14px;
            margin-right: 7px;
            line-height: 40px;

        }

        .cut-radio span {
            margin-right: 20px;
            line-height: 40px;
        }

        label {
            margin-bottom: 0px;
        }
    </style>
@endsection
@section('content')
    @include('layouts.navbar')
    <section class="inner-page-heading-title pt-10">
        <div class="container">
            <div class="section-title-black" style="margin-bottom:10px">
                <h2><span>{{$trip->name}}</span></h2>
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
    <section class="price-customization pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="origin-heading">
                        <h2>Original Trip Price (Per Pax) : USD $ {{$trip->price}}</h2>
                    </div>
                    <div class="originaltrip-body">
                        {{--form--}}
                        <form action="/custombook/one" method="post" id="tripForm">
                            <div class="row up-row col-container">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                    <p class="no-people">No. of People (Pax)</p>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                    <div class="numberbox" style="margin-top:0px;text-align:center">
                                        <button type="button" class="value-button price" id="decrease"
                                                onclick="peopledown()" value="Decrease Value">-
                                        </button>
                                        <input type="text" id="count" name="people" readonly autocomplete="off"
                                               class="counter" value="0"
                                               style="width: 40px; text-align: center; color: black"/>
                                        <button type='button' class="value-button price" id="increase"
                                                onclick="peopleup()" value="Increase Value">+
                                        </button>
                                        <div class="center-align" id="dherai"
                                             style="display: none; color: red;font-size:10px">Cannot
                                            exceed more than 14
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                    <p style=" color: #000;font-size:11px;font-weight:800;line-height:40px">
                                        USD $ <span id="changeprice">{{$trip->price}} (per person) </span>
                                    </p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <div>
                                        <div style="font-weight: 500; font-size:14px; color: red;line-height:40px">
                                            USD $ <span id="pricetotal" value="0">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="hideme" style="display: none">
                                <hr>
                                {{--porter_cost--}}
                                @if($trip->customtrip->porter_cost != null && $trip->customtrip->porter_cost !=0)
                                    <div class="row up-row col-container">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <p class="strong">Porter(s) </p>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 center-contents" style="">
                                            <div class="numbox" style="text-align:center">
                                                <button type="button" class="value-button porterdown afterclickbtn"
                                                        id="decrease"
                                                        onclick="pordown()">
                                                    -
                                                </button>
                                                <input type="text" id="count1" name="porter" readonly
                                                       autocomplete="off"
                                                       class="counter1" value="1"
                                                       style="width: 40px; text-align: center; color: black;line-height:29px; "/>
                                                <button type="button" class="value-button porterup afterclickbtn"
                                                        id="increase"
                                                        onclick="porup()">
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                            <p style="color: #000;font-size:11px;font-weight:800;line-height:40px">
                                                USD $ {{ $trip->customtrip->porter_cost }} (per
                                                person)
                                            </p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                            <div class="">
                                                <p style="font-weight: 500; font-size:14px; color: red;line-height:40px">
                                                    USD $ <span id="portertotal">0</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                {{--end of porter_cost--}}

                                {{--assistant cost--}}
                                @if($trip->customtrip->assistant_cost != null && $trip->customtrip->assistant_cost != 0)
                                    <div class="row up-row col-container">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <p class="strong">Assistant(s)</p>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 center-contents" style="">
                                            <div class="numbox" style="text-align:center">
                                                <button type="button" class="value-button assistantdown afterclickbtn"
                                                        id="decrease"
                                                        onclick="assisdown()">
                                                    -
                                                </button>
                                                <input type="text" id="assistant" name="assistant" readonly
                                                       autocomplete="off"
                                                       class="assistant" value="1"
                                                       style="width: 40px; text-align: center; color: black;line-height:29px; "/>
                                                <button type="button" class="value-button assistantup afterclickbtn"
                                                        id="increase"
                                                        onclick="assisup()">
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                            <p style="color: #000;font-size:11px;font-weight:800;line-height:40px">
                                                USD $ {{ $trip->customtrip->assistant_cost }} (per
                                                person)
                                            </p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                            <div class="">
                                                <p style="font-weight: 500; font-size:14px; color: red;line-height:40px">
                                                    USD $ <span id="assistanttotal">0</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                {{--end of assistant cost--}}
                                {{--guide--}}

                                @if($trip->customtrip->guide_cost != null && $trip->customtrip->guide_cost != 0)
                                    <div class="row up-row col-container">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <p class="strong">Guide(s)</p>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 center-contents" style="">
                                            <div class="numbox" style="text-align:center">
                                                <button type="button" class="value-button guidedown afterclickbtn"
                                                        id="decrease"
                                                        onclick="guidown()">
                                                    -
                                                </button>
                                                <input type="text" id="guide" name="porter" readonly
                                                       autocomplete="off"
                                                       class="guide" value="1"
                                                       style="width: 40px; text-align: center; color: black;line-height:29px; "/>
                                                <button type="button" class="value-button guideup afterclickbtn"
                                                        id="increase"
                                                        onclick="guiup()">
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                            <p style="color: #000;font-size:11px;font-weight:800;line-height:40px">
                                                USD $ {{ $trip->customtrip->guide_cost }} (per
                                                person)
                                            </p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                            <div class="">
                                                <p style="font-weight: 500; font-size:14px; color: red;line-height:40px">
                                                    USD $ <span id="guidetotal">0</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                {{--end of guide--}}
                                {{--sherpa_cost--}}

                                @if($trip->customtrip->sherpa_cost != null && $trip->customtrip->sherpa_cost != 0)
                                    <div class="row up-row col-container">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <p class="strong">Sherpa(s)</p>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 center-contents" style="">
                                            <div class="numbox" style="text-align:center">
                                                <button type="button" class="value-button sherpadown afterclickbtn"
                                                        id="decrease"
                                                        onclick="sherdown()">
                                                    -
                                                </button>
                                                <input type="text" id="sherpa" name="sherpa" readonly
                                                       autocomplete="off"
                                                       class="sherpa" value="1"
                                                       style="width: 40px; text-align: center; color: black;line-height:29px; "/>
                                                <button type="button" class="value-button sherpaup afterclickbtn"
                                                        id="increase"
                                                        onclick="sherup()">
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                            <p style="color: #000;font-size:11px;font-weight:800;line-height:40px">
                                                USD $ {{ $trip->customtrip->sherpa_cost }} (per
                                                person)
                                            </p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                            <div class="">
                                                <p style="font-weight: 500; font-size:14px; color: red;line-height:40px">
                                                    USD $ <span id="sherpatotal">0</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                {{--end of sherpa_cost--}}
                                {{--room--}}
                                <div class="row up-row col-container">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                        <p class="strong">Room(s):</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 center-contents" style="">
                                        <div class="numbox" style="text-align:center">
                                            <button type="button" class="value-button roomsdown afterclickbtn"
                                                    id="decrease"
                                                    onclick="roomdown()">
                                                -
                                            </button>
                                            <input type="text" id="rooms" name="porter" readonly
                                                   autocomplete="off"
                                                   class="rooms" value="1"
                                                   style="width: 40px; text-align: center; color: black;line-height:29px; "/>
                                            <button type="button" class="value-button roomsup afterclickbtn"
                                                    id="increase"
                                                    onclick="roomup()">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <p style="color: #000;font-size:11px;font-weight:800;line-height:40px">

                                        </p>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                        <div class="">
                                            <p style="font-weight: 500; font-size:14px; color: red;line-height:40px">
                                                USD $ <span id="sabairoom"
                                                            data-facet-value="0">0</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                {{--end of room--}}
                                {{--hotel--}}
                                <div class="row up-row col-container">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                        <p class="strong">Hotel/Accomodation(s):</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 center-contents" style="">
                                        <div class="star-rating" style="width:100%;display:block;text-align:center">
                                            <input class="star star-5" id="exp-star-5" type="radio" name="basai"
                                                   value="5">
                                            <label class="star star-5" for="exp-star-5"><i class="active fa fa-star"
                                                                                           aria-hidden="true"></i></label>
                                            <input class="star star-4" id="exp-star-4" type="radio" name="basai"
                                                   value="4">
                                            <label class="star star-4" for="exp-star-4"><i class="active fa fa-star"
                                                                                           aria-hidden="true"></i></label>
                                            <input class="star star-3" id="exp-star-3" type="radio" name="basai"
                                                   value="3" checked>
                                            <label class="star star-3" for="exp-star-3"><i class="active fa fa-star"
                                                                                           aria-hidden="true"></i></label>
                                            <input class="star star-2" id="exp-star-2" type="radio" name="basai"
                                                   value="2">
                                            <label class="star star-2" for="exp-star-2"><i class="active fa fa-star"
                                                                                           aria-hidden="true"></i></label>
                                            <input class="star star-1" id="exp-star-1" type="radio" name="basai"
                                                   value="1" required="">
                                            <label class="star star-1" for="exp-star-1"><i class="active fa fa-star"
                                                                                           aria-hidden="true"></i></label>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <p style="color: #000;font-size:11px;font-weight:800;line-height:40px">
                                        <p style="color: #000;font-size:11px;font-weight:800;line-height:40px">
                                            USD $ <span id="accom">{{$star_3}} (per room)</span>

                                        </p>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                        <div class="">
                                            <p style="font-weight: 500; font-size:14px; color: red;line-height:40px">

                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                {{--end hotel--}}
                                {{--transportation option--}}
                                @if($trip->customtrip->public_cost !=0 || $trip->customtrip->private_cost !=0 ||
                                          $trip->customtrip->flight_cost !=0 )
                                    <div class="row up-row col-container">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <p class="strong">Transportation Option(s): </p>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">

                                        </div>
                                    </div>
                                @endif
                                {{--end of transportation option--}}
                                {{--city tour--}}
                                @if($trip->customtrip->citytour_cost != null && $trip->customtrip->citytour_cost !=0)
                                    <div class="row up-row col-container">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <p class="strong">City Tour </p>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                                            <p class="cut-radio">

					         		<span>
					         			<input type="radio" name="tour" class="filled-in"
                                               id="filled-in-box"
                                               checked="checked" value="1"/>
					         			<label for="filled-in-box"><span
                                            >Included</span></label>
					         			</span>

                                                <span>
					         				<input type="radio" name="tour" class="filled-in"
                                                   id="filled-in-box1"
                                                   value="0"/>
					         				<label for="filled-in-box1"><span
                                                        style="">Don't Include</span></label>
					         				</span>
                                            </p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                                            <div class="">
                                                <p style="font-weight: 500; font-size:14px; color: red;line-height:40px">
                                                    USD $ <span id="citytour"
                                                                data-facet-value="0">0</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                {{--end of city tour--}}

                                {{--meal--}}
                                @if($trip->customtrip->meals_cost != null && $trip->customtrip->meals_cost !=0)
                                    <div class="row up-row col-container">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <p class="strong">Meals</p>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                                            <p class="cut-radio">
					         	  	<span>
					         	  		<input type="radio" name="meals" class="filled-in1 filled-in"
                                               id="mealsIncluded" checked="checked" value="1"/>
					         	  		<label for="mealsIncluded"><span
                                            >Included</span></label>
					         	  		</span>

                                                <span>
					         	  			<input type="radio" name="meals" class="filled-in1 filled-in"
                                                   id="mealsNotIncluded" value="0"/>
					         	  			<label for="mealsNotIncluded"><span
                                                >Don't Include</span></label>
					         	  			</span>
                                            </p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                                            <div class="">
                                                <p style="font-weight: 500; font-size:14px; color: red;line-height:40px">
                                                    USD $ <span id="meals"
                                                                data-facet-value="0"></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                {{--end meal--}}
                                <div class="row" style="background:#fc0;padding:5px 0">
                                    <div class="col-lg-7 col-md-7 col-sm-12 cu-bo">
                                        <input type="hidden" name="trip_id" value="{{$trip->id}}">
                                        <input type="hidden" name="extraprice" class="extraprice">
                                        <input type="hidden" name="alltotal" class="totalprice">
                                        <button type="submit" class="booknow-btn-custom">Book Now</button>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 cu-to">
                                        <p style="font-size: 16px;color:#000; font-weight:600;line-height:32px;text-align:right">
                                            Total Payable: USD $ <span class="grandtotal"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{--end form--}}

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="originaltrip">
                        <div class="origin-heading">
                            <h2>Original Inclusions:</h2>
                        </div>
                        <div class="original-inclusion">
                            @if($trip->customtrip->porter_cost != null && $trip->customtrip->porter_cost!=0)
                                <div>
                                    Porter: <span> {{$porterratio}}</span>
                                </div>
                            @endif
                            @if($trip->customtrip->assistant_cost != null &&
                            $trip->customtrip->assistant_cost != 0 )
                                <div>
                                    Assistant: <span>{{$assistantratio}}</span>
                                </div>
                            @endif
                            @if($trip->customtrip->guide_cost != 0 && $trip->customtrip->guide_cost != null)
                                <div>
                                    Guide: <span>{{$guideratio}}</span>
                                </div>
                            @endif
                            @if($trip->customtrip->sherpa_cost != 0 && $trip->customtrip->sherpa_cost !=
                            null)
                                <div>
                                    Sherpa: <span>{{$sherparatio}}</span>
                                </div>
                            @endif
                            <div>
                                Hotel room: <span>2:1</span>
                            </div>

                            <div>
                                Hotel/Accomodation:
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>

                            </div>
                            @if($trip->customtrip->public_cost != null or $trip->customtrip->public_cost
                            !=0 &&
                            $trip->customtrip->private_cost != null or $trip->customtrip->private_cost !=0
                            &&
                            $trip->customtrip->flight_cost != null or $trip->customtrip->flight_cost !=0 )
                                <div>
                                    Transportation: <span>Private</span>
                                </div>
                            @endif
                            @if($trip->customtrip->meals_cost != 0 && $trip->customtrip->meals_cost != null)
                                <div>
                                    Meals
                                </div>
                            @endif
                            <div>
                                Permits
                            </div>
                            @if($trip->customtrip->citytour_cost != 0 && $trip->customtrip->citytour_cost
                            != null)
                                <div>
                                    City Tour
                                </div>
                            @endif
                        </div>
                        <div class="origin-heading">
                            <h2>Important Notes: </h2>
                        </div>
                        <div class="importantnote">
                            <div>
                                * Group discount is applicable only in case of <b>Original Trip </b> or <b>Total
                                    Payable </b> equal or above the <b>Original Trip Price </b>
                            </div>
                            <hr>
                            @if($trip->customtrip->porter_cost != null && $trip->customtrip->porter_cost !=0)
                                <div>
                                    *
                                    The client-porter ratio is {{$porterratio}}.
                                </div>
                                <hr>

                            @endif
                            @if($trip->customtrip->guide_cost != null && $trip->customtrip->porter_cost !=0)
                                <div>
                                    *
                                    The client-trekking guide ratio is {{$guideratio}}.
                                </div>
                                <hr>

                            @endif
                            <div>
                                * City tours include all the entrance fees, guide, and private transfer
                            </div>
                            <hr>
                            <div>
                                * The weight limit for each porter is 15 KG and it is strictly applied in all
                                cases.
                            </div>
                            <hr>
                            <div>
                                *Accommodation ratings/price applies only for the hotel/s in the cities, not in
                                trekking regions.
                            </div>
                            <div>
                                *Room(s): The cost of rooms is calculated on the basis of number of nights in
                                hotel in city, not during the trekking.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            if ($("html").innerWidth() < 550) {
                console.log('hello');
                $(".up-row").removeClass("col-container");
                $(".up-row").addClass("mobileView");
            } else {
                $(".up-row").removeClass("mobileView");
                $(".up-row").addClass("col-container");
            }
            $(window).resize(function () {
                if ($("html").innerWidth() < 550) {
                    console.log('hello');
                    $(".up-row").removeClass("col-container");
                    $(".up-row").addClass("mobileView");
                } else {
                    $(".up-row").removeClass("mobileView");
                    $(".up-row").addClass("col-container");
                }
            });
        });

            var personprice = null;
            var person = 0;
            var defaultporter = 0;
            var defaultassistant = 0;
            var defaultguide = 0;
            var defaultsherpa = 0;
            var defaultroom = 0;
            @if($trip->customtrip->public_cost != null or $trip->customtrip->public_cost !=0 &&
                $trip->customtrip->private_cost != null or $trip->customtrip->private_cost !=0  &&
                $trip->customtrip->flight_cost != null or $trip->customtrip->flight_cost !=0 )
            var private_price = "{{$trip->customtrip->private_cost}}";
            var public_price = "{{$trip->customtrip->public_cost}}";
            var flight_price = "{{$trip->customtrip->flight_cost}}";
            @endif
            @if($trip->customtrip->accomodation_cost != null or 0)
            var defaultaccomodation = "{{$star_3}}";
            @endif
            var porterup = 0;
            var porterdown = 0;
            var assistantup = 0;
            var assistantdown = 0;
            var guideup = 0;
            var guidedown = 0;
            var sherpaup = 0;
            var sherpadown = 0;
            var roomsup = 0;
            var roomsdown = 0;
            var transport = 0;
            var tour = 0;
            var meals = 0;
            var total = 0;
               function finalcall() {
                var pp = personprice;
                var pu = porterup;
                var pd = porterdown;
                var gu = guideup;
                var gd = guidedown;
                var su = sherpaup;
                var sd = sherpadown;
                var au = assistantup;
                var ad = assistantdown;
                var ru = roomsup;
                var rd = roomsdown;

                var tr = transport;
                console.log("TR" + transport);
                var t = tour;
                console.log("Tour" + t);
                var m = meals;
                console.log("Meals" + m);
                var porters = parseInt(pu + pd);
                console.log("porters " + porters);

                var assistants = parseInt(au + ad);
                console.log("assistant " + assistants);

                var guides = parseInt(gu + gd);
                console.log("guides" + guides);

                var sherpas = parseInt(su + sd);
                console.log("sherpas" + sherpas);

                var accomodations = parseInt(ru + rd);
                console.log("accomodations " + accomodations);


                var netchanges = tr + t + m + porters + assistants + guides + sherpas + accomodations;
                console.log("Net Charges" + netchanges);

                var grandtotal = pp + netchanges;
                x = document.getElementsByClassName("grandtotal");
                for (var i = 0; i < x.length; i++) {
                    x[i].innerText = grandtotal;
                }

                $('.totalprice').val(grandtotal);
                $('.extraprice').val(netchanges);

            }

            function peopledown(){
                var number = parseInt(document.getElementById('count').value);
                var number = number - 1;
                if (number < 0) {
                    number = 0;
                }
                if (number <= 13) {
                    document.getElementById('dherai').style.display = 'none';
                }
                $('.counter').val(number);
                if (number === 0) {
                    window.location.reload(true);
                    document.getElementById('hideme').style.display = 'none';
                }
            }

            function peopleup() {
                var number = parseInt(document.getElementById('count').value);
                var number = number + 1;
                if (number > 14) {
                    number = 14;
                    document.getElementById('dherai').style.display = 'block';
                } else {
                    document.getElementById('dherai').style.display = 'none';
                }
                $('.counter').val(number);
                if (number >= 1) {
                    document.getElementById('hideme').style.display = 'block';

                } else {
                    document.getElementById('hideme').style.display = 'none';
                }
            }
            $(document).on('click', '.price', (function (e) {
                var number = $('#count').val();
                var now_transport = $('select.changeStatus').val();
                var value = $('input[name=tour]:checked').val();
                var value1 = $('input[name=meals]:checked').val();
                if (e.originalEvent.defaultPrevented) return;
                $.ajax({
                    type: 'post',
                    async: false,
                    url: '/groupdiscount',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'number': number,
                        'value': value,
                        'value1': value1,
                        'tripid': "{{$trip->id}}"
                    },
                    success: function (data) {
                        console.log(data.join(' '));
                        personprice = data[2];
                        defaultporter = data[3];
                        defaultassistant = data[8];
                        defaultguide = data[7];
                        defaultsherpa = data[9];
                        defaultroom = data[6];
                        person = data[0];
                        porterdown = 0;
                        roomsdown = 0;
                        porterup = 0;
                        roomsup = 0;
                        guideup = 0;
                        guidedown = 0;
                        assistantdown = 0;
                        assistantup = 0;
                        sherpaup = 0;
                        sherpadown = 0;
                        tour = data[4];
                        meals = data[10];
                        $('#pricetotal').html(data[2]);
                        $('.counter1').val(data[3]);
                        $('.rooms').val(data[6]);
                        $('.guide').val(data[7]);
                        $('.assistant').val(data[8]);
                        $('.sherpa').val(data[9]);

                        $('#sabairoom').text("0");
                        $('#guidetotal').text("0");
                        $('#sherpatotal').text("0");
                        $('#assistanttotal').text("0");
                        $('#portertotal').text("0");
                        @if($trip->customtrip->citytour_cost !=0 or null)
                        document.getElementById('citytour').innerText = data[5];
                        @endif
                        @if($trip->customtrip->meals_cost != 0 or null)
                        document.getElementById('meals').innerText = data[11];
                        @endif
                        transportsabai(now_transport);
                    }
                });
            }));

            function transportsabai(data1) {
                var p = person;
                var basne = parseInt($('#accom').html());
                @if($trip->customtrip->public_cost != null or $trip->customtrip->public_cost !=0 or
                    $trip->customtrip->private_cost != null or $trip->customtrip->private_cost !=0  or
                    $trip->customtrip->flight_cost != null or $trip->customtrip->flight_cost !=0 )
                if (data1 === 'public') {
                    transport = (public_price - private_price) * p;
                    katijana(basne);
                } else if (data1 === 'private') {
                    transport = 0;
                    katijana(basne);
                } else {
                    transport = (flight_price - private_price) * p;
                    katijana(basne);
                }
                @else
                katijana(basne);
                @endif
            }

            function katijana(data) {
                var po = person;
                var p = Math.ceil(po / 2);
                if (data != defaultaccomodation) {
                    roomsup = ((data - defaultaccomodation) * p);
                    roomsdown = 0;
                    $('#sabairoom').html(roomsup);
                    finalcall();
                } else {
                    roomsup = 0;
                    roomsdown = 0;
                    finalcall();
                }
                return false;
            }

            //for porters
            function pordown() {
                var number = parseInt(document.getElementById('count1').value);
                var number = number - 1;
                @if($trip->customtrip->portercom == 1)
                if (number <= 1) {
                    number = 1;
                }
                @else
                if (number < 0) {
                    number = 0;
                }
                @endif

                $('.counter1').val(number);

            }

            function porup() {
                var number = parseInt(document.getElementById('count1').value);
                var number = number + 1;
                $('.counter1').val(number);
            }

            $(document).on('click', '.porterup', (function (e) {
                var number = $('#count1').val();
                var dporter = defaultporter;
                if (e.originalEvent.defaultPrevented) return;
                $.ajax({
                    type: 'post',
                    async: false,
                    url: '/porterpriceup',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'defaultporter': dporter,
                        'number': number,
                        'tripid': "{{$trip->id}}"
                    },
                    success: function (data) {
                        porterup = data[2];
                        porterdown = 0;
                        $('#portertotal').html(data[2]);
                        finalcall();
                    }
                });
            }));
            $(document).on('click', '.porterdown', (function (e) {
                var number = $('#count1').val();
                var dporter = defaultporter;
                if (e.originalEvent.defaultPrevented) return;
                $.ajax({
                    type: 'post',
                    async: false,
                    url: '/porterpricedown',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'defaultporter': dporter,
                        'number': number,
                        'tripid': "{{$trip->id}}"
                    },
                    success: function (data) {
                        porterdown = data[2];
                        porterup = 0;
                        $('#portertotal').html(data[2]);
                        finalcall();
                    }
                });
            }));
            function assisdown() {
                var number = parseInt(document.getElementById('assistant').value);
                var number = number - 1;
                @if($trip->customtrip->assistantcom == 1)
                if (number <= 1) {
                    number = 1;
                }
                @else
                if (number < 0) {
                    number = 0;
                }
                @endif
                $('.assistant').val(number);
            }

            function assisup() {
                var number = parseInt(document.getElementById('assistant').value);
                var number = number + 1;
                $('.assistant').val(number);
            }

            $(document).on('click', '.assistantup', (function (e) {
                var number = $('#assistant').val();
                var dassistant = defaultassistant;

                if (e.originalEvent.defaultPrevented) return;
                $.ajax({
                    type: 'post',
                    async: false,
                    url: '/assistantup',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'defaultassistant': dassistant,
                        'number': number,
                        'tripid': "{{$trip->id}}"
                    },
                    success: function (data) {
                        assistantup = data[2];
                        assistantdown = 0;
                        $('#assistanttotal').html(data[2]);
                        finalcall();
                    }
                });
            }));

            $(document).on('click', '.assistantdown', (function (e) {
                var number = $('#assistant').val();
                var dassistant = defaultassistant;
                if (e.originalEvent.defaultPrevented) return;
                $.ajax({
                    type: 'post',
                    async: false,
                    url: '/assistantdown',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'defaultassistant': dassistant,
                        'number': number,
                        'tripid': "{{$trip->id}}"
                    },
                    success: function (data) {
                        assistantdown = data[2];
                        assistantup = 0;
                        $('#assistanttotal').html(data[2]);
                        finalcall();
                    }
                });
            }));
            function guidown() {
                var number = parseInt(document.getElementById('guide').value);
                var number = number - 1;

                @if($trip->customtrip->guidecom == 1)
                if (number <= 1) {
                    number = 1;
                }
                @else
                if (number < 0) {
                    number = 0;
                }
                @endif
                $('.guide').val(number);
            }

            function guiup() {
                var number = parseInt(document.getElementById('guide').value);
                var number = number + 1;
                $('.guide').val(number);
            }

            $(document).on('click', '.guideup', (function (e) {
                var number = $('#guide').val();
                var dguide = defaultguide;
                if (e.originalEvent.defaultPrevented) return;
                $.ajax({
                    type: 'post',
                    async: false,
                    url: '/guideup',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'defaultguide': dguide,
                        'number': number,
                        'tripid': "{{$trip->id}}"
                    },
                    success: function (data) {
                        guideup = data[2];
                        guidedown = 0;
                        $('#guidetotal').html(data[2]);
                        finalcall();
                    }
                });
            }));

            $(document).on('click', '.guidedown', (function (e) {
                var number = $('#guide').val();
                var dguide = defaultguide;
                if (e.originalEvent.defaultPrevented) return;
                $.ajax({
                    type: 'post',
                    async: false,
                    url: '/guidedown',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'defaultguide': dguide,
                        'number': number,
                        'tripid': "{{$trip->id}}"
                    },
                    success: function (data) {
                        guidedown = data[2];
                        guideup = 0;
                        $('#guidetotal').html(data[2]);
                        finalcall();
                    }
                });
            }));

            function sherdown() {
                var number = parseInt(document.getElementById('sherpa').value);
                var number = number - 1;
                @if($trip->customtrip->sherpacom == 1)
                if (number <= 1) {
                    number = 1;
                }
                @else
                if (number < 0) {
                    number = 0;
                }
                @endif
                $('.sherpa').val(number);
            }

            function sherup() {
                var number = parseInt(document.getElementById('sherpa').value);
                var number = number + 1;
                $('.sherpa').val(number);
            }

            $(document).on('click', '.sherpaup', (function (e) {
                var number = $('#sherpa').val();
                var dsherpa = defaultsherpa;
                if (e.originalEvent.defaultPrevented) return;
                $.ajax({
                    type: 'post',
                    async: false,
                    url: '/sherpaup',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'defaultsherpa': dsherpa,
                        'number': number,
                        'tripid': "{{$trip->id}}"
                    },
                    success: function (data) {
                        sherpaup = data[2];
                        sherpadown = 0;
                        $('#sherpatotal').html(data[2]);
                        finalcall();
                    }
                });
            }));
            $(document).on('click', '.sherpadown', (function (e) {
                var number = $('#sherpa').val();
                var dsherpa = defaultsherpa;
                if (e.originalEvent.defaultPrevented) return;
                $.ajax({
                    type: 'post',
                    async: false,
                    url: '/sherpadown',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'defaultsherpa': dsherpa,
                        'number': number,
                        'tripid': "{{$trip->id}}"
                    },
                    success: function (data) {
                        sherpadown = data[2];
                        sherpaup = 0;
                        $('#sherpatotal').html(data[2]);
                        finalcall();
                    }
                });
            }));

            function roomdown() {
                var number = parseInt(document.getElementById('rooms').value);
                var number = number - 1;
                if (number < 0) {
                    number = 0;
                }
                $('.rooms').val(number);

            }

            function roomup() {
                var number = parseInt(document.getElementById('rooms').value);
                var number = number + 1;
                $('.rooms').val(number);
            }

            $(document).on('click', '.roomsup', (function (e) {
                var roomnumber = $('#rooms').val();
                var droom = defaultroom;
                var manche = $('#count').val();
                var currentprice = parseInt($('#accom').html());
                if (e.originalEvent.defaultPrevented) return;
                $.ajax({
                    type: 'post',
                    async: false,
                    url: '/roomup',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'paisa': currentprice,
                        'manche': manche,
                        'defaultstar': defaultaccomodation,
                        'defaultroom': droom,
                        'roomnumber': roomnumber
                    },
                    success: function (data) {
                        roomsup = data[1];
                        roomsdown = 0;
                        $('#sabairoom').html(data[1]);
                        finalcall();
                    }
                });
            }));

            $(document).on('click', '.roomsdown', (function (e) {
                var roomnumber = $('#rooms').val();
                var droom = defaultroom;
                var manche = $('#count').val();
                var currentprice = parseInt($('#accom').html());
                if (e.originalEvent.defaultPrevented) return;
                $.ajax({
                    type: 'post',
                    async: false,
                    url: '/roomdown',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'defaultstar': defaultaccomodation,
                        'paisa': currentprice,
                        'manche': manche,
                        'defaultroom': droom,
                        'roomnumber': roomnumber
                    },
                    success: function (data) {
                        roomsdown = data[1];
                        roomsup = 0;
                        $('#sabairoom').html(data[1]);
                        finalcall();
                    }
                });
            }));
            $(document).on('change', '.star', (function () {
                var value = $('input[name=basai]:checked').val();
                var room = $('#rooms').val();
                var manche = $('#count').val();
                var droom = defaultroom;
                $.ajax({
                    type: 'post',
                    aysnc: false,
                    url: '/accomodation',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'value': value,
                        'currentpeople': manche,
                        'room': room,
                        'defaultroom': droom,
                        'tripid': "{{$trip->id}}"
                    },
                    success: function (data) {
                        roomsdown = data[1];
                        roomsup = 0;
                        $('#accom').html(data[0]);
                        $('#sabairoom').html(data[1]);
                        finalcall();
                    }
                });
            }));
            $('select.changeStatus').change(function () {
                var currentpeople = $('#count').val();
                $.ajax({
                    type: 'GET',
                    async: false,
                    url: '/transport',
                    data: {
                        transport: $('select.changeStatus').val(),
                        'currentpeople': currentpeople,
                        'tripid': "{{$trip->id}}"
                    },
                    success: function (data) {
                        $('#transport').html(data[2]);
                        transportsabai(data[1]);
                    }
                });

            });
            $(document).on('change', '.filled-in', (function () {
                var value = $('input[name=tour]:checked').val();
                var currentpeople = $('#count').val();
                $.ajax({
                    type: 'post',
                    async: false,
                    url: '/tour',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'currentpeople': currentpeople,
                        'value': value,
                        'tripid': "{{$trip->id}}"
                    },
                    success: function (data) {
                        tour = data[0];
                        $('#citytour').html(data[1]);
                        finalcall();
                    }
                });
            }));
            $(document).on('change', '.filled-in1', (function () {
                var value = $('input[name=meals]:checked').val();
                var currentpeople = $('#count').val();

                $.ajax({
                    type: 'post',
                    async: false,
                    url: '/meal',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'currentpeople': currentpeople,
                        'value': value,
                        'tripid': "{{$trip->id}}"
                    },
                    success: function (data) {
                        meals = data[0];
                        $('#meals').html(data[1]);
                        finalcall();
                    }
                });
            }));
         
    </script>
@endsection


