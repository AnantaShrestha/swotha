@extends('layouts.master')
@section('title')
    <title>
        Booking Form
    </title>
@endsection
@section('metatags')
    {{--Here goes all the meta information for index page--}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{url('css/frontend/booking.css')}}">
    <link rel="stylesheet" href="{{url('css/customtrip.min.css')}}">
    <style>
        .cf:before,
        .cf:after {
            content: " "; /* 1 */
            display: table; /* 2 */
        }

        .cf:after {
            clear: both;
        }

        /**
         * For IE 6/7 only
         * Include this rule to trigger hasLayout and contain floats.
         */
        /*.cf {*/
        /**zoom: 1;*/
        /*}*/
        .wrapper {
            margin-right: auto;
            margin-left: 2%;
            margin-top: 50px;
            width: 95%;
        }

        .content {
            padding: 10px 15px;
        }

        .content h1 {
            margin-top: 0;
        }

        .content p,
        .sidebar p {
            font-family: "BLOKKNeue-Regular";
        }

        .sidebar {
            padding: 20px;
            color: #000000;
        }

        .sidebar h3 {
            margin: 0;
        }

        .content,
        .sidebar {
            float: left;
        }

        /* The sticky */
        .sidebar {
            position: -webkit-sticky;
            position: sticky;
            top: 8%;
        }

        .hea {
            background-color: grey;
            color: white;
            font-family: "Roboto";
        }

        table {
            width: 100%;
            display: table;
            margin-top: 20px;
        }

        td, th {
            padding: 5px 5px;
        }

        h4 {
            font-size: 1.80rem;
        }

        h6 {
            font-weight: 600;
        }

        .row {
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 0px;
        }


        input,
        button {
            background-color: transparent;
            border: 0;
        }

        .input-field.input-field-composed {
            padding-right: 0;
            position: relative;
            width: 100%;
            margin-left: 0;
        }

        .input-field.input-field-composed .btn {
            position: absolute;
            right: -50%;
            top: -3px;
            width: auto;
            height: 44px;
            border-radius: 0 13px 13px 0;
        }

        .input-field.input-field-composed input {
            width: 100% !important;
            border: 2px solid teal !important;
            border-radius: 13px;
            height: 40px;
            text-transform: uppercase;
            font-size: 15px;
        }

    </style>
@endsection
@section('content')
    @include('layouts.navbar')
    <div class="clear"></div>
    <div class="clear"></div>
    <div class="wrapper cf row">
        <div class="col l8 content">
            <h2 class="hea center-align">Booking Form</h2>
            <div class="card hoverable">
                <div class="row center-align">
                    <div class="col l3">
                        <h6>Trip code</h6>
                        <div>MDE94</div>
                    </div>
                    <div class="col l3">
                        <h6>Trip Name</h6>
                        <div>Dhaulagiri</div>
                    </div>
                    <div class="col l3">
                        <h6>Start Location</h6>
                        <div>Beni</div>
                    </div>
                    <div class="col l3">
                        <h6>Finish Location</h6>
                        <div>Jomsom</div>
                    </div>
                    <div class="col l3">
                        <h6>Ages</h6>
                        <div>Min 18</div>
                    </div>
                    <div class="col l3">
                        <h6>Venture</h6>
                        <div>Mountaineering</div>
                    </div>
                    <div class="col l3">
                        <h6>Duration</h6>
                        <div>16 Days</div>
                    </div>
                    <div class="col l3">
                        <h6>Difficulty</h6>
                        <div>Very Severe</div>
                    </div>
                </div>
            </div>
            <div class="card hoverable">
                <div class="row">
                    <div class="input-field col l6 m5 s10 bracket"
                         style="background-color: white;height: 46px;text-align: center;width: 30%;margin-left: 12%;">
                        <div class="loadingStatus hide">
                            <img src="{{url('/images/currency.gif')}}" alt="Loading" height="32px" width="32px">
                            Adding Forms...
                        </div>
                        <select id="not" name="not" class="validate" autocomplete="off">
                            <option value="1" selected><b>No of Travellers :1</b></option>
                            @for($i= 2; $i<=14; $i++)
                                <option value="{{$i}}">No of Travellers :{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="input-field col l6 m5 s10 bracket"
                         style="background-color: white;  height: 46px;text-align: center;width: 30%;margin-left:12%;">
                        <input id="startdate" type="date"
                               name="startdate" class="datepicker" onkeyup="startDate()" required>
                        <label for="startdate" data-error="fill in the date" data-success="right"
                               style="text-align: center"><b>Start Date</b></label>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div class="triangle">
                <div></div>
            </div>
            <div class="card hoverable">
                <div class="row">
                    <div id="bookform">
                        <div class="row">
                            <div class="center-align" style="margin-left: 40%; margin-top: 1%;">
                                <div class="panel-heading center-align hbb" style="color: white;width: 40%;">
                                    Lead Traveller
                                </div>
                            </div>
                            <div style="margin-top: 10px;font-size: 20px;" class="hb">
                                <i class="material-icons tiny">person</i>
                                <b>Personal Information:</b>
                            </div>
                            <div class="row">
                                <div class="col l1 m6 s12">
                                    <div class="input-field">
                                        <select id="koho" name="title" required>
                                            <option value="" disabled selected><b>Title*</b></option>
                                            <option value="mr">Mr</option>
                                            <option value="mrs">Mrs</option>
                                            <option value="ms">Ms</option>
                                            <option value="miss">Miss</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-field col l4 m6 s12" style="width: 25%">
                                    <input name="fname" id="fname" type="text" class="validate" onkeyup="cfirst()"
                                           required>
                                    <label><b>First Name*</b></label>
                                </div>
                                <div class="input-field col l3 m6 s12" style="margin-left: 5%">
                                    <input name="mname" id="mname" type="text" class="validate" onkeyup="csecond()">
                                    <label><b>Middle Name (Optional)</b></label>
                                </div>
                                <div class="input-field col l4 m6 s12" style="margin-left: 5%;width: 25%;">
                                    <input name="lname" id="lname" type="text" class="validate" required
                                           onkeyup="cthird()">
                                    <label><b>Last Name*</b></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col l5 m6 s12" style="width: 33%;">
                                    <input id="name" type="email" name="email" class="validate" required>
                                    <label for="name"><b>Email*</b></label>
                                </div>
                                <div class="input-field col l3 m6 s12" style="margin-left: 5%;">
                                    <input type="number" id="contactno" name="contactno" class="validate" required>
                                    <label for="name"><b>Contact number*</b></label>
                                </div>
                            </div>
                            <div class="row">
                                <div>
                                    <div class="input-field col l1 m4 s12">
                                        <select class="validate" name="dd" required>
                                            <option value="" disabled selected><b>DOB*</b></option>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="input-field col l1 m4 s12">
                                        <select class="validate" name="mm" required>
                                            <option value="" disabled selected><b>Month*</b></option>
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
                                    <div class="input-field col l1 m4 s12">
                                        <select class="validate" name="year" required>
                                            <option value="" disabled selected><b>Year*</b></option>
                                            <option value="fdsfs">fdsfds</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-field col l3 m6 s12" style="margin-left: 3%">
                                    <input name="zip" type="number" class="validate">
                                    <label><b>Postcode / Zip (Optional)</b></label>
                                </div>
                                <div class="input-field col l2 m6 s12" style="margin-left: 3%;width: 25%;">
                                    <input id="passn" type="number" name="passportno" class="validate" required>
                                    <label for="passn" type="number"><b>Passport number*</b></label>
                                </div>
                                <div class="input-field col l2 m12 s12" style="margin-left: 2%;">
                                    <select name="doi" class="validate">
                                        <option value="null" selected><b>Date of issue</b></option>
                                        <option value="fdsfds">fdsfds</option>
                                    </select>
                                </div>
                            </div>
                            <div style="margin-top: 10px;font-size: 20px;" class="hb">
                                <i class="material-icons tiny">location_on</i>
                                <b>Location:</b></div>
                            <div class="row">
                                <div class="input-field col l4 m6 s12" style="width: 33%">
                                    <select name="country" class="validate" required>
                                        <option value="" disabled selected><b>Select your Country*</b></option>
                                        <option value="Nepal">Nepal</option>
                                    </select>
                                </div>
                                {{--third row--}}
                                <div class="input-field col l3 m6 s12" style="margin-left: 5%">
                                    <input name="state" type="text" class="validate">
                                    <label><b>State / Province (Optional)</b></label>
                                </div>
                                <div class="input-field col l4 m6 s12" style="margin-left: 5%;width: 25%;">
                                    <input name="town" type="text" class="validate">
                                    <label><b>Town (Optional)</b></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col l4 m6 s12" style="width: 33%;">
                                    <input name="paddress" type="text" class="validate" required>
                                    <label><b>Permanant Address*</b></label>
                                </div>
                                <div class="input-field col l4 m6 s12" style="margin-left: 5%;">
                                    <input name="taddress" type="text" class="validate">
                                    <label><b>Temporary Address (Optional)</b></label>
                                </div>
                            </div>
                            <div style="margin-top: 10px;font-size: 20px;" class="hb">
                                <i class="material-icons tiny">info</i>
                                <b>General:</b></div>
                            <div class="row">
                                <div class="input-field col l7 m12 s11">
                                    <select id="insurance" name="insurance">
                                        <option value="null" selected>Insurance</option>
                                        <option value="n" id="policyno">I will provide later</option>
                                        <option value="y" id="policyyes">I have full insurance coverage</option>
                                    </select>
                                    <div class=" insurance-show" id="insurance-show" style="display: none;">
                                        <div class="input-field col l4 m6 s11">
                                            <input id="ic" name="ic" type="text" class="validate">
                                            <label for="ic">Insurance Company *</label>
                                        </div>
                                        <div class="input-field col l5 m6 s11">
                                            <input id="ipn" name="ipn" type="number" class="validate">
                                            <label for="ipn">Insurance Policy Number*</label>
                                        </div>
                                        <div class="input-field col l3 m6 s11">
                                            <input id="icn" name="icn" type="number" class="validate">
                                            <label for="icn">Contact*</label>
                                        </div>
                                    </div>
                                    <strong style="font-size: 14px;">
                                        Note: <span style="padding: 2px;"> Insurance</span> is mandatory for the trips.
                                        You must be covered for both medical
                                        issues & emergency evacuation - minimum coverage US$100,000.(For high altitude
                                        adventures) *
                                    </strong>
                                </div>
                                <div class="input-field col l4 m12 s12" style="margin-left: 5%;">
                                    <select name="feedback" class="validate">
                                        <option value="null" selected>How did you hear about us</option>
                                        <option value="Previous Client" id="previousclient">I am a previous client
                                        </option>
                                        <option value="Internet" id="internet">Internet Search</option>
                                        <option value="Facebook" id="facebook">Facebook</option>
                                        <option value="Twitter" id="twitter">Twitter</option>
                                        <option value="Recommendation" id="recommendation">Friend Recommendation
                                        </option>
                                        <option value="Tripadvisor" id="tripadvisor">Trip Advisor</option>
                                        <option value="Lonelyplanet" id="lonelyplanet">Lonely Planet</option>
                                        <option value="Others" id="others">Others</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div class="triangle">
                <div></div>
            </div>
            <div class="card hoverable">
                <div class="row">
                    <div class="center-align" style="margin-left: 40%; margin-top: 1%;">
                        <div class="panel-heading center-align hbb" style="color: white;width: 40%;">
                            Rental Services
                        </div>
                    </div>
                    <div class="col l4 m6 s12">
                        <div class="card-panel hoverable">
                            <div class="row" style="margin-bottom: -35px; font-weight: 500;">
                                <div class="col l12 m12 s12 center-align">
                                    <div class="row">
                                        <div class="col l4 push-l1"><img src="{{url('images/shoes.jpg')}}" height="52px"
                                                                         alt=""></div>
                                        <div class="col l4" style="margin-top: 5%;">Long Boot Shoes</div>
                                        <div class="col l4 pull-l1" style="margin-top: 5%;">$2.5</div>
                                    </div>
                                </div>
                                <div class="col l12 m12 s12 center-align">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="value-button" id="decrease" value="Decrease Value"
                                                 style="background:#008EB0">
                                                <i class='material-icons' style="color: white;">exposure_neg_1</i>
                                            </div>
                                            <input type="text" id="count" name=""
                                                   class="counter" value="0"
                                                   style="width: 40px; text-align: center; color: black"/>
                                            <div class="value-button" id="increase" value="Increase Value"
                                                 style="background:#008EB0">
                                                <i class='material-icons' style="color: white;">exposure_plus_1</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l4 m6 s12">
                        <div class="card-panel hoverable">
                            <div class="row" style="margin-bottom: -35px; font-weight: 500;">
                                <div class="col l12 m12 s12 center-align">
                                    <div class="row">
                                        <div class="col l4 push-l1"><img src="{{url('images/shoes.jpg')}}" height="52px"
                                                                         alt=""></div>
                                        <div class="col l4" style="margin-top: 5%;">Long Boot Shoes</div>
                                        <div class="col l4 pull-l1" style="margin-top: 5%;">$2.5</div>
                                    </div>
                                </div>
                                <div class="col l12 m12 s12 center-align">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="value-button" id="decrease" value="Decrease Value"
                                                 style="background:#008EB0">
                                                <i class='material-icons' style="color: white;">exposure_neg_1</i>
                                            </div>
                                            <input type="text" id="count" name=""
                                                   class="counter" value="0"
                                                   style="width: 40px; text-align: center; color: black"/>
                                            <div class="value-button" id="increase" value="Increase Value"
                                                 style="background:#008EB0">
                                                <i class='material-icons' style="color: white;">exposure_plus_1</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l4 m6 s12">
                        <div class="card-panel hoverable">
                            <div class="row" style="margin-bottom: -35px; font-weight: 500;">
                                <div class="col l12 m12 s12 center-align">
                                    <div class="row">
                                        <div class="col l4 push-l1"><img src="{{url('images/shoes.jpg')}}" height="52px"
                                                                         alt=""></div>
                                        <div class="col l4" style="margin-top: 5%;">Long Boot Shoes</div>
                                        <div class="col l4 pull-l1" style="margin-top: 5%;">$2.5</div>
                                    </div>
                                </div>
                                <div class="col l12 m12 s12 center-align">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="value-button" id="decrease" value="Decrease Value"
                                                 style="background:#008EB0">
                                                <i class='material-icons' style="color: white;">exposure_neg_1</i>
                                            </div>
                                            <input type="text" id="count" name=""
                                                   class="counter" value="0"
                                                   style="width: 40px; text-align: center; color: black"/>
                                            <div class="value-button" id="increase" value="Increase Value"
                                                 style="background:#008EB0">
                                                <i class='material-icons' style="color: white;">exposure_plus_1</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l4 m6 s12">
                        <div class="card-panel hoverable">
                            <div class="row" style="margin-bottom: -35px; font-weight: 500;">
                                <div class="col l12 m12 s12 center-align">
                                    <div class="row">
                                        <div class="col l4 push-l1"><img src="{{url('images/shoes.jpg')}}" height="52px"
                                                                         alt=""></div>
                                        <div class="col l4" style="margin-top: 5%;">Long Boot Shoes</div>
                                        <div class="col l4 pull-l1" style="margin-top: 5%;">$2.5</div>
                                    </div>
                                </div>
                                <div class="col l12 m12 s12 center-align">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="value-button" id="decrease" value="Decrease Value"
                                                 style="background:#008EB0">
                                                <i class='material-icons' style="color: white;">exposure_neg_1</i>
                                            </div>
                                            <input type="text" id="count" name=""
                                                   class="counter" value="0"
                                                   style="width: 40px; text-align: center; color: black"/>
                                            <div class="value-button" id="increase" value="Increase Value"
                                                 style="background:#008EB0">
                                                <i class='material-icons' style="color: white;">exposure_plus_1</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l4 m6 s12">
                        <div class="card-panel hoverable">
                            <div class="row" style="margin-bottom: -35px; font-weight: 500;">
                                <div class="col l12 m12 s12 center-align">
                                    <div class="row">
                                        <div class="col l4 push-l1"><img src="{{url('images/shoes.jpg')}}" height="52px"
                                                                         alt=""></div>
                                        <div class="col l4" style="margin-top: 5%;">Long Boot Shoes</div>
                                        <div class="col l4 pull-l1" style="margin-top: 5%;">$2.5</div>
                                    </div>
                                </div>
                                <div class="col l12 m12 s12 center-align">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="value-button" id="decrease" value="Decrease Value"
                                                 style="background:#008EB0">
                                                <i class='material-icons' style="color: white;">exposure_neg_1</i>
                                            </div>
                                            <input type="text" id="count" name=""
                                                   class="counter" value="0"
                                                   style="width: 40px; text-align: center; color: black"/>
                                            <div class="value-button" id="increase" value="Increase Value"
                                                 style="background:#008EB0">
                                                <i class='material-icons' style="color: white;">exposure_plus_1</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l4 m6 s12">
                        <div class="card-panel hoverable">
                            <div class="row" style="margin-bottom: -35px; font-weight: 500;">
                                <div class="col l12 m12 s12 center-align">
                                    <div class="row">
                                        <div class="col l4 push-l1"><img src="{{url('images/shoes.jpg')}}" height="52px"
                                                                         alt=""></div>
                                        <div class="col l4" style="margin-top: 5%;">Long Boot Shoes</div>
                                        <div class="col l4 pull-l1" style="margin-top: 5%;">$2.5</div>
                                    </div>
                                </div>
                                <div class="col l12 m12 s12 center-align">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="value-button" id="decrease" value="Decrease Value"
                                                 style="background:#008EB0">
                                                <i class='material-icons' style="color: white;">exposure_neg_1</i>
                                            </div>
                                            <input type="text" value="0"
                                                   style="width: 40px; text-align: center; color: black"/>
                                            <div class="value-button" id="increase" value="Increase Value"
                                                 style="background:#008EB0">
                                                <i class='material-icons' style="color: white;">exposure_plus_1</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="center-align" style="margin-left: 40%; margin-top: 1%;">
                    <div class="panel-heading center-align hbb" style="color: white;width: 40%;">
                        Rental Services
                    </div>
                </div>
                <div class="row">
                    {{--@include('layouts.extrapackages')--}}
                </div>
            </div>
            <div id="allother" class="card hoverable" style="display:none">
                <div class="row">
                    <div id="extraform">
                    </div>
                </div>
            </div>
        </div>
        <div class="col l4 sidebar">
            <div class="center-align">
                <h4>Swotah Travel and Adventure Pvt. Ltd</h4>
                <div><span id="kotitle">&nbsp;</span><span id="cfname">&nbsp;</span><span id="cmname">&nbsp;</span><span
                            id="clname"></span></div>
                <table class="centered" style="padding: 0px 5px;">
                    <tr>
                        <td>Invoice No:</td>
                        <td>15298787879</td>
                    </tr>
                    <tr>
                        <td>Booking Date:</td>
                        <td><?php echo date("j F, Y") ?></td>
                    </tr>
                    <tr>
                        <td>Trip Departure Date:</td>
                        <td><span id="janedin"></span></td>
                    </tr>
                </table>
                <table class="">
                    <thead style="text-align: center;background: lightgray;padding: 2px;border-bottom: 3px solid whitesmoke; border-top: 3px solid red;">
                    <tr>
                        <th>Description</th>
                        <th>Unit Price</th>
                        <th>Number of People</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody style="padding: 3px; margin-top: 10px;">
                    <tr style="background-color: lightgray">
                        <td><b>Everest Yoga Trek</b></td>
                        <td>$ 300</td>
                        <td>2</td>
                        <td>USD $600</td>
                    </tr>
                    <tr style="background-color: lightgray">
                        <td><b>Rental Services</b></td>
                        <td>$ 300</td>
                        <td>2</td>
                        <td>USD $600</td>
                    </tr>
                    <tr style="background-color: lightgray">
                        <td><b>Optional Tours</b></td>
                        <td>$ 300</td>
                        <td>2</td>
                        <td>USD $600</td>
                    </tr>
                    <tr>
                        <td><b>Discounts</b></td>
                        <td>$ 114</td>
                        <td>2</td>
                        <td>($228)</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-field input-field-composed">
                                <input id="search" class="border input-boxed" type="text">
                                <button type="submit" class="btn btn-composed-input" id="search-btn-cover">
                                    Use Coupon
                                </button>
                            </div>
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            ($40)
                        </td>
                    </tr>
                    <br>
                    <tr style="background-color: lightgray; border-top:2px solid whitesmoke">
                        <td>
                            Grand Total
                        </td>
                        <td></td>
                        <td></td>
                        <td style="color: red; font-weight: 500;">
                            USD $78687
                        </td>
                    </tr>
                    </tbody>
                </table>
                <button class="btn">View Invoice Details</button>
                <button class="btn">Proceed to Payment</button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 30,
            // format: 'yyyy-MM-dd',
            min: new Date(),
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: true /// Creates a dropdown of 15 years to control year
        });


        $('#koho').on('change', function () {
            var title = this.value;
            document.getElementById("kotitle").innerHTML = title.toUpperCase() + " ";
        });


        function cfirst() {
            var x = document.getElementById("fname");
            document.getElementById("cfname").innerHTML = x.value.toUpperCase() + " ";
        }

        function csecond() {
            var x = document.getElementById("mname");
            document.getElementById("cmname").innerHTML = x.value.toUpperCase() + " ";
        }

        function cthird() {
            var x = document.getElementById("lname");
            document.getElementById("clname").innerHTML = x.value.toUpperCase();
        }

        $(document).ready(function () {

            var title = document.getElementById('koho').value;
            if (title != null) {
                document.getElementById("kotitle").innerHTML = title.toUpperCase() + " ";
            }

            var x = document.getElementById("fname");
            if (x != null) {
                document.getElementById("cfname").innerHTML = x.value.toUpperCase() + " ";
            }

            var y = document.getElementById("mname");
            if (y != null) {
                document.getElementById("cmname").innerHTML = y.value.toUpperCase() + " ";
            }

            var z = document.getElementById("lname");
            if (z != null) {
                document.getElementById("clname").innerHTML = z.value.toUpperCase() + " ";
            }

        });

        $('#startdate').on('change', function () {
            var sdate = document.getElementById('startdate').value;
            document.getElementById('janedin').innerHTML = sdate;
        });

        $('#not').on('change', function () {
            var formnum = this.value;
            $("#extraform").empty();
            // alert(formnum);
            for (var i = 2; i <= formnum; i++) {
                document.getElementById('allother').style.display = "block";
                if (formnum === 1) {
                    alert('fdsfds');
                    break;
                } else {
                    var newdiv = document.createElement('div');
                    newdiv.innerHTML = "<div class=\"center-align\" style=\"margin-left: 40%; margin-top: 1%;\">\n" +
                        "                                        <div class=\"panel-heading center-align hbb\" style=\"color: white;width: 40%;\">\n" +
                        "                                            Traveller \n" + i +
                        "                                        </div>\n" +
                        "                                    </div>\n" +
                        "                                    <div style=\"margin-top: 10px;font-size: 20px;\" class=\"hb\">\n" +
                        "                                        <i class=\"material-icons tiny\">person</i>\n" +
                        "                                        <b>Personal Information:</b>\n" +
                        "                                    </div>\n" +
                        "                                    <div class=\"row\">\n" +
                        "                                        <div class=\"col l1 m6 s12\">\n" +
                        "                                            <div class=\"input-field\">\n" +
                        "                                                <select  name = \"title\" required>\n" +
                        "                                                    <option value=\"\" disabled selected><b>Title*</b></option>\n" +
                        "                                                    <option value = \"mr\">Mr</option>\n" +
                        "                                                    <option value = \"mrs\">Mrs</option>\n" +
                        "                                                    <option value = \"ms\">Ms</option>\n" +
                        "                                                    <option value = \"miss\">Miss</option>\n" +
                        "                                                </select>\n" +
                        "                                            </div>\n" +
                        "                                        </div>\n" +
                        "                                        <div class=\"input-field col l4 m6 s12\" style=\"width: 25%\">\n" +
                        "                                            <input  name = \"fname\" type=\"text\" class=\"validate\" required>\n" +
                        "                                            <label ><b>First Name*</b></label>\n" +
                        "                                        </div>\n" +
                        "                                        <div class=\"input-field col l3 m6 s12\" style=\"margin-left: 5%\">\n" +
                        "                                            <input  name = \"mname\" type=\"text\" class=\"validate\">\n" +
                        "                                            <label ><b>Middle Name (Optional)</b></label>\n" +
                        "                                        </div>\n" +
                        "                                        <div class=\"input-field col l4 m6 s12\" style=\"margin-left: 5%;width: 25%;\">\n" +
                        "                                            <input  name = \"lname\" type=\"text\" class=\"validate\" required>\n" +
                        "                                            <label ><b>Last Name*</b></label>\n" +
                        "                                        </div>\n" +
                        "                                    </div>\n" +
                        "                                    <div class=\"row\">\n" +
                        "                                        <div class=\"input-field col l5 m6 s12\" style=\"width: 33%;\">\n" +
                        "                                            <input id=\"name\" type=\"email\"  name  = \"email\" class=\"validate\" required>\n" +
                        "                                            <label for=\"name\"><b>Email*</b></label>\n" +
                        "                                        </div>\n" +
                        "                                        <div class=\"input-field col l3 m6 s12\" style=\"margin-left: 5%;\">\n" +
                        "                                            <input type=\"number\" id=\"contactno\" name = \"contactno\"  class=\"validate\" required>\n" +
                        "                                            <label for=\"name\"><b>Contact number*</b></label>\n" +
                        "                                        </div>\n" +
                        "                                    </div>\n" +
                        "                                    <div class=\"row\">\n" +
                        "                                        <div>\n" +
                        "                                            <div class=\"input-field col l1 m4 s12\">\n" +
                        "                                                <select class=\"validate\" name = \"dd\" required>\n" +
                        "                                                    <option value=\"null\" disabled selected><b>DOB*</b></option>\n" +
                            @for($d = 1; $d <= 31; $d++)
                                "<option value=\"{{$d}}\">{{$d}}</option>" +
                            @endfor
                                "                                                </select>\n" +
                        "                                            </div>\n" +
                        "                                            <div class=\"input-field col l1 m4 s12\">\n" +
                        "                                                <select class=\"validate\" name = \"mm\" required>\n" +
                        "                                                    <option value=\"\" disabled selected><b>Month*</b></option>\n" +
                        "                                                    <option value=\"1\">Jan</option>\n" +
                        "                                                    <option value=\"2\">Feb</option>\n" +
                        "                                                    <option value=\"3\">Mar</option>\n" +
                        "                                                    <option value=\"4\">Apr</option>\n" +
                        "                                                    <option value=\"5\">May</option>\n" +
                        "                                                    <option value=\"6\">Jun</option>\n" +
                        "                                                    <option value=\"7\">Jul</option>\n" +
                        "                                                    <option value=\"8\">Aug</option>\n" +
                        "                                                    <option value=\"9\">Sep</option>\n" +
                        "                                                    <option value=\"10\">Oct</option>\n" +
                        "                                                    <option value=\"11\">Nov</option>\n" +
                        "                                                    <option value=\"12\">Dec</option>\n" +
                        "                                                </select>\n" +
                        "                                            </div>\n" +
                        "                                            <div class=\"input-field col l1 m4 s12\">\n" +
                        "                                                <select class=\"validate\" name = \"year\" required>\n" +
                        "                                                    <option value=\"\" disabled selected><b>Year*</b></option>\n" +
                        "                                                    <option value=\"fdsfs\">fdsfds</option>\n" +
                        "                                                </select>\n" +
                        "                                            </div>\n" +
                        "                                        </div>\n" +
                        "                                        <div class=\"input-field col l3 m6 s12\" style=\"margin-left: 3%\">\n" +
                        "                                            <input  name = \"zip\" type=\"number\" class=\"validate\">\n" +
                        "                                            <label ><b>Postcode / Zip (Optional)</b></label>\n" +
                        "                                        </div>\n" +
                        "                                        <div class=\"input-field col l2 m6 s12\" style=\"margin-left: 3%;width: 25%;\">\n" +
                        "                                            <input id=\"passn\" type=\"number\"  name = \"passportno\"  class=\"validate\" required>\n" +
                        "                                            <label for=\"passn\" type=\"number\"><b>Passport number*</b></label>\n" +
                        "                                        </div>\n" +
                        "                                        <div class=\"input-field col l2 m12 s12\" style=\"margin-left: 2%;\">\n" +
                        "                                            <select name = \"doi\" class=\"validate\">\n" +
                        "                                                <option value=\"null\" selected><b>Date of issue</b></option>\n" +
                        "                                                <option value=\"fdsfds\">fdsfds</option>\n" +
                        "                                            </select>\n" +
                        "                                        </div>";
                    document.getElementById('extraform').appendChild(newdiv);
                }
            }

            $(document).ready(function () {
                $('select').material_select();
            });

            if (formnum != 1) {
                swal({
                    html:
                        formnum - 1 + " Form extra Added !",
                    showCloseButton: true,
                    showCancelButton: false,
                    showConfirmButton: false,
                    animation: false,
                    customClass: 'animated tada',
                    focusConfirm: false,
                    background: '#008eb0'
                });
            }
        });
    </script>
@endsection