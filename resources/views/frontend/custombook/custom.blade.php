@extends('layouts.master')
@section('title')
    <title>Customize trips</title>
@endsection
@section('metatags')
    {{--Here goes all the meta information for index page--}}
@endsection
{{--End of meta tags--}}
{{--External css--}}
@section('styles')
    <link rel="stylesheet" href="{{url('css/frontend/booking.min.css')}}">
    <link rel="stylesheet" href="{{url('css/customtrip.min.css')}}">
@endsection
@section('content')
    {{--Navbar--}}
    @include('layouts.navbar2')
    <br>
    <div class="clear"></div>
    <div class="booking clear">
        <div class="container">
            <div class = "title-wrapper">
                  <span class="title teal">
                      <strong class ="flow-text">Trip Customization:{{$trip->name}}</strong><!--Padding is optional-->
                  </span>
            </div>
            <div class="clear"></div>
            <div class="card white" style="margin-top:20px">
                <form action="/custombook/step2" method="post">
                <div class="row">
                    {{--first row--}}
                    <div class="col l12 s6 m12">
                        <div class="col l4 m6 s12">
                            <div class="card-panel hoverable">
                                Trip Date:
                                <div class="input-field" style="margin-top: 0.7rem;">
                                    <input id = "startdate" type="date"  name = "startdate" class="datepicker" required>
                                    <label for="startdate">Select Date</label>
                                </div>
                            </div>
                            <div id="warndate"></div>
                        </div>
                        <div class="col l4 m6 s12">
                            <div class="card-panel hoverable">
                                <div class="row">
                                    <div class="col l3 m6 s12">
                                        <div style="margin-top: 8px">
                                            Per People
                                            <br>
                                            <div style="font-weight: 500; color: teal;">
                                                USD $ {{$trip->price}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col l6 m6 s12">
                                        <div class="value-button price" id="decrease" onclick="down()">
                                            <i class='material-icons'>exposure_neg_1</i>
                                        </div>
                                        <input type="text" id="count" max="14" name="people" readonly autocomplete="off"
                                               class="counter" value="0" style="width: 40px; text-align: center; color: black"/>

                                        <div class="value-button price" id="increase" onclick="up()">
                                            <i class='material-icons'>exposure_plus_1</i>
                                        </div>
                                    </div>
                                    <div class="col l3 m6 s12">
                                        <div>
                                            <div style="font-weight: 500; font-size:14px; color: red;">
                                                USD $ <span id="pricetotal" value="0"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col l12 m12 s12" id="dherai" style="display: none">Cannot exceed more than 14</div>
                                 </div>
                            </div>
                        </div>
                        <div class="col l4 m6 s12" id="hideme" style="display:none">
                            <div class="card-panel hoverable">
                                <div class="row">
                                <div class="col l3 m6 s12">
                                    Porter
                                    <br>
                                    <div style="font-weight: 500; color: teal;">
                                        USD $ {{ $trip->customtrip->porter_cost }}
                                    </div>
                                </div>
                                <div class="col l5 m6 s12">
                                    <div class="value-button porterdown" id="decrease" onclick="down1()">
                                        <i class='material-icons'>exposure_neg_1</i>
                                    </div>
                                    <input type="text" id="count1" name="porter" readonly autocomplete="off"
                                           class="counter1" value="0" style="width: 40px; text-align: center; color: black"/>
                                    <div class="value-button porterup" id="increase" onclick="up1()">
                                        <i class='material-icons'>exposure_plus_1</i>
                                    </div>
                                </div>
                                {{--<div class="col l4 m6 s6">--}}
                                    {{--<div class="">--}}
                                        {{--<div style="font-weight: 500; font-size:14px; color: red;">--}}
                                            {{--USD $ <span id="portertotal" >{{ $trip->customtrip->porter_cost }}</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            </div>
                        </div>
                    </div>
                    {{--row finish--}}
                    {{--second row--}}
                    <div id="hideme1" style="display:none"> {{--yeslai hide garne paila--}}
                    <div class="col l12 s6 m12">
                        <div class="col l4 m6 s12">
                            <div class="card-panel hoverable">
                                <div class="row">
                                    <div class="col l3 m6 s12">
                                        <div style="margin-top: 17%">
                                            Transportation Options:</h5>
                                        </div>
                                    </div>
                                    <div class="col l5 m6 s12">
                                        <div class="input-field col s12">
                                            <select class="changeStatus" name = "changeStatus" required autocomplete="off">
                                                <option value="public">Public Vehicle</option>
                                                <option value="private" selected>Private Vehicle</option>
                                                @if($trip->customtrip->flight_cost !=null or $trip->customtrip->flight_cost !=0)
                                                <option value = "flight">Flight</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s6">
                                        <div class="">
                                            <div style="font-weight: 500; font-size:14px; color: red;">
                                                USD $ <span id="transport" data-facet-value="0">{{$trip->customtrip->private_cost}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col l4 m6 s12">
                            <div class="card-panel hoverable">
                                <div class="row">
                                    <div class="col l2 m6 s12">
                                        <div>
                                            Rooms in [2:1]
                                        </div>
                                    </div>
                                    <div class="col l10 m6 s12">
                                        <div class="value-button roomsdown" id="decrease" onclick="roomdown()">
                                            <i class='material-icons'>exposure_neg_1</i>
                                        </div>
                                        <input type="text" id="rooms" name="rooms" readonly autocomplete="off"
                                               class="rooms" value="0" style="width: 40px; text-align: center; color: black"/>
                                        <div class="value-button roomsup" id="increase" onclick="roomup()">
                                            <i class='material-icons'>exposure_plus_1</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col l4 m6 s12">
                            <div class="card-panel hoverable">
                                <div class="row">
                                    <div class="col l0 m6 s12">
                                        <div style="top:0">
                                            Accomodation:
                                        </div>
                                    </div>
                                    <div class="col l8 m8 s12">
                                        <div class="input-field col s12">
                                            <input class="star star-5" id="staff-star-5" type="radio" name="basai" value = "5"/>
                                            <label class="star star-5" for="staff-star-5"></label>

                                            <input class="star star-4" id="staff-star-4" type="radio" name="basai" value = "4"/>
                                            <label class="star star-4" for="staff-star-4"></label>

                                            <input class="star star-3" id="staff-star-3" type="radio" name="basai" value = "3" checked/>
                                            <label class="star star-3" for="staff-star-3"></label>

                                            <input class="star star-2" id="staff-star-2" type="radio" name="basai" value = "2"/>
                                            <label class="star star-2" for="staff-star-2"></label>

                                            <input class="star star-1" id="staff-star-1" type="radio" name="basai" value = "1" required/>
                                            <label class="star star-1" for="staff-star-1"></label>
                                        </div>
                                    </div>
                                    <div class="col l4 m4 s6">
                                        <div class="">
                                            <div style="font-weight: 500; font-size:14px; color: red;">
                                                USD $ <span id="accomodation" data-facet-value="0">{{$star_3}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col l4 m6 s12">
                            <div class="card-panel hoverable">
                                <div class="row">
                                    <div class="col l3 m6 s12">
                                        City Tour
                                    </div>
                                    <div class="col l5 m6 s12">
                                        <span>
                                            <input type="radio" name="tour" class="filled-in" id="filled-in-box" checked="checked" value="1"/>
                                            <label for="filled-in-box">Included</label>
                                        </span>
                                        <span>
                                            <input type="radio" name="tour" class="filled-in" id="filled-in-box1" value="0"/>
                                            <label for="filled-in-box1">Don't Include</label>
                                        </span>
                                    </div>
                                    <div class="col l4 m6 s6">
                                        <div class="">
                                            <div style="font-weight: 500; font-size:14px; color: red;">
                                                USD $ <span id="citytour" class="citytour">{{$citytour}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--third row--}}
                    <div class="col l12 s6 m12">
                        @if($trip->customtrip->guide_cost != null or $trip->customtrip->guide_cost !=0)
                            <div class="col l4 m6 s12">
                                <div class="card-panel hoverable">
                                    <div class="row">
                                        <div class="col l3 m6 s12">
                                            Guide
                                            <br>
                                            <div style="font-weight: 500; color: teal;">
                                                USD $ {{ $trip->customtrip->guide_cost }}
                                            </div>
                                        </div>
                                        <div class="col l5 m6 s12">
                                            <div class="value-button guidedown" id="decrease" onclick="down3()">
                                                <i class='material-icons'>exposure_neg_1</i>
                                            </div>
                                            <input type="text" id="count3" name="porter" readonly autocomplete="off"
                                                   class="counter3" value="1" style="width: 40px; text-align: center; color: black"/>
                                            <div class="value-button guideup" id="increase" onclick="up3()">
                                                <i class='material-icons'>exposure_plus_1</i>
                                            </div>
                                        </div>
                                        <div class="col l4 m6 s6">
                                            <div class="">
                                                <div style="font-weight: 500; font-size:14px; color: red;">
                                                    USD $ <span id="guidetotal">{{ $trip->customtrip->guide_cost }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($trip->customtrip->sherpa_cost != null or $trip->customtrip->sherpa_cost !=0)
                            <div class="col l4 m6 s12">
                                <div class="card-panel hoverable">
                                    <div class="row">
                                        <div class="col l3 m6 s12">
                                            <div style="margin-top: 8px">
                                                Sherpa
                                                <br>
                                                <div style="font-weight: 500; color: teal;">
                                                    USD $ {{ $trip->customtrip->sherpa_cost }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col l5 m6 s12">
                                            <div class="value-button sherpadown" id="decrease" onclick="down4()">
                                                <i class='material-icons'>exposure_neg_1</i>
                                            </div>
                                            <input type="text" id="count4" name="sherpa" readonly autocomplete="off"
                                                   class="counter4" value="1" style="width: 40px; text-align: center; color: black"/>

                                            <div class="value-button sherpaup" id="increase" onclick="up4()">
                                                <i class='material-icons'>exposure_plus_1</i>
                                            </div>
                                        </div>
                                        <div class="col l4 m6 s12">
                                            <div class="">
                                                <div style="font-weight: 500; font-size:14px; color: red;">
                                                    USD $ <span id="sherpatotal">{{ $trip->customtrip->sherpa_cost }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($trip->customtrip->assistant_cost != null or $trip->customtrip->assistant_cost !=0)
                            <div class="col l4 m6 s12">
                                <div class="card-panel hoverable">
                                    <div class="row">
                                        <div class="col l3 m6 s12">
                                            Assistant
                                            <br>
                                            <div style="font-weight: 500; color: teal;">
                                                USD $ {{ $trip->customtrip->assistant_cost}}
                                            </div>
                                        </div>
                                        <div class="col l5 m6 s12">
                                            <div class="value-button assistantdown" id="decrease" onclick="down5()">
                                                <i class='material-icons'>exposure_neg_1</i>
                                            </div>
                                            <input type="text" id="count5" name="porter" readonly autocomplete="off"
                                                   class="counter5" value="1" style="width: 40px; text-align: center; color: black"/>
                                            <div class="value-button assistantup" id="increase" onclick="up5()">
                                                <i class='material-icons'>exposure_plus_1</i>
                                            </div>
                                        </div>
                                        <div class="col l4 m6 s6">
                                            <div class="">
                                                <div style="font-weight: 500; font-size:14px; color: red;">
                                                    USD $ <span id="assistanttotal">{{ $trip->customtrip->assistant_cost}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    </div>
                </div>
                    {{--end third row--}}
                    <div class="custom-header" style="color: white; margin-top: -30px;">
                        <div class="row">
                            <div class="col l4 s6 s12 center-align">
                                Starts from <br>
                                <strong>US$ {{$trip->price}} </strong>per person
                            </div>
                            <div class="col l4 s6 s12 center-align">
                                <span><strong style="font-size: 20px">
                                        Total: US $  <span id="grouptotal">0</span>
                                        +<span id="others">(0)</span> + <span id='tran'>(0)</span>
                                        + <span id='accom'>(0)</span> + <span id='tmor'>(0)</span>
                                        + <span id='guid'> gu(0) </span>
                                        = $ <span id="grandtotal"> </span>
                                    </strong>
                                </span>
                            </div>
                            <div class="col l4 s6 s12">
                                <input type="hidden" name="trip_id" value="{{$trip->id}}">
                                <input type="hidden" name="alltotal"  class="totalprice">
                                <button type="submit" class="btn btn-default" style="float: right">BOOK NOW</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.footer1')
@endsection
@section('scripts')
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}
    <script src="{{url('js/jquery.min.js')}}"></script>
    <script>
        $( document ).ready(function() {
            $('select').material_select();
        });

    </script>
    <script> $113 = jQuery.noConflict();</script>
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>--}}
    <script src="{{url('js/materialize.js')}}"></script>
    <script>
        $113('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 30,
            format: 'yyyy-mm-dd',
            min:new Date(),
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: true /// Creates a dropdown of 15 years to control year
        });

        var a=true;
        function checkDate(){
            if ($("#startdate").val()==''){
                $("#startdate").addClass('invalid');
                document.getElementById('warndate').innerText = "Please enter date";
                a=false;
                return a;
            }else{
                $("#startdate").removeClass('invalid');
                a=true;
                return a;
            }
        }
        $('form').submit(function(){
            checkDate();
            return a;
        });

        var personprice = null;
        var person = 0;
        var defaultporter=0;
        var defaultguide=0;
        var defaultroom = 0;
        var private_price = "{{$trip->customtrip->private_cost}}";
        var public_price = "{{$trip->customtrip->public_cost}}";
        var flight_price = "{{$trip->customtrip->flight_cost}}";
        var defaultaccomodation = "{{$star_3}}";
        var porterup = 0;
        var roomsup = 0;
        var porterdown = 0;
        var roomsdown = 0;
        var guideup = 0;
        var guidedown = 0;
        var sherpaup = 0;
        var sherpadown = 0;
        var assistantup = 0;
        var assistantdown = 0;
        var tour = 0;
        var t = null;
        var room = 0;
        var accomodation = 0;
        var transport = 0;
        var total=0;


        function down() {
            var number = parseInt(document.getElementById('count').value);
            var number = number - 1;
            if (number < 0){
                number = 0;
            }
           if (number<=13){
                document.getElementById('dherai').style.display = 'none';
            }
            $('.counter').val(number);
            if(number === 0){
                document.getElementById('hideme').style.display = 'none';
                document.getElementById('hideme1').style.display = 'none';
            }
        }
        function up(){
            var number = parseInt(document.getElementById('count').value);
            var number = number + 1;
            if(number > 14){
                number = 14;
                document.getElementById('dherai').style.display = 'block';
            }else {
                document.getElementById('dherai').style.display = 'none';
            }
            $('.counter').val(number);
            if(number >= 1){
                document.getElementById('hideme').style.display = 'block';
                document.getElementById('hideme1').style.display = 'block';
            }else{
                document.getElementById('hideme').style.display = 'none';
                document.getElementById('hideme1').style.display = 'none';

            }
        }

        $(document).on('click', '.price', (function (e) {
            var number = $('#count').val();
            var now_transport = $('select.changeStatus').val();
//            alert('nowwwww'+now_transport);
            var value = $('input[name=tour]:checked').val();
            var basne = parseInt(document.getElementById('accomodation').innerText);
//            alert('fdsfs'+basne);
            if (e.originalEvent.defaultPrevented) return;
                $.ajax({
                    type: 'post',
                    async:false,
                    url: '/groupdiscount',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'number': number,
                        'value': value,
                        'tripid': "{{$trip->id}}"
                    },
                    success: function (data) {
//                        alert(data);
                        personprice = data[2];
                        defaultporter = data[3];
                        defaultguide = data[7];
                        defaultroom = data[6];
                        person = data[0];
                        porterdown = 0;
                        roomsdown = 0;
                        porterup = 0;
                        roomsup = 0;
                        tour  = data[4];
                        $('#pricetotal').html(data[2]);
                        $('.counter1').val(data[3]);
                        $('.rooms').val(data[6]);
                        $('.counter3').val(data[7]);
                        document.getElementById('citytour').innerText = data[5];

//                        alert(person);
                    }
                });
        }));

//        function gopal(){
//            alert('i am gopal');
//            mohan();
//        }

        function down1() {
            var number = parseInt(document.getElementById('count1').value);
//            alert(number);
            var number = number - 1;
            if (number < 0){
                number = 0;
            }
            $('.counter1').val(number);

        }
        function up1(){
            var number = parseInt(document.getElementById('count1').value);
            var number = number + 1;
            $('.counter1').val(number);
        }
        function roomdown() {
            var number = parseInt(document.getElementById('rooms').value);
//            alert(number);
            number = number - 1;
            if (number < 0){
                number = 0;
            }
            $('.rooms').val(number);

        }
        function roomup(){
            var number = parseInt(document.getElementById('rooms').value);
            number = number + 1;
            $('.rooms').val(number);
        }

        $(document).on('click', '.porterup', (function (e) {
            var number = $('#count1').val();
//            alert('number'+number);
            var dporter = defaultporter;
//            alert('porter'+dporter);
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async:false,
                url: '/porterpriceup',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'defaultporter': dporter,
                    'number': number,
                    'tripid':"{{$trip->id}}"
                },
                success: function (data) {
//                    alert(data.join(' '));
                    porterup = data[2];
                    porterdown = 0;
                    $('#portertotal').html(data[2]);
                    mohan();
                }
            });
        }));
//
//        function  gita(data) {
////          alert(data);
//          if (data == '1') {
//              total = parseInt(document.getElementById('grandtotal').innerText);
////              alert('vitra' + total);
//          }else{
//            total = groupprice;
////            alert('baira'+ total);
//          }
//          mohan();
//        }

        $(document).on('click', '.porterdown', (function (e) {
            var number = $('#count1').val();
            var dporter = defaultporter;
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async:false,
                url: '/porterpricedown',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'defaultporter': dporter,
                    'number': number,
                    'tripid': "{{$trip->id}}"
                },
                success: function (data) {
//                    alert(data.join(' '));
                    porterdown = data[2];
                    porterup = 0;
                    mohan();
                }
            });
        }));

        $('select.changeStatus').change(function(){
            var currentpeople = $('#count').val();
            $.ajax({
                type: 'GET',
                async:false,
                url: '/transport', // This is the url that will be requested
                data: {
                    transport: $('select.changeStatus').val(),
                    'currentpeople': currentpeople,
                    'tripid':"{{$trip->id}}"
                },
                success: function(data){
//                    alert(data.join(' '));
                    $('#transport').html(data[2]);
                    transportsabai(data[1]);
                }
            });

        });
        function transportsabai(data1) {
            var p = person;
            if (data1 === 'public') {
                transport = (public_price - private_price) * p;
//                alert('public' + transport);
                mohan();
            }
            else if(data1 === 'private')
            {
                transport = 0;
                mohan();
            }else {
                transport = (flight_price - private_price) * p;
                mohan();
            }
        }


        $(document).on('change', '.star', (function () {
            var value = $('input[name=basai]:checked').val();
//            alert('valueee---->'+value);
            var room  = $('#rooms').val();
//            alert('room--->'+room);
            var manche = $('#count').val();
//            alert('mance---->'+ manche);
            var droom = defaultroom;
//            alert('droom'+droom);
            $.ajax({
                type: 'post',
                aysnc:false,
                url: '/accomodation',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'value': value,
                    'currentpeople': manche,
                    'room':room,
                    'defaultroom': droom,
                    'tripid':"{{$trip->id}}"
                },
                success: function (data) {
                    alert(data.join(','));
                    roomsdown = data[1];
                    roomsup = 0;
                    $('#accomodation').html(data[0]);
//                    alert('mohhss'+roomsdown);
                    mohan();
                }
            });
        }));

        $(document).on('click', '.roomsup', (function (e) {
            var roomnumber = $('#rooms').val();
//            alert('rooms----->'+roomnumber);
            var droom = defaultroom;
            var manche = $('#count').val();
//            alert('mance---->'+ manche);
//            alert('defaultroom'+droom);
            var currentprice = parseInt($('#accomodation').html());
//            alert('currentpaisa'+currentprice);
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async:false,
                url: '/roomup',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'paisa': currentprice,
                    'manche':manche,
                    'defaultstar':defaultaccomodation,
                    'defaultroom':droom,
                    'roomnumber': roomnumber
                },
                success: function (data) {
//                    alert(data.join('--'));
                    roomsup = data[1];
                    roomsdown = 0;
                    mohan();
                }
            });
        }));

        $(document).on('click', '.roomsdown', (function (e) {
            var roomnumber = $('#rooms').val();
//            alert('roomnumber----->'+roomnumber);
            var droom = defaultroom;
//            alert('defaultroom----->'+droom);
            var manche = $('#count').val();
//            alert('mance---->'+ manche);
            var currentprice = parseInt($('#accomodation').html());
//            alert('currentprice---->'+currentprice);
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async:false,
                url: '/roomdown',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'defaultstar':defaultaccomodation,
                    'paisa': currentprice,
                    'manche':manche,
                    'defaultroom':droom,
                    'roomnumber': roomnumber
                },
                success: function (data) {
//                    alert(data.join(' '));
                    roomsdown = data[1];
                    roomsup = 0;
                    mohan();
                }
            });
        }));

        function katijana(data) {
            var po = person;
            var p = Math.ceil(po / 2);

            if(data != defaultaccomodation) {
                roomsup = ((data - defaultaccomodation) * p);
                roomsdown = 0;
                mohan();
            }else{
                roomsup = 0;
                roomsdown = 0;
                mohan();
            }
        }

        $(document).on('change', '.filled-in', (function () {
            var value = $('input[name=tour]:checked').val();
//            alert(value);
            var currentpeople = $('#count').val();
//            alert(currentpeople);
            $.ajax({
                type: 'post',
                async:false,
                url: '/tour',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'currentpeople':currentpeople,
                    'value': value,
                    'tripid':"{{$trip->id}}"
                },
                success: function (data) {
//                    alert(data.join('mohan'));
                    tour  = data[0];
                    $('#citytour').html(data[1]);
                    mohan();
                }
            });
        }));

        function down3() {
            var number = parseInt(document.getElementById('count3').value);
//            alert(number);
            var number = number - 1;
            if (number < 0){
                number = 0;
            }
            $('.counter3').val(number);
        }
        function up3(){
            var number = parseInt(document.getElementById('count3').value);
//            alert(number1);
            var number = number + 1;
            $('.counter3').val(number);
        }

        function down4() {
            var number = parseInt(document.getElementById('count4').value);
//            alert(number);
            var number = number - 1;
            if (number < 0){
                number = 0;
            }
            $('.counter4').val(number);
        }

        function up4(){
            var number = parseInt(document.getElementById('count4').value);
//            alert(number1);
            var number = number + 1;
            $('.counter4').val(number);
        }

        function down5() {
            var number = parseInt(document.getElementById('count5').value);
//            alert(number);
            var number = number - 1;
            if (number < 0){
                number = 0;
            }
            $('.counter5').val(number);
        }
        function up5(){
            var number = parseInt(document.getElementById('count5').value);
//            alert(number1);
            var number = number + 1;
            $('.counter5').val(number);
        }

        $(document).on('click', '.guideup', (function (e) {
            var number = $('#count3').val();
//            alert(number);
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async:false,
                url: '/guideup',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'number': number,
                    'tripid':"{{$trip->id}}"
                },
                success: function (data) {
//                    alert(data);
                    guideup = data[2];
                    guidedown = 0;
                    $('#guidetotal').html(data[2]);
                    rita(data[0]);
                }
            });
        }));

        function rita (data) {
            if (data == '1') {
                total = parseInt(document.getElementById('grandtotal').innerText);

//                alert('vitra' + total);
            }else{
                total = groupprice;
//                alert('baira'+ total);
            }
            mohan();
        }
        $(document).on('click', '.guidedown', (function (e) {
            var number = $('#count3').val();
//            alert(number);
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async:false,
                url: '/guidedown',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'number': number,
                    'tripid':"{{$trip->id}}"
                },
                success: function (data) {
//                    alert(data.join(' '));
                    guidedown = data[2];
                    guideup = 0;
                    $('#guidetotal').html(data[2]);
                    lalita(data[0]);
                }
            });
        }));

        $(document).on('click', '.sherpaup', (function (e) {
            var number = $('#count4').val();
//            alert(number);
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async:false,
                url: '/sherpaup',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'number': number,
                    'tripid':"{{$trip->id}}"
                },
                success: function (data) {
                    sherpaup = data[2];
                    $('#sherpatotal').html(data[2]);
                    mohan();
                }
            });
        }));
        $(document).on('click', '.sherpadown', (function (e) {
            var number = $('#count4').val();
//            alert(number);
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async:false,
                url: '/sherpadown',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'number': number,
                    'tripid':"{{$trip->id}}"
                },
                success: function (data) {
                    sherpadown = data[2];
                    $('#sherpatotal').html(data[2]);
                    mohan();
                }
            });
        }));

        $(document).on('click', '.assistantup', (function (e) {
            var number = $('#count5').val();
//            alert(number);
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async:false,
                url: '/assistantup',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'number': number,
                    'tripid':"{{$trip->id}}"
                },
                success: function (data) {
                    assistantup = data[2];
                    $('#assistanttotal').html(data[2]);
                    mohan();
                }
            });
        }));

        $(document).on('click', '.assistantdown', (function (e) {
            var number = $('#count5').val();
//            alert(number);
            if (e.originalEvent.defaultPrevented) return;
            $.ajax({
                type: 'post',
                async:false,
                url: '/assistantdown',
                data: {
//                    '_method': 'post',
                    '_token': $('input[name=_token]').val(),
                    'number': number,
                    'tripid':"{{$trip->id}}"
                },
                success: function (data) {
                    assistantdown = data[2];
                    $('#assistanttotal').html(data[2]);
                    mohan();
                }
            });
        }));

//        function sita(data){
//            if(data === '1'){
//                porterup = 0;
//                porterdown = 0;
//            }
//            mohan();
//        }
        function lalita(data) {
            if(data === '1'){
                guideup = 0;
                guidedown = 0;
            }
            mohan();
        }

        function mohan(){
            document.getElementById('grouptotal').innerHTML = personprice;
            total = personprice;
//            alert('dfsd'+total);
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
            var p = person;
            var t = tour;
            var tr = transport;

            var aco = parseInt(ru + rd);

            var porters = parseInt(pu + pd );

            var gom = parseInt(gu  + gd );
//            alert('msbfunction'+ gom);
            document.getElementById('others').innerHTML = porters;

            document.getElementById('tran').innerHTML = tr;

            document.getElementById('accom').innerHTML = aco;

            document.getElementById('tmor').innerHTML = t;

            document.getElementById('guid').innerHTML = gom;

            var grandtotal = parseInt (total + porters + tr + aco + t + gom);

             //gu + gd + su + sd + t + tr + aco + au + ad
            document.getElementById('grandtotal').innerHTML = grandtotal;
            $('.totalprice').val(grandtotal);

        }
    </script>
@endsection



