@extends('layouts.master')
@section('title')
    Payment | Swotah Travel and Adventure
@endsection
@section('metatags')
    <meta name="title" content="Payment Details | Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('styles')
    <!-- <link rel="stylesheet" href="{{url('css/frontend/booking.css?v=')}}<?php echo rand(1, 100000000)?>"> -->
    <style type="text/css">
        .top-payment img {

            margin-top: -11px !important;
        }

        .invoicePopBody h3 {
            font-size: 18px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 20px;
        }

        .action-button {
            text-align: center;
        }

        .action-button .yes {
            border: 0px;
            background: #0161ba;
            font-size: 16px;
            font-weight: 600;
            padding: 8px 40px;
            color: #fff;
        }

        .action-button .no {
            border: 0px;
            background: red;
            font-size: 16px;
            font-weight: 600;
            padding: 8px 40px;
            color: #fff;
        }

        .invoice-bg {
            display: block;
            overflow: hidden;
            background: #fff;
            box-shadow: 0px 0px 5px #000;
            padding: 20px 30px;
            width: 750px;
            margin: 0px auto;
            background-size: cover;
        }

        .invoice-control {
            width: 100%;
            line-height: 50px;
            padding: 0px 10px;
            border: 1px solid #222;
        }

        .invoice-btn {
            background: #fc0;
            line-height: 52px;
            font-size: 18px;
            font-weight: 600;
            color: #111;
            width: 100%;
            border: 0px;
            box-shadow: inset 0 0 0 0 #111;
            -webkit-transition: ease-out 0.6s;
            -moz-transition: ease-out 0.6s;
            transition: ease-out 0.6s;
        }

        .invoice-btn:hover {
            box-shadow: inset 400px 0 0 0 #111;
            color: #fff;

        }

        .invoicepayment {
            display: none;
        }

        .form-group label {
            font-size: 16px;
            font-weight: 600;
        }

        .red {
            font-size: 12px;
            color: red;
        }

        .onlinepayment {
            display: none;
        }

        .form-group {
            margin-bottom: 5px;
        }

        .online-control {
            line-height: 35px;
            border-radius: 30px;
            border: 1px solid #222;
            padding: 0px 10px;
            width: 100%;
        }

        .online-btn {
            background: #fc0;
            color: #111;
            font-weight: 600;
            border: 0px;
            padding: 10px 15px;
            border-radius: 30px;
            box-shadow: inset 0 0 0 0 #111;
            -webkit-transition: ease-out 0.6s;
            -moz-transition: ease-out 0.6s;
            transition: ease-out 0.6s;
        }

        .online-btn:hover {
            box-shadow: inset 400px 0 0 0 #111;
            color: #fff;

        }
    </style>
@endsection
@section('content')
    @include('layouts.navbar')
    <div class="container">
        <div class="section-title-black mt-30">
            <h2>Online Payment</h2>
            <div class="title-bg">
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
            </div>
        </div>
    </div>
    <section class="invoiceform mb-30">
        <div class="container">
            <div class="invoice-bg invoicepayment">
                <div class="inner-package-head-title mb-20">
                    <h3>Invoice Payment</h3>
                </div>
                @if(!empty($trip1))
                    @if($trip1 != "notripfound")
                        <div class="card payment-card" style="background: #e0e0e0; display: none;">
                            <div class="text-center"></div>
                            <div class="row">
                                <div class="col l6 m6 s12">
                                    <p><b>Invoice No: </b> {{$trip1->bid}}</p>
                                    <p><b> Name: </b> {{$trip1->booking->user->name or $trip1->tbooking->user->name}}
                                    </p>
                                    <p><b> Email: </b> {{$trip1->booking->user->email or $trip1->tbooking->user->email}}
                                    </p>
                                </div>
                                <div class="col l6 m6 s12">
                                    @if(!empty($trip1->booking))
                                        <p><b> Mobile Number: </b>{{$trip1->booking->user->details->phone  or "NA"}}</p>
                                    @else
                                        <p><b> Mobile Number: </b>{{$trip1->tbooking->user->details->phone or "NA"}}</p>
                                    @endif
                                    <p><b> Trip
                                            Name: </b> {{$trip1->booking->trips->trips->name or $trip1->tbooking->trips->name}}
                                    </p>
                                    <p><b> Due amount: </b> $ {{$trip1->left_amount_sum}} </p>
                                </div>
                            </div>
                            <div class="row text-center">
                                <form name="myForm" id="myForm" action="{{route('payment-invoice')}}" method="post"
                                      class="center-align">
                                    {{csrf_field()}}
                                    <input type="hidden" name="invoice_number" value="{{$trip1->bid}}">
                                    <div class="row">
                                        <button type="submit" class="waves-effect waves-light btn center-align"> Proceed
                                            to
                                            Online Payment
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="noinvoice">
                            <h5 style="font-size:14px;font-weight:500;margin-bottom:5px;color:red;">No any such Invoice
                                Number found in our system</h5>
                        </div>
                    @endif
                @else
                @endif

                <div class="row">
                    <div class="col-lg-8 pr-0">
                        <input id="invoice_number" name="invoice" type="number" min="0" class="invoice-control validate"
                               required placeholder="Invoice Number">
                    </div>
                    <div class="col-lg-4 col-md-4 pl-0 pr-0">
                        <button class="invoice-btn sendinvoice" type="submit" name="submit">Proceed Invoice</button>
                    </div>
                </div>

            </div>
            <div class="invoice-bg onlinepayment">
                <div class="inner-package-head-title mb-20">
                    <h3>Online Payment</h3>
                </div>
                <form name="myForm" id="myForm" action="/processpay" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Full Name <span class="red">*</span></label>
                                <input id="fullname" name="fullname" type="text" class="online-control validate"
                                       required placeholder="Full Name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Address <span class="red">*</span></label>
                                <input id="address" name="address" type="text" class="online-control validate" required
                                       placeholder="Address">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Email <span class="red">*</span></label>
                                <input id="email" name="email" type="email" class="online-control validate" required
                                       placeholder="Email">

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Phone Number <span class="red">*</span></label>
                                <input id="phone" name="phone" type="number" class="online-control validate" required
                                       placeholder="Phone Number">
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Trip Date <span class="red">*</span></label>
                                <input id="tripdate" type="date"
                                       name="tripdate" class="online-control" required>
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Amount in $ <span class="red">*</span></label>
                                <input id="amount" name="amount" type="number" step="0.01"
                                       class="online-control validate" min="1"
                                       required placeholder="Amount">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Purpose For Payment <span class="red">*</span></label>
                                <textarea id="purpose" name="purpose" rows="1" class="online-control"
                                          placeholder="Purpose For Payment"> </textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group" style="text-align:center">
                                <button type="submit" class="online-btn">Proceed to Online Payment</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>
    {{--confirmation popup--}}
    <div id="invoiceConfirmModal" class="modal fade invoicePop" role="dialog" data-keyboard="false"
         data-backdrop="static">
        <div class="modal-dialog" style="max-width:400px;margin-top:200px">
            <div class="modal-content">
                <div class="modal-body invoicePopBody">
                    <h3>Do you have invoice number ?</h3>
                    <div class="action-button">
                        <button class="yes inVoiceConfirm" value="Yes" data-dismiss="modal">Yes</button>
                        <button class="no inVoiceConfirm" value="No" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
{{--end of confirmation--}}
@section('scripts')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
                let yesorno;
                var dtToday = new Date();
                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if (month < 10)
                    month = '0' + month.toString();
                if (day < 10)
                    day = '0' + day.toString();

                var minDate = year + '-' + month + '-' + day;
                $('#tripdate').attr('min', minDate);
                @if(Request::is('custompayment'))
                     $('#invoiceConfirmModal').modal('show');
                @else
                    $('.onlinepayment').hide();
                    $('.invoicepayment').show();
                    @if(!empty($trip1))
                        var tripinfo = '{{$trip1}}';
                        $(".invoice_payment_temp").hide(400);
                        $(".payment-card").show(400);
                    @else
                        $('.noinvoice').show(400);
                    @endif
                @endif
                $('.inVoiceConfirm').on('click', function(){
                    yesorno = $(this).val();
                    if (yesorno == 'Yes') {
                        $('.invoicepayment').show();
                    } else {
                        $('.onlinepayment').show();

                    }
                });
                $('.sendinvoice').on('click', function(){
                    var invoice = $('#invoice_number').val();
                    if (invoice !== '') {
                        window.location.href = "{!!URL::to('custompayment/invoice')!!}/" + invoice;
                    }
                });
               
            });

    </script>
@endsection
