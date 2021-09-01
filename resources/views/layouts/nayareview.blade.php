<?php
$totaloverallreviews = 0;
$avgCompanyScore = 0;
?>
@if(count($reviews)>0)
    <?php
    $totalreviews = count($reviews);
    ?>
    @foreach($reviews as $review)
        <?php
        $reviewValue = $review->overall;
        $totaloverallreviews = $totaloverallreviews + $reviewValue;
        ?>
    @endforeach
    <?php
    $avgCompanyScore = round(($totaloverallreviews / $totalreviews), 2);
    ?>
    {{--show in trip page--}}
    @if(!empty($istrip))
        <?php $count = 0; ?>
        @foreach($reviews as $review)
            @if(!empty($review->trip->name))
                @if($review->trip->name == $trip->name)
                    <?php $count++; ?>
                @endif
            @endif
        @endforeach
        @if($count > 0)
            <section class="review-section">
                <div class="container">
                    <section class="count-review">
                        <div class="total-review">
                            <h2>Total Review : {{count($reviews)}}</h2>
                        </div>
                        <div class="overall-rating">
                            <h2>Over All Company Review : {{$avgCompanyScore}}</h2>
                        </div>
                    </section>
                    <div class="row ml-0 mr-0">
                        <div id="review-slider" class="owl-carousel">
                            @foreach($reviews as $review)
                                @if(!empty($review->trip->name))
                                    @if($review->trip->name == $trip->name)
                                        <div class="owl-item">
                                            <div class="review-content">
                                                <div class="row ml-0 mr-0">
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <div class="review-image">
                                                            @if($review->photo!=null)
                                                                <img alt="{{$review->name}}"
                                                                     src="https://www.swotahtravel.com/images/reviewer/{{$review->photo}} ">
                                                            <!-- <img alt="{{$review->name}}"  src="{{url('images/reviewer/'.$review->photo)}}"> -->
                                                            @elseif($review->user_id != null && ($review->user->photo != null))
                                                                <img alt="{{$review->name}}"
                                                                     src="https://www.swotahtravel.com/images/profile/{{$review->user->photo}}">
                                                            <!-- <img  alt="{{$review->name}}" src="{{url('images/profile/'.$review->user->photo)}}"> -->
                                                            @else
                                                                <img alt="{{$review->name}}"
                                                                     src="https://www.swotahtravel.com/images/user.png">
                                                            <!-- <img  alt="{{$review->name}}" src="{{url('images/user.png')}}" > -->
                                                            @endif
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                                        <div class="review-text">
                                                            <p>
                                                                <b style="font-size: 15px;">“</b>
                                                                {{$review->review}}
                                                                <b style="font-size: 15px;">”</b>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row ml-0 mr-0">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 mt-20">
                                                        <div class="review-person-details">
                                                            <div class="row mt-10">
                                                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                                    <p>Name :</p>
                                                                </div>
                                                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                                                    <strong>{{$review->name}}</strong>
                                                                </div>
                                                            </div>
                                                            @if($review->trip_id != null)
                                                                <div class="row mt-10">
                                                                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                                        <p>Trip :</p>
                                                                    </div>
                                                                    <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                                                        <strong>{{$review->trip->name}}</strong>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="row mt-10">
                                                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                                    <p>Nationality :</p>
                                                                </div>
                                                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                                                    <img src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/{{strtolower($review->country)}}.svg"
                                                                         alt="{{$review->country}}"
                                                                         style="width:15%">
                                                                </div>
                                                            </div>
                                                            <div class="row mt-10">
                                                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                                    <p>Overall Rating :</p>
                                                                </div>
                                                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                                                    <span>( {{(float) $review->overall}} )</span>
                                                                    @for($i=1;$i<=$review->overall;$i++)
                                                                        <span><i class="fa fa-star"></i></span>
                                                                    @endfor

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                <!--  <div class="col-lg-4 col-md-4 col-sm-6 mt-20">
                                                        <div class="review-person-details">
                                                            <div class="row mt-10">
                                                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                                    <p>Staff :</p>
                                                                </div>
                                                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                                                    @if($review->staff != 0)
                                                    @for($i=1;$i<=$review->staff;$i++)
                                                        <span><i class="fa fa-star"></i></span>
@endfor
                                                @endif
                                                        </div>
                                                    </div>
                                                    <div class="row mt-10">
                                                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                            <p>Trasportation :</p>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
@if($review->transportation != 0)
                                                    @for($i=1;$i<=$review->transportation;$i++)
                                                        <span><i class="fa fa-star"></i></span>
@endfor
                                                @endif
                                                        </div>
                                                    </div>
                                                    <div class="row mt-10">
                                                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                            <p>Accomodation :</p>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
@if($review->accomodation != 0)
                                                    @for($i=1;$i<=$review->accomodation;$i++)
                                                        <span><i class="fa fa-star"></i></span>
@endfor
                                                @endif


                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 mt-20">
                                                <div class="review-person-details">
                                                    <div class="row mt-10">
                                                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                            <p>Meals :</p>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
@if($review->meal != 0)
                                                    @for($i=1;$i<=$review->meal;$i++)
                                                        <span><i class="fa fa-star"></i></span>
@endfor
                                                @endif

                                                        </div>
                                                    </div>
                                                    <div class="row mt-10">
                                                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                            <p>Price Value :</p>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
@if($review->value != 0)
                                                    @for($i=1;$i<=$review->value;$i++)
                                                        <span><i class="fa fa-star"></i></span>
@endfor
                                                @endif

                                                        </div>
                                                    </div>
                                                    <div class="row mt-10">
                                                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                            <p>Guide & Porter :</p>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
@if($review-> guide!= 0)
                                                    @for($i=1;$i<=$review->guide;$i++)
                                                        <span><i class="fa fa-star"></i></span>
@endfor
                                                @endif


                                                        </div>
                                                    </div>

                                                </div>
                                            </div> -->
                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach


                        </div>
                        <div class="view-all-btn mt-30">
                            <p><a href="/viewreviews" class="btn-viewAll">View All Reviews</a></p>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    {{--show in home page--}}
    @else
        @if(!empty($reviews))
            <section class="review-section">
                <div class="container">
                    <section class="count-review">
                        <div class="total-review">
                            <h2>Total Review : {{count($reviews)}}</h2>
                        </div>
                        <div class="overall-rating">
                            <h2>Over All Company Review : {{$avgCompanyScore}}</h2>
                        </div>
                    </section>
                    <div class="row ml-0 mr-0">
                        <div id="review-slider" class="owl-carousel" style="display:flex !important">
                            @foreach($reviews as $review)
                                <div class="owl-item">
                                    <div class="review-content">
                                        <div class="row ml-0 mr-0">
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="review-image">
                                                    @if($review->photo!=null)
                                                        <img alt="{{$review->name}}"
                                                             src="https://www.swotahtravel.com/images/reviewer/{{$review->photo}}">
                                                    <!-- <img alt="{{$review->name}}"  src="{{url('images/reviewer/'.$review->photo)}}"> -->
                                                    @elseif($review->user_id != null && ($review->user->photo != null))
                                                        <img alt="{{$review->name}}"
                                                             src="https://www.swotahtravel.com/images/profile/{{$review->user->photo}}">
                                                    <!-- <img  alt="{{$review->name}}" src="{{url('images/profile/'.$review->user->photo)}}"> -->
                                                    @else
                                                        <img alt="{{$review->name}}"
                                                             src="https://www.swotahtravel.com/images/user.png">
                                                    <!-- <img  alt="{{$review->name}}" src="{{url('images/user.png')}}" > -->
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9">
                                                <div class="review-text">
                                                    <p>
                                                        <b style="font-size: 15px;">“</b>
                                                        {{$review->review}}
                                                        <b style="font-size: 15px;">”</b>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ml-0 mr-0">
                                            <div class="col-lg-12 col-md-12 col-sm-12 mt-20">
                                                <div class="review-person-details">
                                                    <div class="row mt-10">
                                                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                            <p>Name :</p>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                                            <strong>{{$review->name}}</strong>
                                                        </div>
                                                    </div>
                                                    @if($review->trip_id != null)
                                                        <div class="row mt-10">
                                                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                                <p>Trip :</p>
                                                            </div>
                                                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                                                <strong>{{$review->trip->name}}</strong>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="row mt-10">
                                                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                            <p>Nationality :</p>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                                            <img src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/{{strtolower($review->country)}}.svg"
                                                                 alt="{{$review->country}}"
                                                                 style="width:15%">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-10">
                                                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                            <p>Overall Rating :</p>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                                            <span>( {{(float) $review->overall}} )</span>
                                                            @for($i=1;$i<=$review->overall;$i++)
                                                                <span><i class="fa fa-star"></i></span>
                                                            @endfor

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        <!--  <div class="col-lg-4 col-md-4 col-sm-6 mt-20">
                                                <div class="review-person-details">
                                                    <div class="row mt-10">
                                                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                            <p>Staff :</p>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                                            @if($review->staff != 0)
                                            @for($i=1;$i<=$review->staff;$i++)
                                                <span><i class="fa fa-star"></i></span>
@endfor
                                        @endif
                                                </div>
                                            </div>
                                            <div class="row mt-10">
                                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                    <p>Trasportation :</p>
                                                </div>
                                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
@if($review->transportation != 0)
                                            @for($i=1;$i<=$review->transportation;$i++)
                                                <span><i class="fa fa-star"></i></span>
@endfor
                                        @endif
                                                </div>
                                            </div>
                                            <div class="row mt-10">
                                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                    <p>Accomodation :</p>
                                                </div>
                                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
@if($review->accomodation != 0)
                                            @for($i=1;$i<=$review->accomodation;$i++)
                                                <span><i class="fa fa-star"></i></span>
@endfor
                                        @endif


                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 mt-20">
                                        <div class="review-person-details">
                                            <div class="row mt-10">
                                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                    <p>Meals :</p>
                                                </div>
                                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
@if($review->meal != 0)
                                            @for($i=1;$i<=$review->meal;$i++)
                                                <span><i class="fa fa-star"></i></span>
@endfor
                                        @endif

                                                </div>
                                            </div>
                                            <div class="row mt-10">
                                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                    <p>Price Value :</p>
                                                </div>
                                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
@if($review->value != 0)
                                            @for($i=1;$i<=$review->value;$i++)
                                                <span><i class="fa fa-star"></i></span>
@endfor
                                        @endif

                                                </div>
                                            </div>
                                            <div class="row mt-10">
                                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                    <p>Guide & Porter :</p>
                                                </div>
                                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
@if($review-> guide!= 0)
                                            @for($i=1;$i<=$review->guide;$i++)
                                                <span><i class="fa fa-star"></i></span>
@endfor
                                        @endif


                                                </div>
                                            </div>

                                        </div>
                                    </div> -->
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="view-all-btn mt-30">
                            <p><a href="/viewreviews" class="btn-viewAll">View All Reviews</a></p>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif
@endif