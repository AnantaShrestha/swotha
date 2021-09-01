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
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, nepal trekking packages,
    trekking guide in nepal,short treks in nepal,nepal trekking companies,trekking in nepal costs, trekking in nepal himalaya
    trekking in nepal best time of year, trekking in himalaya, bucket list,Nepal travel, Adventure, Mountains, Tours">
@endsection
{{--End of meta tags--}}
{{--External css--}}
@section('styles')
    <link rel="stylesheet" href="{{url('css/frontend/index.css')}}">
    <link rel="stylesheet" href="{{url('css/w3.css')}}">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans"/>
    {{--<style>--}}
    {{--.parallax-container {--}}
    {{--height: 200px;--}}
    {{--}--}}
    {{--</style>--}}
@endsection
{{--end of content--}}
{{--Start of content section--}}
@section('content')
    @include('layouts.navbar')
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <form method="post" action="https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment">
        <input type="hidden" id="paymentGatewayID" name="paymentGatewayID" value="9103332813">
        <input type="hidden" id="invoiceNo" name="invoiceNo" value="1516869902">
        <input type="hidden" id="productDesc" name="productDesc" value="Nepal">
        <input type="hidden" id="amount" name="amount" value="000000000010">
        <input type="hidden" id="currencyCode" name="currencyCode" value="840">
        <input type="hidden" id="nonSecure" name="nonSecure" value="N">
        <?php
        $invoice = 1516869902;
        $paymentgateway = 9103332748;
        $price = 000000000010;
        $currencyCode = 840;
        $nonSecure = 'Y';
        $signatureString = $paymentgateway . $invoice . $price . $currencyCode . $nonSecure;
        $securitycode = '967NYD9LQSIORON44Y60YU1E9B0FHBSI';
        $signData = hash_hmac('SHA256', $signatureString, $securitycode, false);
        $signData = strtoupper($signData);
        ?>
        <input type="hidden" id="hashValue" name="hashValue" value="{{$signData}}"/>
        <button type="submit" class="waves-effect waves-light btn"
                name="submit">Pay Online
        </button>
    </form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.slider').slider();
        });
    </script>
@endsection



