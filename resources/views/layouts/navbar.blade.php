<div class="navigation-search">
    <form class="nav-search" action="{{route('search')}}">
        <input id="search" type="text" name="q"
               placeholder="I want to travel to..." onfocus="false" required>
    </form>
</div>
<div class="top-header @section('innertop')@show">
    <div class="container">
        <div class="flex-box">
            <div class="contact-info">
                <ul class="flex-box">
                    <li><i class="fa fa-envelope"></i>&nbsp;&nbsp;info@swotahtravel.com</li>
                    <li><i class="fa fa-phone"></i>&nbsp;/&nbsp;<i class="fab fa-viber"></i>&nbsp;&nbsp;+977-9841595962
                    </li>
                </ul>
            </div>
            <div class="social-icon flex">
                <ul class="flex-box">
                    <li><a href="https://facebook.com/Swotah" rel="noreferrer" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://twitter.com/SwotahTravel" rel="noreferrer" target="_blank"><i
                                    class="fab fa-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/swotahnepal/" rel="noreferrer" target="_blank"><i
                                    class="fab fa-instagram"></i></a></li>
                    <li><a href="https://www.youtube.com/channel/UCIEAl1j63bbDVsYpe3lvQXw" rel="noreferrer"
                           target="_blank"><i class="fab fa-youtube"></i></a></li>
                    <li><a href="https://www.linkedin.com/company/swotah-travel-and-adventure-pvt-ltd" rel="noreferrer"
                           target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                    <!--  <li><a href=""><i class="fab fa-pinterest-p"></i></a></li> -->
                </ul>
            </div>
            <div class="top-payment">
                <a href="/custompayment">
                    <img src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179005/static_webp/payonline.webp"
                    >
                </a>
            </div>
            {{--<div class="price-select-option">
                <a class="btn-currency currencyButton" id="currencyButton">
                    <i class="fa fa-dollar"></i>
                    <span style="color:black"><b>$</b> USD</span>
                </a>
            </div>--}}

        </div>
    </div>
</div>
<header class="header" id="header">
    <div class="menu-area">
        <div class="menu-grid">

            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-5 col-xs-4 pl-0 mb-50">
                    <div class="logo">
                        <a href="{{url('/')}}" rel="noreferrer">
                            <img alt="Swotah Travel and Adventure"
                                 src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1617714963/static_webp/swotah_logo.jpg"></a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-7 col-xs-8 pr-0 mb-50">

                    <div class="bar-menu">
                        <div class="top-search-icon">
                            <li><a href="javascript:;" class="fixed-search"><i class="fa fa-search"></i></a></li>
                        </div>
                        <button class="bar-ic"><i class="fa fa-bars"></i></button>
                    </div>
                    <nav class="mobile-nav">
                        <div class="close-menu">
                            <button class="cl-ic">&times;</button>
                        </div>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class="child-mb">
                                <a href="javascript:;" class="has-drop">Destination <i class="fa fa-caret-down"
                                                                                       style="float:right;line-height:50px"></i></a>
                                <ul class="mobile-dropdown">
                                    <?php $count = 0;?>
                                    @foreach($destinations as $destination)
                                        @if($count < 10)
                                            <li><a href="/{{$destination->slug}}">{{$destination->country_name}}</a>
                                            </li>
                                        @endif
                                        <?php $count++ ?>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="child-mb"><a href="javascript:;" class="has-drop">Activities <i
                                            class="fa fa-caret-down"
                                            style="float:right;line-height:50px"></i></a>
                                <ul class="mobile-dropdown">
                                    <?php $count = 0;?>
                                    @foreach($themes as $theme)
                                        @if($count < 10)
                                            <li><a href="/{{$theme->slug}}">{{$theme->theme_name}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            <li class="child-mb"><a href="javascript:;" class='has-drop'>Special Offers <i
                                            class="fa fa-caret-down"
                                            style="float:right;line-height:50px"></i></a>
                                <ul class="mobile-dropdown">
                                    <?php $count = 0;?>
                                    @foreach($trips as $trip)
                                        @if($count < 12)
                                            <li><a href="/{{$trip->slug}}">{{$trip->name}} ({{$trip->special_discount}}%
                                                    OFF)</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            <li class="child-mb"><a href="javascript:;" class="has-drop">About Us<i
                                            class="fa fa-caret-down"
                                            style="float:right;line-height:50px"></i></a>
                                <ul class="mobile-dropdown">
                                    @foreach($abouts as $about)
                                        <li><a href="/{{$about->slug}}"> {{$about->aboutname}}</a></li>
                                    @endforeach
                                </ul>

                            </li>
                            @if(!Auth::user())
                                <li><a href="{{route('login')}}">Login</a></li>
                            @else
                                <li><a href="/profile/{{Auth::user()->name}}">My Account</a></li>
                                <li><a href="{{route('logout')}}"
                                       onclick="event.preventDefault();document.getElementById('logout-form2').submit();">Logout</a>
                                    <form id="logout-form2" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </nav>
                    <nav class="top-navigation">
                        <ul class='flex-box nav nav2'>
                            <li class="flex"></li>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class="dropdown">
                                <a href="">Destinations&nbsp;<i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu">
                                    <?php $count = 0;?>
                                    @foreach($destinations as $destination)
                                        @if($count < 10)
                                            <li><a href="/{{$destination->slug}}">{{$destination->country_name}}</a>
                                            </li>
                                        @endif
                                        <?php $count++ ?>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#">Activities&nbsp;<i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu" style="width:250px">
                                    <?php $count = 0;?>
                                    @foreach($themes as $theme)
                                        @if($count < 10)
                                            <li><a href="/{{$theme->slug}}">{{$theme->theme_name}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Special Offers&nbsp;<i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu" style="width:350px;left:-50px">
                                    <?php $count = 0;?>
                                    @foreach($trips as $trip)
                                        @if($count < 12)
                                            <li><a href="/{{$trip->slug}}">{{$trip->name}} ({{$trip->special_discount}}%
                                                    OFF)</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">About Us&nbsp;<i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu" style="width:350px;left:-80px">
                                    @foreach($abouts as $about)
                                        <li><a href="/{{$about->slug}}"> {{$about->aboutname}}</a></li>
                                    @endforeach

                                </ul>
                            </li>
                            @if(!Auth::user())
                                <li><a href="{{route('login')}}">Login</a></li>
                            @else
                                <li class="dropdown">
                                    <a>
                                        @if(Auth::user()->photo)
                                            <img class="af-ur-im" src="{{url('images/profile/'.Auth::user()->photo)}}"
                                                 style="height:30px;width:30px;border-radius:50%;line-height:30px">
                                        @else
                                            <img class="af-ur-im"
                                                 src="{{url('https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179005/static_webp/people.png')}}"
                                                 style="height:30px;width:30px;border-radius:50%;line-height:30px">
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu profile-ac" style=";left:-80px">
                                        <li><a href="/profile/{{Auth::user()->name}}">My Account</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">

                                                Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>

                                    </ul>
                                </li>
                            @endif
                            <li><a href="javascript:;" class="fixed-search"><i class="fa fa-search"></i></a></li>

                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</header>

{{--<div id="currencyModal" class="modal fade" role="dialog">--}}
{{--    <div class="modal-dialog modal-dialog-centered" style="width:250px">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h4 class="modal-title">Select Currency</h4>--}}
{{--                <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <select name="toConvert" class="form-control" id="currencyChange">--}}
{{--                    <option value="USD" selected>USD</option>--}}
{{--                    --}}{{--<option value="EUR">€ &nbsp;Euro</option>--}}
{{--                    <option value="GBP">£ &nbsp;&nbsp;British Pound</option>--}}
{{--                    <option value="AUD">AUD &nbsp;&nbsp;Australian Dollar</option>--}}
{{--                    <option value="CHF">CHF &nbsp;&nbsp;Swiss Franc</option>--}}
{{--                    <option value="INR">Rs. &nbsp;&nbsp;Indian Rupee</option>--}}
{{--                    <option value="CNY">RMB &nbsp;&nbsp;Chinese Yuan</option>--}}
{{--                    <option value="JPY">¥ &nbsp;&nbsp;Japanese Yen</option>--}}
{{--                    <option value="CAD">CAD &nbsp;&nbsp;Canadian Dollar</option>--}}
{{--                    <option value="THB">฿ &nbsp;&nbsp;Thai Baht</option>--}}
{{--                    <option value="SGD">SGD &nbsp;&nbsp;Singapore Dollar</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button id="currencySubmit" type="submit"--}}
{{--                class="modal-close waves-effect waves-green btn currencyBtn reserve-submit-btn" name="submit">--}}
{{--                Submit--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</div>--}}