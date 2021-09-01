<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    @yield('title')
    @yield('metatags')
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">
    <meta name="author" content="Swotah Travel and Adventure">
    <meta name="google-site-verification" content="hU8p3h2vtwEcNUJahw1_zK2P-WLYiG3HSP7U7UCD5H0" />
    <meta http-equiv="PRAGMA" content="NO-CACHE">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:image" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    <link rel="shortcut icon" href="{{{ asset('images/favicon.ico') }}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.1/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.1/assets/owl.theme.default.min.css">
    {{--<link rel="stylesheet" href="{{url('css/frontend/master.css')}}">--}}
    <link rel="stylesheet" href="https://res.cloudinary.com/images-swotahtravel-com/raw/upload/v1530670696/css/master.css">
    <link rel="stylesheet" type="text/css" href="https://res.cloudinary.com/images-swotahtravel-com/raw/upload/v1530671031/css/search.css">
    <link rel="stylesheet" href="https://res.cloudinary.com/images-swotahtravel-com/raw/upload/v1530671059/css/frontend.css">
    <link rel="stylesheet" href="https://res.cloudinary.com/images-swotahtravel-com/raw/upload/v1530671077/css/fonts.css">
    <link rel="stylesheet" href="https://res.cloudinary.com/images-swotahtravel-com/raw/upload/v1530672249/css/review.css">
    <link rel="stylesheet" href="https://res.cloudinary.com/images-swotahtravel-com/raw/upload/v1530671098/css/footer.css">

    <style>
        #topbtn{
            display: none;
            position: fixed;
            bottom: 80px;
            right: 27px;
            cursor: pointer;
        }

        .bor{
            border: 1px solid red;
        }

        @media only screen and (min-width: 900px){
            .newsletter{
                width: 50%;
            }
        }
        .newsletter{
            overflow: hidden;
            /*border-radius: 5px;*/
            color:#008FB0;
            padding: 26px 5px;
        }

        @media only screen and (max-width:325px){
            .nothanks{
                margin-top: 8px;
            }
        }

        .newsletter .btn{
            color: snow;
            font-size: 14px;
            border:1px solid #008FB0;
            background-color: #008FB0;
        }
        .newsletter .btn:hover{
            background-color: #008FB0;
            color: snow;
            font-size: 18px;
            font-weight: bolder;
        }
        #oneemail{
            box-shadow: none;
            padding-left:2px;
            border: 1px solid #008FB0 !important;
        }

        .newsletter p{
            line-height: 0;
            font-size: 15px;
        }

        .newsletter .input-field.col label {
            margin-top: 0;
        }

        .newsletter label b{
            color: #008FB0 !important;
        }

        .close_btn{
            background-color: snow;
            color: #0b0b0b;
            position: absolute;
            top:0px;
            right:1px;
            height: 30px;
            width: 30px;
            padding: 5px;
            border-radius: 50px;
            border: none;
            font-weight: bold;
            /*font-size: 12px;*/
        }
        .close_btn:hover, .close_btn:active, .close_btn:focus {
            background-color: snow;
        }

        .swal2-popup .swal2-content {
            font-size: 18px;
            text-align: center;
            font-weight: 300;
            position: relative;
            float: none;
            margin: 0;
            padding: 0;
            line-height: normal;
            color: white!important;
            word-wrap: break-word;
        }

    </style>
    @yield('styles')
</head>

<body>
<!-- Modal Structure -->
@yield('content')

<div id="modal100" class="modal newsletter" style="">
    <button class=" modal-action modal-close close_btn">
        &times;
    </button>
    <div class="row center-align">
        {{--<h4>Swotah Travel</h4>--}}
        <h4><b>Let's stay in touch</b></h4>
        <p>Subscribe to our Newsletter</p>
        <span class="emailres" style="color:red;"></span>
        <div class="input-field col l8 offset-l2 m8 offset-m2 s12 center-align">
            <input type="email" id="oneemail"  name ="oneemail" class="validate" autocomplete="off" required style="border: 1px solid">
            <label for="name"><b>Enter your email here</b></label>
        </div>
    </div>
    <div class="col l12 center-align">
        <button type="submit" id="submite" class="waves-effect waves-light btn">Subscribe</button>
        <button type="submit" class="modal-action modal-close waves-effect waves-light btn nothanks">No Thanks</button>
    </div>

</div>

<div id="modal101" class="modal" style="width: 30%; overflow: hidden;">
    <div class="row center-align" style="padding: 20px;">
        <span class="emailres"></span>
    </div>
    <div class="col l12 center-align">
        <button type="submit" class="modal-action modal-close waves-effect waves-light btn">Okay</button>
    </div>
</div>

<a class="btn-floating waves-effect waves-light hbb scrollup tooltipped" data-tooltip="Go To Top" data-position="top" data-delay="10" onclick="topFunction()" id="topbtn" title="Go to top">
    <img src="{{url('images/top.png')}}" style="margin-top: 1px;
    margin-left: 2px;">
</a>


<!-- Modal Structure -->
<div id="modal20" class="modal">
    <div class="modal-content">
        <a class="modal-action modal-close waves-effect waves-light btn center" style="width:100%;">Select Another Trip </a>
    </div>
</div>

<div id="modal2" class="modal">
    <div class="modal-content" style="text-align: center;">
        You have selected two trips. You can compare these trips or add another. <br>
        <a class="modal-action modal-close waves-effect waves-light btn center" style="width:100%;">Add another trip</a>
        <span class="CompareOr" >OR</span>
        <a href="javascript:ViewComparison();" class="modal-action modal-close waves-effect waves-light btn center" style="width:100%;">Compare Trips</a>
    </div>
</div>

<!-- Modal Structure -->
<div id="modal3" class="modal">
    <div class="modal-content">
        <h5>You have already checked trips.You can compare 2 or 3 trips only</h5>
    </div>
    <div class="modal-footer">
        <a href="#" class="modal-action modal-close waves-effect waves-light center">Okay</a>
    </div>
</div>


<script>
    var trips = [];
    var compareTemp = false;
    function compareTo(a, b) {
        // alert("I am here");
        var found = false;
        for(var i=0; i < trips.length; i++){
            /* alert("I am for loop");*/
            if(trips[i] == a){
                /* alert("I am in if else");*/
                found = true;
                trips.splice(i,1);
            }
        }
        if(found == false) {
            $(b).addClass('active');
            if (trips.length == 3) {
                compareTemp = true;
            } else {
                trips.push(a);
                var tripsno = trips.length;
                /* alert(tripsno);*/
                switch (tripsno) {
                    case 1:
                        // alert("I am number 1");
                        $('#modal20').modal('open');
                        compareTemp = false;
                        break;
                    case 2:
                        /* alert("I am in number 2");*/
                        compareTemp = false;
                        $("#modal2").modal('open');
                        break;
                    case 3:
                        ViewComparison();
                        break;
                    /* case 4:
                         $("#modal3").modal('open');
                         break;*/
                }
            }
        }
        else {
            $(b).removeClass('active');
        }
    }

    function ViewComparison() {
        var triplist ="";
        for (var i = 0; i < trips.length; i++) {
            triplist = triplist + trips[i] + ",";
        }
        if (triplist.length > 0) {
            triplist = triplist.substring(0, triplist.length - 1);

        }
        var compareurl = "/compare/" + triplist;
        for (var i = 0; i < trips.length; i++) {

        }
        window.open(compareurl,'_blank');
        trips.length =0;
        trips.checked =false;
        var compareCheckbox = document.getElementsByClassName("compareCheckbox");

        for(i=0; i< compareCheckbox.length ; i++){
            compareCheckbox[i].checked = false;
        }
        // location.reload();
    }


</script>
{{--Scripts--}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
<script type="text/javascript" src="{{url('js/owl.carousel.min.js')}}"></script>
<script>
    $(document).ready(function(){
        // alert('fdsfdsfds');
        $('#owl-1 .owl-carousel').owlCarousel({
            // items:5,
            // stagePadding:50,
            margin:10,
            autoplay:true,
            loop:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            dots: false,
            dotsEach:true,
            nav:true,
            navText: ['',''],
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    navbar:true
                },
                600:{
                    items:3,
                    navbar:true
                },
                1000:{
                    items:4,
                    navbar:true
                }
            }
        });

        $('#owl-2 .owl-carousel').owlCarousel({
            // items:5,
            loop:true,
            center: true,
            lazyLoad: true,
            margin:10,
            animateOut: 'slideOutDown',
            animateIn: 'flipInX',
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            dots: false,
            dotsEach: true,
            nav:true,
            navText: ['',''],
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    navbar:true
                },
                600:{
                    items:3,
                    navbar:true
                },
                1000:{
                    items:4,
                    navbar:true
                }
            }
        });
        $('#owl-3 .owl-carousel').owlCarousel({
            // items:5,
            //  loop:true,
            lazyLoad: true,
            margin:10,
            animateOut: 'slideOutDown',
            animateIn: 'flipInX',
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            dots: false,
            dotsEach: true,
            nav:true,
            navText: ['',''],
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    navbar:true
                },
                600:{
                    items:2,
                    navbar:true
                },
                1000:{
                    items:3,
                    navbar:true
                },
                1340:{
                    items:4,
                    navbar:true
                }
            }
        });
    });

    $('.reviewCarousel').owlCarousel({
        loop:true,
        margin:10,
        rewind:true,
        dots:true,
        autoplay:true,
        autoplayTimeout:30000,
        autoplayHoverPause:true,
        lazyLoad: true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:1,
                nav:false
            },
            1000:{
                items:1,
                nav:true,
                loop:false
            }
        }
    });
</script>

<script type="text/javascript">
    $(".blog_temp2").hide();

    function changeRecentBlogs(){
        $(".blog_temp1").show();
        $(".blog_temp2").hide();
    }

    function changeReviewedBlogs(){
        $(".blog_temp2").show();
        $(".blog_temp1").hide();
    }
</script>

<script>
    $(document).ready(function(){
        $('.owl-2 .blogCourosel').owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            slideSpeed: 200,
            rewind:true,
            center: true,
            lazyLoad: true,
            animateOut: 'slideOutDown',
            animateIn: 'flipInX',
            autoplay:true,
            autoplayTimeout:4000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:1,
                    nav:true
                },
                768:{
                    items:3,
                    nav:true
                },
                1000:{
                    items:3,
                    nav:true
                }
            }
        })

    });

</script>

<script>
    $(document).ready(function(){
        $('.owl-2 .galleryCaurosel').owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            slideSpeed: 200,
            rewind:true,
            center: true,
            lazyLoad: true,
            animateOut: 'slideOutDown',
            animateIn: 'flipInX',
            autoplay:true,
            autoplayTimeout:4000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:1,
                    nav:true
                },
                768:{
                    items:1,
                    nav:true
                },
                1000:{
                    items:1,
                    nav:true
                }
            }
        })

    });

</script>

<script>
    $(document).ready(function(){
        $('.owl-2 .recentblogCourosel').owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            slideSpeed: 200,
            rewind:true,
            center: true,
            lazyLoad: true,
            animateOut: 'slideOutDown',
            animateIn: 'flipInX',
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:3,
                    nav:true
                },
                1000:{
                    items:4,
                    nav:true
                }
            }
        })

    });

</script>

<script>
    $(document).ready(function(){
        $('.owl-2 .mostblogCourosel').owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            slideSpeed: 200,
            rewind:true,
            center: true,
            lazyLoad: true,
            animateOut: 'slideOutDown',
            animateIn: 'flipInX',
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:3,
                    nav:true
                },
                1000:{
                    items:4,
                    nav:true
                }
            }
        })

    });

</script>
<script type="text/javascript" src="{{url('js/lightslider.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/master.js')}}"></script>
<script type="text/javascript" src="{{url('js/sweetalert2.all.min.js')}}"></script>
@include('layouts.alert')

@if(!Auth::user())
    <script>
        if(sessionStorage.getItem('popState') != 'shown'){
            setTimeout(function () {
                $('#modal69').modal('open');
                swal({
                    html:
                    'Please <a href="/login" style="color: white;background: tomato;padding: 2px 5px;"><b>log in</b></a> or <a href="/register" style="color: white;background: tomato;padding: 2px 5px;"><b>Sign up </b></a>to enjoy all the exclusive ' +
                    'features such' +
                    ' as: ' +
                    'Trip price, Discounts, Trip partners, Detailed programs, Customization, Bucket list and so on',
                    showCloseButton: true,
                    showCancelButton: false,
                    showConfirmButton: false,
                    animation: false,
                    customClass: 'animated tada',
                    focusConfirm: false,
                    position: 'top-right',
                    background:'#008eb0'
                });

            }, 25000);
            sessionStorage.setItem('popState','shown')
        }
    </script>
@elseif(Auth::user() && (Auth::user()->is_active == 0))
    <script>
        if(sessionStorage.getItem('popState1') != 'shown'){
            setTimeout(function () {
                swal({
                    html:
                    'Please <a style="text-decoration:underline;color:black;" href="/profile/edit/resendprimary/{{Auth::user()->id}}"><b>verify</b></a> your account to enjoy all the exclusive features such as: ' +
                    'Trip price, Discounts, Trip partners, Detailed programs, Customization, Bucket list and so on',
                    showCloseButton: true,
                    showCancelButton: false,
                    showConfirmButton: false,
                    animation: false,
                    customClass: 'animated tada',
                    focusConfirm: false,
                    position: 'top-right',
                    background:'#008eb0'
                });

            }, 1000);
            sessionStorage.setItem('popState1','shown')
        }
    </script>
@endif

<script>
    $(document).ready(function() {
        $("#submite").click(function () {
            var email = $("#oneemail").val();
            if(email === ""){
                alert('empty email address');
            }

            var token = $('input[name=_token]').val();

            $.ajax({
                type:'post',
                url:'/emailsubscribe',
                data:{
                    '_token': token,
                    'email':email
                },
                success:function (data) {
                    $('.emailres').html(data[1]);
                    if(data[0] != 0){
                        $('#modal100').modal('close');
                        $('#modal101').modal('open');
                    }

                }
            })

        });
    });

    $("form#uploadAnonymous").submit(function (e) {
        $('.uploadAnonymousPhoto').html('<img src="{{url('images/profile/loading.gif')}}" class="img-anonymous responsive-img circle center-align">');
        e.preventDefault();
        var formData = new FormData(this);
        $('#uploadAnonymousModal').fadeOut(3000);
        $.ajax({
            type: 'POST',
            async: false,
            url: "/upload-image",
            data: formData,
            success: function (data) {
                $('.uploadAnonymousPhoto').html('<img src="'+data[0]+'" alt="" class="img-anonymous responsive-img circle center-align">');
                $('#photo').val(data[1]);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    //for backend
    $("form#backendModalPhotoUpload").submit(function (e) {
        $('.uploadAnonymousPhoto').html('<img src="{{url('images/profile/loading.gif')}}" class="img-anonymous responsive-img circle center-align">');
        e.preventDefault();
        var formData = new FormData(this);
        $('#uploadAnonymousModal').fadeOut(3000);
        $.ajax({
            type: 'POST',
            async: false,
            url: "/backend-upload-image",
            data: formData,
            success: function (data) {
                $('.uploadAnonymousPhoto').html('<img src="'+data[0]+'" alt="" class="circle">');
                $('#photo').val(data[1]);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
</script>
<script type="text/javascript" src="{{url('js/blur.js')}}"></script>
<script type="text/javascript" src="{{url('js/lazysizes.min.js')}}"></script>
@yield('scripts')
</body>
</html>