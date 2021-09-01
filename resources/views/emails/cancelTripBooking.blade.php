@component('mail::message')

<div id="mailContent" style="color: black">
<p> Hello, <br> <blockquote> <b>{{ucfirst($user->name)}} </b></blockquote></p>
<p style="font-family: 'Lato', sans-serif;line-height: 1.5;color: black">
 Sorry your booking of the trip {{$trip->name}} has been canceled because of inadequate information in the sent documents.
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
@endcomponent

