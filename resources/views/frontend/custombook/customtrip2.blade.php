@extends('layouts.master')
@section('title')
    <title>{{$trip->name}}</title>
@endsection
@section('metatags')
@endsection
@section('styles')
    <link rel="stylesheet" href="{{url('css/frontend/booking.css')}}">
    <link rel="stylesheet" href="{{url('css/customtrip.css')}}">
    <style>
        .original-inclusion > div {
            padding: 2px 5px;
            color: #FFFFFF;
            background-color:#008EB0;
            border-radius: 2px;
            display: inline-block;
            margin: 2px;
            font-size: 12px;
            padding: 5px;
        }

        .original-inclusion > div > span .material-icons {
            vertical-align: middle;
            color: white;
            font-size: 19px;
        }

        .center-contents {
            display: flex;
            justify-content: center;
        }

        .defFont {
            color: teal;
            /*font-size:10px ;*/
            text-align: center;
        }

        #tripForm .card-panel {
            padding: 1px;
            margin-top: 3px;
            margin-bottom: 1px;
        }

        .col-container .card-panel {
            margin: 2px;
        }

        #tripForm .row {
            margin-bottom: 0px;
        }

        .card-panel input {
            margin-bottom: 0px;
        }

        .select-wrapper input.select-dropdown {
            margin-bottom: 0px;
            border-bottom: none;
            height: 37.5px;
            margin: 2px;
            /*width: 70%;*/
        }

        .col-container {
            display: flex;
            flex-wrap: wrap;
        }

        .center-contents #decrease {
            border: 3px solid #008EB0;
            border-right: none;
            height: 35px;
        }

        .center-contents .value-button {
            background-color: #008EB0;
        }

        .center-contents #decrease .material-icons {
            color: #FFF;
        }

        .center-contents #increase .material-icons {
            color: #FFF;
        }

        .center-contents #increase {
            border: 3px solid #008EB0;
            border-left: none;
            height: 35px;
        }


        .center-contents input {
            border: 1px solid #008EB0;
            border-right: none;
            border-left: none;
            height: 33px;
        }

        .col-container > .col-content {
            flex: 1;
            /*width: 100px;*/
        }

        #hideme .col-container .col-content {
            width: 200px;
        }

        #cityTour > span {
            margin: 2px;
        }

        .mobileView {
            display: block;
        }

        /*@media only screen and (max-width:800px){*/
        /*#cityTour{*/
        /*flex-direction: column;*/
        /*}*/
        /*}*/

        .customPanelContent{
            padding: 0px 10px;
        }

        .customPanelTitle{
            background-color: #4B4B4B;
            color: white;
        }

        .customPanelContent .value-button{
            padding:5px 0px;
        }

        .customPanelTitle h2{
            padding: 8px 0px;
            font-size: 15px;
            text-transform: uppercase;
            font-weight: bolder;
            text-align: center;
            border:0px;
        }


        .panelContainer{
            border:1px solid gray;
            border-top: 0px;
            box-shadow: 0.1px 0.4px 0.6px black;
        }

        .customPanelBody{
            padding: 0px 10px 10px 10px;
        }

        #customTripSelect .select-wrapper input.select-dropdown{
            border:0px;
        }

        #customTripSelect .select-wrapper{
            border:1px solid gray;
        }

        @media screen and (min-width: 600px){
          .payableSmallScreen,.customOriginalSmScreen{
              display: none;
          }

          .payableLargeScreen,.customOriginalLgScreen{
              display:block;
          }  
        }

        @media screen and (max-width: 600px){
          .payableSmallScreen,.customOriginalSmScreen{
              display: block;
          }
  
          .payableLargeScreen, .customOriginalLgScreen{
              display:none;
          }  
        }
        
        .roomsStarSection .input-field label{
            color:black!important;
        }
    </style>
@endsection
@section('content')
    @include('layouts.navbar2')
    <div class="clear"></div>
    <div class="booking clear">
        <div class="container-fliud containerPadding" style="margin-top:-20px;">
            <h2  class="titleHeadtwo" style="font-size: 20px;padding:8px;"> <span class="reviewTitle" style="color:teal;"> Trip Customization: {{$trip->name}} </span> </h2>

            <div class="row" style="margin-top: -45px;">
                <div class="col 12 m12 s12 ">
                    <div class="customTripRightpart customPanelContent">
                        <div class="panelContainer customOriginalSmScreen">
                            <div class="customPanelTitle">
                                <h2> Original Inclusions: </h2>
                            </div>

                            <div class="customPanelBody">
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
                                        <span style="">
                                            <i class="material-icons">star</i><i class="material-icons">star</i><i
                                                    class="material-icons">star</i>
                                            <i class="material-icons">star_border</i><i class="material-icons">star_border</i>
                                            </span>
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
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l8 m8 s12 ">
                    <div class="customTripLeftpart customPanelContent">
                        <div class="panelContainer">
                            <div class="customPanelTitle">
                                <h2> Original Trip Price (Per Pax) : USD $ {{$trip->price}} </h2>
                            </div>

                            <div class="customPanelBody">
                                <form action="/custombook/one" method="post" id="tripForm">
                                    <div class=" lighten-1" >
                                        <div class="row up-row col-container" style="box-shadow: 1px 1px 1px gray;">
                                            <div class="card-panel hoverable col-content" style="background-color: #e0e0e0;">
                                                <div class="row" >
                                                    <div class="col l3 m3 s12 center-align">
                                                        <div>
                                                            <p>No. of People (Pax) </p>
                                                        </div>
                                                    </div>

                                                    <div class="col l3 m3 s12 center-contents">
                                                        <div class="value-button price" id="decrease" onclick="peopledown()" style="background: tomato;border-color: tomato;">
                                                            <i class='material-icons'>exposure_neg_1</i>
                                                        </div>
                                                        <input type="text" id="count" name="people" readonly autocomplete="off"
                                                               class="counter" value="0"
                                                               style="width: 40px; text-align: center; color: black;border-color:tomato;"/>

                                                        <div class="value-button price" id="increase" onclick="peopleup()" style="background: tomato;border-color: tomato;">
                                                            <i class='material-icons'>exposure_plus_1</i>
                                                        </div>
                                                        <div class="center-align" id="dherai" style="display: none; color: red;">Cannot
                                                            exceed more than 14
                                                        </div>
                                                    </div>

                                                    <div class="col l3 m3 s12 center-align">
                                                        <div>
                                                            <p style="font-weight: 500; color: teal;">
                                                                USD $ <span id="changeprice">{{$trip->price}} (per person) </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col  l3 m3 s12 center-align">
                                                        <div>
                                                            <div style="font-weight: 500; font-size:14px; color: red; margin-top: 12px;">
                                                                USD $ <span id="pricetotal" value="0">0</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="hideme" style="display: none">
                                            <hr>

                                            @if($trip->customtrip->porter_cost != null && $trip->customtrip->porter_cost !=0)
                                            <div class="row up-row col-container">
                                                <div class="card-panel hoverable col-content">
                                                    <div class="row">
                                                        <div class="col l3 m3 s12  center-align">
                                                           <p>Porter(s) </p>
                                                        </div>

                                                        <div class="col l3 m3 s12 center-contents" style="">
                                                            <div class="value-button porterdown" id="decrease" onclick="pordown()">
                                                                <i class='material-icons'>exposure_neg_1</i>
                                                            </div>
                                                            <input type="text" id="count1" name="porter" readonly autocomplete="off"
                                                                   class="counter1" value="1"
                                                                   style="width: 40px; text-align: center; color: black; "/>
                                                            <div class="value-button porterup" id="increase" onclick="porup()">
                                                                <i class='material-icons'>exposure_plus_1</i>
                                                            </div>
                                                        </div>

                                                        <div class="col l3 m3 s12  center-align">
                                                            <p style="font-weight: 500; color: teal;">
                                                                USD $ {{ $trip->customtrip->porter_cost }} (per person)
                                                            </p>
                                                        </div>

                                                        

                                                        <div class="col l3 m3 s12 center-align">
                                                            <div class="">
                                                                <p style="font-weight: 500; font-size:14px; color: red;">
                                                                    USD $ <span id="portertotal">0</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif


                                            @if($trip->customtrip->assistant_cost != null && $trip->customtrip->assistant_cost != 0)
                                            <div class="row up-row col-container">
                                                <div class=" card-panel hoverable col-content">
                                                    <div class="row">
                                                        <div class="col l3 m3 s12 center-align">
                                                            <p>Assistant(s) </p>
                                                        </div>

                                                        <div class="col l3 m3 s12 center-contents" style="">
                                                            <div class="value-button assistantdown" id="decrease"
                                                                 onclick="assisdown()">
                                                                <i class='material-icons'>exposure_neg_1</i>
                                                            </div>
                                                            <input type="text" id="assistant" name="assistant" readonly
                                                                   autocomplete="off"
                                                                   class="assistant" value="1"
                                                                   style="width: 40px; text-align: center; color: black"/>
                                                            <div class="value-button assistantup" id="increase"
                                                                 onclick="assisup()">
                                                                <i class='material-icons'>exposure_plus_1</i>
                                                            </div>
                                                        </div>
                                                        <div class="col l3 m3 s12 center-align">
                                                            <p style="font-weight: 500; color: teal;">
                                                                USD $ {{ $trip->customtrip->assistant_cost }}  (per person)
                                                            </p>
                                                        </div>

                                                        
                                                        <div class="col l3 m3 s12 center-align">
                                                            <div class="">
                                                                <p style="font-weight: 500; font-size:14px; color: red;">
                                                                    USD $ <span id="assistanttotal">0</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif


                                            @if($trip->customtrip->guide_cost != null && $trip->customtrip->guide_cost != 0)
                                            <div class="row up-row col-container">
                                                <div class=" card-panel hoverable col-content">
                                                    <div class="row">
                                                        <div class="col l3 m3 s12 center-align">
                                                           <p> Guide(s) </p>
                                                        </div>

                                                        <div class="col l3 m3 s12 center-contents" style="">
                                                            <div class="value-button guidedown" id="decrease" onclick="guidown()">
                                                                <i class='material-icons'>exposure_neg_1</i>
                                                            </div>
                                                            <input type="text" id="guide" name="porter" readonly autocomplete="off"
                                                                   class="guide" value="1"
                                                                   style="width: 40px; text-align: center; color: black"/>
                                                            <div class="value-button guideup" id="increase" onclick="guiup()">
                                                                <i class='material-icons'>exposure_plus_1</i>
                                                            </div>
                                                        </div>
                                                        <div class="col l3 m3 s12 center-align">
                                                            <p style="font-weight: 500; color: teal;">
                                                                USD $ {{ $trip->customtrip->guide_cost }}  (per person)
                                                            </p>
                                                        </div>
                                                        
                                                        <div class="col l3 m3 s12 center-align">
                                                            <div class="">
                                                                <p style="font-weight: 500; font-size:14px; color: red;">
                                                                    USD $ <span id="guidetotal">0</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if($trip->customtrip->sherpa_cost != null && $trip->customtrip->sherpa_cost != 0)
                                            <div class="row up-row col-container">
                                                <div class=" card-panel hoverable col-content">
                                                    <div class="row">
                                                        <div class="col l3 m3 s12 center-align">
                                                            <div style="">
                                                               <p>Sherpa(s) </p>
                                                            </div>
                                                        </div>

                                                        
                                                        <div class="col l3 m3 s12 center-contents" style="">
                                                            <div class="value-button sherpadown" id="decrease"
                                                                 onclick="sherdown()">
                                                                <i class='material-icons'>exposure_neg_1</i>
                                                            </div>
                                                            <input type="text" id="sherpa" name="sherpa" readonly
                                                                   autocomplete="off"
                                                                   class="sherpa" value="1"
                                                                   style="width: 40px; text-align: center; color: black"/>

                                                            <div class="value-button sherpaup" id="increase" onclick="sherup()">
                                                                <i class='material-icons'>exposure_plus_1</i>
                                                            </div>
                                                        </div>

                                                        <div class="col l3 m3 s12 center-align">
                                                            <div style="">
                                                                <p style="font-weight: 500; color: teal;">
                                                                    USD $ {{ $trip->customtrip->sherpa_cost }}  (per person)
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="col l3 m3 s12 center-align">
                                                            <div class="">
                                                                <p style="font-weight: 500; font-size:14px; color: red;">
                                                                    USD $ <span id="sherpatotal">0</span>
                                                                </p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            
                                            <div class="row up-row col-container">
                                                <div class=" card-panel hoverable col-content">   
                                                    <div class="row">
                                                        <div class="col l3 m3 s12 center-align" style="margin: 8px 0px;">
                                                           <p> Room(s): </p>
                                                        </div>

                                                        <div class="col l3 m3 s12 center-contents" style="">
                                                            <div class="value-button roomsdown" id="decrease" onclick="roomdown()">
                                                                <i class='material-icons'>exposure_neg_1</i>
                                                            </div>
                                                            <input type="text" id="rooms" name="porter" readonly autocomplete="off"
                                                                   class="rooms" value="1"
                                                                   style="width: 40px; text-align: center; color: black"/>
                                                            <div class="value-button roomsup" id="increase" onclick="roomup()">
                                                                <i class='material-icons'>exposure_plus_1</i>
                                                            </div>
                                                        </div>

                                                        <div class="col l3 m3 s12 ">
                                                            
                                                        </div>

                                                        
                                                        <div class="col l3 m3 s12">
                                                            <div class="center-align">
                                                                <p style="font-weight: 500; font-size:14px; color: red;">
                                                                    USD $ <span id="sabairoom" data-facet-value="0">0</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col l3 m3 s12 center-align">
                                                            <div>
                                                              <p> Hotel/Accomodation(s): </p>
                                                            </div>
                                                        </div>


                                                        <div class="col l3 m3 s12 roomsStarSection">
                                                            <div class="input-field ">
                                                                <div style="display: flex;justify-content: center;
                                                                flex-direction: row-reverse;margin-top:-35px;">
                                                                    <input class="star star-5" id="staff-star-5" type="radio" name="basai" value="5"/>
                                                                    <label class="star star-5" for="staff-star-5"></label>
                                                                    <input class="star star-4" id="staff-star-4" type="radio" name="basai" value="4"/>
                                                                    <label class="star star-4" for="staff-star-4"></label>
                                                                    <input class="star star-3" id="staff-star-3" type="radio" name="basai" value="3" checked/>
                                                                    <label class="star star-3" for="staff-star-3"></label>
                                                                    <input class="star star-2" id="staff-star-2" type="radio" name="basai" value="2" />
                                                                    <label class="star star-2" for="staff-star-2"></label>
                                                                    <input class="star star-1" id="staff-star-1" type="radio" name="basai" value="1" required/>
                                                                    <label class="star star-1" for="staff-star-1"></label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col l3 m3 s12 center-align">
                                                            <div>
                                                                <p style="font-weight: 500; color: teal;">
                                                                    USD $ <span id="accom">{{$star_3}}  (per room)</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>


                                            @if($trip->customtrip->public_cost != null or $trip->customtrip->public_cost !=0 &&
                                            $trip->customtrip->private_cost != null or $trip->customtrip->private_cost !=0  &&
                                            $trip->customtrip->flight_cost != null or $trip->customtrip->flight_cost !=0 )
                                            
                                            <div class="row up-row col-container">
                                                <div class=" card-panel hoverable col-content">
                                                    <div class="row">
                                                        <div class="col l3 m3 s12 center-align">
                                                            <div style="">
                                                              <p>  Transportation Option(s): </p>
                                                            </div>
                                                        </div>
                                                        <div class="col l3 m3 s12  center-contents" >
                                                            <div class="input-field" id="customTripSelect" style="margin:0px;margin-bottom:-10px;">
                                                                <select class="changeStatus" name="changeStatus" required
                                                                        autocomplete="off" style="border: 2px solid gray;">
                                                                    <option value="public">Public Vehicle</option>
                                                                    <option value="private" selected>Private Vehicle</option>
                                                                    <option value="flight">Flight</option>
                                                                </select> <br>
                                                            </div>
                                                        </div>
                                                        <div class="col l3 m3 s12 center-align">
                                                        </div>
                                                        
                                                        <div class="col l3 m3 s12 center-align">
                                                            <div class="">
                                                                <p style="font-weight: 500; font-size:14px; color: red;">
                                                                    USD $ <span id="transport" data-facet-value="0">{{$private}}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                                    
                                            @if($trip->customtrip->citytour_cost != null   && $trip->customtrip->citytour_cost !=0)
                                            <div class="row up-row col-container">
                                                <div class=" card-panel hoverable col-content">
                                                    <div class="row">
                                                        <div class="col l3 m3 s12 center-align">
                                                          <p> City Tour </p>
                                                        </div>

                                                        <div class="col l6 m6 s12 center-contents" style="" id="cityTour"> <br>
                                                            <p>
                                                         
                                                               <span>
                                                                   <input type="radio" name="tour" class="filled-in" id="filled-in-box"
                                                                          checked="checked" value="1"/>
                                                                   <label for="filled-in-box"><span
                                                                               style="margin-left: -12px;">Include</span></label>
                                                               </span>

                                                                <span>
                                                                    <input type="radio" name="tour" class="filled-in" id="filled-in-box1"
                                                                           value="0"/>
                                                                    <label for="filled-in-box1"><span style="margin-left: -12px; text-align: left;">Don't Include</span></label>
                                                                </span>
                                                            </p>

                                                        </div>

                                                        <div class="col l3 m3 s12 center-align">
                                                            <div class="">
                                                                <p style="font-weight: 500; font-size:14px; color: red;">
                                                                    USD $ <span id="citytour" data-facet-value="0">0</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if($trip->customtrip->meals_cost != null && $trip->customtrip->meals_cost !=0)
                                            <div class="row up-row col-container">
                                                <div class=" card-panel hoverable col-content">
                                                    <div class="row">
                                                    <div class="col l3 m3 s12 center-align">
                                                      <p> Meals </p>
                                                    </div>

                                                    <div class="col l6 m6 s12 center-contents">
                                                        <p>
                                                            <span>
                                                                <input type="radio" name="meals" class="filled-in1" id="mealsIncluded" checked="checked" value="1"/>
                                                                <label for="mealsIncluded"><span style="margin-left: -12px;">Included</span></label>
                                                            </span>

                                                             <span>
                                                                 <input type="radio" name="meals" class="filled-in1" id="mealsNotIncluded" value="0"/>
                                                                 <label for="mealsNotIncluded"><span style="margin-left: -12px;">Don't Include</span></label>
                                                             </span>
                                                        </p>
                                                       
                                                    </div>

                                                    <div class="col l3 m3 s12 center-align">
                                                        <div class="">
                                                            <p style="font-weight: 500; font-size:14px; color: red;">
                                                                USD $ <span id="meals" data-facet-value="0"></span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="custom-header" style="paddin:2px;">
                                                <div class="row">

                                                    <div class="col l4 m4 s12 payableSmallScreen" style="margin-top: -10px;" >
                                                        <p style="font-size: 17px;color:white;">
                                                            Total Payable: USD $ <span class="grandtotal"></span>
                                                        </p>
                                                    </div>

                                                    <div class="col l8 m8 s12" style="text-align: center;">
                                                        <input type="hidden" name="trip_id" value="{{$trip->id}}">
                                                        <input type="hidden" name="extraprice" class="extraprice">
                                                        <input type="hidden" name="alltotal" class="totalprice">
                                                        <button type="submit" class="btn btn-default" style="background-color: #4B4B4B;">BOOK</button> 
                                                    </div>

                                                    <div class="col l4 m4 s12 payableLargeScreen" >
                                                        <p style="font-size: 17px;color:white;">
                                                            Total Payable: USD $ <span class="grandtotal"></span>
                                                        </p>
                                                    </div>

                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="clear:both;"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div> 

                <div class="col l4 m4 s12 ">
                    <div class="customTripRightpart customPanelContent">
                        <div class="panelContainer customOriginalLgScreen">
                            <div class="customPanelTitle">
                                <h2> Original Inclusions: </h2>
                            </div>

                            <div class="customPanelBody">
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
                                        <span style="">
                                            <i class="material-icons">star</i><i class="material-icons">star</i><i
                                                    class="material-icons">star</i>
                                            <i class="material-icons">star_border</i><i class="material-icons">star_border</i>
                                            </span>
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
                            </div>
                        </div>

                        <div class="panelContainer">
                            <div class="customPanelTitle">
                                <h2> Important Notes: </h2>
                            </div>

                            <div class="customPanelBody">
                                <div id="#importantNote" style="font-size: 12px;">
                                    <div>
                                        * Group discount is applicable only in case of <b>Original Trip </b> or <b>Total
                                            Payable </b> equal or above the <b>Original Trip Price </b>
                                    </div> <hr>
                                    <div>
                                        *
                                        @if($trip->customtrip->porter_cost != null && $trip->customtrip->porter_cost !=0)
                                            The client-porter ratio is {{$porterratio}}.
                                        @endif
                                        @if($trip->customtrip->guide_cost != null && $trip->customtrip->porter_cost !=0)
                                            The client-trekking guide ratio is {{$guideratio}}
                                        @endif
                                    </div> <hr>
                                    <div>
                                        * City tours include all the entrance fees, guide, and private transfer
                                    </div> <hr>
                                    <div>
                                        * The weight limit for each porter is 15 KG and it is strictly applied in all cases.
                                    </div> <hr>
                                    <div>
                                        *Accommodation ratings/price applies only for the hotel/s in the cities, not in
                                        trekking regions.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            
        </div>
    </div>

    @include('layouts.footer1')
@endsection
@section('scripts')
    <script>
        //for mobile response
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

        $(document).ready(function () {
            $('select').material_select();
        });

        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 30,
            format: 'yyyy-mm-dd',
            min: new Date(),
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: true /// Creates a dropdown of 15 years to control year
        });
        var a = true;

        function checkDate() {
            if ($("#startdate").val() == '') {
                $("#startdate").addClass('invalid');
                document.getElementById('warndate').innerText = "Please enter date";
                a = false;
                return a;
            } else {
                $("#startdate").removeClass('invalid');
                a = true;
                return a;
            }
        }

        $('form').submit(function () {
            checkDate();
            return a;
        });

        //codes for custom trips js
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

        //for people
        function peopledown() {
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

        //for people's price
        $(document).on('click', '.price', (function (e) {
            var number = $('#count').val();
//          alert("person:"+number);
            var now_transport = $('select.changeStatus').val();
//            alert('nowwwww'+now_transport);
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
//                     alert(data.join(' '));
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
//                alert('public' + transport);
                katijana(basne);
            }
            else if (data1 === 'private') {
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
//            alert('katijan'+po);
            var p = Math.ceil(po / 2);
//            alert('p' + p);
//            alert('data' + data);
//            alert('default' + defaultaccomodation);
            if (data != defaultaccomodation) {
//                alert('i am true');
                roomsup = ((data - defaultaccomodation) * p);
                roomsdown = 0;
                $('#sabairoom').html(roomsup);
                finalcall();
            } else {
//                alert('i ma false');
                roomsup = 0;
                roomsdown = 0;
                finalcall();
            }
            return false;
        }

        //for porters
        function pordown() {
            var number = parseInt(document.getElementById('count1').value);
//            alert(number);
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
//            alert('number'+number);
            var dporter = defaultporter;
//            alert('porter'+dporter);
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async: false,
                url: '/porterpriceup',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'defaultporter': dporter,
                    'number': number,
                    'tripid': "{{$trip->id}}"
                },
                success: function (data) {
//                    alert(data.join(' '));
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
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'defaultporter': dporter,
                    'number': number,
                    'tripid': "{{$trip->id}}"
                },
                success: function (data) {
                   // alert(data.join(' '));
                    porterdown = data[2];
                    porterup = 0;
                    $('#portertotal').html(data[2]);
                    finalcall();
                }
            });
        }));

        //for assistant
        function assisdown() {
            var number = parseInt(document.getElementById('assistant').value);
//            alert(number);
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
//            alert(number1);
            var number = number + 1;
            $('.assistant').val(number);
        }

        $(document).on('click', '.assistantup', (function (e) {
            var number = $('#assistant').val();
            var dassistant = defaultassistant;
//            alert('dassistant'+ dassistant);
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async: false,
                url: '/assistantup',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'defaultassistant': dassistant,
                    'number': number,
                    'tripid': "{{$trip->id}}"
                },
                success: function (data) {
//                    alert(data.join(' '));
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
//            alert('dassistant'+ dassistant);
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async: false,
                url: '/assistantdown',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'defaultassistant': dassistant,
                    'number': number,
                    'tripid': "{{$trip->id}}"
                },
                success: function (data) {
//                    alert(data.join(' '));
                    assistantdown = data[2];
                    assistantup = 0;
                    $('#assistanttotal').html(data[2]);
                    finalcall();
                }
            });
        }));

        //for guide
        function guidown() {
            var number = parseInt(document.getElementById('guide').value);
//            alert(number);
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
//            alert(number1);
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
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'defaultguide': dguide,
                    'number': number,
                    'tripid': "{{$trip->id}}"
                },
                success: function (data) {
//                    alert(data);
                    guideup = data[2];
                    guidedown = 0;
                    $('#guidetotal').html(data[2]);
                    finalcall();
                }
            });
        }));

        $(document).on('click', '.guidedown', (function (e) {
            var number = $('#guide').val();
//            alert(number);
            var dguide = defaultguide;
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async: false,
                url: '/guidedown',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'defaultguide': dguide,
                    'number': number,
                    'tripid': "{{$trip->id}}"
                },
                success: function (data) {
//                    alert(data.join(' '));
                    guidedown = data[2];
                    guideup = 0;
                    $('#guidetotal').html(data[2]);
                    finalcall();
                }
            });
        }));

        //for sherpa
        function sherdown() {
            var number = parseInt(document.getElementById('sherpa').value);
//            alert(number);
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
//            alert(number1);
            var number = number + 1;
            $('.sherpa').val(number);
        }

        $(document).on('click', '.sherpaup', (function (e) {
            var number = $('#sherpa').val();
//            alert(number);
            var dsherpa = defaultsherpa;
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async: false,
                url: '/sherpaup',
                data: {
//                    '_method': 'post',
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
//                    '_method': 'post',
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

        //for rooms number
        function roomdown() {
            var number = parseInt(document.getElementById('rooms').value);
//            alert(number);
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
           // alert('rooms----->'+roomnumber);
            var droom = defaultroom;
            var manche = $('#count').val();
           // alert('mance---->'+ manche);
           // alert('defaultroom'+droom);
            var currentprice = parseInt($('#accom').html());
//            alert('currentpaisa'+currentprice);
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async: false,
                url: '/roomup',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'paisa': currentprice,
                    'manche': manche,
                    'defaultstar': defaultaccomodation,
                    'defaultroom': droom,
                    'roomnumber': roomnumber
                },
                success: function (data) {
                   // alert(data.join('--'));
                    roomsup = data[1];
                    roomsdown = 0;
                    $('#sabairoom').html(data[1]);
                    finalcall();
                }
            });
        }));

        $(document).on('click', '.roomsdown', (function (e) {
            var roomnumber = $('#rooms').val();
           // alert('roomnumber----->'+roomnumber);
            var droom = defaultroom;
           // alert('defaultroom----->'+droom);
            var manche = $('#count').val();
           // alert('mance---->'+ manche);
            var currentprice = parseInt($('#accom').html());
           // alert('currentprice---->'+currentprice);
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async: false,
                url: '/roomdown',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'defaultstar': defaultaccomodation,
                    'paisa': currentprice,
                    'manche': manche,
                    'defaultroom': droom,
                    'roomnumber': roomnumber
                },
                success: function (data) {
                   // alert(data.join(' '));
                    roomsdown = data[1];
                    roomsup = 0;
                    $('#sabairoom').html(data[1]);
                    finalcall();
                }
            });
        }));
        //for acccomodation ratings
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
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'value': value,
                    'currentpeople': manche,
                    'room': room,
                    'defaultroom': droom,
                    'tripid': "{{$trip->id}}"
                },
                success: function (data) {
//                    alert(data.join('-'));
                    roomsdown = data[1];
                    roomsup = 0;
                    $('#accom').html(data[0]);
                    $('#sabairoom').html(data[1]);
                    finalcall();
                }
            });
        }));

        //for transportation
        $('select.changeStatus').change(function () {
            var currentpeople = $('#count').val();
            $.ajax({
                type: 'GET',
                async: false,
                url: '/transport', // This is the url that will be requested
                data: {
                    transport: $('select.changeStatus').val(),
                    'currentpeople': currentpeople,
                    'tripid': "{{$trip->id}}"
                },
                success: function (data) {
//                    alert(data.join(' '));
                    $('#transport').html(data[2]);
                    transportsabai(data[1]);
                }
            });

        });
        //for city tour
        $(document).on('change', '.filled-in', (function () {
            var value = $('input[name=tour]:checked').val();
//            alert(value);
            var currentpeople = $('#count').val();
//            alert(currentpeople);
            $.ajax({
                type: 'post',
                async: false,
                url: '/tour',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'currentpeople': currentpeople,
                    'value': value,
                    'tripid': "{{$trip->id}}"
                },
                success: function (data) {
//                    alert(data.join(' '));
                    tour = data[0];
                    $('#citytour').html(data[1]);
                    finalcall();
                }
            });
        }));
        //for meals price
        $(document).on('change', '.filled-in1', (function () {
            var value = $('input[name=meals]:checked').val();
            var currentpeople = $('#count').val();

            $.ajax({
                type: 'post',
                async: false,
                url: '/meal',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'currentpeople': currentpeople,
                    'value': value,
                    'tripid': "{{$trip->id}}"
                },
                success: function (data) {
//                    alert(data.join(' '));
                    meals = data[0];
                    $('#meals').html(data[1]);
                    finalcall();
                }
            });
        }));


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
            var t = tour;
            var m = meals;
            var porters = parseInt(pu + pd);
            var assistants = parseInt(au + ad);
            var guides = parseInt(gu + gd);
            var sherpas = parseInt(su + sd);
            var accomodations = parseInt(ru + rd);

            var netchanges = tr + t + m + porters + assistants + guides + sherpas + accomodations;

            var grandtotal = pp + netchanges;
            x=document.getElementsByClassName("grandtotal");
            for(var i = 0; i < x.length; i++){
               x[i].innerText=grandtotal;    // Change the content
            }

            $('.totalprice').val(grandtotal);
            $('.extraprice').val(netchanges);

        }
    </script>
@endsection