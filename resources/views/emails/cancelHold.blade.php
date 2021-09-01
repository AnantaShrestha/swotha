@component('mail::message')
<div id="mailContent" style="color: black">
<p> Hello, <br> <blockquote> <b>{{ucfirst($name)}} </b></blockquote></p>
<p style="font-size: 22px;font-family: 'Lato', sans-serif;line-height: 1.5;color: black">
@component('mail::panel')
{{ucfirst($message)}}
@endcomponent
</p>
<br>
</div>
@endcomponent
