
<link rel="stylesheet" href="{{url('css/review.css')}}">
<style>
    @media only screen and (min-width:600px)
    {
     .rating_only_review{
        margin-top: 8%;
     }

    }

    @media only screen and (max-width:800px)
    {
        .reviewTopRibbonHead{
            display:none;
        }

        .reviewTopRibbonDiv{
            display:block;
        }
    }

    @media only screen and (min-width:800px)
    {
        .reviewTopRibbonHead{
            display:block;
        }

        .reviewTopRibbonDiv{
            display:none;
        }
    }

    .traingularValue{
        font-size: 22px;
    }

    .reviewTopRibbonHead{
        text-align: center;
    }
</style>
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
    $avgCompanyScore = round(($totaloverallreviews / $totalreviews),2);
    ?>


@if(Request::is('trip/*'))
    <?php $count=0; ?>
    @foreach($reviews as $review)
        @if(!empty($review->trip->name))
            @if($review->trip->name == $trip->name)
                <?php $count++; ?>
            @endif
        @endif
    @endforeach
@if($count > 0)
    <div class="reviewTopRibbonDiv" style="color: black;background: #00B1FF;color:white;">
        <div class="row container">
            <div class="col l6 m6 s12" style="margin-bottom: -30px;">
                <p style="font-size: 18px;text-align: center;"> Total reviews: <span class="traingularValue">  {{count($reviews)}} </span> </p>
            </div>

            <div class="col l6 m6 s12">
                <p style="font-size: 18px;text-align: center;"> Overall Company Review: <span class="traingularValue"> {{$avgCompanyScore}}</span> </p>
            </div>
        </div>
    </div>
<div class="parallax-container valign-wrapper ParallexContent" id="aboutus">
    <div class="container">
        <h2 class="travelGreedingHead">
            <span style="text-align: center;"> {{$parallax->title}} </span>
        </h2>
        <div class="reviewTopRibbonHead">
            <p style="margin-top:0px;position: absolute;top: 0px;left: 0px;color:white;border-top:180px solid #00B1FF;border-right:200px solid transparent;width:0px;height:0px;"> </p>
            <p style="position: absolute;top: 0px;left: 20px;font-size: 12px"> Total reviews</br> {{count($reviews)}}</p>

            <p style="margin-top:0px;position: absolute;top: 0px;right: 0px;color:white;border-top:180px solid #00B1FF;border-left:240px solid transparent;width:0px;height:0px;"> </p>
            <p style="position: absolute;top: 0px;right: 20px;font-size: 12px"> Overall Company Review</br> {{$avgCompanyScore}} </p>
        </div>

        <div class="container-fluid" id="reviewSection" >
            <div class="owl-carousel reviewCarousel owl-theme owl-loaded">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="padding:10px 30px;">
                            @foreach($reviews as $review)
                                @if(!empty($review->trip->name))
                                    @if($review->trip->name == $trip->name)
                                        <div class="owl-item">
                                            <div class="row">
                                                <div class="col l4 m4 s12">
                                                    <div>
                                                        @if($review->photo!=null)
                                                            <img src="{{url('images/reviewer/'.$review->photo)}}" class="reviewImg responsive-img circle">
                                                        @elseif($review->user_id != null && ($review->user->photo != null))
                                                            <img src="{{url('images/profile/'.$review->user->photo)}}" class="reviewImg responsive-img circle">
                                                        @else
                                                            <img src="{{url('images/people.png')}}" class="reviewImg responsive-img circle">
                                                        @endif
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <table>
                                                            <tr>
                                                                <td> Name: </td>
                                                                <td> {{$review->name}} </td>
                                                            </tr>
                                                            @if($review->trip_id != null)
                                                                <tr>
                                                                    <td> Trips: </td>
                                                                    <td>{{$review->trip->name}}</td>
                                                                </tr>
                                                            @endif
                                                            <tr>
                                                                <td> Nationality:&nbsp; </td>
                                                                <td>
                                                                    <img src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/{{strtolower($review->country)}}.svg" alt="{{$review->country}}"
                                                                         class="reviewNationFlag">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Overall Rating: </td>
                                                                <td>
                                                                    ( {{(float) $review->overall}} )
                                                                    <span class = "overallstar stars reviewStars"> {{(float) $review->overall}}</span>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                    </div>
                                                </div>
                                                @if(($review->review !=="-") and ($review->review !=null))
                                                    <div class="col l8 m8 s12">
                                                        <div class="row reviewTextContent">
                                                            <div class="col l12 m12"  style="padding-bottom: 20px;">
                                                                <b style="font-size: 30px;">&ldquo;</b>
                                                                {{$review->review}}
                                                                <b style="font-size: 30px;">&rdquo;</b>
                                                                @if(str_word_count($review->review)>50)
                                                                    @if($review->staff != 0 or $review->meal != 0 or $review->transportation != 0 or $review->value != 0 or $review->accomodation != 0 or $review->guide !=0 )
                                                                        <span>
                                                                      <a onclick="reviewAllPart()" style="cursor:pointer" class="reviewTextViewBtn reviewAllPartBtn"> View&nbsp;More
                                                                      </a>

                                                                      <a style="display:none;cursor:pointer" onclick="reviewNone()" class="reviewTextViewBtn reviewNoneBtn"> View&nbsp;Less
                                                                      </a>
                                                                    </span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="reviewExpandOrCollapse" >
                                                                {{--if review is > than 50 words then show less and hide appears--}}
                                                                @if(str_word_count($review->review)>50)
                                                                        <div class="reviewPart" style="display: none;">
                                                                            @if($review->staff != 0)
                                                                                <div class="col l6 m6 s12">
                                                                                    Staff:
                                                                                    <span  class = "stars reviewStars">{{$review->staff}}</span>
                                                                                </div>
                                                                            @endif
                                                                            @if($review->meal != 0)
                                                                                <div class="col l6 m6 s12">
                                                                                    Meals:
                                                                                    <span  class = "stars reviewStars">{{$review->meal}}</span>
                                                                                </div>
                                                                            @endif
                                                                            @if($review->transportation != 0)

                                                                                <div class="col l6 m6 s12">
                                                                                    Transportation:
                                                                                    <span  class = "stars reviewStars">{{$review->transportation}}</span>
                                                                                </div>
                                                                            @endif
                                                                            @if($review->value != 0)
                                                                                <div class="col l6 m6 s12">
                                                                                    Price value:
                                                                                    <span  class = "stars reviewStars">{{$review->value}}</span>
                                                                                </div>
                                                                            @endif
                                                                            @if($review->accomodation != 0)
                                                                                <div class="col l6 m6 s12">
                                                                                    Accomodation:
                                                                                    <span  class = "stars reviewStars">{{$review->accomodation}}</span>
                                                                                </div>
                                                                            @endif
                                                                            @if($review->guide !=0)
                                                                                <div class="col l6 m6 s12">
                                                                                    Guide & porter:
                                                                                    <span  class = "stars reviewStars">{{$review->guide}}</span>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                @else


                                                                @endif
                                                            </div>
                                                        </div>
                                                     </div>
                                                @else
                                                    <div class="col l8 m8 s12 rating_only_review" style="" >
                                                        <div class="row reviewTextContent">
                                                            <div class="reviewExpandOrCollapse">
                                                                <div class="reviewEmpty">
                                                                    @if($review->staff != 0)
                                                                        <div class="col l6 m6 s12">
                                                                            Staff:
                                                                            <span  class = "stars reviewStars">{{$review->staff}}</span>
                                                                        </div>
                                                                    @endif
                                                                    @if($review->meal != 0)
                                                                        <div class="col l6 m6 s12">
                                                                            Meals:
                                                                            <span  class = "stars reviewStars">{{$review->meal}}</span>
                                                                        </div>
                                                                    @endif
                                                                    @if($review->transportation != 0)

                                                                        <div class="col l6 m6 s12">
                                                                            Transportation:
                                                                            <span  class = "stars reviewStars">{{$review->transportation}}</span>
                                                                        </div>
                                                                    @endif
                                                                    @if($review->value != 0)
                                                                        <div class="col l6 m6 s12">
                                                                            Price value:
                                                                            <span  class = "stars reviewStars">{{$review->value}}</span>
                                                                        </div>
                                                                    @endif
                                                                    @if($review->accomodation != 0)
                                                                        <div class="col l6 m6 s12">
                                                                            Accomodation:
                                                                            <span  class = "stars reviewStars">{{$review->accomodation}}</span>
                                                                        </div>
                                                                    @endif
                                                                    @if($review->guide !=0)
                                                                        <div class="col l6 m6 s12">
                                                                            Guide & porter:
                                                                            <span  class = "stars reviewStars">{{$review->guide}}</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                    </div>
                </div>
            </div>
            <div style="text-align: center;margin-top: 30px;margin-bottom:40px;">
                <a class="waves-effect waves-light btn" style="padding:0px 10px; font-size: 12px;" href="/showallreviews">View All</a>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="{{url('images/coverImage/'.$parallax->image)}}" alt="img"></div>
</div>
@endif
@else
    @if(!empty($reviews))
        <div class="reviewTopRibbonDiv" style="color: black;background: #00B1FF;color:white;">
            <div class="row container">
                <div class="col l6 m6 s12" style="margin-bottom: -30px;">
                    <p style="font-size: 18px;text-align: center;"> Total reviews: {{count($reviews)}} </p>
                </div>

                <div class="col l6 m6 s12">
                    <p style="font-size: 18px;text-align: center;"> Overall Company Review: {{$avgCompanyScore}} </p>
                </div>
            </div>
        </div>

        <div class="parallax-container valign-wrapper ParallexContent" id="aboutus">
            <div class="container">
                <h2 class="travelGreedingHead">
                    <span style="text-align: center;"> {{$parallax->title}} </span>
                </h2>
                    <div class="reviewTopRibbonHead">
                        <p style="margin-top:0px;position: absolute;top: 0px;left: 0px;color:white;border-top:180px solid #00B1FF;border-right:200px solid transparent;width:0px;height:0px;"> </p>
                        <p style="position: absolute;top: 0px;left: 20px;font-size: 12px"> Total reviews</br> <span class="traingularValue"> {{count($reviews)}} </span> </p>

                        <p style="margin-top:0px;position: absolute;top: 0px;right: 0px;color:white;border-top:180px solid #00B1FF;border-left:240px solid transparent;width:0px;height:0px;"> </p>
                        <p style="position: absolute;top: 0px;right: 20px;font-size: 12px"> Overall Company Review</br> <span class="traingularValue">{{$avgCompanyScore}}</span> </p>
                    </div>
                <div class="container-fluid" id="reviewSection" >
                    <div class="owl-carousel reviewCarousel owl-theme owl-loaded">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="padding:10px 30px;">
                                @foreach($reviews as $review)
                                    <div class="owl-item">
                                        <div class="row">
                                            <div class="col l4 m4 s12">
                                                <div>
                                                    @if($review->photo!=null)
                                                        <img src="{{url('images/reviewer/'.$review->photo)}}" class="reviewImg responsive-img circle">
                                                    @elseif($review->user_id != null && ($review->user->photo != null))
                                                        <img src="{{url('images/profile/'.$review->user->photo)}}" class="reviewImg responsive-img circle">
                                                    @else
                                                        <img src="{{url('images/people.png')}}" class="reviewImg responsive-img circle">
                                                    @endif
                                                </div>
                                                <br>
                                                <div>
                                                    <table>
                                                        <tr>
                                                            <td> Name: </td>
                                                            <td> {{$review->name}} </td>
                                                        </tr>
                                                        @if($review->trip_id != null)
                                                            <tr>
                                                                <td> Trips: </td>
                                                                <td>{{$review->trip->name}}</td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td> Nationality:&nbsp; </td>
                                                            <td>
                                                                <img src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/{{strtolower($review->country)}}.svg" alt="{{$review->country}}"
                                                                     class="reviewNationFlag">
                                                            </td>
                                                        </tr>
                                                        <tr>

                                                            <td>Overall Rating: </td>
                                                            <td>
                                                                ( {{(float) $review->overall}} )
                                                                <span class = "overallstar stars reviewStars"> {{(float) $review->overall}}</span>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </div>
                                            </div>

                                            @if(($review->review !=="-") and ($review->review !=null) )
                                                <div class="col l8 m8 s12">
                                                    <div class="row reviewTextContent">

                                                        <div class="col l12 m12"  style="padding-bottom: 20px;">
                                                                <b style="font-size: 30px;">&ldquo;</b>
                                                                {{$review->review}}
                                                                <b style="font-size: 30px;">&rdquo;</b>
                                                            @if(str_word_count($review->review)>50)
                                                                @if($review->staff != 0 or $review->meal != 0 or $review->transportation != 0 or $review->value != 0 or $review->accomodation != 0 or $review->guide !=0 )
                                                                 <span>
                                                                  <a onclick="reviewAllPart()" style="cursor:pointer" class="reviewTextViewBtn reviewAllPartBtn"> View&nbsp;More
                                                                  </a>

                                                                  <a style="display:none;cursor:pointer" onclick="reviewNone()" class="reviewTextViewBtn reviewNoneBtn"> View&nbsp;Less
                                                                  </a>
                                                                </span>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="reviewExpandOrCollapse" >
                                                            @if(str_word_count($review->review)>50)
                                                                {{--if review is > than 50 words then this section in hidden--}}
                                                                <div class="reviewPart" style="display: none;">
                                                                    @if($review->staff != 0)
                                                                        <div class="col l6 m6 s12">
                                                                            Staff:
                                                                            <span  class = "stars reviewStars">{{$review->staff}}</span>
                                                                        </div>
                                                                    @endif
                                                                    @if($review->meal != 0)
                                                                        <div class="col l6 m6 s12">
                                                                            Meals:
                                                                            <span  class = "stars reviewStars">{{$review->meal}}</span>
                                                                        </div>
                                                                    @endif
                                                                    @if($review->transportation != 0)

                                                                        <div class="col l6 m6 s12">
                                                                            Transportation:
                                                                            <span  class = "stars reviewStars">{{$review->transportation}}</span>
                                                                        </div>
                                                                    @endif
                                                                    @if($review->value != 0)
                                                                        <div class="col l6 m6 s12">
                                                                            Price value:
                                                                            <span  class = "stars reviewStars">{{$review->value}}</span>
                                                                        </div>
                                                                    @endif
                                                                    @if($review->accomodation != 0)
                                                                        <div class="col l6 m6 s12">
                                                                            Accomodation:
                                                                            <span  class = "stars reviewStars">{{$review->accomodation}}</span>
                                                                        </div>
                                                                    @endif
                                                                    @if($review->guide !=0)
                                                                        <div class="col l6 m6 s12">
                                                                            Guide & porter:
                                                                            <span  class = "stars reviewStars">{{$review->guide}}</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @else
                                                                {{--if review is < than 50 words then this section in not hidden--}}
                                                                <div class="" style="">
                                                                        @if($review->staff != 0)
                                                                            <div class="col l6 m6 s12">
                                                                                Staff:
                                                                                <span  class = "stars reviewStars">{{$review->staff}}</span>
                                                                            </div>
                                                                        @endif
                                                                        @if($review->meal != 0)
                                                                                <div class="col l6 m6 s12">
                                                                                Meals:
                                                                                <span  class = "stars reviewStars">{{$review->meal}}</span>
                                                                                </div>
                                                                        @endif
                                                                        @if($review->transportation != 0)
                                                                            <div class="col l6 m6 s12">
                                                                                Transportation:
                                                                                <span  class = "stars reviewStars">{{$review->transportation}}</span>
                                                                             </div>
                                                                        @endif
                                                                        @if($review->value != 0)
                                                                            <div class="col l6 m6 s12">
                                                                                Price value:
                                                                                <span  class = "stars reviewStars">{{$review->value}}</span>
                                                                            </div>
                                                                        @endif
                                                                        @if($review->accomodation != 0)
                                                                                <div class="col l6 m6 s12">
                                                                                    Accomodation:
                                                                                    <span  class = "stars reviewStars">{{$review->accomodation}}</span>
                                                                                </div>
                                                                        @endif
                                                                        @if($review->guide !=0)
                                                                                <div class="col l6 m6 s12">
                                                                                    Guide & porter:
                                                                                    <span  class = "stars reviewStars">{{$review->guide}}</span>
                                                                                </div>
                                                                        @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                 </div>
                                            @else
                                                <div class="col l8 m8 s12 rating_only_review" style="" >
                                                    <div class="row reviewTextContent">
                                                        <div class="reviewExpandOrCollapse">
                                                            <div class="reviewEmpty">
                                                                    @if($review->staff != 0)
                                                                        <div class="col l6 m6 s12">
                                                                                Staff:
                                                                                <span  class = "stars reviewStars">{{$review->staff}}</span>
                                                                        </div>
                                                                    @endif

                                                                    @if($review->meal != 0)
                                                                        <div class="col l6 m6 s12">
                                                                                Meals:
                                                                                <span  class = "stars reviewStars">{{$review->meal}}</span>
                                                                        </div>
                                                                    @endif

                                                                    @if($review->transportation != 0)

                                                                        <div class="col l6 m6 s12">
                                                                                Transportation:
                                                                                <span  class = "stars reviewStars">{{$review->transportation}}</span>
                                                                        </div>
                                                                    @endif
                                                                    @if($review->value != 0)
                                                                        <div class="col l6 m6 s12">
                                                                            Price value:
                                                                            <span  class = "stars reviewStars">{{$review->value}}</span>
                                                                         </div>
                                                                    @endif
                                                                    @if($review->accomodation != 0)
                                                                        <div class="col l6 m6 s12">
                                                                            Accomodation:
                                                                            <span  class = "stars reviewStars">{{$review->accomodation}}</span>
                                                                        </div>
                                                                    @endif
                                                                    @if($review->guide !=0)
                                                                        <div class="col l6 m6 s12">
                                                                            Guide & porter:
                                                                            <span  class = "stars reviewStars">{{$review->guide}}</span>
                                                                        </div>
                                                                    @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div style="text-align: center;margin-top: 30px;margin-bottom:40px;">
                        <a href="/viewreviews" target="_blank" class="waves-effect waves-light btn" style="padding:0 10px; font-size: 12px;">View All</a>
                    </div>
                </div>
            </div>
            <div class="parallax"><img src="{{url('images/coverImage/'.$parallax->image)}}" alt="img"></div>
        </div>
    @endif
@endif
@endif
<script>
    function reviewAllPart(){
        $('.reviewPart').css({'display':'block'});
        $('.reviewAllPartBtn').css({'display':'none'});
        $('.reviewNoneBtn').css({'display':'inline'});
    }

    function reviewNone(){
        $('.reviewPart').css({'display':'none'});
        $('.reviewAllPartBtn').css({'display':'inline'});
        $('.reviewNoneBtn').css({'display':'none'});
    }
</script>

