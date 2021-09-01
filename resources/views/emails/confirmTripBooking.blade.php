@component('mail::message')

<div id="mailContent" style="color: black">
<p> Hello, <br> <blockquote> <b>{{ucfirst($user->name)}} </b></blockquote></p>
<p style="font-size: 22px;font-family: 'Lato', sans-serif;line-height: 1.5;color: black">
 Congratulations your booking of the trip {{$trip->name}} has been Confirmed.
</p>
 <br>
@component('mail::panel')
<h1>Trip Details</h1>
Trip Name : {{$trip->name}} <br>
Start Location : {{$trip->start_location}} <br>
Finish Location : {{$trip->finish_location}} <br>
Departure Date : {{$booking->start_date}}
@endcomponent
</div>

Do you want to find other fellow travelers to join your trip? If yes, please click here
<br>
<a class="btn btn-primary" href = "https://www.swotahtravel.com/profile/{{$user->name}}">
 Post to Trekking Partner
</a>
<br>
<br>

Thanks, {{ config('app.name') }}

@endcomponent
