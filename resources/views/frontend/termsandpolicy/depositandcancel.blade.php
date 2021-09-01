@extends('layouts.master')
<title>Deposit and Cancellation Policy | Swotah Travel and Adventure</title>
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="Deposit and Cancellation Policy   | Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
{{--End of meta tags--}}
@section('styles')
    <style type="text/css">
        table tr td {
            padding: 0px 5px;
            border: 1px solid black;
            height: 0px;
            font-size: 12px;
            width: 100% !important;
        }

        table {
            width: 90% !important;
            margin: auto;
        }

        @media only screen  and (max-width: 600px) {
            table tr td {
                padding: 0px;
            }
        }
    </style>
@endsection
@section('content')
    @include('layouts.navbar')
    <section class="all-footer-inner-page">
        <div class="container">
            <div class="section-title-black">
                <h2> Deposit and Cancellation Policy</h2>
                <div class="title-bg">
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                </div>
            </div>
            <div class="allfooter-content">
                @if($depositDetails)
                    <div style="width: 90%;margin:auto;text-align: justify;">
                        {!! $depositDetails->deposit_details !!}
                    </div>
                @else
                    <div style="text-align: center;min-height: 300px;">
                        <p> NO DEPOSIT AND CANCELLATION POLICY</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
