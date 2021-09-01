@component('mail::message')

<div id="mailContent" style="color: black">
<p> Hello, <br> <blockquote> <b>{{ucfirst($user->name)}} </b></blockquote></p>
<p style="font-family: 'Lato', sans-serif;line-height: 1.5;color: black">
Congratulations your booking of the trip {{$tripdate->trips->name}} has been Confirmed. And please bring the copy of final confirmation invoice along with you.
</p>
<br>
 @component('mail::panel')
<h1>Trip Details</h1>
Trip Name : {{$tripdate->trips->name}} <br>
Start Location : {{$tripdate->trips->start_location}} <br>
Finish Location : {{$tripdate->trips->finish_location}} <br>
Departure Date : {{$tripdate->start_date}}
<br>
<br>
Do you want to find other fellow travelers to join your trip? If yes, please click here
<br>
  <a class="btn btn-primary" href = "https://www.swotahtravel.com/profile/{{$user->name}}">Post to Trekking Partner
  </a>
<br>
<div>
{{--<a href="https://www.swotahtravel.com/holdconfirm/{{$hold->confirmation}}" style="background: tomato;color:--}}
{{--white;padding: 8px 10px;text-decoration: none;"> Confirm</a>--}}
</div>
@endcomponent
</div>
Thanks, {{ config('app.name') }}

@endcomponent
