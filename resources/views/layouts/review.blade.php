<style>
    #carouselNReview span.stars span{
        margin-bottom: 0px;
    }
    #carouselNReview .card .row{
        margin-bottom: 0;
    }
    #carouselContainer .carousel{
        -webkit-perspective: 1700px;
        perspective: 1700px;
    }

    #carouselContainer .carousel-item{
        width:400px;
        height: 100%;
        opacity: 1 !important;
        color: #FFF;
    }

    /*@media only screen and (max-width:400px){*/
        /*#carouselContainer .carousel-item{*/
            /*width:350px;*/
        /*}*/
    /*}*/

    #carouselNReview .card .card-content {
        padding: 5px 15px;
    }

    #carouselNReview .card .card-content .card-title {
        margin-bottom: 0px;
    }

    #carouselNReview .card .card-content h5{
        margin:0px 5px 0px;
    }

    #carouselNReview .card .card-content h5>span{
        margin: 1px;
    }
    .review-content{
        text-align:justify;
        font-size:15px;
    }

    #carouselContainer button{
        background:none!important;
        color:inherit;
        padding:0px 6px!important;
        font: inherit;
        border:1.5px solid #FFF;
        cursor: pointer;
        box-shadow: none;
        border-radius:2px;
        text-transform:capitalize!important;
        font-weight:bold;
    }

    #carouselContainer button:hover{
        font-size: 17px;
        color:#23334B!important;
        background-color:#FFF !important;
        font-weight:bolder;
        letter-spacing: 1px;
        /*border-color:#23334B;*/
        /*outline: 1px solid #23334B;*/
    }



</style>
<div id="carouselNReview">
    <div class="container" id="carouselContainer">
            {{--<div class = "title-wrapper1">
            <span class="title teal">
                <span class="flow-text" style="color: white;">
                What clients say about us
                </span>
            </span>
            </div>--}}
        <div class="container" style="text-align: center;background-color:#e1e9f0;">
            <h1 class="s-fon">What Clients say about us</h1>
        </div>
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
        <div class="carousel">
            @foreach($reviews as $review)
                @if($review->trip->name == $trip->name)
            <a class="carousel-item">
                <div class="card " style="background-color: #23334B!important;">
                    <div class="card-content">
                        <span class="make-uppercase card-title center-align">{{ucfirst($review->title)}}</span>
                        <hr>

                        <p class="center-align" style="font-weight: bold;">Overall Ratings</p>
                        <div class="row">
                            <div class="col l6 m6 s6">
                                <h5 class = "center-align"><span class = "stars">
                                                    {{(float) $review->total_rating}}
                                    </span>
                                </h5>
                            </div>
                            <div class="col l6 m6 s6">
                                <h5 class="center-align">{{$review->total_rating}}</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row ">
                        <p class="review-content">
                            {{str_limit($review->review, 150)}}
                        </p>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col s7">
                                <span class="center-align"><img id="flag"
                                                                src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/{{strtolower($review->country)}}.svg"
                                                                alt="Review by {{$review->country}}"></span>
                                <span>Review by: <br></span>
                                <span style="font-weight: bold">{{$review->name}}</span>
                            </div>
                            <div class="col s5">
                                <span class = "right" style="font-weight: bold">Reviewed on: <br>
                                    {{\Carbon\Carbon::parse($review->created_at)->toFormattedDateString()}}
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <button class="btn modal-trigger center-align" style="width: 100%;" data-target="modal{{$review->trip->id}}">
                                    view more
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
                @endif
            @endforeach
        </div>
    </div>
    <div id="reviewCarouselModal">
        <div id="modal{{$review->trip->id}}" class="modal">
            <div class="modal-content">
                <div class="card blue-grey darken-1  z-depth-5" style="background-color: #23334B!important;">
                    <div class="card-content white-text">
                        <span class="card-title center-align">{{ucfirst($review->title)}}</span>
                        <hr>
                        <h5 class="center-align" style="">Overall Ratings</h5>
                        <div class="row">
                            <div class="col l6 m6 s6">
                                <h5 class = "center-align">
                                    <span class = "stars" >
                                                    {{(float) $review->total_rating}}
                                    </span>
                                </h5>
                            </div>
                            <div class="col l6 m6 s6">
                                <h5><span style="text-align: center;">{{$review->total_rating}}</span></h5>
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
                            <div class="review-content">
                                {{$review->review}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col l7">
                                <span class="center-align"><img id="flag"
                                                                src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/{{strtolower($review->country)}}.svg"
                                                                alt="{{$review->country}}"></span>
                                <span>Review by: <br></span>
                                <span>{{$review->name}}</span>
                            </div>
                            <div class="col l5">
                                <span class = "right">
                                    Reviewed on: <br>
                                    {{\Carbon\Carbon::parse($review->created_at)->toFormattedDateString()}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-action center-align">
                        <a href="/trip/{{$review->trip->slug}}">
                        @if($review->trip_id != 0)
                            <strong class="flow-text">{{$review->trip->name}}</strong>
                        @else
                            <strong class="flow-text">{{$review->custom_name}}</strong>
                        @endif
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>
    </div>
    @else
        <div class="container">
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
        <div class="carousel">
            @foreach($reviews as $review)
                <a class="carousel-item">
                    <div class="card " style="background-color: #23334B!important;">
                        <div class="card-content">
                            <span class="card-title center-align">{{ucfirst($review->title)}}</span>
                            <hr>

                            <p class ="center-align" style="font-weight: bold;">Overall Ratings</p>
                            <div class="row">
                                <div class="col l6 m6 s6">
                                    <h5 class = "center-align">
                                        <span class = "stars">
                                            {{(float) $review->total_rating}}
                                        </span>
                                    </h5>
                                </div>
                                <div class="col l6 m6 s6">
                                    <h5 class="center-align">{{$review->total_rating}}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row ">
                                <p class="review-content">
                                    {{str_limit($review->review, 150)}}
                                </p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col s7">
                                    <span class="center-align"><img id = "flag" src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/{{strtolower($review->country)}}.svg" alt="{{$review->country}}"></span>
                                    <span>Review by: <br></span>
                                    <span>{{$review->name}}</span>
                                </div>
                                <div class="col s5">
                                <span class = "right">Reviewed on: <br>
                                    {{\Carbon\Carbon::parse($review->created_at)->toFormattedDateString()}}
                                </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <button class="btn modal-trigger center-align" style="width: 100%;" data-target="modal{{$review->trip->id}}">
                                        view more
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
</div>

@foreach($reviews as $review)
<div id="reviewCarouselModal">
    <div id="modal{{$review->trip->id}}" class="modal">
        <div class="modal-content">
            <div class="card blue-grey darken-1  z-depth-5" style="background-color: #23334B!important;">
                <div class="card-content white-text">
                    <span class="card-title center-align">{{ucfirst($review->title)}}</span>
                    <hr>
                    <h5 class = "center-align">Overall Ratings</h5>
                    <div class="row">
                        <div class="col l6 m6 s6">
                            <h5 class = "center-align">
                                <span class = "stars">
                                    {{(float) $review->total_rating}}
                                </span>
                            </h5>
                        </div>
                        <div class="col l6 m6 s6">
                            <h5><span>{{$review->total_rating}}</span></h5>
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
                        <div class="review-content">
                            {{$review->review}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col l7">
                            <span class="center-align"><img id = "flag" src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/{{strtolower($review->country)}}.svg" alt="{{$review->country}}"></span>
                            <span>Review by: <br></span>
                            <span>{{$review->name}}</span>
                        </div>
                        <div class="col l5">
                                <span class = "right">
                                    Reviewed on: <br>
                                    {{\Carbon\Carbon::parse($review->created_at)->toFormattedDateString()}}
                                </span>
                        </div>
                    </div>
                </div>
                <div class="card-action center-align">
                    <a href="/trip/{{$review->trip->slug}}">
                    @if($review->trip_id != 0)
                        <strong class="flow-text">{{$review->trip->name}}</strong>
                    @else
                        <strong class="flow-text">{{$review->custom_name}}</strong>
                    @endif
                    </a>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
    </div>
</div>
@endforeach
@endif


