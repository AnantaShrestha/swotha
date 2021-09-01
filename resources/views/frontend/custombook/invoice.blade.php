@extends('layouts.master')
@section('title')
    <title>Swotah Travel and Adventure | Book Trip </title>
@endsection
@section('metatags')
    <meta name="description" content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
{{--End of meta tags--}}
{{--External css--}}
@section('styles')
    <link rel="stylesheet" href="{{url('css/frontend/booking.min.css')}}">
    <style>
        .tabs .indicator{
            height:3px;
            max-width: 460px !important;
            background-color:#008EB0;
            /*left: 457px !important;*/
            margin-left: 2px!important;
            margin-right: 1px!important;
        }

        li>a:active{
            color: white;
            background-color: #EF7B7F;
        }

        .card{
            padding: 15px 15px 3px;
        }

        @media only screen and (max-width: 717px){
            #confirmTrip td .btn{
                line-height: 13px;
                padding: 0px 1rem;
            }
        }

        @media only screen and (max-width:461px ){
            .card {
                padding: 2px 2px 3px;
            }
            .card .card-tabs a.pay, .card .card-tabs a.pay:active{
                font-size: 10px !important;
            }
            table thead tr{
                padding:0 0 0 0;
            }

            table thead tr th,table tbody tr td{
                padding: 10px 0px;
                font-size:12px;
            }

            #confirmTrip td .btn{
                height: 21px;
                line-height: 23px;
                padding: 0px 1rem;
            }
        }
        .card-content{
            padding: 20px 0px  0px!important;
        }
        .card-action{
            padding:0px !important;
        }
        a.pay.active{
            color: white!important;
            font-size: 20px!important;
            background-color:#008EB0!important;
        }
    </style>
@endsection
@section('content')
    {{--Navbar--}}
    @include('layouts.navbar2')
    <br>
    <div class="booking clear">
            <div class="container" style="text-align:center;background-color:#e1e9f0;margin-top:1px;">
                <h1 class="s-fon">Booking Process(Step 4 of 4)</h1>
            </div>
        <br>
        <div class="clear"></div>
        <div class="container"  style="color: black;">
            <div style="text-align:center;background-color:#e1e9f0;margin-top:-68px;">
                <h1 class="s-fon">Invoice</h1>
            </div>
            <br>
            <div class="row">
                <div class="card darken-1">
                    <div class="card-content">
	                    <?php $total = 0;?>
	                    <?php use App\Coupons;use Illuminate\Support\Facades\Session;
	                    $total = 0;
	                    $input1 = Session::get('custom.value');
	                    $input2 = Session::get('custom1.value');
	                    $customprice = $input1['alltotal'];
	                    $equipments = Session::get('custom3.value');
	                    $people = $input1['people'];
	                    $start_date = $input1['startdate'];
	                    $bid = $input1['bookid'];

	                    if(!empty($couponused1)){
		                    if($couponused1 == 1){
			                    $couponid = Session::get('users.ctripcoupons1'.Auth::user()->id);
			                    if(!empty($couponid)){
				                    $allcoupons = Coupons::findOrFail($couponid);
				                    $adddiscount = [];
				                    foreach ($allcoupons as $a) {
					                    if($a){
						                    $coudiscount = $a->discountamount;
						                    array_push($adddiscount, $coudiscount);
					                    }
				                    }
				                    $alldiscount =array_sum($adddiscount);

			                    }
		                    }
	                    }
	                    ?>
                        <div class="details">
                            <div class="row">
                                <div class="col l6 m12 s12" style="margin-left: 8%; width: 42%;">
                                    <h5>
                                        <span class="card-title center-align" style="font-size: 22px;">Swotah Travel and Adventure Pvt. Ltd.</span>
                                    </h5>
                                    <div class="name center-align hb"><u style="font-size: 20px;font-weight: bold;"><b>{{$name}}</b></u></div>
                                    <table class="table bordered centered " border ="2px solid" style="border: 1px solid red;">
                                        <tbody>
                                        <tr style = "color:black">
                                            <td><b>Invoice No. :</b></td>
                                            <td><b>{{$bid}}</b></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><b>Booking Date :</b></td>
                                            <td><b>{{date('M d, Y')}}</b></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><b>Trip Departure Date :</b></td>
                                            <td><b>{{date('M d, Y',strtotime($start_date))}}</b></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col l6 m12 s12">
                                    <div class="center-align">
                                        <img src="{{url('images/trips/thumbnail/'.$trip->cover_image)}}" alt="{{$trip->name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
							<?php $start_date0 = strtotime($start_date); ?>
                            @if($start_date0 > strtotime('- 90 day ago'))
                                <p class="center-align"
                                   style="background-color: #d9edf7;color:#3a87ad;padding:13px;font-size:15px;margin-top:10px;" >
                                    <span style="color: teal;">*</span>
                                    ( To get <strong>Early Bird Discount</strong>
                                    please make sure
                                    to deposit full amount
                                    while booking the trip.)
                                </p>
                            @endif
                            <div class="center-align">
                                <a class="btn modal-trigger" href="#coupon1">If you have Coupon, Please use it !</a>
                            </div>

                            <div class="card" style="box-shadow: none; border: 1px solid;">
                                <div class="card-tabs" style="border: 2px solid seagreen">
                                    <ul class="tabs tabs-fixed-width">
                                        <li class="tab">
                                            <a href="#confirmTrip" class="pay active" id="tab1" style="color: #0b0b0b">
                                                <strong>Confirm this trip</strong>
                                            </a>
                                        </li>
                                        <li class="tab">
                                            <a class="pay" href="#fullPay"  id="tab2" style="color: #0b0b0b;">
                                                <strong>Pay in full</strong>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-content">
                                    <div id="confirmTrip">
                                        <table class="bordered responsive-table centered">
                                            <thead style="background-color: lightgrey;">
                                            <tr>
                                                <th>Description</th>
                                                <th>Unit Price</th>
                                                <th>Number of people</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><b>{{$trip->name}}</b><span style="display: block">Trip Price</span></td>
                                                <td>$ {{$trip->price}}</td>
                                                <td>{{$people}}</td>
                                                <td>$ {{$customprice}} (customized)</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Discounts</b>
                                                    <div>
                                                        @if($trip->special_discount != 0 && $trip->special_discount != null)
                                                            Special Trip Discount({{$trip->special_discount}}%),
						                                    <?php $std = $trip->special_discount; ?>
                                                        @else
						                                    <?php $std = 0; ?>
                                                        @endif

                                                        @if($groupdiscount != 0)
                                                            @if($people > 1)
                                                                Group Discount({{$groupdiscount}}%),
							                                    <?php $gd = $groupdiscount; ?>
                                                            @endif
                                                        @else
						                                    <?php $gd = 0; ?>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
				                                    <?php
				                                    $edis = round(($std/100) * $customprice);
				                                    $lowerprice = $customprice - $edis;
				                                    $sdis = round(($gd/100) * $lowerprice);

				                                    $totaldiscount = round(($edis + $sdis));
				                                    $totaldis = round(($edis + $sdis)/$people);

				                                    echo '$ '.$totaldis;
				                                    ?>
                                                </td>
                                                <td>{{$people}}</td>
                                                <td>$ {{$totaldiscount}}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
				                                    <?php
				                                    $grandamount = $customprice - $totaldiscount;
				                                    if(!empty($alldiscount)){
					                                    $grandamount = $grandamount - $alldiscount;
				                                    }
				                                    echo  'USD $ '.$grandamount;
				                                    ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
										<?php $etotal = 0; ?>
                                        @if($extra != 0)
                                            <h5 style="text-align: center;">Extra Services</h5>
                                            <table class="bordered responsive-table centered">
                                                <thead style="background-color: lightgrey;">
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Price(perday)</th>
                                                    <th>Quantity</th>
                                                    <th>Days</th>
                                                    <th>Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($equipments as $e)
                                                        <tr style = "color:black">
                                                            <td>{{$e['equipment_name']}}</td>
                                                            <td>USD ${{$e['equipment_price']}}</td>
                                                            <td>{{$e['equipment_quantity']}}</td>
                                                            <td>{{$trip->trekdays}}</td>
															<?php $etotal += ($e['equipment_price'] *
																$e['equipment_quantity'] * ((int) $trip->trekdays));
															?>
                                                            <td> USD $ {{($e['equipment_price'] *
                                                $e['equipment_quantity'] * ((int) $trip->trekdays))}}</td>
                                                        </tr>
                                                @endforeach
                                                <tr style = "color:black">
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td style="color:black">Total: USD ${{$etotal}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @endif
	                                    <?php $pactotal = 0 ;  ?>
                                        @if(!empty($packages))
                                            <h5 style="text-align: center;">Optional Activities</h5>
                                            <table class="bordered responsive-table centered">
                                                <thead style="background-color: lightgrey;">
                                                <tr>
                                                    <th>Name</th>
                                                    <th></th>
                                                    <th>Price</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($packages as $pac)
                                                    <tr>
                                                        <td>{{$pac->title}}</td>
                                                        <td><img src="{{url('images/trips/extraPackages/'.$pac->image)}}" style="height: 62px;"></td>
					                                    <?php
					                                    $pactotal += $pac->price;
					                                    ?>
                                                        <td>USD ${{$pac->price}}</td>
                                                    </tr>
                                                @endforeach
                                                <tr style = "color:black">
                                                    <td></td>
                                                    <td></td>
                                                    <td style="color:black">Total: USD ${{$pactotal}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                        <table class="striped centered ">
                                            <tbody>
                                            <tr style ="color:black">
                                                <td><strong>Grand Total</strong> </td>
                                                <td>
                                                    @if(!empty($alldiscount))
                                                        <div class="chip">
                                                            Coupon Discount: $ <?php echo $alldiscount ?>
                                                            <i class="close material-icons">close</i>
                                                        </div>
                                                    @endif
                                                </td>
												<?php $grandtotal = $grandamount + $etotal + $pactotal;?>
                                                <td><b>USD $ {{$grandtotal}}</b></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="card-action">
                                            <div class="clear">
                                            </div>
                                            <div class="clear">
                                            </div>
                                            <div class="row" id="confirmcard" style="">
                                                <div class="col s12 m12 l12">
                                                    <div class="card" style="padding: 24px;">
                                                        <div class="card-content">
															<?php $depdate = strtotime($start_date);
															$today = time();
															$days = ceil(($depdate - $today)/(60*60*24));
															$a = (($confirm/100) * $grandtotal);?>
                                                                @if($grandtotal > 200)
                                                                    <div class="center-align" style="font-size: 15px;">
                                                                        This trip has <strong>@if($days >0 ){{$days}} @else 0 @endif days</strong> to go. Therefore, in order to book this trip,
                                                                        you are requested to make payment of <strong>{{$confirm}} %</strong> of Grand Total,
                                                                        i.e.
                                                                        <strong style="border: 1px solid red; padding: 2px;">
                                                                            @if($grandtotal < 200)
                                                                                USD $ {{$grandtotal}}
                                                                            @else
                                                                                @if($a < 200)
                                                                                    Minimum USD $200
                                                                                @else
                                                                                    USD ${{round(($confirm/100) * $grandtotal)}}
                                                                                @endif
                                                                            @endif
                                                                        </strong>
                                                                    </div>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="hbb" style="color:white;padding:20px;font-size:15px;font-weight: bold">
                                                <input type="checkbox" id="myCheckbox" class="filled-in" checked="checked" disabled required/>
                                                <label  for="myCheckbox" style="color: white;">
                                                    I agree to
                                                    <a href = "/terms" target = "_blank" style="color:black;margin-right: 4px;">
                                                        TERMS AND CONDITIONS</a>of the trip and verify that the details provided is true.
                                                </label>
                                            </div>
                                            <hr>
                                            <div class="row" style="border: 1px solid;">
                                                <div class="col l6 m6 s12 center-align" style="border-right: 1px solid">
                                                <form action="/custombook/confirm" method = "POST">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name = "bid" value="{{$bid}}">
                                                    <input type="hidden" name = "chosen" value="confirm">
                                                    <input type="hidden" name = "gdiscount" value="{{$groupdiscount}}">
                                                    <input type="hidden" name = "sdiscount" value="{{$trip->special_discount}}">
                                                    <input type="hidden" name = "trip_id" value="{{$trip->id}}">
                                                    <input type="hidden" name = "trip_date" value="{{$start_date}}">
                                                    @if($a < 200)
                                                        <input type="hidden" name = "confirm_pay" value="200">
                                                        <input type="hidden" name = "confirm_due" value="{{round($grandtotal - 200)}}">
                                                    @else
                                                        <input type="hidden" name = "confirm_pay" value="{{round(($confirm/100) * $grandtotal)}}">
                                                        <input type="hidden" name = "confirm_due" value="{{round($grandtotal - (($confirm/100)*$grandtotal))}}">
                                                    @endif
                                                    <input type="hidden" name = "status" value="pending">
                                                    <p class="details-content">
                                                        Please make sure that you deposit the confirmation amount on our bank details,
                                                        which will be sent on your verified email address. Once you make the payment,
                                                        Please do not forget to attach and send the deposit slip on our email address
                                                        or you can also upload it from your web profile.
                                                    </p>
                                                    <div class="row">
                                                        <div class="col s6">
                                                            <img src="{{url('images/bank.gif')}}" alt="" height="32px;">
                                                        </div>
                                                        <div class="col s6">
                                                            <button type="submit" class="waves-effect waves-light btn"
                                                                    name = "submit" onclick="showloading()">Confirm Booking</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                                <div class="col l6 s12 m6 center-align">
                                                    <form action="https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment" method="post">
                                                        {{csrf_field()}}
                                                        <p class="details-content">
                                                            At present, VISA & Master Card are supported
                                                            but we will be introducing American Express,
                                                            JCB, UnionPay & SCT in near future.
                                                        </p>
                                                        <div class="row">
                                                            {{--//custom values--}}
				                                            <?php
				                                            $alldata = array(
					                                            'bid'=>$bid,
					                                            'chosen'=>'confirm',
					                                            'discount'=>$discount,
					                                            'gdiscount'=>$groupdiscount,
					                                            'sdiscount'=>$trip->special_discount,
					                                            'trip_id'=>$trip->id,
					                                            'trip_date'=>$start_date,
					                                            'confirm_pay'=>$grandtotal,
					                                            'confirm_due'=>$grandtotal - (($confirm/100)*$grandtotal),
					                                            'status'=>'paid'
				                                            );
				                                            Session::put('alldata', $alldata);
				                                            ?>

                                                            {{--compulsory values--}}
				                                            <?php
				                                            $money = '1'.'00';
				                                            //$money = $grandtotal0.'00';
				                                            $money = sprintf("%012s", $money);
				                                            //echo  $money;
				                                            ?>
                                                            <input type="hidden" id="paymentGatewayID" name="paymentGatewayID" value="9103332813">
                                                            <input type="hidden" id="invoiceNo" name="invoiceNo" value="{{$bid}}">
                                                            <input type="hidden" id="productDesc" name="productDesc" value="{{$trip->name}}">
                                                            <input type="hidden" id="amount" name="amount" value="{{$money}}">
                                                            <input type="hidden" id="currencyCode" name="currencyCode" value="840">
                                                            <input type="hidden" id="nonSecure" name="nonSecure" value="N">
                                                            <input type="hidden" id="userDefined1" name="userDefined1" value="normaltrip">
				                                            <?php
				                                            $invoice = $bid;
				                                            $paymentgateway = 9103332748;
				                                            $price = $money;
				                                            $currencyCode = 840;
				                                            $nonSecure = 'N';
				                                            $signatureString = $paymentgateway.$invoice.$price.$currencyCode.$nonSecure;
	                                                        $securitycode = 'WJTUR2N2Q3Z5XGEJPC27XDR3C24IVHJT';
				                                            $signData = hash_hmac('SHA256', $signatureString, $securitycode, false);
				                                            $signData = strtoupper($signData);
				                                            ?>
                                                            <input type="hidden" id="hashValue" name="hashValue" value="{{$signData}}"/>
                                                            <div class="col s6">
                                                                <img src="{{url('images/online.jpg')}}" alt="">
                                                            </div>
                                                            <div class="col s6">
                                                                <button type="submit" class="waves-effect waves-light btn"
                                                                        name = "submit">Pay Online</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
{{----------------------------------------------------------full payment-----------------------------------------------------------------------}}
                                    <div id="fullPay">
                                        <table class="bordered responsive-table centered">
                                            <thead style="background-color: lightgrey;">
                                            <tr>
                                                <th>Description</th>
                                                <th>Unit Price</th>
                                                <th>Number of people</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><b>{{$trip->name}}</b><span style="display: block">Trip Price</span></td>
                                                <td>$ {{$trip->price}}</td>
                                                <td>{{$people}}</td>
                                                <td>$ {{$customprice}} (customized)</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Discounts</b>
                                                    <div>
                                                        @if($trip->special_discount != 0 && $trip->special_discount != null)
                                                            Special Trip Discount({{$trip->special_discount}}%),
						                                    <?php $std = $trip->special_discount; ?>
                                                        @else
						                                    <?php $std = 0; ?>
                                                        @endif
                                                        @if($discount != 0)
                                                            Early Booking Discount({{$discount}}%),
						                                    <?php $ebd = $discount; ?>
                                                        @else
						                                    <?php $ebd = 0; ?>
                                                        @endif

                                                        @if($groupdiscount != 0)
                                                            @if($people > 1)
                                                                Group Discount({{$groupdiscount}}%),
							                                    <?php $gd = $groupdiscount; ?>
                                                            @endif
                                                        @else
						                                    <?php $gd = 0; ?>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
				                                    <?php
				                                    $edis = round(($std/100) * $customprice);
				                                    $lowerprice = $customprice - $edis;
				                                    $sdis = round(($gd/100) * $lowerprice);
				                                    $secondlower = $lowerprice - $sdis;
				                                    $ebdd = round(($ebd/100)*$secondlower);

				                                    $totaldiscount1 = round(($edis + $sdis + $ebdd));
				                                    $totaldisc = round(($edis + $sdis + $ebdd)/$people);

				                                    echo '$ '.$totaldisc;
				                                    ?>
                                                </td>
                                                <td>{{$people}}</td>
                                                <td>$ {{$totaldiscount1 }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
				                                    <?php
				                                    $grandamount1 = $customprice - $totaldiscount1;
				                                    if(!empty($alldiscount)){
					                                    $grandamount1 = $grandamount1 - $alldiscount;
				                                    }
				                                    echo  'USD $ '.$grandamount1;
				                                    ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
										<?php $etotal1 = 0 ?>
                                        @if($extra != 0)
                                            <h5 style="text-align: center;">Extra Services</h5>
                                            <table class="bordered responsive-table centered">
                                                <thead style="background-color: lightgrey;">
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Price(perday)</th>
                                                    <th>Quantity</th>
                                                    <th>Days</th>
                                                    <th>Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($equipments as $e)
                                                        <tr style = "color:black">
                                                            <td>{{$e['equipment_name']}}</td>
                                                            <td>USD ${{$e['equipment_price']}}</td>
                                                            <td>{{$e['equipment_quantity']}}</td>
                                                            <td>{{$trip->trekdays}}</td>
															<?php $etotal1 += ($e['equipment_price'] *
																$e['equipment_quantity'] * ((int) $trip->trekdays));
															?>
                                                            <td> USD $ {{($e['equipment_price'] *
                                                $e['equipment_quantity'] * ((int) $trip->trekdays))}}</td>
                                                        </tr>
                                                @endforeach
                                                <tr style = "color:black">
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td style="color:black">Total: USD ${{$etotal1}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @endif
	                                    <?php $pactotal1 = 0 ;  ?>
                                        @if(!empty($packages))
                                            <h5 style="text-align: center;">Optional Activities</h5>
                                            <table class="bordered responsive-table centered">
                                                <thead style="background-color: lightgrey;">
                                                <tr>
                                                    <th>Name</th>
                                                    <th></th>
                                                    <th>Price</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($packages as $pac)
                                                    <tr>
                                                        <td>{{$pac->title}}</td>
                                                        <td><img src="{{url('images/trips/extraPackages/'.$pac->image)}}" style="height: 62px;"></td>
					                                    <?php
					                                    $pactotal1 += $pac->price;
					                                    ?>
                                                        <td>USD ${{$pac->price}}</td>
                                                    </tr>
                                                @endforeach
                                                <tr style = "color:black">
                                                    <td></td>
                                                    <td></td>
                                                    <td style="color:black">Total: USD ${{$pactotal1}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                        <table class="striped centered">
                                            <tbody>
                                            <tr style = "color:black; font-weight: 500;">
                                                <td><strong>Grand Total</strong></td>
                                                <td>
                                                    @if(!empty($alldiscount))
                                                        <div class="chip">
                                                            Coupon Discount: $ <?php echo $alldiscount ?>
                                                            <i class="close material-icons">close</i>
                                                        </div>
                                                    @endif
                                                </td>
	                                            <?php $grandtotal1 = $grandamount1 + $etotal1 + $pactotal1;  ?>
                                                <td>USD $ {{$grandtotal1}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        <div class="clear"></div>
                                        <div class="row" id="confirmcard" style="">
                                            <div class="col s12 m12 l12">
                                                <div class="card" style="padding: 24px;">
                                                    <div class="card-content">
                                                        <div class="center-align">To make final booking of this trip, Please make full payment of
                                                            <span style="border: 1px solid red; padding: 2px;">USD $ {{$grandtotal1}} </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="hbb" style="color:white;padding:20px;font-size:15px;font-weight: bold">
                                            <input type="checkbox" id="myCheckbox" class="filled-in" checked="checked" disabled required/>
                                            <label  for="myCheckbox" style="color: white;">
                                                I agree to
                                                <a href = "/terms" target = "_blank" style="color:black;margin-right: 4px;">
                                                    TERMS AND CONDITIONS</a>of the trip and verify that the details provided is true.
                                            </label>
                                        </div>
                                        <div class="row" style="border: 1px solid;">
                                            <div class="col l6 m6 s12 center-align" style="border-right: 1px solid">
                                                <form action="/custombook/confirm" method = "POST">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name = "bid" value="{{$bid}}">
                                                    <input type="hidden" name = "chosen" value="fullpayment">
                                                    <input type="hidden" name = "discount" value="{{$discount}}">
                                                    <input type="hidden" name = "gdiscount" value="{{$groupdiscount}}">
                                                    <input type="hidden" name = "sdiscount" value="{{$trip->special_discount}}">
                                                    <input type="hidden" name = "trip_id" value="{{$trip->id}}">
                                                    <input type="hidden" name = "trip_date" value="{{$start_date}}">
                                                    <input type="hidden" name = "full_pay" value="{{round($grandtotal1)}}">
                                                    <input type="hidden" name = "full_due" value="0">
                                                    <input type="hidden" name = "status" value="pending">
                                                    <p class="details-content">
                                                        Please make sure that you deposit the confirmation amount on our bank details,
                                                        which will be sent on your verified email address. Once you make the payment,
                                                        Please do not forget to attach and send the deposit slip on our email address
                                                        or you can also upload it from your web profile.
                                                    </p>
                                                    <div class="row">
                                                        <div class="col s6">
                                                            <img src="{{url('images/bank.gif')}}" alt="" height="32px;">
                                                        </div>
                                                        <div class="col s6">
                                                            <button type="submit" class="waves-effect waves-light btn"
                                                                    name = "submit" onclick="showloading()">Confirm Booking</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col l6 s12 m6 center-align">
                                                <form action="https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment" method="post">
                                                    {{csrf_field()}}
                                                    <p class="details-content">
                                                        At present, VISA & Master Card are supported
                                                        but we will be introducing American Express,
                                                        JCB, UnionPay & SCT in near future.
                                                    </p>
                                                    <div class="row">
                                                        {{--//custom values--}}
				                                        <?php
				                                        $alldata1 = array(
					                                        'bid'=>$bid,
					                                        'chosen'=>'confirm',
					                                        'discount'=>$discount,
					                                        'gdiscount'=>$groupdiscount,
					                                        'sdiscount'=>$trip->special_discount,
					                                        'trip_id'=>$trip->id,
					                                        'trip_date'=>$start_date,
					                                        'confirm_pay'=>$grandtotal1,
					                                        'confirm_due'=>0,
					                                        'status'=>'paid'
				                                        );
				                                        Session::put('alldata1', $alldata1);
				                                        ?>

                                                        {{--compulsory values--}}
				                                        <?php
				                                        $money = '1'.'00';
				                                        //$money = $grandtotal0.'00';
				                                        $money = sprintf("%012s", $money);
				                                        //echo  $money;
				                                        ?>
                                                        <input type="hidden" id="paymentGatewayID" name="paymentGatewayID" value="9103332813">
                                                        <input type="hidden" id="invoiceNo" name="invoiceNo" value="{{$bid}}">
                                                        <input type="hidden" id="productDesc" name="productDesc" value="{{$trip->name}}">
                                                        <input type="hidden" id="amount" name="amount" value="{{$money}}">
                                                        <input type="hidden" id="currencyCode" name="currencyCode" value="840">
                                                        <input type="hidden" id="nonSecure" name="nonSecure" value="N">
                                                        <input type="hidden" id="userDefined1" name="userDefined1" value="normaltrip">
				                                        <?php
				                                        $invoice = $bid;
				                                        $paymentgateway = 9103332748;
				                                        $price = $money;
				                                        $currencyCode = 840;
				                                        $nonSecure = 'N';
				                                        $signatureString = $paymentgateway.$invoice.$price.$currencyCode.$nonSecure;
	                                                    $securitycode = 'WJTUR2N2Q3Z5XGEJPC27XDR3C24IVHJT';
				                                        $signData = hash_hmac('SHA256', $signatureString, $securitycode, false);
				                                        $signData = strtoupper($signData);
				                                        ?>
                                                        <input type="hidden" id="hashValue" name="hashValue" value="{{$signData}}"/>
                                                        <div class="col s6">
                                                            <img src="{{url('images/online.jpg')}}" alt="">
                                                        </div>
                                                        <div class="col s6">
                                                            <button type="submit" class="waves-effect waves-light btn"
                                                                    name = "submit">Pay Online</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer1')
@endsection

@section('scripts')
    <script>
        function chColor(){
            $("#fullPay").css("color","#FFFFFF");
        }


        function showloading() {
            swal({
                text: "Please stay with us for a moment, while we are generating your invoice",
                allowOutsideClick:false,
                onOpen: () => {
                swal.showLoading()
        }
        })
        }
    </script>
@endsection
<div id="coupon1" class="modal" style="width: 20%">
    <div class="modal-content center-align">
        <form action="/submitctripcoupon1" method="post">
            {{csrf_field()}}
            <h4 style="color: teal;">Enter Coupon Number</h4>
            <input placeholder="Enter Coupon"  id="coupon1" name="coupon1" type="text" class="coupon1 validate" autocomplete="on">
            <div class="center-align">
                <button class="btn modal-action modal-close" type="submit">SUBMIT</button>
            </div>
        </form>
    </div>
</div>
{{---------------------------}}

<div id="coupon2" class="modal" style="width: 20%">
    <div class="modal-content center-align" >
        <form action="/submitctripcoupon2" method="post">
            {{csrf_field()}}
            <h4 style="color: teal;">Enter Coupon Number</h4>
            <input placeholder="Enter Coupon"  id="coupon2" name="coupon2" type="text" class="coupon2 validate" autocomplete="on">
            <div class="center-align">
                <button class="btn modal-action modal-close" type="submit">SUBMIT</button>
            </div>
        </form>
    </div>
</div>
{{---------------------------}}


