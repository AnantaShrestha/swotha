@component('mail::message')

<div id="mailContent" style="color: black">
<p> Hello, <br> <blockquote> <b>  {{ucfirst($user->name)}} </b></blockquote>  </p>
<p style="font-size: 22px;font-family: 'Lato', sans-serif;line-height: 1.5;color: black">
This is a confirmation mail sent to confirm your secondary email at <a href = "www.swotahtravel.com">Swotah Travel and Adventure site </a>
</p>
 <br>
<div>
 <a href="https://www.swotahtravel.com/secondaryverify/{{$user->secondary_token}}"  style="background: tomato;color: white;padding: 8px 10px;text-decoration: none;"> Click here to confirm your registration </a>
</div> <br>
  </div>

 Thanks, {{ config('app.name') }}

@endcomponent
