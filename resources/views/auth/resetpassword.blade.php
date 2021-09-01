<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Reset password | Swotah Travel </title>

    <meta name="title" content="Reset password - Swotah Travel and Adventure">
    <meta name="description" content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">

    <link rel="stylesheet" href="{{URL::TO('css/loginstyle.min.css')}}">
</head>
<body>
<div class="login-header">
    <h1></h1>
</div>
<div class="login z-depth 5" id="mala">
    <div class="login-header">
        <a href="/">
        <img src="{{url('logo2.png')}}" style="height: 60%;width: 60%">
        </a>
        <h5>Forgot Password ?</h5>
    </div>
    <form class="login-form" role="form" method="POST" action="/forgot/rest">
        {{ csrf_field() }}
        <input type="hidden" name = "user_id" value="{{$user->id}}">
        <h3>Email:</h3>
        <input type="password" name = "password" placeholder="Please type your new password" required/><br>
        <br>

        <input type="submit" value="Reset password" class="login-button"/>
    </form>
</div>
<div id="footer" class="footer default" data-bind="css: { 'default': !backgroundLogoUrl() }">
    <div id="footerNode">©2017 Swotah Travel and Adventure</div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.min.js"></script>
</body>
</html>