@component('mail::message')
<div>
<h2 style="font-size: 22px;"> Confirm Your hold to <strong>{{$trip->trips->name}}</strong> </h2> <hr>
 <div>
<div id="mailContent" style="color: black">
<p> Hello again, <br> <blockquote> <b>{{ucfirst($user->name)}} </b></blockquote></p>
<p style="font-size: 22px;font-family: 'Lato', sans-serif;line-height: 1.5;color: black">
We’d like to remind you that you’ll be able to hold this trip only for 3 days.<br>
 As per our policy, we try to operate small group of people not exceeding 7 unless it is
 a group of families or friends. During the peak season, it may be hard to find the right
 departure dates and the availability of seats. Therefore, we encourage you to
 confirm this trip and book as soon as possible. 
<br>
 Please visit the link below to confirm.
</p>
 <br>
<div>
 <a href="https://www.swotahtravel.com/holdconfirm/{{$hold->confirmation}}" style="background: tomato;color:
  white;padding: 8px 10px;text-decoration: none;"> Confirm</a>
</div> 
<br>
</div>
 </div>
</div>
Thanks, {{ config('app.name') }}
@endcomponent
