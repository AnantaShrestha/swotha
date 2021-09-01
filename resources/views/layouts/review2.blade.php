<div class="container">
    <div class = "title-wrapper1">
            <span class="title teal">
            <span class="flow-text"><b>What clients say about us</b></span>
            </span>
    </div>
</div>
<div class="clear"></div>
<div class="marg"></div>
@if(Request::is('trip/*'))
    <div class="container">
        <div class="card blue-grey darken-1 z-depth-5" style="background-color: #23334B!important;">
            <div class="card-content white-text">
				<?php $count=0; ?>
                @foreach($reviews as $review)
                    @if($review->trip->name == $trip->name)
						<?php $count++; ?>
                    @endif
                @endforeach
				<?php if($count <= 1) { ?>
                <span class="card-title center-align">Showing {{$count}} verified review</span>
				<?php } else { ?>
                <span class="card-title center-align">Showing {{$count}} verified reviews</span>
				<?php } ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="wrapper">
            <div class="contents">
                @foreach($reviews as $review)
                    @if($review->trip->name == $trip->name)
                        <div class="col l6 m6 s12">
                            <div class="card blue-grey darken-1 z-depth-5" style="background-color: #23334B!important;">
                                <div class="card-content white-text">
                                    <span class="card-title center-align">{{ucfirst($review->title)}}</span>
                                    <hr>
                                    <div class = "container">
                                        <h5 class = "center-align">Overall Ratings</h5>
                                        <div class="row">
                                            <div class="col l6 m6 s6">
                                                <h5 class = "center-align"><span class = "stars">
                                                        {{(float) $review->total_rating}}</span>
                                                </h5>
                                            </div>
                                            <div class="col l6 m6 s6">
                                                <h5 class="center-align"><span>{{$review->total_rating}}</span></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row ratings">
                                        <div class="col l4 m6 s12">
                                            <span class = "rate">Staff</span><br>
                                            <div class="rate">
                                                @for($i = 0; $i < $review->staff; $i++)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="col l4 m6 s12">
                                            <span class = "rate">Price Value</span><br>
                                            <div class="rate">
                                                @for($i = 0; $i < $review->value; $i++)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="col l4 m6 s12">
                                            <span class = "rate">Meals</span><br>
                                            <div class="rate">
                                                @for($i = 0; $i < $review->meal; $i++)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="col l4 m6 s12">
                                            <span>Accomodation</span><br>
                                            <div class="rate">
                                                @for($i = 0; $i < $review->accomodation; $i++)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @endfor

                                            </div>
                                        </div>
                                        <div class="col l4 m6 s12">
                                            <span>Transportation</span><br>
                                            <div class="rate">
                                                @for($i = 0; $i < $review->transportation; $i++)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @endfor
                                            </div>

                                        </div>
                                        <div class="col l4 m6 s12">
                                            <span class = "rate">Guides & Porters</span><br>
                                            <div class="rate">
                                                @for($i = 0; $i < $review->guide; $i++)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @endfor
                                            </div>

                                        </div>
                                        <div class="col l4 m6 s12">
                                            <span>All in all</span><br>
                                            <div class="rate">
                                                @for($i = 0; $i < $review->exp; $i++)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div style="height: 100px; @media screen and (max-device-width:425px) {
                                                    height: auto !important;
                                                }">
                                            {{$review->review}}
                                        </div>
                                    </div>
                                    <hr>
                                    <span class = "center-align"><img id = "flag" src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/{{strtolower($review->country)}}.svg" alt="{{$review->country}}"></span>
                                    <span>Review by:</span>
                                    <span>{{$review->name}}</span>
                                    <span class = "right">Reviewed on {{\Carbon\Carbon::parse($review->created_at)->toFormattedDateString()}}</span>
                                </div>
                                <div class="card-action center-align">
                                    <a href="/trip/{{$review->trip->slug}}">
                                        @if($review->trip_id != 0)
                                            <strong>{{$review->trip->name}}</strong>
                                        @else
                                            <strong>{{$review->custom_name}}</strong>
                                        @endif
                                    </a>

                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@else
    <div class="container-fluid">
        <div class="card blue-grey darken-1 z-depth-5" style="background-color: #23334B!important;">
            <div class="card-content white-text">
				<?php if(count($reviews) <= 1) { ?>
                <span class="card-title center-align">Showing {{count($reviews)}} verified review</span>
				<?php } else { ?>
                <span class="card-title center-align">Showing {{count($reviews)}} verified reviews</span>
				<?php } ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="wrapper">
            <div class="contents">
                @foreach($reviews as $review)
                    <div class="col l6 m6 s12">
                        <div class="card blue-grey darken-1 z-depth-5" style="background-color: #23334B!important;">
                            <div class="card-content white-text">
                                <span class="card-title center-align">{{ucfirst($review->title)}}</span>
                                <hr>
                                <div class = "container">
                                    <h5 class = "center-align">Overall Ratings</h5>
                                    <div class="row">
                                        <div class="col l6 m6 s6">
                                            <h5 class = "center-align"><span class = "stars">
                                                    {{(float) $review->total_rating}}</span>
                                            </h5>
                                        </div>
                                        <div class="col l6 m6 s6">
                                            <h5><span>{{$review->total_rating}}</span></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ratings">
                                    <div class="col l4 m6 s12">
                                        <span class = "rate">Staff</span><br>
                                        <div class="rate">
                                            @for($i = 0; $i < $review->staff; $i++)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <span class = "rate">Price Value</span><br>
                                        <div class="rate">
                                            @for($i = 0; $i < $review->value; $i++)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <span class = "rate">Meals</span><br>
                                        <div class="rate">
                                            @for($i = 0; $i < $review->meal; $i++)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <span>Accomodation</span><br>
                                        <div class="rate">
                                            @for($i = 0; $i < $review->accomodation; $i++)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            @endfor

                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <span>Transportation</span><br>
                                        <div class="rate">
                                            @for($i = 0; $i < $review->transportation; $i++)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            @endfor
                                        </div>

                                    </div>
                                    <div class="col l4 m6 s12">
                                        <span class = "rate">Guides & Porters</span><br>
                                        <div class="rate">
                                            @for($i = 0; $i < $review->guide; $i++)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            @endfor
                                        </div>

                                    </div>
                                    <div class="col l4 m6 s12">
                                        <span>All in all</span><br>
                                        <div class="rate">
                                            @for($i = 0; $i < $review->exp; $i++)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div style="height: 125px; @media screen and (max-device-width:425px) {
                                                height: auto !important;
                                            }">
                                        {{$review->review}}
                                    </div>
                                </div>
                                <hr>
                                <span class = "center-align"><img id = "flag" src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/{{strtolower($review->country)}}.svg" alt="{{$review->country}}"></span>
                                <span>Review by:</span>
                                <span>{{$review->name}}</span>
                                <span class = "right">Reviewed on {{\Carbon\Carbon::parse($review->created_at)->toFormattedDateString()}}</span>
                            </div>
                            <div class="card-action center-align">
                                <a href="/trip/{{$review->trip->slug}}">
                                    @if($review->trip_id != 0)
                                        <strong>{{$review->trip->name}}</strong>
                                    @else
                                        <strong>{{$review->custom_name}}</strong>
                                    @endif
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
