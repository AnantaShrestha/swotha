<style>
    .trips span .rectangle {
        position: absolute;
        top: 35px;
        left: -3px;
        z-index: 1;
        width: 100px;
        padding: 4px 10px;
    }

    #recomend {
        /*color:red;*/
    }

    .trips .btn:hover {
        background-color: #1999b7;
    }

    .trips.card-container {
        position: relative;
        flex-wrap: wrap;
        overflow: hidden;
        display: flex;
        justify-content: center;
    }

    .trips .card {
        position: relative;
        border-radius: 2px;
        background-size: cover;
        box-shadow: 5px 5px 10px 1px rgba(0, 0, 0, 0.3);
        transition: 0.2s all linear;
        border: 1px solid rgba(128, 128, 128, 0.15);
        box-sizing: border-box;
    }

    .trips .card .card-social {
        position: absolute;
        width: 100%;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
        bottom: 0px;
    }

    .trips .card .card-social ul {
        padding: 0;
        margin: 0;
        list-style: none;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: space-around;
    }

    .trips .card .card-social ul li {
        height: 100%;
        line-height: 75px;
        font-size: 1.5em;
        color: rgba(255, 255, 255, 0.85);
        text-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
    }

    .trips .card .card-social ul li:hover {
        text-shadow: 7px 7px 5px rgba(0, 0, 0, 0.7);
        transition: all 0.1s linear;
    }

    .trips .card .card-image {
        width: 100%;
        /*height: 275px;*/
        position: relative;
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;
    }

    .trips .card .card-info {
        position: absolute;
        display: block;
        width: 100%;
        height: 35px;
        line-height: 35px;
        top: 9px;
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;
        color: rgba(255, 255, 255, 0.85);
    }

    .trips .card .card-info .card-title {
        line-height: 20px;
        height: 45px;
        position: relative;
        top: 0px;
        text-align: center;
        font-size: medium;
        margin-top: -10px;
        background: rgba(0, 0, 0, 0.6);
        box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.3);
        font-weight: 100 !important;
    }

    .trips .card .card-info .card-detail p {
        line-height: 1.5rem;
        font-size: 15px;
    }

    .trips .card:hover {
        box-shadow: 10px 10px 10px 1px rgba(0, 0, 0, 0.3);
    }

    .trips .card:hover .card-info .card-title {
        box-shadow: 10px 10px 10px 1px rgba(0, 0, 0, 0.3);
        transition: 0.3s all linear;
    }

    .btn-floating.halfway-fab {
        position: absolute;
        right: 24px;
        bottom: 1px;
    }

    #similarTrips .buckets {
        background-color: transparent;
    }


</style>
@if(!empty($recommended))
    @if(count($recommended) > 0)
        <div class="container-fluid" style="background: #e0e0e0;padding:10px 0px 40px 0px;">
            <h2 class="titleHeadtwo"><span class="reviewTitle"> Similar Trips </span></h2>
            <div class="clear"></div>
            <section id="owl-3" style="width: 100%;">
                <div class="owl-carousel owl-theme ">
                    @foreach($recommended as $ft)
                        <div class="trips card-container">
                            <a href="{{$ft->slug}}">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="{{url('https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179002/static_webp/default_img.webp')}}"
                                             data-src="{{url('images/trips/thumbnail/'.$ft->cover_image)}}"
                                             style=" border-bottom:red;" alt="{{$ft->name}}" class="lazyload">
                                    </div>
                                    <div class="card-info">
                                        <div class="card-title">
                                            <div style="position: absolute; right: 0; top: 0;">
                                                @if(!Auth::user())
                                                    <a href="/wish/{{$ft->id}}"
                                                       class="bucket sbutton btn-floating tooltipped" data-position=""
                                                       data-delay="10" data-tooltip="Add to Bucket list"
                                                       style="height: 32px; width: 32px; margin-top: 6px; margin-right: 6px;">
                                                        <i class="fa fa-heart"
                                                           style="color: whitesmoke; font-size: 14px; margin-top: -2px; display: block"
                                                           aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    @if(!Auth::user())
                                                        <a class="bucket btn-floating sbutton white tooltipped"
                                                           id="{{$ft->id}}" data-id="{{$ft->id}}"
                                                           data-name="{{Auth::user()->is_active}}"
                                                           data-value="{{$ft->id}}" data-position=""
                                                           data-delay="10" data-tooltip="Remove from Bucket list"
                                                           style="height: 32px; width: 32px; margin-top: 6px; margin-right: 6px;">
                                                            <i class="fa fa-heart" style="color: #ff2330"
                                                               aria-hidden="true"></i>
                                                        </a>
                                                    @else
                                                        @if(!empty($ft->wish) && $ft->wish->user_id == Auth::user()->id)
                                                            <a class="bucket rmv  red btn-floating tooltipped"
                                                               id="{{$ft->id}}" data-id="{{$ft->id}}"
                                                               data-name="{{Auth::user()->is_active}}"
                                                               data-value="{{$ft->id}}"
                                                               data-position="bottom"
                                                               data-delay="10" data-tooltip="Remove from Bucket list"
                                                               style="height: 32px; width: 32px; margin-top: 6px; margin-right: 6px;">
                                                                <i class="fa fa-heart"
                                                                   style="color: whitesmoke; font-size: 14px; margin-top: -2px; display: block"
                                                                   aria-hidden="true"></i>
                                                            </a>
                                                        @else
                                                            <a class="bucket btn-small wsh  btn-floating tooltipped"
                                                               id="{{$ft->id}}"
                                                               data-id="{{$ft->id}}"
                                                               data-name="{{Auth::user()->is_active}}"
                                                               data-value="{{$ft->id}}" data-position="bottom"
                                                               data-delay="10" data-tooltip="Add to Bucket list"
                                                               style="height: 32px; width: 32px; margin-top: 6px; margin-right: 6px;">
                                                                <i class="fa fa-heart"
                                                                   style="color: whitesmoke; font-size: 14px; margin-top: -2px; display: block"
                                                                   aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="valign-wrapper"
                                                 style="line-height: 45px;text-align: center;display: block;padding-right: 48px;">
                                                {{$ft->name}}
                                            </div>
                                            <a class="buckets tooltipped"
                                               data-position="" data-delay="10"
                                               data-tooltip="Total views:{{$ft->views->count}}"
                                               style="position: absolute; right: 15px; top: 50px;">
                                                <i class="fa fa-eye" style="color: whitesmoke" aria-hidden="true"></i>
                                            </a>
                                            <span>
                                    @if(!empty($ft->customtrip->recommended))
                                                    @if($ft->customtrip->recommended == 1)
                                                        <div class="rectangle center-align"
                                                             style="background-color: tomato;padding:1px 1px;">
                                                        <i class="shine"></i>
                                                        <span id="recomend" style="font-size: 14px;">Trending</span>
                                                    </div>
                                                    @endif
                                                @endif
                                </span>
                                        </div>
                                    </div>
                                    <div class="similar-trip-btn">
                                    <span title="Compare" class="compare_btn" style="">
                                        <input class="filled-in compareCheckbox" type="checkbox" id="{{$ft->id}}"
                                               onchange="compareTo('{{$ft->id}}',this)"/>
                                        <label for="{{$ft->id}}"
                                               style="color:white; padding-left: 25px; line-height: 20px;">Compare</label>


                                    </span>
                                        <a href="/book-trip/{{$ft->id}}"
                                           class="waves-effect waves-light btn tooltipped book_now"
                                           data-position="" data-delay="10" data-tooltip="Book Your Trip" style="">
                                            Book Now
                                        </a>
                                    </div>


                                </div>

                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
        <script>
            var trips = [];
            var compareTemp = false;

            function compareTo(a, b) {
                // alert("I am here");
                var found = false;
                for (var i = 0; i < trips.length; i++) {
                    /* alert("I am for loop");*/
                    if (trips[i] == a) {
                        /* alert("I am in if else");*/
                        found = true;
                        trips.splice(i, 1);
                    }
                }
                if (found == false) {
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
                } else {
                    $(b).removeClass('active');
                }
            }

            function ViewComparison() {
                var triplist = "";
                for (var i = 0; i < trips.length; i++) {
                    triplist = triplist + trips[i] + ",";
                }
                if (triplist.length > 0) {
                    triplist = triplist.substring(0, triplist.length - 1);

                }
                var compareurl = "/compare/" + triplist;
                for (var i = 0; i < trips.length; i++) {

                }
                window.open(compareurl, '_blank');
                trips.length = 0;
                trips.checked = false;
                var compareCheckbox = document.getElementsByClassName("compareCheckbox");

                for (i = 0; i < compareCheckbox.length; i++) {
                    compareCheckbox[i].checked = false;
                }
                // location.reload();
            }

        </script>
    @endif
@endif
