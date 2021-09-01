@component('mail::message')
    Hello,
    {{ucfirst($user->name)}}
    <br>
    This is a confirmation mail sent to confirm your registration at <a href = "www.swotahtravel.com">Swotah Travel and Adventure site</a>
    <br>
    <div>
        <a href="https://www.swotahtravel.com/confirmuser/{{$user->code}}">
          <button class="btn btn-primary">Click here to confirm your registration</button></a>

    </div>
    Thanks,
    {{ config('app.name') }}
@endcomponent
