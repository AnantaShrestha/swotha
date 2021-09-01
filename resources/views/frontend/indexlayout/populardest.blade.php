<div class="container-fluid">
    <div class="row">
        @foreach($featuredTrips as $trip)
            <div class="col s12 m6 l3">
                <a href="/trip/{{$trip->slug}}">
                    <div class="card hoverable">
                        <div class="card-content white-text">
                            <img src="{{url('https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179002/static_webp/default_img.webp')}}"
                                 data-src="{{url('/images/trips/thumbnail/'.$trip->cover_image)}}" alt="{{$trip->name}}"
                                 width="100%" class="lazyload">
                        </div>
                        <div class="card-action">
                            <div class="center-align tname">{{$trip->name}}</div>
                            <div class="right">
                                <a class="btn-floating sbutton tooltipped"
                                   data-position="bottom" data-delay="10" data-tooltip="Total views:{{count($trip->views)}}">
                                    <img src="{{url('/images/default_img.jpg')}}" data-src="{{url('images/eyes.png')}}" alt="views" class="lazyload">
                                </a>
                                <a href="/trip/{{$trip->slug}}#departures" class="btn-floating sbutton tooltipped"
                                   data-position="bottom" data-delay="10" data-tooltip="View Departure Dates">
                                    <i class="material-icons">date_range</i>
                                </a>
                                @if(!Auth::user())
                                    <a href="/wish/{{$trip->id}}" class="btn-floating sbutton tooltipped" data-position="bottom"
                                    data-delay="10" data-tooltip="Add to Bucket list">
                                        <i class="material-icons">favorite</i>
                                    </a>
                                @else
                                    @if(!Auth::user())
                                        <a class="btn-floating sbutton tooltipped"
                                           id="{{$trip->id}}" data-id="{{$trip->id}}" data-name="{{Auth::user()->is_active}}"
                                           data-value="{{$trip->id}}" data-position="bottom"
                                           data-delay="10" data-tooltip="Remove from Bucket list" ><i
                                                    class="material-icons">favorite</i></a>
                                    @else
                                        @if(!empty($trip->wish) && $trip->wish->user_id == Auth::user()->id)
                                            <a class="btn-small rmv sbutton red btn-floating tooltipped"
                                               id="{{$trip->id}}" data-id="{{$trip->id}}"
                                               data-name="{{Auth::user()->is_active}}" data-value="{{$trip->id}}"
                                               data-position="bottom"
                                               data-delay="10" data-tooltip="Remove from Bucket list"> <i
                                                        class="material-icons">favorite</i></a>
                                        @else
                                            <a class="btn-small wsh sbutton btn-floating tooltipped"
                                               id="{{$trip->id}}"
                                               data-id="{{$trip->id}}" data-name="{{Auth::user()->is_active}}"
                                               data-value="{{$trip->id}}" data-position="bottom"
                                               data-delay="10" data-tooltip="Add to Bucket list"><i class="material-icons">favorite</i>
                                            </a>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
        </div>
        @endforeach
    </div>
</div>