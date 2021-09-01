@if(!Auth::user())
    <a href="/wish/{{$trip->id}}"
       data-position="bottom" data-delay="10"
       data-title="Please Login to add your trip to Bucket List">
        <i class="fa fa-heart"></i>
    </a>
@else
    @if(!Auth::user())
        <a class="red"
           id="{{$trip->id}}" data-id="{{$trip->id}}"
           data-name="{{Auth::user()->is_active}}"
           data-value="{{$trip->id}}" data-position="bottom" data-delay="10"
           data-title="Remove from Bucket list"><i class="fa fa-heart"></i>
        </a>
    @else
        @if(!empty($trip->wish) && $trip->wish->user_id == Auth::user()->id)
            <a class="red"
               id="{{$trip->id}}" data-id="{{$trip->id}}"
               data-name="{{Auth::user()->is_active}}"
               data-value="{{$trip->id}}" data-position="bottom"
               data-delay="10" data-title="Remove from Bucket list"><i class="fa fa-heart"></i></a>
        @else
            <a href="javascript:;" class="wsh"
               id="{{$trip->id}}"
               data-id="{{$trip->id}}"
               data-name="{{Auth::user()->is_active}}"
               data-value="{{$trip->id}}" data-position="bottom"
               data-delay="10" data-title="Add to Bucket list"><i class="fa fa-heart"></i>
            </a>
        @endif
    @endif
@endif