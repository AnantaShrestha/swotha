<section class="departure-section">
    <div class="container">
        <div class="section-title-black">
            <h2>{{$parallaxes[3]->title}} </h2>
            <div class="title-bg">
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
            </div>
            @if(!isset($lastDeal) and empty($lastDeal))
                <p>No Any Last Minutes Deals!!</p>
            @else
                <p>{{$parallaxes[3]->description}}</p>
            @endif
        </div>
        <div class="departure-table overflow-departure">
            <table>
                <thead>
                <tr>
                    <th>Trip Name</th>
                    <th>Gallery</th>
                    <th>Seats Availability</th>
                    <th>Departure Date</th>
                    <th>Days</th>
                    <th>Price</th>
                    <th>Reserve</th>
                    <th>Book</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lastDeal as $key=>$deal)
                    <tr>
                        <td><a href="/{{$deal->trips->slug}}" style="color:#111"><strong>{{$deal->trips->name}}</strong></a>
                        </td>
                        <td><a href="/{{$deal->trips->slug}}"><img
                                        data-src="https://www.swotahtravel.com/images/trips/thumbnail/{{$deal->trips->cover_image}}"
                                        src="https://www.swotahtravel.com/images/trips/thumbnail/{{$deal->trips->cover_image}}"
                                        class="imgallery lazyload" alt="{{$deal->trips->name}}" style="height:50px"></a>
                        </td>
                        <td><span class="waves-effect waves-light tableBtn lastmintooltipBtn 	tooltipped"
                                  style="color:#fff;padding:4px 10px;font-size:13px;border-radius:15px;
                                          background-color: @if($deal->remainingseats >= 10) #20a56e @elseif($deal->remainingseats >= 5)
                                          #d5d50b @else red @endif" data-in="
													@if($deal->remainingseats >= 10)
                                    There are good number of seats available. Be one of the first ones to book the trip for this date!
@elseif($deal->remainingseats >= 5)
                                    Only limited seats are available for this departure date. Please make sure to book or Reserve as soon as possible!
@else
                                    The number of seats for this trip is almost full or may not be available. Please leave an enquiry for more details!
@endif"> Available
												</span></td>
                        <td>{{$deal->start_date}}</td>
                        <td>{{$deal->trips->days}} days</td>
                        <td><span class="oldPrice">
													$<span><strike
                                            class="originalPrice">{{$deal->trips->price}}</strike></span>
													<span class="oldConverted" style="color:green;"></span>
												</span>
                            <span style="color:#D8343D;font-weight: 600;" class="newPrice">
								$<span class="price">
														@if($deal->trips->special_discount != 0) {{-- chnaged--}}
                                    <?php
                                    $total = ($deal->price - (($deal->discount) / 100 * $deal->price));
                                    $total1 = round($total - (($deal->trips->special_discount) / 100 * $total));
                                    echo $total1;
                                    ?>
                                    @else
                                        {{round($deal->trips->price - (($deal->discount/100)*$deal->trips->price))}}
                                    @endif
													</span>
								<span class="newConverted" style="color:green; font-size:16px;"></span>
							</span>
                        </td>
                        <td>
                            <?php  $holdStatus = false;  ?>
                            @if(strtotime($deal->start_date) > strtotime('-1 month ago'))
                                <?php
                                $holdStatus = false;
                                if ($holdStatus) {
                                    $singleTotal = 0;
                                    $allTotal = 0;
                                    $temp = 0;
                                    foreach ($seats as $seat) {
                                        if ($deal->id == $seat->trip_id) {
                                            if (strtotime($seat->trips->start_date) == strtotime($deal->start_date)) {
                                                $singleTotal += $seat->seats;
                                            }
                                        }
                                        $allTotal += $seat->seats;
                                    }
                                }
                                ?>
                                @if($deal->remainingseats > 0)
                                    @if((Auth::user()))
                                        <a class="reserve-last"
                                           style="background:#356bb2;color:#fff;padding:4px 10px;font-size:13px;border-radius:15px;cursor:pointer"
                                           data-in="Please note that if seats are available,
                                            you can Reserve up to 7 seats of any particular trip,
                                             and 14 seats in total, at a given period of time."
                                           onclick="reserveModal({{$deal->id}})">Reserve</a>
                                    @else
                                        <a class="reserve-last"
                                           style="background:#356bb2;color:#fff;padding:4px 10px;font-size:13px;border-radius:15px"
                                           href="/login" title="Login to Reserve">
                                            Reserve
                                        </a>
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>@if($deal->remainingseats)
                                <a href="/book/{{$deal->id}}" class="booking-btn">Book</a>
                            @else
                                <a href="#enq-btn" id="enquire" data-id="{{$deal->trips->id}}"
                                   class="tableBtn waves-effect waves-light  hbb">Enquire</a>
                            @endif
                        </td>
                        <div id="holdModal{{$deal->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" style="width:400px">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Reserve</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="/hold/{{$deal->id}}" method="post" id="form{{$deal->id}}">
                                        <div class="modal-body">
                                            <p style="font-size:12px;color:#111;margin-bottom:10px;line-height:25px;">
                                                Please note that
                                                if seats are available, you can Reserve up to 7 seats of any particular
                                                trip, and 14
                                                seats in total, at a given period of time.
                                            </p>
                                            {{csrf_field()}}
                                            <input type="hidden" name='deal_id' value="{{$deal->id}}">
                                            <div class="form-group">
                                                <select name="seats" id="seats1{{$deal->id}}" class="form-control">
                                                    <option selected disabled="disabled">Select No. Of Seats to Reserve
                                                    </option>
                                                    <?php
                                                    if ($deal->remainingseats > 7) {
                                                        $seats = 7;
                                                    } else {
                                                        $seats = $deal->remainingseats;
                                                    }
                                                    ?>
                                                    @for($i=1; $i<=7; $i++)
                                                        <option value="{{$i}}"
                                                        @if($holdStatus && (((($singleTotal+$i) > 7))|| ((($allTotal+$i)) > 14) || ($i > $deal->remainingseats)))
                                                            {{'disabled'}}
                                                                @endif>
                                                            {{$i}}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit"
                                                    class="reserve-submit-btn" name="submit"
                                                    @if($holdStatus && (($allTotal+1) > 14 || ($singleTotal+1) > 7)))
                                                    {{'disabled'}}
                                                    @endif>Continue
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>