<!DOCTYPE html>
<html>
<head>
    <title>Swotah Travel and Adventure
    </title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/plugin/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">

</head>
<style type="text/css">
    .form-bg {
        margin-top: 150px;
    }
</style>
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
                {{-- @if (session('status'))
                     <div class="alert alert-success">
                         {{ session('status') }}
                     </div>
                 @endif--}}
                <form action="{{ route('password.email') }}" method="post">
                    {{csrf_field()}}
                    <div class="input-wrapper">
                        <input class='validate form-input ' type='email' name='email' id='email'
                               placeholder="Enter your Email"/>
                        @if ($errors->has('email'))
                            <span style="color:red;font-size:14px;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="input-wrapper">
                        <button type="submit" class="btn-login">Reset Your Password</button>
                    </div>
                    <div class="input-wrapper">
                        <p style="font-size:13px;color:#fff;text-align:center">Remember your password <a
                                    style="color:#fc0" href="{{route('login')}}">Login Here</a></p>
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
</script>
</html>

    




