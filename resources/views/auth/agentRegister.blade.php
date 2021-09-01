<!DOCTYPE html>
<html>
<head>
    <title>Agent Register | Swotah Travel</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="{{asset('css/plugin/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
    <style type="text/css">
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
        }

        input[type=number] {
            -moz-appearance: textfield; /* Firefox */
        }

        input[type="file"].agencydocument {
            display: none;
        }

        .custom-file-upload {
            background: #fc0;
            display: inline-block;
            padding: 5px 7px;
            cursor: pointer;
            color: #111;
            margin-left: 5px;
            margin-top: 7px;
        }

        .input-wrapper p {

            display: block;

        }
    </style>
</head>
<body>

<div class="background-opacity">
    <div class="form-block">
        <div class="form-bg" style="width:750px">
            <div class="logo" style="text-align:center;margin-bottom:30px">
                <a href="/">
                    <img style="width:200px" src="{{asset('logo2.png')}}">
                </a>
            </div>
            <div class="login-form">
                <form action="{{url('/agent/register')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <h1 class="log-header">Agency</h1>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='text' name='companyname' id='companyName' onselect="true"
                                       placeholder="Legal Company Name*" value="{{old('companyname')}}"/>
                                @if ($errors->has('companyname'))
                                    <span class="validation-error">
                                  {{ $errors->first('companyname') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='number' name='registration_number' id='regNumber'
                                       onselect="true"
                                       placeholder="Business Registration No*" value="{{old('registration_number')}}"/>
                                @if ($errors->has('registration_number'))
                                    <span class="validation-error">
                                  {{$errors->first('registration_number')}}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <h1 class="log-header">Agency Address</h1>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='text' name='agencyaddress' id='agencyAddress'
                                       onselect="true"
                                       placeholder="Address*" value="{{old('agencyaddress')}}"/>
                                @if ($errors->has('agencyaddress'))
                                    <span class="validation-error">
                              {{ $errors->first('agencyaddress') }}
                              </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <select name="country">
                                    <option value="" disabled selected>Your Country*</option>
                                    @foreach($countries as $index=>$country)
                                        <option {{ old('country') == $country['name'] ? "selected" : "" }} value="{{$country['name']}}">{{ucfirst($country['name'])}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country'))
                                    <span class="validation-error">
                                      {{$errors->first('country')}}
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='text' name='astate' id='aState' onselect="true"
                                       placeholder="State" value="{{old('astate')}}"/>
                                @if ($errors->has('astate'))
                                    <span class="validation-error">
                                    {{ $errors->first('astate') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='text' name='acity' id='aCity' onselect="true"
                                       placeholder="City*" value="{{old('aCity')}}"/>
                                @if ($errors->has('acity'))
                                    <span class="validation-error">
                                {{ $errors->first('acity') }}
                                </span>
                                @endif

                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='number' name='apostalcode' id='aPostalCode'
                                       onselect="true"
                                       placeholder="Postal Code*" value="{{old('aPostalCode')}}"/>
                                @if ($errors->has('apostalcode'))
                                    <span class="validation-error">
                                  {{ $errors->first('apostalcode') }}
                                  </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <h1 class="log-header">Agency Contact Details</h1>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='email'
                                       name='agencyemail' id='agencyEmail'
                                       onselect="true" placeholder="Agency Email*" value="{{old('agencyEmail')}}"/>
                                @if ($errors->has('agencyemail'))
                                    <span class="validation-error">
                                  {{ $errors->first('agencyemail') }}
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='number'
                                       name='agencypublicphone'
                                       id='agencyPublicPhone'
                                       onselect="true" placeholder="Phone Number*"
                                       value="{{old('agencypublicphone')}}"/>
                                @if ($errors->has('agencypublicphone'))
                                    <span class="validation-error">
                                {{ $errors->first('agencypublicphone') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='number'
                                       name='aphonenumber' id='aPhoneNumber'
                                       placeholder="Private Supplier Phone*" onselect="true"
                                       value="{{old('aphonenumber')}}"/>
                                @if ($errors->has('anhonenumber'))
                                    <span class="validation-error">
                                  {{ $errors->first('aphonenumber') }}
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='number'
                                       name='afax' id='aFax' onselect="true" placeholder="Fax" value="{{old('afax')}}"/>
                                @if ($errors->has('afax'))
                                    <span class="validation-error">
                                  {{ $errors->first('afax') }}
                                  </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <h1 class="log-header">Agency Manager</h1>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='text'
                                       name='amfirstname' id='aMFirstName'
                                       onselect="true" placeholder="First Name*" value="{{old('amfirstname')}}"/>
                                @if ($errors->has('amfirstname'))
                                    <span class="validation-error">
                                {{ $errors->first('amfirstname') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='text'
                                       name='middle_name' id='aMMiddleName'
                                       onselect="true" placeholder="Middle Name(Optional)"
                                       value="{{old('middle_name')}}"/>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='text'
                                       name='amlastname' id='aMLastName'
                                       onselect="true" placeholder="Last Name*" value="{{old('amlastname')}}"/>
                                @if ($errors->has('amlastname'))
                                    <span class="validation-error">
                                {{ $errors->first('amlastname') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='email'
                                       name='amemail' id='aMEmail'
                                       onselect="true" placeholder="Agent Manager Email*" value="{{old('amemail')}}"/>
                                @if ($errors->has('amemail'))
                                    <span class="validation-error">
                                  {{ $errors->first('amemail') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='password'
                                       name='ampassword' id='aMPassword'
                                       onselect="true" placeholder="Password*" value="{{old('ampassword')}}"/>
                                @if ($errors->has('ampassword'))
                                    <span class="validation-error">
                                {{ $errors->first('ampassword') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="input-wrapper">
                                <input class='validate' type='password'
                                       name='amconfirmPassword'
                                       id='aMConfirmPassword'
                                       onselect="true" placeholder="Confirm Password*"
                                       value="{{old('amconfirmPassword')}}"/>
                                @if ($errors->has('amconfirmPassword'))
                                    <span class="validation-error">
                              {{ $errors->first('amconfirmPassword') }}
                              </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <p class="company-note">Note: Company Registration Document is for verification. </p>
                            <div class="input-wrapper">
                                <p><label class="custom-file-upload">
                                        <input type="file" name="document"
                                               value="{{old('document')}}" class="agencydocument">
                                        Upload Document

                                    </label>
                                </p>
                                @if ($errors->has('document'))
                                    <span class="validation-error">
                              {{ $errors->first('document') }}
                              </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="input-wrapper">
                        <button type="submit" class="btn-login">Submit</button>
                    </div>
                </form>
                <div class='already'>
                    Already have account? <a href="{{route('login')}}">LOGIN</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{asset('js/plugin/jquery-3.5.1.min.js')}}"></script>
<script type="text/javascript">
    let bodyheight = ($('.form-block').height());
    $(window).on('load', function () {
        $('.background-opacity').css('height', bodyheight + 300 + 'px');
    });
    @if(!empty(Session::get('message')))
    swal(
        'Success',
        '{{Session::get('message')}}',
        'success'
    )
    @endif
</script>
</html>
