@component('mail::message')

<div id="mailContent" style="color: black">
<p> Hello, <br> <blockquote> <b>  {{ucfirst($user->name)}} </b></blockquote>  </p>
<p style="font-size: 22px;font-family: 'Lato', sans-serif;line-height: 1.5;color: black">
 It seems like you've had trouble signing up. So, we thought it would be nice to help you verifying your email. Please enjoy all of our exclusive features!
</p>
<br>
           
</div>

Thanks, {{ config('app.name') }}


@endcomponent

