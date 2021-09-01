<style>
    .srch{
        right: -14px;
        margin-top: 175px;
        position: inherit;
        padding: 5px;
        -webkit-animation: fadeinout 4s linear forwards;
        animation: fadeinout 4s linear forwards;
    }
    @-webkit-keyframes srch{
        to {
            opacity: 1;
        }
    }
    @keyframes srch {
        to {
            opacity: 1;
        }
    }
    .srchfade {
        -webkit-animation: srch 1s ease-in 1 forwards;
        animation: srch 1s ease-in 1 forwards;
        opacity: 0;
    }
</style>
<header id = "wrapper" class = "nav-container">
    <div class="logo-container">
        <a href = "/">
            <img id = "image" class="brand-logo" src="{{url('images/logos/logo.png')}}" alt="Swotah Travel">
        </a>
    </div>
    <div  class="srch srchfade js-fade hide-on-med-and-down" id="srch" onscroll="srch()" style="display: none;">
        <div class="search" >
            <form action="{{route('search')}}" class="formSideNav">
                <div class="input-field input-field-composed input-field-home border center-align alignsearch "
                     style="height: 47px;margin-top:0px;">
                    <input id="search" class="type-effect input-boxed center-align giffoot" type="text" name="q"
                           onfocus="true" placeholder="Search and Compare" required style="height: 41px !important;">
                    <button type="submit" class="btn" id="search-btn-cover" style="height:41px;width: 0%;">
                        <i class="material-icons blink" style="color: white!important;font-size: 2rem;margin-left: -13px;margin-top: 2px;">search</i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="fixed-action-btn horizontal click-to-toggle navbutton hide-on-med-and-down">
        <a id ="menu" class="merobutton btn-floating btn-small menu-close" data-tooltip="MENU" data-position="left" style="background-color:#008EB0;">
            <i class="material-icons">menu</i>
        </a>
        <ul class = "navabar hide-on-med-and-down" id="horizontal-list" style="top:-24px;">
            <li class="bttn"><a class="dropdown-button navtext"  data-activates="dropdown1">Destinations
                    <i class=" small material-icons right hide-on-med-and-down" style="color: white;">arrow_drop_down</i>
                </a>
            </li>
            <li class="bttn2"><a class="dropdown-button navtext"  data-activates="dropdown2">Ventures
                    <i class="small material-icons right hide-on-med-and-down" style="color: white;">arrow_drop_down</i>
                </a>
            </li>
            <li class="bttn3"><a class="dropdown-button navtext"  data-activates="dropdown3" >Swotah
                    <i class="small material-icons right hide-on-med-and-down" style="color: white;">arrow_drop_down</i>
                </a>
            </li>
            <li class="bttn4"><a class="dropdown-button navtext"  data-activates="dropdown4" >Swotah Special
                    <i class="small material-icons right hide-on-med-and-down" style="color: white;">arrow_drop_down</i>
                </a>
            </li>
            <li>
            @if(!Auth::user())
                <li class="bttn5">
                    <a class="dropdown-button navtext" href="/login" >Login
                        <i class="small material-icons right hide-on-med-and-down" style="color: white;">arrow_drop_down</i>
                    </a>
                </li>

            @else
                <a class="" data-tooltip="{{Auth::user()->name}}"  href="/profile/{{Auth::user()->name}}" data-position="bottom">
                    @if(Auth::user()->photo)

                        <img src="{{url('images/profile/'.Auth::user()->photo)}}"
                             alt="" class="circle responsive-img" style="height: 50px; width: 50px; margin-bottom: -18px; ">
                    @else
                        <img src="{{url('images/person.jpg')}}" alt=""class="circle responsive-img"
                             style="height: 50px; width: 50px; margin-bottom: -18px; ">
                    @endif
                </a>
                @endif
            </li>
            <li class = "search">
                <form action="{{route('search')}}" class="formSideNav">
                    <input name = "q" required placeholder="Search">
                    <label style="font-size:0.8rem;position: absolute;
                            top: 54px; margin-left: -26px;" class="label-icon" for="search"><i class="material-icons" style="margin-top: -2px">search</i></label>
                </form>
            </li>
        </ul>
    </div>
    <div class="showonmedanddown">
        <a id = "menu"  href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</header>
{{--<!-- Destinations for dropdown -->--}}
<div id='dropdown1' class='dropdown-content row'>
    <?php $count = 0;?>
    @foreach($destinations as $destination)
        @if($count < 10)
            <div class = "col l3">
                <a href="/destination/{{$destination->slug}}">
                    <div class="card z-depth-5 waves-effect waves-block waves-light">
                        <div class="card-image">
                            <img src="{{url('images/destinations/thumbnail/'.$destination->image)}}" alt="{{$destination->country_name}}">
                            <span class="card-title hbb" style = "padding:0px">{{$destination->country_name}}</span>
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
                <a href="/venture/{{$theme->slug}}">
                    <div class="card z-depth-5 waves-effect waves-block waves-light">
                        <div class="card-image">
                            <img src="{{url('images/themes/thumbnail/'.$theme->image)}}" alt="{{$theme->theme_name}}">
                            <span class="card-title hbb" style = "padding:0px">{{$theme->theme_name}}</span>
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
            @if($about->slug == 'team')
                <a href="/allmembers/{{$about->slug}}">
                    <div class="card z-depth-5 waves-effect waves-block waves-light">
                        <div class="card-image">
                            <img src="{{url('images/about/thumbnail/'.$about->cover_image)}}" alt="{{$about->slug}}">
                            <span class="card-title hbb" style = "padding:0px">
                                 {{$about->aboutname}}
                            </span>
                        </div>
                    </div>
                </a>
            @else
                <a href="/about/{{$about->slug}}">
                    <div class="card z-depth-5 waves-effect waves-block waves-light">
                        <div class="card-image">
                            <img src="{{url('images/about/thumbnail/'.$about->cover_image)}}" alt="{{$about->slug}}">
                            <span class="card-title hbb" style = "padding:0px">
                            {{$about->aboutname}}
                            </span>
                        </div>
                    </div>
                </a>
            @endif
        </div>
    @endforeach
</div>
{{--dropdown for swotah special--}}
<div id='dropdown4' class='dropdown-content row'>
    <?php $count = 0;?>
    @foreach($trips as $trip)
        @if($count < 12)
            <div class = "col l3">
                <a href="/trip/{{$trip->slug}}">
                    <div class="card z-depth-5 waves-effect waves-block waves-light">
                        <div class="card-image" id="container">
                            <div id="special" class="tooltipped " data-delay="10" data-tooltip="Discount {{$trip->special_discount}} %" ><b>{{$trip->special_discount}} % OFF </b></div>
                            <img src="{{url('images/trips/thumbnail/'.$trip->cover_image)}}" alt="{{$trip->name}}">
                            <span style="background:#008EB0; padding: 5px"
                                  class="card-title">{{$trip->name}}</span>
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
                            <a href="/destination/{{$destination->slug}}" >
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
            <b>Ventures</b>
        </a>
        {{--ventures for mobile themes--}}
        <div id='ventures-small' class='collapsible-body'>
            <?php $count = 0;?>
            <ul>
                @foreach($themes as $theme)
                    @if($count < 10)
                        <li>
                            <a href="/venture/{{$theme->slug}}">
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
        <a class="collapsible-header">
            <b>Swotah</b>
        </a>
        {{-- dropdown swotah small mobile--}}
        <div id='swotah-small' class='collapsible-body' >
            <ul>
                @foreach($abouts as $about)
                    <li>
                        @if($about->slug == 'team')
                            <a href="/allmembers/{{$about->slug}}">{{$about->aboutname}}</a>
                        @else
                            <a href="/about/{{$about->slug}}">
                                {{$about->aboutname}}
                            </a>
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>

    </li>

    <li>
        <a class="collapsible-header" >
            <b>Swotah Special</b>
        </a>
        {{--swotah special mobile--}}
        <div id='swotah-special-small' class='collapsible-body'>
            <?php $count = 0;?>
            <ul>
                @foreach($trips as $trip)
                    @if($count < 12)
                        <li style="">
                            <a href="/trip/{{$trip->slug}}" style="padding-left: 15px;padding-right: 10px;" >
                                <span id="discountBadge" class="white-text badge hbb darken-3"
                                      style="border-radius:2px;margin-left: 0px;"  >
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

    @if(!Auth::user())
        <li>
            <a class="collapsible-header" href="/login">Login/Sign Up</a>
        </li>
    @else
        <div class="row" style="margin-top:100px" >
            <a  href="/profile">
                @if(Auth::user()->photo)
                    <img src="{{url('images/profile/'.Auth::user()->photo)}}"
                         alt="" class="tooltipped circle responsive-img "
                         data-tooltip="{{Auth::user()->name}}"
                         style="height: 60px; width: 60px; margin-left: 34%;">
                @else
                    <img src="{{url('images/person.jpg')}}" alt=""class="tooltipped circle responsive-img "
                         data-tooltip="{{Auth::user()->name}}" data-position="bottom"
                         style="height: 60px; width: 60px;  margin-left: 34% ">
                @endif
            </a>
        </div>
    @endif

    <li class ="search sidenav-search" >
        <div class="searchContainer z-depth-2">
            <form action = "{{route('search')}}">
                <input name = "q"  required id="sideSearch" placeholder="Search">
                <label class="label-icon" for="search" id="searchLabel">
                    <button type="submit" class="btn sideBtn" for="search">
                        <i class="material-icons" style="font-size: 25px; font-weight: bold;">search</i>
                    </button>
                </label>
            </form>
        </div>
    </li>
</ul>
<script>

    window.onscroll = function() {srch()};

    function srch() {
        if (document.body.scrollTop > 700 || document.documentElement.scrollTop > 700) {
            document.getElementById("srch").style.display = "";
            var el = document.querySelector('.js-fade');
        }
        else {
            document.getElementById("srch").style.display = "none";
            var el = document.querySelector('.js-fade');
        }
    }


</script>



