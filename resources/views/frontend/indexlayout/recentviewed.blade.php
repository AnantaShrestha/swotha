@if(!empty($recentTrips))
@if(count($recentTrips) > 0)
    <!--    --><?php //dd($recentTrips) ?>
<div class="container-fluid" style="background: #e0e0e0;padding:10px 0px 40px 0px;">
    <h2 class="titleHeadtwo"><span class="reviewTitle"> Recently Viewed </span></h2>
<div class="clear"></div>
<section id="owl-3" style="width: 100%;">
    <div class="owl-carousel owl-theme ">
        @foreach($recentTrips as $ft)
            <div class="trips card-container">
                <a href="/trip/{{$ft->slug}}">
                    <div class="card">
                        <div class="card-image">
                            <img  src="{{url('/images/default_img.jpg')}}" data-src="{{url('images/trips/thumbnail/'.$ft->cover_image)}}" style=" border-bottom:red;"
                                 alt="{{$ft->name}}" class="lazyload blur-up">
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
                                            <div class="rectangle center-align" style="background-color: tomato;padding:1px 1px;">
                                                <i class="shine"></i>
                                                <span id="recomend" style="font-size: 14px;">Trending</span>
                                            </div>
                                        @endif
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="card-social">
                            <ul>
                                <li>
                                    <a class="bucket tooltipped"
                                       data-position="" data-delay="10" data-tooltip="Total views:{{$ft->views->count}}">
                                        <i class="fa fa-eye" style="color: whitesmoke" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    @if(!Auth::user())
                                        <a href="/wish/{{$ft->id}}" class="bucket  tooltipped" data-position=""
                                           data-delay="10" data-tooltip="Add to Bucket list">
                                            <i class="fa fa-heart" style="color: whitesmoke" aria-hidden="true"></i>
                                        </a>
                                    @else
                                        @if(!Auth::user())
                                            <a class="bucket white tooltipped"
                                               id="{{$ft->id}}" data-id="{{$ft->id}}" data-name="{{Auth::user()->is_active}}"
                                               data-value="{{$ft->id}}" data-position=""
                                               data-delay="10" data-tooltip="Remove from Bucket list" >
                                                <i class="fa fa-heart" style="color: #ff2330" aria-hidden="true"></i>
                                            </a>
                                        @else
                                            @if(!empty($ft->wish) && $ft->wish->user_id == Auth::user()->id)
                                                <a class="bucket rmv  red btn-floating tooltipped"
                                                   id="{{$ft->id}}" data-id="{{$ft->id}}"
                                                   data-name="{{Auth::user()->is_active}}" data-value="{{$ft->id}}"
                                                   data-position="bottom"
                                                   data-delay="10" data-tooltip="Remove from Bucket list">
                                                    <i class="fa fa-heart" style="color: whitesmoke" aria-hidden="true"></i>
                                                </a>
                                            @else
                                                <a class="bucket btn-small wsh  btn-floating tooltipped"
                                                   id="{{$ft->id}}"
                                                   data-id="{{$ft->id}}" data-name="{{Auth::user()->is_active}}"
                                                   data-value="{{$ft->id}}" data-position="bottom"
                                                   data-delay="10" data-tooltip="Add to Bucket list">
                                                    <i class="fa fa-heart" style="color: whitesmoke" aria-hidden="true"></i>
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                </li>
                                <li style="margin-right: -20px;">
                                   <span title="Compare" style="background: #008eb0;font-size: 16px;padding: 9px 8px 9px 8px;border-radius:2px;">
                                       <label for="{{$ft->id}}">
                                           <input type="checkbox" id="{{$ft->id}}" class="compareCheckbox" onchange="compareTo('{{$ft->id}}',this)"/>
                                           <span style="font-size: 12px;color:white;">Compare</span>
                                       </label>
                                   </span>
                                </li>
                                <li>
                                    <a href="/book-trip/{{$ft->id}}" class="waves-effect waves-light btn tooltipped"
                                       style="background:#008EB0;font-size: 12px;color:white;height:auto!important;padding:1px 8px"
                                       data-position="" data-delay="10" data-tooltip="Book Your Trip">
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
@endif
