<!DOCTYPE html>
<html lang="">
<head>
    <title>
        @if(!empty($title))
            {{$title->content}}
        @else
            Swotah Travel and Adventure
        @endif
        @section('title')@show
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=0.5, minimum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Swotah Travel and Adventure">
    <meta name="google-site-verification" content="AoHWzWAAMdlSOaIwpSY81EKlFirenGteiZFaq2c7vfs"/>
    <meta name="ahrefs-site-verification" content="0c4c5e6b888488b310b4af2207119911310fb0dce99a5e0338e632fb5efdf373">
    <meta http-equiv="PRAGMA" content="NO-CACHE">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msvalidate.01" content="93887C47E11B526FC6085D31E22F38AB"/>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    @yield('metatags')
    
    @yield('seocontents')
    @section('metatags') @show
    <link rel="shortcut icon" href="{{url('https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1531014673/static_images/favicon.ico')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/plugin/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/setting.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/css/swiper.css">
    <link rel="stylesheet" type="text/css" href="https://kenwheeler.github.io/slick/slick/slick-theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    {!! Recaptcha::renderJs() !!}
    <style type="text/css">
        .notransition {
          -webkit-transition: none !important;
          -moz-transition: none !important;
          -o-transition: none !important;
          transition: none !important;
          transform: none !important;
        }
        .compare-slider{
            display:flex;
        }
    </style>
@section('styles') @show
</head>
<body>
<!-- <div id="loader-wrapper">
   <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>  -->
@yield('content')
@if(!Auth::user())
    <div class="custom-notification">
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="#" class="close-notification">&times</a>
                <p style="margin-top:5%">Please sign up or log in to enjoy up to $100 worth coupon code and for many
                    other exclusive discounts such
                    as: Last Minute Deals, Early Bird Discounts, Group Discounts and so on.</p>
                <div class="view-all-btn" style="margin-top:5px">
                    <p>
                        <a href="/login" class="btn-viewAll-white" style="background: #008EB0; color:white">Login/Sign
                            Up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@elseif(Auth::user() && (Auth::user()->is_active == 0))
    <div class="custom-notification">
        <a href="#" class="close-notification">&times</a>
        <p style="margin-top:5%">Please verify your account to enjoy all the exclusive features including Trip price,
            Discounts, Trip partners,
            Detailed itineraries, Price Customization and Bucket list</p>
        <a href="/profile/edit/resendprimary/{{Auth::user()->id}}" class="btn-viewAll-white"
           style="background: #008EB0; color:white; margin-left:40%; margin-top:5%">Verify</a>
    </div>
@endif
@include('layouts.footer1')
<script src="{{asset('js/plugin/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('js/plugin/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/js/swiper.js"></script>
<script src="{{asset('js/plugin/slick.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script src="{{asset('js/plugin/sticky.js')}}"></script>
<script src="{{asset('js/plugin/script.js')}}"></script>
<script src="{{asset('js/plugin/mainindex.js')}}"></script>
<script src="{{asset('js/plugin/lazysizes.min.js')}}"></script>
{{--<script data-main="{{asset('js/app')}}" src="{{asset('js/plugin/require.js')}}"></script>--}}

@include('layouts.alert')

@yield('scripts')
</body>
</html>

