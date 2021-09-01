@extends('layouts.master')
@section('title')
    Payment Details | Swotah Travel and Adventure
@endsection

@section('metatags')

@endsection

@section('content')
    @include('layouts.navbar2')
    @if($choice == 'lastminutefixed')
    <form name="myForm" id="myFormpay" action="/generatelastminuteinvoice" method="post">
        {{csrf_field()}}
    </form>
    @endif

    @if($choice == 'normaltrip')
        <form name="myForm" id="myFormpay" action="/generatenormalinvoice" method="post">
            {{csrf_field()}}
            <input type="hidden" name = "bid" value="{{$data['bid']}}">
            <input type="hidden" name = "chosen" value="{{$data['chosen']}}">
            <input type="hidden" name = "discount" value="{{$data['discount']}}">
            <input type="hidden" name = "gdiscount" value="{{$data['gdiscount']}}">
            <input type="hidden" name = "sdiscount" value="{{$data['sdiscount']}}">
            <input type="hidden" name = "trip_id" value="{{$data['trip_id']}}">
            <input type="hidden" name = "trip_date" value="{{$data['trip_date']}}">
            <input type="hidden" name = "confirm_pay" value="{{$data['confirm_pay']}}">
            <input type="hidden" name = "confirm_due" value="{{$data['confirm_due']}}">
            <input type="hidden" name = "status" value="{{$data['status']}}">
        </form>
    @endif

    @if($choice == 'customtrip')
        <form name="myForm" id="myFormpay" action="/generatecustomizedtripinvoice" method="post">
            {{csrf_field()}}
            <input type="hidden" name = "bid" value="{{$data['bid']}}">
            <input type="hidden" name = "chosen" value="{{$data['chosen']}}">
            <input type="hidden" name = "discount" value="{{$data['discount']}}">
            <input type="hidden" name = "gdiscount" value="{{$data['gdiscount']}}">
            <input type="hidden" name = "sdiscount" value="{{$data['sdiscount']}}">
            <input type="hidden" name = "trip_id" value="{{$data['trip_id']}}">
            <input type="hidden" name = "trip_date" value="{{$data['trip_date']}}">
            <input type="hidden" name = "confirm_pay" value="{{$data['confirm_pay']}}">
            <input type="hidden" name = "confirm_due" value="{{$data['confirm_due']}}">
            <input type="hidden" name = "status" value="{{$data['status']}}">
        </form>
    @endif
@endsection
@section('scripts')
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript">
        $(window).load(function () {
            // alert('the form is loaded');
            setTimeout(function () {
                $('#myFormpay').submit();
            }, 1000);
        });
    </script>
@endsection