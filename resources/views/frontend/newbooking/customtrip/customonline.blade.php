@extends('layouts.master')
@section('title')
    Online Payment
@endsection
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/online.css')}}">
    <style type="text/css">
        .top-payment img {
            margin-top: -11px !important;
        }
    </style>
@endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
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
    <div class="online-payment-details mb-30">
        <div class="container">
            <form name="myForm" id="myFormpay" action="https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment"
                  method="post">
                {{csrf_field()}}
                <?php
                $bank_charge = round(((3.82 / 100) * $totalP), 2);
                $amount_total = $totalP + $bank_charge;
                //            dd($amount_total);

                if (strpos($amount_total, '.') !== false) {
                    $allamount = explode('.', $amount_total);
                    if (strlen($allamount[1]) === 1) {
                        $cents = $allamount[1] . '0';
                    } else {
                        $cents = $allamount[1];
                    }
                    $jointprice = $allamount[0] . '.' . $cents;
                } else {
                    $jointprice = $amount_total . '.00';
                }

                if (is_numeric($jointprice) && strpos($jointprice, '.')) {
                    $money = str_replace('.', '', $jointprice);
                }

                $money = sprintf("%012s", $money);
                $invoiceNo = $invoice;
                //dollar 840  nepali 524
                $currentype = 840;
                ?>
                <input type="hidden" id="paymentGatewayID" name="paymentGatewayID" value="9103332813">
                <input type="hidden" id="invoiceNo" name="invoiceNo" value="{{$invoiceNo}}">
                <input type="hidden" id="productDesc" name="productDesc" value="{{$tripname}}">
                <input type="hidden" id="amount" name="amount" value="{{$money}}">
                <input type="hidden" id="currencyCode" name="currencyCode" value="{{$currentype}}">
                <input type="hidden" id="nonSecure" name="nonSecure" value="N">
                <input type="hidden" id="userDefined1" name="userDefined1" value="normaltrip">
                <?php
                $invoice = $invoiceNo;
                $paymentgateway = 9103332748;
                $price = $money;
                $currencyCode = $currentype;
                $nonSecure = 'Y';
                $signatureString = $paymentgateway . $invoice . $price . $currencyCode . $nonSecure;
                $securitycode = 'WJTUR2N2Q3Z5XGEJPC27XDR3C24IVHJT';
                $signData = hash_hmac('SHA256', $signatureString, $securitycode, false);
                $signData = strtoupper($signData);
                ?>
                <input type="hidden" id="hashValue" name="hashValue" value="{{$signData}}"/>
                <div class="invoice-details-box">
                    <div class="flex-box">
                        <div class="left-online">
                            <h3><strong>Invoice No</strong></h3>
                        </div>
                        <div class="arrow-icon flex">
                            <p><i class="fas fa-arrow-right"></i></p>
                        </div>
                        <div class="right-online">
                            <p>{{$invoiceNo}}</p>
                        </div>
                    </div>
                    <div class="flex-box">
                        <div class="left-online">
                            <h3><strong>Total Amount</strong></h3>
                        </div>
                        <div class="arrow-icon flex">
                            <p><i class="fas fa-arrow-right"></i></p>
                        </div>
                        <div class="right-online">
                            <p>USD $ {{$totalP}}</p>
                        </div>
                    </div>
                    <div class="flex-box">
                        <div class="left-online">
                            <h3><strong>Payment Portal charges: (3.82%)</strong></h3>
                        </div>
                        <div class="arrow-icon flex">
                            <p><i class="fas fa-arrow-right"></i></p>
                        </div>
                        <div class="right-online">
                            <p>USD $ {{$bank_charge}}</p>
                        </div>
                    </div>
                    <div class="flex-box">
                        <div class="left-online">
                            <h3><strong>Total Payable Amount</strong></h3>
                        </div>
                        <div class="arrow-icon flex">
                            <p><i class="fas fa-arrow-right"></i></p>
                        </div>
                        <div class="right-online">
                            <p>USD $ {{$amount_total}}</p>
                        </div>
                    </div>
                    <div class="confirm-button">
                        <button type="submit" class="btn-confirm">Confirm the Payment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
     <script type="text/javascript">
         $(window).load(function () {
             // alert('the form is loaded');
             setTimeout(function () {
                 $('#myFormpay').submit();
             }, 3000);
         });
     </script>--}}
@endsection