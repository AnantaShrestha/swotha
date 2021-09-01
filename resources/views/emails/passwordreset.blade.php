<link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div class = "container" style = "color:#ccc">
<div style = "text-align:center;font-size:16px;font-color:black">Confirm Your hold to <strong>{{$trip->name}}</strong></div>
<hr style = "color:white">
<div style = "text-align:center">
<a href = "https://swotahtravel.com"><img src = "https://swotahtravel.com/public/img/logo_swotah.png"></a>
</div>
<div style = "font-size:18px;text-align:center;color:black">
Hello again, {{ucfirst($user->name)}}!
</div>
<strong>{{ucfirst($trip->name)}}</strong><br>
We’d like to remind you that you’ll be able to hold this trip only for 3 days.<br>
As it is a part of a Swotah tradition that we operate a trip of small group of people, not exceeding 7 unless it’s group of families and friends. We believe in ever long friendship with our clients and the best way to do that is by being with them throughout their journey as and when possible. Especially, during the peak season, to find the right departure date and the availability of seats, is a hard job. Therefore we encourage you to confirm the trip or at least book it well in advance to not to miss your perfect trip. <br>
Please visit the link below to confirm your hold.
<a href = "https://www.swotahtravel.com/holdconfirm/{{$hold->confirmation}}">
<button class="btn btn-primary">Confirm trip</button></a>

Thanks,
Swotah Travel and Adventure

</div>
