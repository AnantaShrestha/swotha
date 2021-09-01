@component('mail::message')

<div id="mailContent" style="color: black">
<p> Hello, <br> <blockquote> <b>  {{ucfirst($user->name)}} </b></blockquote>  </p>
<p style="font-size: 22px;font-family: 'Lato', sans-serif;line-height: 1.5;color: black">
 We would like to thank you very much for your curiosity and showing interest in Nepal & Swotah Travel and Adventure.<br>
 Please <a href="https://www.swotahtravel.com/brochure" style="color: teal;border: 1px solid teal;">click here</a> to download our brochure. <br> We appreciate your interest in traveling with us and look forward to organizing your trip.
</p>
 <br>
  </div>

 Thanks, {{ config('app.name') }}

@endcomponent
