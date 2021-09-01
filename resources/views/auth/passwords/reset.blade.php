<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password | Swotah Travel</title>

    <meta name="title" content="Reset Password - Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">


    <link rel="stylesheet" type="text/css" href="{{asset('css/plugin/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
</head>
<body>
<div class="background-opacity">
    <div class="form-block">
        <div class="form-bg">
            <div class="logo" style="text-align:center;margin-bottom:30px">
                <a href="/">
                    <img style="width:200px" src="{{asset('logo2.png')}}">
                </a>
            </div>
            <div class="login-form">
                <h1 style="font-size:21px;text-align:center;color:#fff;">Reset Password</h1>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('password.request') }}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="input-wrapper">
                        <input class='validate form-input ' type='email' name='email' id='email' placeholder="Email"/>
                        @if ($errors->has('email'))
                            <span style="color:red;font-size:14px;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="input-wrapper">
                        <input class='validate form-input' type='password' name='password' id='password' minlength="6"
                               placeholder="New Password (Min Length : 6)"/>
                        @if ($errors->has('password'))
                            <span class="help-block" style="color:red">
                                <strong>{{ $errors->first('password') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div class="input-wrapper">
                        <input id="password-confirm" type="password" class="validate form-input"
                               name="password_confirmation" minlength="6" placeholder="Password Confirmation">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="input-wrapper">
                        <button type="submit" class="btn-login">Reset Password</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

</body>
<script src="{{asset('js/plugin/jquery-3.5.1.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script>
    let bodyheight = ($(window).height());
    $(window).on('load', function () {
        $('.background-opacity').css('height', bodyheight);
    });
</script>
<script type="text/javascript">
    @if(!empty(Session::get('status')))
    var popupId = "{{ uniqid() }}";
    if (!sessionStorage.getItem('shown-' + popupId)) {
        swal(
            'SUCCESS',
            '{{Session::get('status')}}',
            'success')
    }
    sessionStorage.setItem('shown-' + popupId, '1');
    @endif
    // location.href = '/login';
</script>
</html>



