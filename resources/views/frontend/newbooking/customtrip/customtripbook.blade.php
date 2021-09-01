@extends('layouts.master')
@section('title','Booking Form')
@section('metatags')

@endsection
<style type="text/css">
    .top-payment img {
    margin-top:0px;
}
</style>
<link rel="stylesheet" type="text/css" href="{{asset('css/booking.css')}}">
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('content')
    @include('layouts.navbar')
    <section class="booking-form  mt-20 mb-20">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 pl-0 pr-0 mesureheight">
                    <div class="booking-form-heading">
                        <h1>{{$trips->name}}</h1>
                        <div class="step-heading mt-10">
                            <ul id="progressbar">
                                <li class="active">Personal Information</li>
                                <li>Rental/Activities</li>
                                <li>General</li>
                            </ul>
                        </div>
                    </div>
                    <div class='form-field-block'>
                        <form id="firstform" action="/customtripbook-confirm" method="post">
                            <input type="hidden" name="invoiceno" value="{{$invoiceNo}}">
                            <input type="hidden" name="tripid" value="{{$trips->id}}">
                            <input type="hidden" name="not" value="{{$manche}}">
                            <input type="hidden" name="customprice" value="{{$totalprice}}">
                            <div class="info-form">
                                <div class="select-no mb-20">
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                                            <label>Select No Of Travellers</label>
                                            <select id="not" name="not" class="form-control col-4-select" required>
                                                <option value="{{$manche}}" selected>No of Travellers
                                                    :{{$manche}}</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                                            <label>Trip Departure <span class="red">*</span></label>
                                            <input type="date" id="startdate" name="start_date" class="form-control"
                                                   required>

                                        </div>
                                        <div class="col-lg-2"></div>

                                    </div>
                                </div>

                                <fieldset id="personals">
                                    <div class="inner-package-head-title mb-20"><h3>Personal Information</h3></div>


                                    <div class="row ">
                                        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>Title <span class="red">*</span></label>
                                                <select id="koho" name="title[1]"
                                                        class="form-control validate col-2-select" autocomplete="off"
                                                        required>
                                                    <option value="" disabled selected><b>Title</b></option>
                                                    <option value="mr">Mr</option>
                                                    <option value="mrs">Mrs</option>
                                                    <option value="ms">Ms</option>
                                                    <option value="miss">Miss</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>First Name <span class="red">*</span></label>
                                                <input onkeyup="cfirst()" id="fname" type="text" name="fname[1]"
                                                       class="form-control validate" required placeholder="First Name">

                                            </div>

                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>Last Name <span class="red">*</span></label>
                                                <input onkeyup="cthird()" id="lname" type="text" name="lname[1]"
                                                       class="form-control validate" required placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>Email <span class="red">*</span></label>
                                                <input type="email" name="email[1]" class="form-control validate"
                                                       required placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>DOB <span class="red">*</span></label>
                                                <select class="form-control validate col-2-select" name="dd[1]"
                                                        autocomplete="off" required>
                                                    <option value="" disabled selected><b>DOB</b></option>
                                                    @for($d = 1; $d <= 31; $d++)
                                                        <option value="{{$d}}">{{$d}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>Month <span class="red">*</span></label>
                                                <select class="validate form-control col-2-select" name="mm[1]"
                                                        autocomplete="off" required>
                                                    <option value="" disabled selected><b>Month</b></option>
                                                    <option value="1">Jan</option>
                                                    <option value="2">Feb</option>
                                                    <option value="3">Mar</option>
                                                    <option value="4">Apr</option>
                                                    <option value="5">May</option>
                                                    <option value="6">Jun</option>
                                                    <option value="7">Jul</option>
                                                    <option value="8">Aug</option>
                                                    <option value="9">Sep</option>
                                                    <option value="10">Oct</option>
                                                    <option value="11">Nov</option>
                                                    <option value="12">Dec</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>Year <span class="red">*</span></label>
                                                <select class="validate form-control col-2-select" name="year[1]"
                                                        autocomplete="off" required>
                                                    <option value="" disabled selected><b>Year</b></option>
                                                    @for($d = date('Y'); $d >= 1930; $d--)
                                                        <option value="{{$d}}">{{$d}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label>Contact Number <span class="red">*</span></label>
                                                <input type="number" id="contactno" name="contactno[1]"
                                                       class="validate form-control"
                                                       required placeholder="Contact number" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>Passport Number <span class="red">*</span></label>
                                                <input id="passn" type="text" name="passportno[1]"
                                                       class="validate form-control" required autocomplete="off"
                                                       placeholder="Passport Number">
                                            </div>
                                        </div>

                                    </div>
                                    <input type="button" name="next" class="next action-button mesure" value="Next"
                                           style="margin-bottom:20px"/>
                                </fieldset>
                                <fieldset id="rentalfield">
                                    <div class="inner-package-head-title mb-20"><h3>Rental Service</h3></div>


                                    @include('frontend.newbooking.layouts.rentalandoptional')
                                    <input style="margin-top:20px" type="button" name="previous"
                                           class="previous action-button top-sc" value="Previous"/>
                                    <input type="button" name="next" class="next  action-button top-sc" value="Next"/>
                                </fieldset>
                                <fieldset>
                                    <div class="inner-package-head-title mb-20"><h3>General</h3></div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>Country <span class="red">*</span></label>
                                                <select id="country" name="country[1]"
                                                        class="validate form-control col-3-select" autocomplete="off"
                                                        required>
                                                    <option value="" disabled selected><b>Select your Country</b>
                                                    </option>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country['name']}}">{{$country['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>Permanent Address <span class="red">*</span></label>
                                                <input name="paddress[0]" type="text" class="validate form-control"
                                                       required
                                                       placeholder="Permanant Address" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>Temporary Address <span class="red">*</span></label>
                                                <input name="taddress[1]" type="text" class="validate form-control"
                                                       placeholder="Temporary Address" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>Insurance Company</label>
                                                <input id="ic" name="ic[1]" type="text"
                                                       class="validate form-control" autocomplete="off"
                                                       placeholder="Insurance Company">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>Insurance Policy Number</label>
                                                <input id="ipn" name="ipn[1]" type="text"
                                                       class="validate form-control"
                                                       placeholder="Insurance Policy Number">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>Contact</label>
                                                <input id="icn" name="icn[1]" type="number"
                                                       class="validate form-control"
                                                       placeholder="Contact">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>How did you hear about us</label>
                                                <select name="feedback[0]" class="validate form-control col-4-select"
                                                        autocomplete="off">
                                                    <option value="null" selected>How did you hear about us</option>
                                                    <option value="Previous Client" id="previousclient">I am a previous
                                                        client
                                                    </option>
                                                    <option value="Internet" id="internet">Internet Search</option>
                                                    <option value="Facebook" id="facebook">Facebook</option>
                                                    <option value="Twitter" id="twitter">Twitter</option>
                                                    <option value="Recommendation" id="recommendation">Friend
                                                        Recommendation
                                                    </option>
                                                    <option value="Tripadvisor" id="tripadvisor">Trip Advisor</option>
                                                    <option value="Lonelyplanet" id="lonelyplanet">Lonely Planet
                                                    </option>
                                                    <option value="Others" id="others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-10">
                                        <div class="col-lg-12">
                                            <p class="center-align" style="margin: 5px 0 0;font-size:12px">
                                                <b>Note:</b> To get <b>Early Bird Discount</b>
                                                please make sure to deposit full amount while booking the trip.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mb-10" id="radiocb" onclick="cbclick(event)" style="display:flex">
                                        <div class="col-lg-6 col-md-6 col-sm-6  pr-0">
                                            <input type="checkbox" id="test6" class="payoption" value="advanced"
                                                   autocomplete="off"/>
                                            <label for="test6">Advanced Payment : </label> USD $<span
                                                    id="advanced">0</span>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 pr-0">
                                            <input type="checkbox" id="test5" checked class="payoption" value="full"
                                                   autocomplete="off"/>
                                            <label for="test5">Full Payment :</label> USD $<span
                                                    id="grandytotal2">0</span>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input type="checkbox" id="termsCheckbox"
                                                   class="termsncondnvalue styled-checkbox" value="" autocomplete="off"
                                                   name="termsncondnvalue" onclick="termsnconditionModal()"/>
                                            <label for="termsCheckbox"> I accept the <a style="color:#111"
                                                                                        class="term-trigger"
                                                                                        href="javascript:;">Terms
                                                    and condition</a> </label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="confirm" id="confirmPay" value="">
                                    <input type="button" name="previous" class="previous action-button"
                                           value="Previous"/>
                                    <button class="payonlinebtn btn-btn-submit" onclick="payonline()" disabled="">Pay
                                        Online
                                    </button>
                                    <button class="paybank btn-btn-submit" onclick="paybank()" disabled="">Wire
                                        Transfer
                                    </button>

                                </fieldset>
                            </div>
                            @include('frontend.newbooking.termandconditionmodal')

                            <div class='rental-services'>

                                @include('frontend.newbooking.layouts.viewinvoicemodal')

                            </div>
                            <button type="submit" id="merosubmit" name="submitall" style="display: none;"></button>
                        </form>

                    </div>

                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 pl-0 pr-0">
                    <div class="booking-details-block" id="book-side">

                        <div class="all-details">
                            <div class="booking-name-details">
                                <span class="boookingName" id="kotitle"> </span>
                                <b> <span class="boookingName" id="cfname"> </span>
                                    <span class="boookingName" id="clname"> </span> </b>
                            </div>
                        </div>
                        <div class="trip-details-table" style="padding:0px 5px;margin-bottom:5px">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="bo-de-ti">Trip Details</th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <table>
                                        <tr>
                                            <td><b>Trip Code</b><i
                                                        style="font-size:12px;color:#fc0;float:right;line-height:20px"
                                                        class="fa fa-arrow-right" aria-hidden="true"></i></td>
                                            <td>&nbsp;&nbsp;{{$trips->code}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Location</b><i
                                                        style="font-size:12px;color:#fc0;float:right;line-height:20px"
                                                        class="fa fa-arrow-right" aria-hidden="true"></i></td>
                                            <td>&nbsp;&nbsp;{{$trips->start_location}}- {{$trips->finish_location}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Ages</b><i
                                                        style="font-size:12px;color:#fc0;float:right;line-height:20px"
                                                        class="fa fa-arrow-right" aria-hidden="true"></i></td>
                                            <td>&nbsp;&nbsp;Min {{$trips->ages}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Venture</b><i
                                                        style="font-size:12px;color:#fc0;float:right;line-height:20px"
                                                        class="fa fa-arrow-right" aria-hidden="true"></i></td>
                                            <td>&nbsp;&nbsp;{{$trips->ventures}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Duration</b><i
                                                        style="font-size:12px;color:#fc0;float:right;line-height:20px"
                                                        class="fa fa-arrow-right" aria-hidden="true"></i></td>
                                            <td>&nbsp;&nbsp;{{$trips->trekdays}} Days - {{$trips->days}} Days</td>
                                        </tr>
                                        <tr>
                                            <td><b>Difficulty</b><i
                                                        style="font-size:12px;color:#fc0;float:right;line-height:20px"
                                                        class="fa fa-arrow-right" aria-hidden="true"></i></td>
                                            <td>&nbsp;&nbsp;@if($trips->physical_rating == 1)
                                                    Easy
                                                @elseif($trips->physical_rating == 2)
                                                    Moderate
                                                @elseif($trips->physical_rating  == 3)
                                                    Hard
                                                @elseif($trips->physical_rating  == 4)
                                                    Very Hard
                                                @elseif($trips->physical_rating  == 5)
                                                    Severe
                                                @elseif($trips->physical_rating  == 6)
                                                    Very Severe
                                                @else
                                                    Extreme
                                                @endif</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 pl-0">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="bo-de-ti">Booking Details</th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <table>
                                        <tr>
                                            <td><b>Invoice No</b><i
                                                        style="font-size:12px;color:#fc0;float:right;line-height:20px"
                                                        class="fa fa-arrow-right" aria-hidden="true"></i></td>
                                            <td>&nbsp;&nbsp;{{$invoiceNo}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Booking Date</b><i
                                                        style="font-size:12px;color:#fc0;float:right;line-height:20px"
                                                        class="fa fa-arrow-right" aria-hidden="true"></i></td>
                                            <td>&nbsp;&nbsp;{{date("j F, Y")}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Trip Departure Date</b><i
                                                        style="font-size:12px;color:#fc0;float:right;line-height:20px"
                                                        class="fa fa-arrow-right" aria-hidden="true"></i></td>
                                            <td>&nbsp;&nbsp;<div id="janedin"></div>
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>


                        <div class="package-details-table">

                            <table id="package-table-booking" class="highlight grandtotal">
                                <thead>
                                <tr>
                                    <th>DESCRIPTION</th>
                                    <th>PRICE</th>
                                    <th style="width:40px">PAX</th>
                                    <th>TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><b>{{$trips->name}}</b></td>
                                    <td>${{$trips->price}}</td>
                                    <td><span class="pax">1</span></td>
                                    <td>USD $ <span class="triptotal">
                                                {{$totalprice}}
                                            </span>(customized)
                                    </td>
                                </tr>

                                @if(count($allequipments)> 0)
                                    <tr>
                                        <td><b>Rental Services</b></td>
                                        <td></td>
                                        <td></td>
                                        <td>USD $<span id="eqsubtotal0">0</span></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td><b>Rental Services</b></td>
                                        <td colspan="3">No rental services available</td>
                                    </tr>
                                @endif

                                @if(count($extrapackages) > 0 )
                                    <tr>
                                        <td><b>Optional Tours</b></td>
                                        <td></td>
                                        <td></td>
                                        <td>USD $<span id="actssubtotal0">0</span></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td><b>Optional Tours</b></td>
                                        <td colspan="3">No optional activities available</td>
                                    </tr>
                                @endif

                                <tr>
                                    <td>
                                        <b>Discounts</b><br>

                                    </td>
                                    <td>$<span class="discountone"></span></td>
                                    <td><span class="disperson">1</span></td>
                                    <td>(USD $<span class="discountallperson">0</span>)</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div class="promo-code">
                                            <input id="couponcode" class="border input-boxed" type="text">
                                            <button type="submit" class="btn-composed-input" id="submitcoupon">
                                                Promo Code </span>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        $ <span class="coupon">0</span>
                                    </td>
                                </tr>


                                </tbody>
                            </table>
                            <div class="grand-total"
                                 style="background-color: lightgray;font-weight: bolder;font-size: 16px;color:#000;">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <button type="button" class="viewInvoice">View Invoice Details</button>
                                    </div>

                                    <div class="col-lg-7 col-md-6 ggtt"><b style="font-size:16px">Grand Total</b> USD
                                        $<span style="font-size:13px" id="grandytotal1"></span></div>

                                </div>

                            </div>

                        </div>
                    </div>{{--end of col-4--}}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
   <script type="text/javascript">
        $(document).ready(function () {
            var current_fs, next_fs, previous_fs; 
            var left, opacity, scale;
            var animating;
            $(".next").click(function () {
                animating = true;
                current_fs = $(this).parent();
                next_fs = $(this).parent().next();
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                next_fs.show();
                current_fs.animate({opacity: 0}, {
                    step: function (now, mx) {
                        scale = 1 - (1 - now) * 0.2;
                        left = (now * 50) + "%";
                        opacity = 1 - now;
                        current_fs.css({
                            'transform': 'scale(' + scale + ')'
                        });
                        next_fs.css({'left': left, 'opacity': opacity});
                    },
                    duration: 800,
                    complete: function () {
                        current_fs.hide();
                        animating = false;
                    },
                    easing: 'easeInOutBack'
                });
            });
            $(".previous").click(function () {
                if (animating) return false;
                animating = true;
                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();
                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
                previous_fs.show();
                current_fs.animate({opacity: 0}, {
                    step: function (now, mx) {
                        scale = 0.8 + (1 - now) * 0.2;
                        left = ((1 - now) * 50) + "%";
                        opacity = 1 - now;
                        current_fs.css({'left': left});
                        previous_fs.css({'transform': 'scale(' + scale + ')', 'opacity': opacity});
                     },
                     duration: 800,
                    complete: function () {
                        current_fs.hide();
                        animating = false;
                    },
                    easing: 'easeInOutBack'
                });
            });
        })

    </script>
    <script type="text/javascript">
        var trekdin = "{{$trips->trekdays}}";
        var trip_price = "{{$trips->totalprice}}";

        $('.viewInvoice').on('click', function () {
            $('#invoiceModal').modal('show');
        });
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var minDate = year + '-' + month + '-' + day;

        $('#startdate').attr('min', minDate);

        $('#startdate').on('change', function () {
            chosedate()
        });
        function chosedate() {
            var sdate = document.getElementById('startdate').value;
            $.ajax({
                type: 'post',
                url: '/changedeparture',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'startdate': sdate,
                    'tripid': "{{$trips->id}}"
                },
                success: function (data) {
                    $('#janedin').html(data[0]);
                    $('#janedin1').html(data[0]);
                    $('#confirmPay').val(data[2]);
                    calculateEBC(data[1]);
                }
            });
        }

        $('#koho').on('change', function () {
            var title = this.value;

            if (title != "miss") {
                document.getElementById("kotitle").innerHTML = title + ". ";
                document.getElementById("kotitlem").innerHTML = title + ". ";
            } else {
                document.getElementById("kotitle").innerHTML = title + " ";
                document.getElementById("kotitlem").innerHTML = title + " ";
            }
        });

        function cfirst() {
            var x = document.getElementById("fname");
            document.getElementById("cfname").innerHTML = x.value + " ";
            document.getElementById("cfnamem").innerHTML = x.value + " ";
        }

        function cthird() {
            var x = document.getElementById("lname");
            document.getElementById("clname").innerHTML = x.value;
            document.getElementById("clnamem").innerHTML = x.value;
        }

        $(document).ready(function () {

            var title = document.getElementById('koho').value;
            if (title != null) {
                document.getElementById("kotitle").innerHTML = title + " ";
            }

            var x = document.getElementById("fname");
            if (x != null) {
                document.getElementById("cfname").innerHTML = x.value + " ";
            }

            var z = document.getElementById("lname");
            if (z != null) {
                document.getElementById("clname").innerHTML = z.value + " ";
            }


            calculateAllDiscount();
            calculateGrandtotal();
        });

        function calculateAllDiscount() {
            var disarray = [];

            $('#discounts td').each(function () {
                var eachdis = $(this).html();
                var str = eachdis.match(/\d+/g, "") + '';
                var s = Number(str.split(',').join(''));
                disarray.push(s);
            });

            function cleaner(arr) {
                return arr.filter(function (item) {
                    return typeof item == "string" || (typeof item == "number" && item);
                });
            }

            var nayaarray = cleaner(disarray);
            var tripP = trip_price;
            var currentP = parseInt($('#not :selected').val());

            console.log(tripP);

            var arraylen = nayaarray.length;

            for (var o = 0; o < arraylen; o++) {
                var price1 = tripP - ((nayaarray[o] / 100) * tripP);
                tripP = price1;

            }
            var sabaidis = (trip_price - tripP).toFixed(2);

            var finaldis = (sabaidis * currentP).toFixed(2);

            $('.discountone').html(sabaidis);
            $('.disperson').html(currentP);
            $('.discountallperson').html(finaldis);

            calculateGrandtotal();

        }
        function calculateEBC(ebc) {
            var ebc1 = ebc;
            if (ebc1 != 0) {
                $('#ebcdiscount').html("EarlyBird Discount(" + ebc1 + "%)");
                $('.ebcdiscount').val(ebc1);

            } else {
                $('#ebcdiscount').empty();
                $('.ebcdiscount').val(0);
            }
            var advancedpayment = $('#confirmPay').val();
            console.log('advpay---->' + advancedpayment);

            if (advancedpayment === 100) {
                document.getElementById('radiocb').style.display = "none";
            } else {
                document.getElementById('radiocb').style.display = "flex";
            }

            calculateAllDiscount();
        }

        function calculateGrandtotal() {
            var sabaipaisa = [];
            all = $('.grandtotal > tbody > tr');
            var count = 0;
            all.each(function () {
                if (count < 4) {
                    var dollar = ($('td:eq(3)', this).text());
                    var str = dollar.replace(/[^0-9.]/g, "") + '';
                    var s = Number(str.split(',').join(''));
                    sabaipaisa.push(s);
                }

                if (count === 4) {
                    var dollar = ($('td:eq(1)', this).text());
                    var str = dollar.replace(/[^0-9.]/g, "") + '';
                    var s = Number(str.split(',').join(''));
                    sabaipaisa.push(s);
                }

                count++;
            });

            var grandytotal = parseInt(Math.round(sabaipaisa[0] + sabaipaisa[1] + sabaipaisa[2] - sabaipaisa[3] - sabaipaisa[4]));
            $('#grandytotal0').html(grandytotal);
            $('#grandytotal1').html(grandytotal);
            $('#grandytotal2').html(grandytotal);
        }

        function downequip(id) {
            var number = parseInt(document.getElementById('count' + id).value);
            console.log(number);
            var number = number - 1;

            if (number <= 0) {
                number = 0;
            }
            $('.counter' + id).val(number);

            if (number <= 0) {
                $("#rentals > tbody > #equiprow" + id).remove();
            } else {
                var rwoid = $("#rentals > tbody > #equiprow" + id).length;
                if (rwoid >= 1) {
                    $("#rentals > tbody > #equiprow" + id).remove();
                    var name = $('#eqname' + id).text();
                    var price = $('#eqprice' + id).text();
                    var eqtotal = "$" + parseInt(price * number * trekdin);
                    var markup = "<tr id='equiprow" + id + "'><td>" + name + "</td><td>" + price + "</td><td>" + number + "</td><td>" + trekdin + "</td><td >" + eqtotal + "</td></tr>";
                    $("#rentals tbody").append(markup);
                } else {
                    var name = $('#eqname' + id).text();
                    var price = $('#eqprice' + id).text();
                    var eqtotal = "$" + parseInt(price * number * trekdin);
                    var markup = "<tr id='equiprow" + id + "'><td>" + name + "</td><td>" + price + "</td><td>" + number + "</td><td>" + trekdin + "</td><td>" + eqtotal + "</td></tr>";
                    $("#rentals tbody").append(markup);
                }
            }
            calculateeqpTotal();

        }

        function upequip(id) {
            var number1 = parseInt(document.getElementById('count' + id).value);
            var number1 = number1 + 1;
            $('.counter' + id).val(number1);
            var rwoid = $("#rentals > tbody > #equiprow" + id).length;

            if (rwoid >= 1) {
                $("#rentals > tbody > #equiprow" + id).remove();

                var name = $('#eqname' + id).text();
                var price = $('#eqprice' + id).text();
                var eqtotal = "$" + parseInt(price * number1 * trekdin);
                var markup = "<tr id='equiprow" + id + "'><td>" + name + "</td><td>" + price + "</td><td>" + number1 + "</td><td>" + trekdin + "</td><td>" + eqtotal + "</td></tr>";
                $("#rentals tbody").append(markup);
            } else {
                var name = $('#eqname' + id).text();
                var price = $('#eqprice' + id).text();
                var eqtotal = "$" + parseInt(price * number1 * trekdin);
                var markup = "<tr id='equiprow" + id + "'><td>" + name + "</td><td>" + price + "</td><td>" + number1 + "</td><td>" + trekdin + "</td><td>" + eqtotal + "</td></tr>";
                $("#rentals tbody").append(markup);
            }
            calculateeqpTotal();

        }
        function calculateeqpTotal() {
            var sum = 0,
                all = $('#rentals > tbody > tr');
            all.each(function () {
                var dollar = ($('td:eq(4)', this).text());
                var yeahhh = parseInt(dollar.replace('$', ''));
                sum += yeahhh;
            });
            $('#eqsubtotal0').html(sum);
            $('#eqsubtotal1').html(sum);
            $('#eqsubtotal2').html(sum);

            calculateGrandtotal();
        }


        function upoptact(id) {
            var number1 = parseInt(document.getElementById('count1' + id).value);
            var number1 = number1 + 1;
            $('.counter1' + id).val(number1);

            var rwoid = $("#acts > tbody > #actsrow" + id).length;

            if (rwoid >= 1) {
                $("#acts > tbody > #actsrow" + id).remove();
                var name = $('#actname' + id).text();
                var price = $('#actprice' + id).val();
                var eqtotal = "$" + parseInt(price * number1);
                var markup = "<tr id='actsrow" + id + "'><td>" + name + "</td><td>" + number1 + "</td><td>" + price + "</td><td >" + eqtotal + "</td></tr>";
                $("#acts tbody").append(markup);
            } else {
                var name = $('#actname' + id).text();
                var price = $('#actprice' + id).val();
                var eqtotal = "$" + parseInt(price * number1);
                var markup = "<tr id='actsrow" + id + "'><td>" + name + "</td><td>" + number1 + "</td><td>" + price + "</td><td>" + eqtotal + "</td></tr>";
                $("#acts tbody").append(markup);
            }
            calculateactsTotal()
        }

        function downoptact(id) {
            var number = parseInt(document.getElementById('count1' + id).value);
            var number = number - 1;
            if (number < 0) {
                number = 0;
            }
            $('.counter1' + id).val(number);

            if (number <= 0) {
                $("#acts > tbody > #actsrow" + id).remove();
            } else {
                var rwoid = $("#acts > tbody > #actsrow" + id).length;

                if (rwoid >= 1) {
                    $("#acts > tbody > #actsrow" + id).remove();
                    var name = $('#actname' + id).text();
                    var price = $('#actprice' + id).val();
                    var eqtotal = "$" + parseInt(price * number);
                    var markup = "<tr id='actsrow" + id + "'><td>" + name + "</td><td>" + price + "</td><td>" + number + "</td><td >" + eqtotal + "</td></tr>";
                    $("#acts tbody").append(markup);
                } else {
                    var name = $('#actname' + id).text();
                    var price = $('#actprice' + id).val();
                    var eqtotal = "$" + parseInt(price * number);
                    var markup = "<tr id='actsrow" + id + "'><td>" + name + "</td><td>" + price + "</td><td>" + number + "</td><td>" + eqtotal + "</td></tr>";
                    $("#acts tbody").append(markup);
                }
            }
            calculateactsTotal()
        }

        function calculateactsTotal() {
            var sum = 0,
                all = $('#acts > tbody > tr');


            all.each(function () {
                var dollar = ($('td:eq(3)', this).text());
                var yeahhh = parseInt(dollar.replace('$', ''));
                sum += yeahhh;
            });
            $('#actssubtotal0').html(sum);
            $('#actssubtotal1').html(sum);
            $('#actssubtotal2').html(sum);
            calculateGrandtotal()
        }


        $("#submitcoupon").click(function () {
            var name = $("#couponcode").val();
            if (name === "") {
                swal({
                    text: "You have entered empty Coupon",
                });
            } else {
                var token = $('input[name=_token]').val();
                $.ajax({
                    type: 'post',
                    url: '/tripchangingcoupon',
                    data: {
                        '_token': token,
                        'coupon': name,
                        'tripid': "{{$trips->id}}"
                    },

                    success: function (data) {
                        $('.coupon').html(data[2]);
                        yeiho(data[1]);
                    }
                })
            }

        });

        function yeiho(val) {
            swal({
                text: val,
            });
            calculateGrandtotal();
        }

        var formnum = $("#not").val();

        var person = formnum;

        var triprice = "{{$trips->totalprice}}";
        var newprice = (person * triprice);
        $('.pax').html(person);

        var extraprice = "{{$extracharge}}";
        if (extraprice >= newprice) {
            $.ajax({
                type: 'post',
                async: false,
                url: '/changetripgroupdiscount',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'person': person,
                    'tripid': "{{$trips->id}}"
                },

                success: function (data) {

                    if (data[0] != 0) {
                        $('#gdiscount').html("Group Discount(" + data[0] + "%)");
                        $('.gdiscount').val(data[0]);
                        checkPayment1();
                        calculateAllDiscount();
                    } else {
                        $('#gdiscount').empty();
                        $('.gdiscount').val(0);
                        checkPayment1();
                        calculateAllDiscount();
                    }

                }
            });
        } else {
            $('#gdiscount').empty();
            $('.gdiscount').val(0);
            checkPayment1();
            calculateAllDiscount();
        }

        function cbclick(e) {
            e = e || event;
            var cb = e.srcElement || e.target;
            if (cb.type !== 'checkbox') {
                return true;
            }
            var cbxs = document.getElementById('radiocb').getElementsByTagName('input'), i = cbxs.length;
            while (i--) {
                if (cbxs[i].type && cbxs[i].type == 'checkbox' && cbxs[i].id !== cb.id) {
                    cbxs[i].checked = false;
                }
            }
            checkPayment();
        }

        function checkPayment() {
            var moin = null;

            $(".payoption:checked").each(function () {
                moin = $(this).val();
            });
            if (moin === 'advanced') {
                $('#ebcdiscount').empty();
                $('.ebcdiscount').val(0);
                calculateAllDiscount();
                var grandytotal = $("#grandytotal1").text();
                var advancedpayment = $('#confirmPay').val();
                var advpay = ((advancedpayment / 100) * grandytotal).toFixed(0);
                var advaPrice = advpay;
                $('#advanced').html(advaPrice);
            } else {
                chosedate();
            }
        }


        function checkPayment1() {
            $('#ebcdiscount').empty();
            $('.ebcdiscount').val(0);
            calculateAllDiscount();
            var grandytotal = $("#grandytotal1").text();
            var advancedpayment = $('#confirmPay').val();
            var advpay = ((advancedpayment / 100) * grandytotal).toFixed(0);
            var advaPrice = advpay;
            $('#advanced').html(advaPrice);
        }

        function paybank() {
            var sabaiinfo = [];
            var sabaipaisa = [];
            var count = 0;
            all = $('.grandtotal > tbody > tr');
            all.each(function () {
                if (count < 4) {
                    var dollar = ($('td:eq(3)', this).text());
                    var str = dollar.replace(/[^0-9.]/g, "") + '';
                    var s = Number(str.split(',').join(''));
                    sabaipaisa.push(s);
                }

                if (count >= 4) {
                    var dollar = ($('td:eq(1)', this).text());
                    var str = dollar.replace(/[^0-9.]/g, "") + '';
                    var s = Number(str.split(',').join(''));
                    sabaipaisa.push(s);
                }

                count++;
            });

            sabaiinfo.push(sabaipaisa);
            var moin = null;
            $(".payoption:checked").each(function () {
                moin = $(this).val();
            });

            sabaiinfo.push(moin);
            var advancepay = $('#advanced').text();
            sabaiinfo.push(advancepay);

            $.ajax({
                type: 'post',
                async: false,
                url: '/saveallcustomtripdata',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'formData': sabaiinfo
                },
                success: function (data) {
                    $("#merosubmit").trigger("click");
                }
            });

        }

        function payonline() {
            var sabaiinfo = [];
            var sabaipaisa = [];
            var count = 0;
            all = $('.grandtotal > tbody > tr');
            all.each(function () {
                if (count < 4) {
                    var dollar = ($('td:eq(3)', this).text());
                    var str = dollar.replace(/[^0-9.]/g, "") + '';
                    var s = Number(str.split(',').join(''));
                    sabaipaisa.push(s);
                }

                if (count >= 4) {
                    var dollar = ($('td:eq(1)', this).text());
                    var str = dollar.replace(/[^0-9.]/g, "") + '';
                    var s = Number(str.split(',').join(''));
                    sabaipaisa.push(s);
                }

                count++;
            });

            sabaiinfo.push(sabaipaisa);
            var moin = null;
            $(".payoption:checked").each(function () {
                moin = $(this).val();
            });

            sabaiinfo.push(moin);
            var advancepay = $('#advanced').text();
            sabaiinfo.push(advancepay);
            $.ajax({
                type: 'post',
                async: false,
                url: '/savealldata',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'formData': sabaiinfo
                },
                success: function (data) {
                    $('#firstform')[0].setAttribute('action', '/customtripproceedonline');
                    $("#merosubmit").trigger("click");
                }
            });

        }

        $(document).ready(function () {
            $('.noOfTravellers input').attr('required', true);
            $('.tripDepartureDate input').attr('required', true);
              $('.top-sc').on("click",function(){
                $(window).scrollTop(150);
           });
            $('.term-trigger').on('click',function(){
                $('#termandcondition').modal('show');
            });
        });


    </script>
    <script type="text/javascript">
        function termsnconditionModal() {
            var checkedValue = $('.termsncondnvalue').val();
            var checkedValue = null;
            var inputElements = document.getElementsByClassName('termsncondnvalue');
            for (var i = 0; inputElements[i]; ++i) {
                if (inputElements[i].checked) {
                    $(".payonlinebtn").removeAttr("disabled");
                    $(".paybank").removeAttr("disabled");
                    checkedValue = inputElements[i].value;
                    break;
                } else {
                    $('.payonlinebtn').attr("disabled", "disabled");
                    $('.paybank').attr("disabled", "disabled");
                }
            }
        }

        function disagreeTermsCondition() {
            $('.termsncondnvalue').prop('checked', false);
            $('#termandcondition').modal('hide');
            termsnconditionModal();
            
        }

        function agreeTermsCondition() {
            $('.termsncondnvalue').prop('checked', true);
            $('#termandcondition').modal('hide');
            termsnconditionModal();

        }
    </script>
@endsection