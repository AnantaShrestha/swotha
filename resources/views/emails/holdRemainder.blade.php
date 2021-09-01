@component('mail::message')

<div id="mailContent" style="color: black">
 <p> Hello, <br> <blockquote> <b>  {{ucfirst($user->name)}} </b></blockquote>  </p>
 <p style="font-size: 22px;font-family: 'Lato', sans-serif;line-height: 1.5;color: black">
  You have only {{(strtotime($holdDates->date) - strtotime(Carbon\Carbon::now()->format('Y-m-d')))/(60*60*24) }} days remaning before the Trip you have holded expires.
 </p>
  <br>
  @component('mail::panel')
<h1>Trip Details</h1>
Trip Name : {{$tripdate->trips->name}} <br>
Start Location : {{$tripdate->trips->start_location}} <br>
Finish Location : {{$tripdate->trips->finish_location}} <br>
Departure Date : {{$tripdate->start_date}}
  @endcomponent
 
</div>
 Thanks, {{ config('app.name') }}

@endcomponent
