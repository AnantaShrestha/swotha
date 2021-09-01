@component('mail::message')
    @if(!empty($name->name))
        Hello {{ucfirst($name->name)}}, <br>
    @else
        Hello {{ucfirst($name)}}, <br>
    @endif
Congratulations!!<br>
You’ve received {{count($code)}} promo code{{(count($code)>1)?'\'s':''}} for your next booking with Swotah.<br>
@for($i=0; $i<count($code); $i++)
<button style="background-color: #9adad6; color:black; border: 1px solid black; border-radius: 2px;">{{$code[$i]}}</button><br>
@endfor
<div style="max-width: 450px; text-align: justify;">
{{(count($code)>1)?'These':'This'}} promo code offers you the discount of $ {{$amount}} each.<br>
The code will be valid untill {{$date}}.
<br>
<strong>Note: </strong><br>
<ul style="margin-left: 0px; padding-left: 0px;">
    <li style="margin-left: 0px;">
        The promo code could be shared with friends or acquaintances but please note that it could be used only once.
    </li>
    <li style="margin-left: 0px; padding-left: 0px;">
        Promo code discount is subject to change according to your next booking.
        The promo ccode discounts may vary according to the price of next trip you book compared to your previous booking.
        For full use of promo code discount, please make sure the next trip you book is priced equal or higher than that of previous trip.
        (If price of second trip you are booking is higher than the price of first trip, then promo code could be fully utilized.
        If price of second trip is lower than the first trip, then the promo code discount will be based on price of the second
        trip and it will be calculated on percentage basis of new trip price.)
    </li>
</ul>
</div>
@endcomponent
