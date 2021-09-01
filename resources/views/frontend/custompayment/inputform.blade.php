@extends('layouts.master')
@section('title')
    <title>Payment Details | Swotah Travel and Adventure</title>
@endsection
@section('metatags')
    <meta name="title" content="Payment Details | Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
@section('styles')
    <link rel="stylesheet" href="{{url('css/frontend/booking.css?v=')}}<?php echo rand(1, 100000000)?>">
    <style>
        .row {
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 0px;
        }

        @media screen and (min-width: 993px) {
            .row .col.l6 {
                left: auto;
                right: auto;
                width: 40%;
                margin-left: 6%;
            }
        }
    </style>
@endsection
@section('content')
    @include('layouts.navbar2')
    <div class="container containerPadding center-align" style="margin-top:60px;">
        <h1 class="titleHeadtwo"><span class="reviewTitle">Swotah Travel and Adventure [Online payment] </span></h1>
        <div class="card" style="padding:10px 30px;">
            <form name="myForm" id="myForm" action="/processpay" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <input name="fullname" type="text" class="form-control validate" required>
                        <label><b>Full Name*</b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                        <input name="tripdescription" type="text" class="form-control validate" required>
                        <label><b>Trip Name*</b></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <input name="email" type="email" class="form-control validate" required>
                        <label><b>Email Id*</b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                        <input name="phone" type="number" class="form-control validate" required>
                        <label><b>Phone Number*</b></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <input id="startdate" type="date"
                               name="startdate" class="form-control datepicker" required>
                        <label for="startdate" data-error="fill in the date"><b>Trip Date</b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                        <input name="amount" type="number" class="form-control validate" min="1" required>
                        <label><b>Amount in ($) *</b></label>
                    </div>
                </div>
                <button type="submit" class="waves-effect waves-light btn"
                        name="submit">Proceed to Online Payment
                </button>
            </form>
        </div>
    </div>
    <br>
    <br>
    @include('layouts.footer1')
@endsection
@section('scripts')
    <script>
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
                a = false;
                return a;
            } else {
                $("#startdate").removeClass('invalid');
                a = true;
                return a;
            }
        }

        //        $(function(){
        //            $('#startdate').on('change',function() {
        //                checkDate();
        //            });
        //        });
        $('form').submit(function () {
            checkDate();
            return a;
        });

    </script>
@endsection
