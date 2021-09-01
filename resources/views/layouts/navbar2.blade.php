<style>

    header.shrink {
        height: 56px;
        background: #00253c;
        z-index: 999;
        box-shadow: rgba(0,0,0,.7) 0 0 15px;
    }

    header.shrink img#image {
        height: 70px;
        margin-top: -5px;
        -webkit-transition: all 1s;
        -moz-transition: all 1s;
        -ms-transition: all 1s;
        -o-transition: all 1s;
        transition: all 1s;
    }

    header .navbutton {
        top: 6px;
        bottom: 0px;
        z-index: 0;
        position: absolute;
    }

    .showonmedanddown a {
        right: 23px;
        position: absolute;
        top: 17px;
    }

    .dropdownMenu li{
        padding:0px!important;
    }

    .dropdownMenu a{
        padding:5px!important;
        color:white!important;
        font-size: 15px!important;
    }

    .dropdownMenu a:hover{
        color:black!important;
    }

    .dropdown-content .dropdownMenu li{
        line-height: 2px;
        min-height:10px;
    }

    .side-nav{
        background: #008EB0;
    }

    .side-nav a{
        color: white;
    }
    .mySideNav>li>a, .side-nav li>a{
        color:white!important;
    }
    input#sideSearch{
        background: white!important;
    }

</style>

<style>
    #horizontal-list li{
        transition:ease-out;
    }

    #search{
        height: 26px;
        width: 100%;
        border: 1px solid white;
        border-radius: 20px;
        background-color: white;
    }
    #searchfield{
        position: relative;
        margin-top: 30px;
        width: 250px;

    }

    #testo li{
        display: inline-block;
    }
    .socialobuttons
    {
        float: left;
        margin-top: -18px;
    }


    #meroapp li a {
        background: #cccccc;
        border-radius: 1px;
        color: #ffffff;
        display: inline-block;
        line-height: 24px;
        text-align: center;
        height: 24px;
        width: 24px;
    }

    #meroapp li a.facebook:hover {
        background-color: #4867aa;
    }

    #meroapp li a.twitter:hover {
        background-color: #1da1f2;
    }

    #meroapp li a.linkedin:hover {
        background-color: #0077b5;
    }
    #meroapp li a.instagram:hover{
        background-color: #8a3ab9;
    }

    #meroapp li a.youtube:hover{
        background-color: #fe3700;
    }

    #meroapp li a.google-plus:hover{
        background-color: #dd4b39;
    }

    #meroapp li a.pinterest:hover{
        background-color: #bd081c;
    }


    #searchbarwithothers li a{
        display: inline-block;
        align-items: center;
        height: 100%;
    }

    /*#meroapp li a:hover {*/
    /*background-color: gray;*/
    /*}*/

    .custimage{
        height: 26px;
        position: absolute;
        background-color: transparent;
        margin-top: 6px;
        left:50%;
    }
    .custimage2 {
        height: 26px;
        position: absolute;
        background-color: transparent;
        margin-top: 6px;
        left: 50%;
    }

    @media only screen and (max-width:760px) {
        #meroapp li {
            display:none;
        }

    }

    .rightma{
        margin-top: -28px;
        float: right;
    }
    /*@media only screen and (min-width: 760px){*/
    /*.rightma{*/

    /*}*/
    /*}*/

    @media only screen and (min-width:500px) and (max-width: 760px)  {
        .rightma{
            float: none;
            margin-left: 33%;
        }
    }

    @media only screen and (min-width: 100px) and (max-width: 499px) {
        .rightma {
            float: none;
            margin-left: 15%;
        }

    }

    @media only screen and (min-width:761px) {
        #meroapp li{
            display: inline-block;
        }
    }


    @media only screen and (max-width:600px){
        .custimage{
            display: none;
        }
    }

    .dropdownMenu li{
        padding:0px!important;
    }

    .dropdownMenu a{
        padding:5px!important;
        color:white!important;
        font-size: 15px!important;
    }

    .dropdownMenu a:hover{
        color:black!important;
    }

    .dropdown-content .dropdownMenu li{
        line-height: 2px;
        min-height:10px;
    }
    .side-nav{
        background: #008EB0;
    }

    .side-nav a{
        color: white;
    }
    .mySideNav>li>a, .side-nav li>a{
        color:white!important;
    }
    input#sideSearch{
        background: white!important;
    }
    .mySideNav ul li a{
        background: #3aacc7;
        color: black
    }

    .navBtn , .bttn4{
        background: #1C9AB9;
        border-right: 2px solid white!important;
    }

    #dropdown1.dropdown-content, #dropdown2.dropdown-content, #dropdown3.dropdown-content, #dropdown4.dropdown-content{
        background: rgba(255,255,255,0.8);
    }
</style>

<header id = "wrapper1" class = "nav-container shrink">

    <div class="logo-container">
        <a href = "/">
            <img id = "image" class="brand-logo lazyload" data-src="{{url('images/logos/logo.png')}}" alt="Swotah Travel">
        </a>
    </div>

    <div class="fixed-action-btn horizontal click-to-toggle navbutton hide-on-small-only hide-on-med-only">
        <a id = "menu" class="merobutton btn-floating btn-small hbb menu-close tooltipped" data-tooltip="MENU" style="background-color: #008EB0">
            <i class="material-icons">menu</i>
        </a>
        <ul class = "navabar hide-on-med-and-down" id="horizontal-list" style="top:-10px;margin-right:10px">
            <li class="bttn navBtn"><a class="dropdown-button navtext"  data-activates="dropdown1">Destinations
                    <i class=" small material-icons right hide-on-med-and-down" style="color: white;">arrow_drop_down</i>
                </a>
            </li>
            <li class="bttn2 navBtn"><a class="dropdown-button navtext"  data-activates="dropdown2">Ventures
                    <i class="small material-icons right hide-on-med-and-down" style="color: white;">arrow_drop_down</i>
                </a>
            </li>

            <li class="bttn4 navBtn"><a class="dropdown-button navtext"  data-activates="dropdown4" >Special Offers
                    <i class="small material-icons right hide-on-med-and-down" style="color: white;">arrow_drop_down</i>
                </a>
            </li>

            <li class="bttn3 navBtn"><a class="dropdown-button navtext"  data-activates="dropdown3" >About Us
                    <i class="small material-icons right hide-on-med-and-down" style="color: white;">arrow_drop_down</i>
                </a>
            </li>

            <li>
                @if(!Auth::user())
                    <a class="bttn navBtn" href="/login">
                        <i class="small material-icons right hide-on-med-and-down" style="color: white;visibility:hidden" >arrow_drop_down</i>LOGIN</a>
                @else
                    <a class="dropdown-button"  data-activates="dropdown5">
                        @if(Auth::user()->photo)
                            <img alt="user profile" data-src="{{url('images/profile/'.Auth::user()->photo)}}"
                                class="lazyload circle responsive-img" style="height: 42px; width: 42px; margin-bottom: -20px;border:2px solid white; ">
                            <i class="small material-icons right hide-on-med-and-down" style="color: white;" >arrow_drop_down</i>
                        @else
                            <img alt="user profile" data-src="{{url('images/person.jpg')}}" class="lazyload circle responsive-img" style="height: 42px; width: 42px; margin-bottom: -20px;border:2px solid white; ">
                            <i class="small material-icons right hide-on-med-and-down" style="color: white;" >arrow_drop_down</i>
                        @endif
                    </a>
                @endif
            </li>
        </ul>
    </div>
    <div class="showonmedanddown show-on-medium-and-down hide-on-large-only">
        <a id = "menu"  href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons" style="color: white;">menu</i></a>
    </div>
</header>
<!-- Dropdown Structure -->
<div id='dropdown1' class='dropdown-content row'>
    <?php $count = 0;?>
    @foreach($destinations as $destination)
        @if($count < 10)
            <div class = "col l3">
                <a href="/{{$destination->slug}}">
                    <div class="card z-depth-5 waves-effect waves-block waves-light">
                        <div class="card-image">
                            <img data-src="{{url('images/destinations/thumbnail/'.$destination->image)}}" alt="{{$destination->country_name}}" class="lazyload">
                            <span class="card-title " style = "">{{$destination->country_name}}</span>
                        </div>
                    </div>
                </a>
            </div>
        @else
            @break
        @endif
        <?php $count++ ?>
    @endforeach
</div>

{{--Dropdown for themes--}}
<div id='dropdown2' class='dropdown-content row'>
    <?php $count = 0;?>
    @foreach($themes as $theme)
        @if($count < 10)
            <div class = "col l3">
                <a href="/{{$theme->slug}}">
                    <div class="card z-depth-5 waves-effect waves-block waves-light">
                        <div class="card-image">
                            <img data-src="{{url('images/themes/thumbnail/'.$theme->image)}}" alt="{{$theme->theme_name}}" class="lazyload">
                            <span class="card-title " style = "">{{$theme->theme_name}}</span>
                        </div>
                    </div>
                </a>
            </div>
        @else
            @break
        @endif
        <?php $count++ ?>
    @endforeach
</div>
{{--dropdown for swotah--}}
<div id='dropdown3' class='dropdown-content row'>
    @foreach($abouts as $about)
        <div class = "col l3 content" >
            {{-- @if($about->slug == 'team')
                 <a href="/allmembers/{{$about->slug}}">
                     <div class="card z-depth-5 waves-effect waves-block waves-light">
                         <div class="card-image">
                             <img data-src="{{url('images/about/thumbnail/'.$about->cover_image)}}" alt="{{$about->slug}}" class="lazyload">
                             <span class="card-title " style = "">
                                  {{$about->aboutname}}
                             </span>
                         </div>
                     </div>
                 </a>
             @else--}}
            <a href="/{{$about->slug}}">
                    <div class="card z-depth-5 waves-effect waves-block waves-light">
                        <div class="card-image">
                            <img data-src="{{url('images/about/thumbnail/'.$about->cover_image)}}" alt="{{$about->slug}}" class="lazyload">
                            <span class="card-title " style = "">
                            {{$about->aboutname}}
                            </span>
                        </div>
                    </div>
                </a>
            {{--            @endif--}}
        </div>
    @endforeach
</div>

{{--dropdown for Special Offers--}}
<div id='dropdown4' class='dropdown-content row'>
    {{--@foreach($trips as $trip)--}}
    {{--<a tabindex="-1" href="/trip/{{$trip->slug}}">{{$trip->special_discount}}% discount on {{$trip->name}}</a>--}}
    {{--@endforeach--}}
    <?php $count = 0;?>
    @foreach($trips as $trip)
        @if($count < 12)
            <div class = "col l3">
                <a href="/{{$trip->slug}}">
                    <div class="card z-depth-5 waves-effect waves-block waves-light">
                        <div class="card-image">
                            <div id="special" class="tooltipped " data-delay="10" data-tooltip="Discount {{$trip->special_discount}} %">
                                <b>{{$trip->special_discount}} % OFF </b></div>
                            <img data-src="{{url('images/trips/thumbnail/'.$trip->cover_image)}}" alt="{{$trip->name}}" class="lazyload">
                            <span style="" class="card-title ">{{$trip->name}}</span>

                            @if(!empty($trip->customtrip->recommended))
                                @if($trip->customtrip->recommended == 1)
                                    <span id="recomend"  style="background-color: tomato;padding:1px 1px;font-size: 14px;position: absolute;top:5px;right: 5px;" >Trending</span>
                                @endif
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @else
            @break
        @endif
        <?php $count++ ?>
    @endforeach
</div>



<div id='dropdown5' class='dropdown-content row' >
    <div class = "col l12 m12 s12 content">
        @if(Auth::user())
            <div class="dropdownMenu" >
                <li>
                    <a href="/profile/{{Auth::user()->name}}" >
                        My Account
                    </a>
                </li><br>
                <li>
                    <a  class="tooltipped" data-tooltip="Logout"  data-position="bottom" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        @endif
    </div>
</div>

{{--mobile side bar--}}
<ul id="slide-out" class="side-nav mySideNav collapsible collapsible-accordion" >
    <li>
        <a class="collapsible-header">
            <b>Destination</b>
        </a>
        {{--Dropdown for Destination mobile--}}
        <div id='destination-small' class='collapsible-body'>
            <?php $count = 0;?>
            <ul>
                @foreach($destinations as $destination)
                    @if($count < 10)
                        <li>
                            <a href="/{{$destination->slug}}">
                                {{$destination->country_name}}
                            </a>
                        </li>
                    @else
                        @break
                    @endif
                    <?php $count++ ?>
                @endforeach
            </ul>
        </div>

    </li>

    <li>
        <a class="collapsible-header" >
            <b>Activities</b>
        </a>
        {{--ventures for mobile themes--}}
        <div id='ventures-small' class='collapsible-body'>
            <?php $count = 0;?>
            <ul>
                @foreach($themes as $theme)
                    @if($count < 10)
                        <li>
                            <a href="/{{$theme->slug}}">
                                {{$theme->theme_name}}
                            </a>
                        </li>
                    @else
                        @break
                    @endif
                    <?php $count++ ?>
                @endforeach
            </ul>
        </div>
    </li>
    <li>
        <a class="collapsible-header" >
            <b>Special Offers</b>
        </a>
        {{--Special Offers mobile--}}
        <div id='swotah-special-small' class='collapsible-body'>
            <?php $count = 0;?>
            <ul>
                @foreach($trips as $trip)
                    @if($count < 12)
                        <li style=" padding-left: 5px;padding-right: 2px;">
                            <a href="/{{$trip->slug}}" style="padding-left: 15px;padding-right: 10px;">
                                <span id="discountBadge" class="white-text badge teal darken-3"
                                      style="background-color:#b71c1c;border-radius:2px;margin-left: 0px;"  >
                                {{$trip->special_discount}}%
                                </span>
                                <span>{{$trip->name}}</span>
                            </a>
                        </li>
                    @else
                        @break
                    @endif
                    <?php $count++ ?>
                @endforeach
            </ul>
        </div>
    </li>


    <li>
        <a class="collapsible-header">
            <b>About Us</b>
        </a>
        {{-- dropdown swotah small mobile--}}
        <div id='swotah-small' class='collapsible-body' >
            <ul>
                @foreach($abouts as $about)
                    <li>
                        {{--@if($about->slug == 'team')
                            <a href="/allmembers/{{$about->slug}}">{{$about->aboutname}}</a>
                        @else--}}
                        <a href="/{{$about->slug}}">
                                {{$about->aboutname}}
                            </a>
                    </li>
                    {{--                    @endif--}}
                @endforeach
            </ul>
        </div>

    </li>


    @if(!Auth::user())
        <li>
            <a class="collapsible-header" href="/login">Login/Sign Up</a>
        </li>
    @else
        <div class="row">
            <a href="/profile/{{Auth::user()->name}}">
                @if(Auth::user()->photo)
                    <img src="{{url('images/profile/'.Auth::user()->photo)}}"
                         alt="" class="tooltipped circle responsive-img "
                         data-tooltip="{{Auth::user()->name}}"
                         style="height: 60px; width: 60px;">
                @else
                    <img src="{{url('images/person.jpg')}}" alt=""class="tooltipped circle responsive-img "
                         data-tooltip="{{Auth::user()->name}}" data-position="bottom"
                         style="height: 60px; width: 60px;">
                @endif
            </a>
            <li class="">
                <a class="tooltipped" data-tooltip="Logout" data-position="bottom" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    &nbsp;&nbsp;&nbsp;&nbsp;Logout
                </a>
            </li>
        </div>
    @endif

    <li class ="search sidenav-search" >
        <div class="searchContainer z-depth-2" style="border:0px!important;">
            <form action = "{{route('search')}}">
                <input name = "q"  required id="sideSearch" placeholder="Search" style="border-radius:0px;">
                <label class="label-icon" for="search" id="searchLabel">
                    <button type="submit" class="btn sideBtn" for="search">
                        <i class="material-icons" style="font-size: 25px; font-weight: bold;">search</i>
                    </button>
                </label>
            </form>
        </div>
    </li>

</ul>









