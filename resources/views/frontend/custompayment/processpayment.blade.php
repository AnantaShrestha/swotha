@extends('layouts.master')
@section('title')
   Payment Details | Swotah Travel and Adventure
@endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('metatags')
    <meta name="title" content="Payment Details | Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
@section('styles')
<style type="text/css">
.top-payment img {

    margin-top: -11px !important;
}
.online-payment
{
    
}
.invoice-generate
{
    background:#fff;
    box-shadow: 0px 0px 5px #000;
    padding:20px 30px;
    width:600px;
    margin:0px auto;
}
.invoice-table table {
    width: 100%;
}
.invoice-table table tbody
{
    line-height:50px;
    font-size:18px;

}
.online-btn
{
    background:#fc0;
    color:#111;
    font-weight:600;
    border:0px;
    padding:10px 15px;
    border-radius:30px;
    box-shadow: inset 0 0 0 0 #111;
  -webkit-transition: ease-out 0.6s;
  -moz-transition: ease-out 0.6s;
  transition: ease-out 0.6s;
}
.online-btn:hover
{
    box-shadow: inset 400px 0 0 0 #111;
    color:#fff;

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
    <section class="online-payment mb-30">
        <div class="container">
            <div class="invoice-generate">
                <form name="myForm" id="myFormpay" action="https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment"
                method="post">
                        {{csrf_field()}}
                        <?php
                        $totalP = $amount;
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
                    //            dd($money);
                        $invoiceNo = $invoice_number;
                    //dollar 840  nepali 524
                        $currentype = 840;
                        $userDefined1 = $user_defined;
                        ?>
                        <input type="hidden" id="paymentGatewayID" name="paymentGatewayID" value="9103332813">
                        <input type="hidden" id="invoiceNo" name="invoiceNo" value="{{$invoiceNo}}">
                        <input type="hidden" id="productDesc" name="productDesc" value="Nepal">
                        <input type="hidden" id="amount" name="amount" value="{{$money}}">
                        <input type="hidden" id="currencyCode" name="currencyCode" value="{{$currentype}}">
                        <input type="hidden" id="nonSecure" name="nonSecure" value="N">
                        <input type="hidden" id="userDefined1" name="userDefined1" value="{{$userDefined1}}">
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
                        <div class="invoice-table">
                            <table>
                            <tr>
                                <td>Invoice No</td>
                                <td>{{$invoiceNo}}</td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td>USD $ {{$totalP}}</td>
                            </tr>
                            <tr>
                                <td>Payment Portal charges: (3.82%)</td>
                                <td>USD $ {{$bank_charge}}</td>
                            </tr>
                            <tr>
                                <td>Total Payable Amount</td>
                                <td>USD $ {{$amount_total}}</td>
                            </tr>
                        </table>
                    </div>
                     <div class="payment-btn" style="text-align:center">
                        <button type="submit" class="online-btn">Confirm the Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('scripts')   
@endsection
