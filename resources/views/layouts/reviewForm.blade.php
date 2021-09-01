<section class="review-form page-scroll" id="review-form">
    <div class="container">
        <div class="section-title-black">
            <h2 class="">Share Your Experience</h2>
            <div class="title-bg">
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
            </div>
        </div>
        <form action="/review" method="post" id="alignreview">
            {{csrf_field()}}
            {!! Recaptcha::field('home', 'g-recaptcha-response', ['id' => 'recaptcha-id', 'class' => 'form-element']) !!}
            <div class="review-blocks">
                <div class="row ml-0 mr-0 review-bg">
                    <div class="col-lg-12 review-border">
                        <div class="row ml-0 mr-0">
                            <div class="star-content col-lg-6 col-md-6 col-sm-12">
                                <p>On a scale of 1 to 10, how likely are you to recommend Swotah to your friends or
                                    acquaintances ?</p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="star-rating" style="line-height:50px">
                                    <input class="recommend-star star-10" id="recommend-star-10" type="radio"
                                           name="recomendation_scale" value="10"/>
                                    <label class="recommend-star star-10" for="recommend-star-10"><i
                                                class="active fa fa-star" aria-hidden="true"></i></label>
                                    <input class="recommend-star star-9" id="recommend-star-9" type="radio"
                                           name="recomendation_scale" value="9"/>
                                    <label class="recommend-star star-9" for="recommend-star-9"><i
                                                class="active fa fa-star" aria-hidden="true"></i></label>
                                    <input class="recommend-star star-8" id="recommend-star-8" type="radio"
                                           name="recomendation_scale" value="8"/>
                                    <label class="recommend-star star-8" for="recommend-star-8"><i
                                                class="active fa fa-star" aria-hidden="true"></i></label>
                                    <input class="recommend-star star-7" id="recommend-star-7" type="radio"
                                           name="recomendation_scale" value="7"/>
                                    <label class="recommend-star star-7" for="recommend-star-7"><i
                                                class="active fa fa-star" aria-hidden="true"></i></label>
                                    <input class="recommend-star star-6" id="recommend-star-6" type="radio"
                                           name="recomendation_scale" value="6"/>
                                    <label class="recommend-star star-6" for="recommend-star-6"><i
                                                class="active fa fa-star" aria-hidden="true"></i></label>
                                    <input class="recommend-star star-5" id="recommend-star-5" type="radio"
                                           name="recomendation_scale" value="5"/>
                                    <label class="recommend-star star-5" for="recommend-star-5"><i
                                                class="active fa fa-star" aria-hidden="true"></i></label>
                                    <input class="recommend-star star-4" id="recommend-star-4" type="radio"
                                           name="recomendation_scale" value="4"/>
                                    <label class="recommend-star star-4" for="recommend-star-4"><i
                                                class="active fa fa-star" aria-hidden="true"></i></label>
                                    <input class="recommend-star star-3" id="recommend-star-3" type="radio"
                                           name="recomendation_scale" value="3"/>
                                    <label class="recommend-star star-3" for="recommend-star-3"><i
                                                class="active fa fa-star" aria-hidden="true"></i></label>
                                    <input class="recommend-star star-2" id="recommend-star-2" type="radio"
                                           name="recomendation_scale" value="2"/>
                                    <label class="recommend-star star-2" for="recommend-star-2"><i
                                                class="active fa fa-star" aria-hidden="true"></i></label>
                                    <input class="recommend-star star-1" id="recommend-star-1" type="radio"
                                           name="recomendation_scale" value="1"/>
                                    <label class="recommend-star star-1" for="recommend-star-1"><i
                                                class="active fa fa-star" aria-hidden="true"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 pl-0">
                        <div class="review-form-part">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Your Name" name="name"
                                               class="review-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="email" placeholder="Enter Your Email" name="email"
                                               class="review-control"
                                               value="@if(Auth::user()) {{Auth::user()->email}} @endif" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="review-control" name="country" required>
                                            <option value="" disabled selected>Your Nationality</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country['code']}}">{{$country['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if(!empty($istrip))
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select name="trip_id" class="review-control" required>
                                                <option value="{{$trip->id}}">{{$trip->name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-6">
                                    <div class="form-group overallrate-form">
                                        <div class="flex-box">
                                            <div class="rating-title flex">
                                                <label class="reviewform-label overallrating" style="">Overall Rating
                                                    :</label>
                                            </div>
                                            <div class="many-star" style="margin-left: 10px;">
                                                <div class="star-rating" style="line-height:47px">
                                                    <input class="star star-5" id="exp-star-5" type="radio"
                                                           name="overall" value="5"/>
                                                    <label class="star star-5" for="exp-star-5"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-4" id="exp-star-4" type="radio"
                                                           name="overall" value="4"/>
                                                    <label class="star star-4" for="exp-star-4"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-3" id="exp-star-3" type="radio"
                                                           name="overall" value="3"/>
                                                    <label class="star star-3" for="exp-star-3"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-2" id="exp-star-2" type="radio"
                                                           name="overall" value="2"/>
                                                    <label class="star star-2" for="exp-star-2"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-1" id="exp-star-1" type="radio"
                                                           name="overall" value="1" required/>
                                                    <label class="star star-1" for="exp-star-1"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
<textarea class="review-control"
          placeholder="Please share what the best & least about your recent trip and experience"
          name="review0">
</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 pr-0">
                        @if(!Auth::user())
                            <div class="preview img-wrapper uploadAnonymousPhoto">
                                <img src="{{asset('images/user.png')}}">
                            </div>
                        @else
                            @if(Auth::user()->photo)
                                <div class="preview img-wrapper uploadAnonymousPhoto">
                                    <img src="{{asset('images/profile/'.Auth::user()->photo)}}">
                                </div>
                            @else
                                <div class="preview img-wrapper uploadAnonymousPhoto">
                                    <img src="{{asset('images/user.png')}}">

                                </div>
                            @endif
                        @endif
                        <div class="file-upload-wrapper">
                            <button class="upload-image-btn" type="button">Upload Image</button>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group" style="text-align:center">
                            <button type="submit" id="submitreview" class="btn-book" style="border:0px;">Submit</button>
                        </div>
                    </div>
                    <div id="modal-no-recommend" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">What would you like us to improve?</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                            <div class="form-group">
                                                <input id="hospitality" type="checkbox" class="filled-in"
                                                       value="hospitality" name="improve_area[]"/>
                                                <label for="hospitality">Hospitality</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" class="filled-in" id="cuisines" value="cusines"
                                                       name="improve_area[]"/>

                                                <label for="cuisines">Cuisines</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" class="filled-in" id="transfers"
                                                       value="transfers" name="improve_area[]"/>


                                                <label for="transfers">Transfers</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-12 col7-recom" style="">
                                            <div class="form-group">

                                                <label for="unsatisfied rates">Unsatisfiable Rates</label>
                                                <input type="checkbox" id="unsatisfiable_rates" class="filled-in"
                                                       value="unsatisfied rates" name="improve_area[]"/>
                                            </div>
                                            <!--  <div class="form-group">


                                                 <label for="Our Escorts">Our Escorts</label>
                                                  <input type="checkbox" class="filled-in" id="our_escorts" value="escorts" name="improve_area[]"/>
                                             </div> -->
                                            <div class="form-group">
                                                <label for="no recommendations">No recommedations</label>
                                                <input type="checkbox" class="filled-in" id="no_recommend"
                                                       value="no recommendations" name="improve_area[]"/>

                                            </div>

                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="you_suggestions" style="display: block;">Your
                                                    suggestions:</label>
                                                <textarea placeholder="Please write your suggestion here."
                                                          class="form-control" id="you_suggestions"
                                                          name="suggestion">
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="footer-ok" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="modal59" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Would you like to provide detailed reviews? </h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="other-star">
                                                <strong>Staff Rating</strong>
                                                <div class="star-rating">
                                                    <input class="star star-5" id="staff-star-5" type="radio"
                                                           name="staff" value="5"/>
                                                    <label class="star star-5" for="staff-star-5"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-4" id="staff-star-4" type="radio"
                                                           name="staff" value="4"/>
                                                    <label class="star star-4" for="staff-star-4"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-3" id="staff-star-3" type="radio"
                                                           name="staff" value="3"/>
                                                    <label class="star star-3" for="staff-star-3"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-2" id="staff-star-2" type="radio"
                                                           name="staff" value="2"/>
                                                    <label class="star star-2" for="staff-star-2"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-1" id="staff-star-1" type="radio"
                                                           name="staff" value="1"/>
                                                    <label class="star star-1" for="staff-star-1"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="other-star">
                                                <strong>Price Value</strong>
                                                <div class="star-rating">
                                                    <input class="star star-5" id="value-star-5" type="radio"
                                                           name="value" value="5"/>
                                                    <label class="star star-5" for="value-star-5"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-4" id="value-star-4" type="radio"
                                                           name="value" value="4"/>
                                                    <label class="star star-4" for="value-star-4"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-3" id="value-star-3" type="radio"
                                                           name="value" value="3"/>
                                                    <label class="star star-3" for="value-star-3"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-2" id="value-star-2" type="radio"
                                                           name="value" value="2"/>
                                                    <label class="star star-2" for="value-star-2"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-1" id="value-star-1" type="radio"
                                                           name="value" value="1"/>
                                                    <label class="star star-1" for="value-star-1"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="other-star">
                                                <strong>Meals</strong>
                                                <div class="star-rating">
                                                    <input class="star star-5" id="meal-star-5" type="radio" name="meal"
                                                           value="5"/>
                                                    <label class="star star-5" for="meal-star-5"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-4" id="meal-star-4" type="radio" name="meal"
                                                           value="4"/>
                                                    <label class="star star-4" for="meal-star-4"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-3" id="meal-star-3" type="radio" name="meal"
                                                           value="3"/>
                                                    <label class="star star-3" for="meal-star-3"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-2" id="meal-star-2" type="radio" name="meal"
                                                           value="2"/>
                                                    <label class="star star-2" for="meal-star-2"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-1" id="meal-star-1" type="radio" name="meal"
                                                           value="1"/>
                                                    <label class="star star-1" for="meal-star-1"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="other-star">
                                                <strong>Accomodation</strong>
                                                <div class="star-rating">
                                                    <input class="star star-5" id="accomodation-star-5" type="radio"
                                                           name="accomodation" value="5"/>
                                                    <label class="star star-5" for="accomodation-star-5"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-4" id="accomodation-star-4" type="radio"
                                                           name="accomodation" value="4"/>
                                                    <label class="star star-4" for="accomodation-star-4"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-3" id="accomodation-star-3" type="radio"
                                                           name="accomodation" value="3"/>
                                                    <label class="star star-3" for="accomodation-star-3"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-2" id="accomodation-star-2" type="radio"
                                                           name="accomodation" value="2"/>
                                                    <label class="star star-2" for="accomodation-star-2"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-1" id="accomodation-star-1" type="radio"
                                                           name="accomodation" value="1"/>
                                                    <label class="star star-1" for="accomodation-star-1"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="other-star">
                                                <strong>Transportation</strong>
                                                <div class="star-rating">
                                                    <input class="star star-5" id="transportation-star-5" type="radio"
                                                           name="transportation" value="5"/>
                                                    <label class="star star-5" for="transportation-star-5"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-4" id="transportation-star-4" type="radio"
                                                           name="transportation" value="4"/>
                                                    <label class="star star-4" for="transportation-star-4"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-3" id="transportation-star-3" type="radio"
                                                           name="transportation" value="3"/>
                                                    <label class="star star-3" for="transportation-star-3"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-2" id="transportation-star-2" type="radio"
                                                           name="transportation" value="2"/>
                                                    <label class="star star-2" for="transportation-star-2"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-1" id="transportation-star-1" type="radio"
                                                           name="transportation" value="1"/>
                                                    <label class="star star-1" for="transportation-star-1"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="other-star">
                                                <strong>Guide & Porter</strong>
                                                <div class="star-rating">
                                                    <input class="star star-5" id="guide-star-5" type="radio"
                                                           name="guide" value="5"/>
                                                    <label class="star star-5" for="guide-star-5"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-4" id="guide-star-4" type="radio"
                                                           name="guide" value="4"/>
                                                    <label class="star star-4" for="guide-star-4"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-3" id="guide-star-3" type="radio"
                                                           name="guide" value="3"/>
                                                    <label class="star star-3" for="guide-star-3"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-2" id="guide-star-2" type="radio"
                                                           name="guide" value="2"/>
                                                    <label class="star star-2" for="guide-star-2"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                    <input class="star star-1" id="guide-star-1" type="radio"
                                                           name="guide" value="1"/>
                                                    <label class="star star-1" for="guide-star-1"><i
                                                                class="active fa fa-star"
                                                                aria-hidden="true"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="footer-ok" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<div id="uploadAnonymousModal" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Please choose a picture</h4>
                <button type="button" class="close close-review" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" id="uploadAnonymous" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <h3 style="font-size:14px;color:red;margin-bottom:10px">Please select image of size less than 5
                        MB</h3>
                    <input type="hidden" name="table" value="user">
                    <input type="file" id="photo" name="photo" class=" form-control" accept="image/*" required/>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="reserve-submit-btn">Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>