<style>
    .trips span .rectangle{
        position: absolute;
        top: 35px;
        left: -3px;
        z-index: 1;
        width: 100px;
        padding:4px 10px;
    }

    #recomend{
        /*color:red;*/
    }
    .trips .btn:hover{
        background-color: #1999b7;
    }
    .trips.card-container {
        position: relative;
        flex-wrap: wrap;
        overflow: hidden;
        /*padding-top: 15px;*/
        /*padding-bottom: 15px;*/
        display: flex;
        justify-content: center;
    }

    .trips .card {
        /*min-width: px;*/
        /*width: 420px;*/
        position: relative;
        /*margin: 10px 10px;*/

        /*height: 350px;*/

        border-radius: 2px;
        background-size: cover;
        /*background: rgba(0, 0, 0, 0.7);*/
        box-shadow: 5px 5px 10px 1px rgba(0, 0, 0, 0.3);
        transition: 0.2s all linear;
        border: 1px solid rgba(128, 128, 128, 0.15);
        box-sizing: border-box;
    }


    .trips .card .card-social {
        position: absolute;
        /*height: 55px;*/
        width: 100%;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
        /*top: 275px;*/
        bottom:0px;
    }

    .trips .card .card-social ul {
        padding: 0;
        margin: auto -20px;;
        list-style: none;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content:space-around;
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
        font-family: "Open Sans";
        color: rgba(255, 255, 255, 0.85);
    }
    .trips .card .card-info .card-title {
        line-height: 20px;
        height: 45px;
        position: relative;
        top: 0px;
        text-align: center;
        /*font-size: 25px;*/
        font-size: medium;
        margin-top: -10px;
        background: rgba(0, 0, 0, 0.6);
        box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.3);
        font-weight: 100 !important;
    }

    .trips .card .card-info .card-detail p{
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

    #similarTrips .buckets{
        background-color: transparent;
    }

    [type="checkbox"]:not(:checked), [type="checkbox"]:checked {
        position: relative;
        left: 0px;
        opacity: 1;
        font-size: 20px;
        top: 3px;
        height: 18px;
    }

</style>
@if(count($recommended) > 0)
    <div class="container-fluid" style="background: #e0e0e0;padding:10px 0px 40px 0px;">
        <h2  class="titleHeadtwo"> <span class="reviewTitle"> similar trips </span> </h2>
        <div class="clear"></div>
        <section id="owl-3" style="width: 100%;">
            <div class="owl-carousel owl-theme ">
                @foreach($recommended as $ft)

                    <div class="trips card-container">
                        <a href="/trip/{{$ft->slug}}">
                            <div class="card">
                                <div class="card-image">
                                    <img src="{{url('images/trips/thumbnail/'.$ft->cover_image)}}" style=" border-bottom:red;"
                                         alt="{{$ft->name}}">
                                </div>
                                <div class="card-info">
                                    <div class="card-title">
                                        <div class="valign-wrapper">
                                            <i class="small material-icons">place</i>
                                            {{$ft->name}}
                                        </div>
                                        <span>
                                    @if(!empty($ft->customtrip->recommended))
                                                @if($ft->customtrip->recommended == 1)
                                                    <div class="rectangle center-align hbb" style="">
                                                <i class="shine"></i>
                                                <span id="recomend" style="font-size: 16px">Trending</span>
                                            </div>
                                                @endif
                                            @endif
                                </span>
                                    </div>
                                </div>
                                <div class="card-social">
                                    <ul>
                                        <li>
                                            <a class="buckets tooltipped"
                                               data-position="" data-delay="10" data-tooltip="Total views:{{count($ft->views)}}">
                                                <i class="fa fa-eye" style="color: whitesmoke" aria-hidden="true"></i>
                                            </a>
                                        </li>

                                        <li>
                                            @if(!Auth::user())
                                                <a href="/wish/{{$ft->id}}" class="bucket  tooltipped" data-position=""
                                                   data-delay="10" data-tooltip="Add to Bucket list" style="background: transparent;">
                                                    <i class="fa fa-heart" style="color: whitesmoke" aria-hidden="true"></i>
                                                </a>
                                            @else
                                                @if(!Auth::user())
                                                    <a class="bucket white tooltipped"
                                                       id="{{$ft->id}}" data-id="{{$ft->id}}" data-name="{{Auth::user()->is_active}}"
                                                       data-value="{{$ft->id}}" data-position=""
                                                       data-delay="10" data-tooltip="Remove from Bucket list"  style="background: transparent;" >
                                                        <i class="fa fa-heart" style="color: #ff2330" aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    @if(!empty($ft->wish) && $ft->wish->user_id == Auth::user()->id)
                                                        <a class="bucket rmv  red btn-floating tooltipped"
                                                           id="{{$ft->id}}" data-id="{{$ft->id}}"
                                                           data-name="{{Auth::user()->is_active}}" data-value="{{$ft->id}}"
                                                           data-position="bottom"
                                                           data-delay="10" data-tooltip="Remove from Bucket list"  style="background: transparent;">
                                                            <i class="fa fa-heart" style="color: whitesmoke" aria-hidden="true"></i>
                                                        </a>
                                                    @else
                                                        <a class="bucket btn-small wsh  btn-floating tooltipped"
                                                           id="{{$ft->id}}"
                                                           data-id="{{$ft->id}}" data-name="{{Auth::user()->is_active}}"
                                                           data-value="{{$ft->id}}" data-position="bottom"
                                                           data-delay="10" data-tooltip="Add to Bucket list"  style="background: transparent;">
                                                            <i class="fa fa-heart" style="color: whitesmoke" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                            @endif
                                        </li>

                                        <li style="margin-right: -20px;">
                                             <span title="Compare" style="background: #008eb0;font-size: 16px;padding: 9px 8px 9px 8px;border-radius:2px;">
                                                <label for="{{$ft->id}}">
                                                    <input class="compareCheckbox" type="checkbox" id="{{$ft->id}}" class="compareCheckbox"
                                                           onchange="compareTo({{$ft->id}},this)"/>
                                                    <span style="font-size: 12px;color:white;">Compare</span>
                                                </label>

                                            </span>
                                        </li>

                                        <li  style="margin-right: -20px;">
                                            <a href="/trip/book/{{$ft->id}}" class="waves-effect waves-light btn tooltipped"
                                               data-position="" data-delay="10" data-tooltip="Book Your Trip" style="background:#008EB0;font-size: 12px;color:white;height:auto!important;padding:1px 8px">
                                                Book Now
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endif
