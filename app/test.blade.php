<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{URL::TO('css/front-end/meganav.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>


<style>
    input[placeholder], [placeholder], *[placeholder] {
        color: darkgrey !important;
        text-align: center;
        background-color: white;
    }

    @media only screen and (max-width: 768px) {

        .nav > li#small {
            display: inline-block;

        }
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -2px;
        background-color: #090102b3 !IMPORTANT;
        border-bottom: 3px solid red;
        height: 400px;
    }

    .dropdown-menu > li > a {
        color: white;
    }

    /*#secondmenu
    {
        margin-top:-20px;
    }*/


    #seconddrop {
        /*position: absolute;*/
        top: 100%;
        background-color: #090102b3 !IMPORTANT;
        height: 400px !important;


        left: 39%;
        width: 20%;
        /*margin-right:%;00px;*/
    }

    #seconddrop2 {
        /*position: absolute;*/
        top: 100%;
        background-color: #090102b3 !IMPORTANT;
        height: 400px !important;


        left: 46%;
        width: 20%;
        /*margin-right:%;00px;*/
    }

    #maindrop {
        /*position: absolute;*/
        top: 100%;
        background-color: #090102b3 !IMPORTANT;
        height: 400px !important;


        width: 100%;
        /*margin-right:%;00px;*/
    }

    a.test {
        margin-top: 20px;
    }

    #fixattop1 {
        position: absolute;
        top: -20px;
    }

    #fixattop2 {
        position: absolute;
        top: -116px;
    }
</style>

<body>
<nav class="navbar navbar-transparent navbar-fixed-top " id="second"
     style="z-index:10000;width:70%;margin-top:-20px;background-color: rgba(170, 170, 170, 0.01);font-size:14px !important">
    <div class="container">
        <ul class="nav navbar-nav navbar-right" id="navsecond">
            <li id="small"><a href="/wish">
                    <i class="fa fa-heart visible-xs-inline-block fa-lg" aria-hidden="true"></i>


                    <span class="hidden-xs"><i class="fa fa-heart fa-4x"></i> <span id="count">@if(!empty($wishlist) and $wishlist > 0 )
                                ( {{$wishlist}} )@endif</span> Bucket List </span></a>
            </li>
            <li id="small">

                @if(!Auth::user())
                    <a href="/login"><i class="fa fa-user visible-xs-inline-block fa-lg" aria-hidden="true"></i>
                        <span class="hidden-xs"><i class="fa fa-user" aria-hidden="true"></i> Sign In</span></a>
                @else
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        <span><i class="fa fa-user-times visible-xs-inline-block fa-2x" aria-hidden="true"></i> </span>
                        <span class="hidden-xs"><i class="fa fa-user" aria-hidden="true"></i> Sign Out(<small>{{Auth::user()->name}}</small>)</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif
            </li>
            <li id="small"><a href="#">
                    <i class="fa fa-book visible-xs-inline-block fa-lg" aria-hidden="true"></i>


                    <span class="hidden-xs"><i class="fa fa-book" aria-hidden="true"></i>Brochures</span></a>
            </li>
            <li id="small"><a href="#">
                    <i class="fa fa-phone visible-xs-inline-block fa-lg" aria-hidden="true"></i>
                    <span class="hidden-xs"><i class="fa fa-phone" aria-hidden="true"></i><i
                                class="fa fa-weixin fa-2x"></i>  +977-9841595962</span></a>
            </li>
        </ul>
    </div>
</nav>


<nav class="navbar navbar-ct-red navbar-transparent navbar-fixed-top nyav shrink"
     style="z-index: 5000;width:100% !important;" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar1">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand">
                <a href="/"><img src="{{URL::TO('img/swotah_official.png')}}" class="img-responsive"
                                 style="height: 58px;" id="logoimg"{{--margin-top:-28px"--}} /></a>
            </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="myNavbar1">
            <ul class="nav navbar-nav">
                <li class="dropdown mega-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Destinations <b class="caret"></b></a>
                    <ul class="dropdown-menu row no-gutter" id="maindrop"
                        {{--style="width: 900px;padding: 20px 0px;"--}} id="#blackground"
                        style="background-color: rgba(39, 33, 33, 0.5);">
                        <?php $count = 0;?>
                        @foreach($destinations as $destination)
                            @if($count < 10)
                                <li class="col-sm-3 col-xs-12" style="margin:0 -20px 0 -50px">
                                    <ul>
                                        {{--<li class="dropdown-header" style="font-size: 150%">{{ucfirst($destination->country_name)}}</li>--}}
                                        <li><a href="/destination/{{$destination->id}}"><img id="ress"
                                                                                             src="{{url('img/destinations/'.$destination->image)}}"
                                                                                             class="img-responsive"
                                                                                             alt="nepal"
                                                                                             style="max-height: 250px;height: 163px;width: 100%;margin-bottom:20px; border-radius:6px; border:solid #D8343D 1px">
                                                <div class="bottomleftmenu">{{$destination->country_name}}</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                @break
                            @endif
                            <?php $count++ ?>
                        @endforeach
                    </ul>
                </li>
                <li class="dropdown mega-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Ventures <b class="caret"></b></a>
                    <ul class="dropdown-menu row no-gutter"
                        id="maindrop"{{--style="width: 900px;padding: 20px 0px;"--}}>
                        <?php $count = 0;?>
                        @foreach($themes as $theme)
                            @if($count < 10)
                                <li class="col-sm-3 col-xs-12" style="margin:0 -20px 0 -50px">
                                    <ul>
                                        {{--<li class="dropdown-header" style="font-size: 150%">{{ucfirst($theme->theme_name)}}</li>--}}
                                        <li><a href="/theme/{{$theme->id}}"><img id="ress"
                                                                                 src="{{url('img/themes/'.$theme->image)}}"
                                                                                 class="img-responsive" alt="nepal"
                                                                                 style="max-height: 250px;height:163px;width: 100%;margin-bottom:20px; border-radius:6px; border:solid #D8343D 1px">
                                                <div class="bottomleftmenu">{{$theme->theme_name}}</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                @break
                            @endif
                            <?php $count++ ?>
                        @endforeach
                    </ul>
                </li>
                <li class="dropdown mega-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Swotah <b class="caret"></b></a>
                    <ul class="dropdown-menu row no-gutter"
                        id="seconddrop"{{--style="width: 900px;padding: 20px 0px;"--}}>

                        <li class="dropdown-submenu" id="secondmenu">
                            <a class="test" tabindex="-1" href="/about">About Swotah<span class="caret"></span></a>
                            <ul class="dropdown-menu" id="fixattop1">
                                <li><a href="/styles"><h1>About Swotah</h1></a></li>
                                <li role="presentation" class="divider"></li>
                                <li><a tabindex="-1" href="/about">Our Story</a></li>
                                <li><a tabindex="-1" href="#">Our belief</a></li>
                                <li><a tabindex="-1" href="/loyalty">Loyalty Program</a></li>
                                <li><a tabindex="-1" href="/blog">Swotah Blog</a></li>
                                <li><a tabindex="-1" href="/blog">History</a></li>


                            </ul>
                        </li>
                        <li>

                            <a class="test" tabindex="-1" href="/style1">Our Styles</a>
                            {{-- <ul class="dropdown-menu">
                                 <li><a href="/styles"><h1>Our Styles</h1></a></li>
                                 <li role="presentation" class="divider"></li>
                                 <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
                                 <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
                                 <li><a tabindex="-1" href="/styles">Our Styles</a></li>
                             </ul>--}}
                        </li>
                        <li class="dropdown-submenu" id="secondmenu">
                            <a class="test" tabindex="-1" href="#">Members FAQ<span class="caret"></span></a>
                            <ul class="dropdown-menu" id="fixattop2">
                                <li><a href="/faq"><h1>FAQ</h1></a></li>
                                <li role="presentation" class="divider"></li>

                                <li><a tabindex="-1" href="#">Terms and conditions</a></li>
                                <li><a tabindex="-1" href="/styles">Legal Aspects</a></li>
                                <li><a tabindex="-1" href="/styles">Employment</a></li>
                                <li><a tabindex="-1" href="/styles">Travel Guide</a></li>
                                <li><a tabindex="-1" href="/styles">Volunteering</a></li>

                            </ul>
                        </li>
                        {{--<li class="dropdown-submenu" id="secondmenu">
                            <a class="test" tabindex="-1" href="#">New dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
                                <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
                                <li><a tabindex="-1" href="/styles">Our Styles</a></li>
                            </ul>
                        </li>--}}
                    </ul>
                </li>

                <li class="dropdown mega-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Special Deals <b class="caret"></b></a>
                    <ul class="dropdown-menu row no-gutter"
                        id="seconddrop2"{{--style="width: 900px;padding: 20px 0px;"--}}>
                        <li><a tabindex="-1" href="/about">HERE ARE THE LINKS</a></li>
                        <li><a tabindex="-1" href="#">HERE ARE THE LINKS</a></li>
                        <li><a tabindex="-1" href="/loyalty">HERE ARE THE LINKS</a></li>
                        <li><a tabindex="-1" href="/blog">HERE ARE THE LINKS</a></li>
                        <li><a tabindex="-1" href="/blog">HERE ARE THE LINKS</a></li>


                    </ul>
                </li>
                <li>
                    <form class="navbar-form" role="search" id="navsearch" action="{{route('searchtrips')}}">
                        <div class="input-group">
                            <input type="text" class="form-control" id="navsearchsmall" placeholder="Search" style="border: 2px solid #ccc;-webkit-border-radius: 50px;
                                          -moz-border-radius: 50px;
                                           border-radius: 50px;width:350px;background: white" name="tripsearch">
                            <div class="input-group-btn">
                                <button class="btn btn-default"
                                        style="color:#ccc;border:0;margin-top: -4px;background-color: #D8343D;height: 29px;"
                                        id="navsearchsmallbutton" type="submit"><i
                                            class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>


        </div>
    </div><!-- /.nav-collapse -->
</nav>
<script>
    $(document).ready(function () {
        $('.dropdown-submenu a.test').on("click", function (e) {
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });
</script>