<!DOCTYPE html>
<html lang="">
<head>
  <title>Login</title>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="{{asset('css/plugin/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
    {!! Recaptcha::renderJs() !!}
</head>
<style type="text/css">

 @media screen and (max-width: 480px)
 {
    .btn-or::before {
       width: 155px;
 
    }
    .btn-or::after {
       width: 155px;
 
    }
 }

</style>
<body>
  
    <div class="background-opacity">
        <div class="form-block">
           <div class="form-bg">
               <a href="/"><div class="logo" style="text-align:center;margin-bottom:30px">
                    <img style="width:200px" src="{{asset('logo2.png')}}">
                </div>
               </a>
                <div class="login-form">
                      <form action="{{ route('login') }}" method="post" >
                      {{csrf_field()}}
                        <div class="input-wrapper">
                            <input type="email" id="email1" class="form-input validate" placeholder="Enter your Email" name="email">
                            @if ($errors->has('email'))
                                <span class="validation-error">
                                {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        <div class="input-wrapper">
                            <input type="password" id="password1" class="form-input validate" placeholder="Enter your Password" minlength="6" maxlength="25" name="password">
                            @if ($errors->has('password'))
                              <span class="validation-error">
                                  {{ $errors->first('password') }}
                              </span>
                            @endif
                        </div>
                        <div class="input-wrapper flex-box">
                            <input class="filled-in" type="checkbox" id="remember" name="remember_token"/>
                            <label class="label flex" for="remember">Remember Me</label>
                            <a href="/password/reset" class="forgot-pass">Forgot Password ?</a>
                        </div>
                        <div class="input-wrapper">
                            <button type="submit" class="btn-login">Login</button>
                        </div>
                     
                    </form>
                     <div class="input-wrapper">
                            <button type="button" class="btn-register">Sign Up</button>
                      </div>
                      <div class="input-wrapper" style="text-align:center">
                          <button class="btn-or">OR</button>
                      </div>
                       <div class="input-wrapper">
                           <a href="/login/facebook">

                              <button class="btn-facebook"><i class="fab fa-facebook-f"></i>&nbsp;&nbsp;<span>Continue with facebook</span></button>
                          </a>
                      </div>
                 
                </div>
                <div  class="register-form">
                    <form action="{{ route('register') }}" method="post" >
                      <input type="hidden" name="is_active" value="0">
                      {{csrf_field()}}
                        {!! Recaptcha::field('home', 'g-recaptcha-response', ['id' => 'recaptcha-id0', 'class' => 'form-element']) !!}
                        <div class="input-wrapper">
                              <input type="text" id="name" class="form-input validate" placeholder="Enter your Full Name" name="name" required>
                             
                        </div>
                        <div class="input-wrapper">
                              <input type="email" id="email" class="form-input validate" placeholder="Enter your Email" name="email" required>
                             
                        </div>
                        <div class="input-wrapper">
                              <input type="password"  class="form-input validate" placeholder="Enter your Password (Min Length:6)" name="password"  minlength="6" maxlength="25" id='password1' required>
                             
                        </div>
                         <div class="input-wrapper">
                              <input class='validate' id="password-confirm" type="password"  minlength="6" maxlength="25" name="password_confirmation" required placeholder="Passsword Confirmation"/>
                             
                        </div>
                        <div class="input-wrapper">
                            <button type="submit" class="btn-login">Register</button>
                        </div>
                    </form>
                     <div class="input-wrapper">
                            <button type="button" class="btn-register">Login</button>
                      </div>
                </div>
           </div>
        </div>
  
    </div>
</body>
<script src="{{asset('js/plugin/jquery-3.5.1.min.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function(){
    let bodyheight=($(window).height());
    $('.background-opacity').css('height',bodyheight);
      $('.btn-register').on('click', function() {
        $('.login-form').fadeToggle("slow");
        $('.register-form').fadeToggle("slow");
      });
  {{--@if(!empty(Session::get('message')))
    swal(
        'Success',
        '{{Session::get('message')}}',
        'success'
      )
  @endif--}}
  });
</script>
</html>
