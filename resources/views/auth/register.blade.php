<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | Swotah Travel  </title>
        
        <meta name="title" content="Register - Swotah Travel and Adventure">
        <meta name="description" content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
        <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">

    <link rel="shortcut icon" href="{{{ asset('images/favicon.ico') }}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <link rel="stylesheet" href="{{URL::TO('css/loginstyle.css')}}">
    {!! Recaptcha::renderJs() !!}
</head>
<body>
<div class="login-header">
    <h1></h1>
</div>
<div class="login">
    <div class="container z-depth 5" id="mala">
        <div class="row">
           <center>
               <a href="/">
                     <img href="/" src="{{url('logo2.png')}}" class="img-responsive" style="height: 60%;width: 60%;" alt="">
               </a>
           </center>
            <form class="col s12" method="post"  action="{{ route('register') }}">
                {{csrf_field()}}
                {!! Recaptcha::field('home', 'g-recaptcha-response', ['id' => 'recaptcha-id0', 'class' => 'form-element']) !!}
                <input type="hidden" name="is_active" value="0">
                <div class='row'>
                    <div class='col s12'>
                        <center><h5>Sign Up </h5></center>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field col s12'>
                        <i class="material-icons prefix">account_circle</i>
                        <input class='validate' type='text' name='name' id='username'  onselect="true"  />
                        <label for='username'>Enter your full name</label>
                    </div>
                    @if ($errors->has('name'))
                        <span class="help-block" style="color:red">
                        <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class='row'>
                    <div class='input-field col s12'>
                        <i class="material-icons prefix">email</i>
                        <input class='validate' type='email' name='email' id='email'/>
                        <label for='email' data-error="wrong" data-success="right">Enter your email</label>
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block" style="color:red">
                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class='row'>
                    <div class='input-field col s12'>
                        <i class="material-icons prefix">fingerprint</i>
                        <input class='validate' type='password'  minlength="6" maxlength="25" name='password' id='password' />
                        <label for='password'>Password (Min Length:6)</label>
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block" style="color:red">
                        <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class='row'>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">fingerprint</i>
                        <input id="password-confirm" type="password" class="validate" minlength="6" maxlength="25" name="password_confirmation">
                        <label for="password-confirm">Password Confirmation</label>
                    </div>
                </div>

                <center>
                    <div class='row'>
                        <button type='submit' name='btn_login' value="register"
                                class='col s12 btn-large waves-effect waves-light'>Submit
                        </button>

                    </div>
                </center>
            </form>
            <center>
                <a href="/login/facebook">
                    <button class="loginBtn loginBtn--facebook">
                        Login with Facebook
                    </button>
                </a>
            </center>
        </div>
        <center>
            Already have account? <a href="/login">Login here</a>
        </center>
    </div>
</div>
{{--<div id="footer" class="footer default" data-bind="css: { 'default': !backgroundLogoUrl() }">--}}
    {{--<div id="footerNode">©2017 Swotah Travel and Adventure</div>--}}
{{--</div>--}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
<script src={{url("js/index.js")}}></script>
</body>
</html>
