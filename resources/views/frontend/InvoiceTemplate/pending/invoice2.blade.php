@include('frontend.InvoiceTemplate.header-invoice')
<style>
    .table td {
        vertical-align: middle!important;
    }
    #logoAndCompInfo p{
        margin:0px;
    }

    .no-bordered-table tr td{
        border: none !important;
    }

    #clientTable tr:last-child td:last-child{
        border: solid 2px #F2F2F2 !important;
        padding:2px 5px;
        max-width: 150px;
        max-height:80px;
    }

    #clientTripDetails, #payementDetails{
        margin-top:10px;
    }

    #clientTripDetails table tr td{
        padding:2px !important;
    }



    .trip-table tr td:last-child{
        border: solid 2px #FFFFFF !important;
        text-align: center;
        padding: 5px 45px!important;
        border-radius: 2px !important;
    }
    .trip-table{
        border-spacing: 2px;
        border-collapse: separate;
    }

    #payementTable tr td,#payementTable tr th, #xtraServiceTable tr td, #xtraServiceTable tr th,#grandTotal td,#confirmandDue td{
        text-align: center;
    }

    #grandTotal td{
        text-align: right;
    }

    #waterMarkImg img{
        position: absolute;
        top: 10px;
        left: 0;
        height:100%;
        width:100%;
        opacity: 0.05;
        background-size:200px 200px ;
        background-repeat: no-repeat;
    }

    #stampAndSign{
        text-align:center;
        vertical-align: middle;
    }

    #importantNote p{
        margin:0px;
        padding: 0px;
    }

    .round{
        height: 18px;
        width:18px;
        /*border-radius: 50%;*/
        display: inline-block;
        vertical-align: middle;
        margin-top:-5px;
    }

    #trapezoidMid {
        position: relative;
        border-top: 18px solid #EE6E73;
        border-left: 20px solid transparent;
        border-right: 20px solid transparent;
        height: 0;
        top:-1px;
        width: 280px;
        border-radius-left:2px ;
        margin-left:35%;
    }

    #trapezoidMid span{
        position: absolute;
        top:4px;
        margin-top:-25px ;
        color: white;
        font-size:15px;
        font-weight: bold;
        padding-left: 14%;
        /*text-align: center;*/
    }

    hr.dash-hr{
        border:none;
        border-top:2px dashed #EE6E73;
        color:lightgrey;

        background-color:#fff;
        height:1px;
        width:97%;
        margin-bottom:20px;
    }


</style>
<body>
<div class="container" style="background-color: white;margin-top: -15px!important;
    margin-bottom:0px;padding: 0px;">
    <div class="row">
        <h2 style="text-align: center;color: #EE6E73;font-weight: bold;position: relative;font-family:'Palatino Linotype'">
            SWOTAH-INVOICE
        </h2>
       <h4> <span style="font: 15px bold;background: #008EB0;color: white;padding: 5px 10px;text-align: center;position:absolute; top:-1px;right:10px;letter-spacing: 2px;"> PENDING</span></h4>
         
    </div>
    <div style="padding: 2px 10px 6px;border: 2px solid #EE6E73;border-bottom:0px;margin-top: 0px; ">
        <div class="row">
            <div id="logoAndCompInfo">
                <div class="col-xs-6" >
                    <b style="color:#23334B;font-size: 15px; ">
                        Swotah Travel and Adventure Pvt. Ltd.
                    </b>
                    <p>Gairidhara-2, Kathmandu, Nepal</p>
                    <p>Tel : (+977)-1-4004750</p>
                    <p>P.O. Box : 612</p>
                    <p>GPO : 44600, Sundhara, Kathmandu </p>
                    <p><E></E>mail : info@swotahtravel.com, aj@swotahtravel.com</p>
                </div>
                <div class="col-xs-6" style="text-align: right;position: relative;">
                    <div style="margin:0px;">
                        <img src="https://i.imgur.com/IaMtsPI.png"
                             border="0" style="float: right; max-width: 170px;"/>
                    </div>
                    <div style="position: absolute;top: 80px;right: 20px;">
                        <p>PAN NO.: 604349574</p>
                        <p>REG. NO.: 158282/073/074</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="clientTripDetails" >
            <div class="col-xs-6" >
                <div style="padding: 10px;border: 2px solid lightgray;">
                    <b style="color:#2F4F4F; font-size: 15px;
                        border-bottom: solid 1px #2F4F4F;text-align: center">
                        Client Details:
                    </b>
                    <table class="table no-bordered-table" id="clientTable">
                        <tbody>
                        <tr></tr>
                        <tr>
                            <td>Client Name:</td>
                            <td>{{$name->name}}</td>
                        </tr>
                        <tr>
                            <td>Passport Number:</td>
                            <td>{{$name->passportno}}</td>
                        </tr>
                        <tr>
                            <td>Date of Birth:</td>
                            <td>{{$name->dob}}</td>
                        </tr>
                        <tr>
                            <td style="position: relative">
                                 <span style="position: absolute; top: 3px">
                                     Client Address:
                                 </span>
                            </td>
                            <td style="border: solid 2px #F2F2F2 !important; padding:2px 10px!important; max-width: 150px; max-height:80px; ">
                                @if($name->taddress != null)
                                    {{$name->taddress}}, <br>
                                @endif

                                @if($name->paddress != null)
                                    {{$name->paddress}}
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Trip Details--}}
            <div class="col-xs-6" >
                <div style="background-color: #F2F2F2;border-radius:2px;padding:1px 5px;">
                    <b style="color:#2F4F4F; font-size: 15px; border-bottom: solid 1px #2F4F4F;text-align: center">
                        Trip Details :
                    </b>
					<?php $total=0?>
                    <table class="table no-bordered-table trip-table">
                        <tbody>
                        <tr>
                            <td>Booking ID :</td>
                            <td>{{$name->bid}}</td>
                        </tr>
                        <tr>
                            <td>Trip Title :</td>
                            <td>{{$trip->name}}</td>
                        </tr>
                        <tr>
                            <td>Trip Code : </td>
                            <td>{{$trip->code}}</td>
                        </tr>
                        <tr>
                            <td>Number of Adults (pax): </td>
                            <td>{{$tripbooking->people}}</td>
                        </tr>
                        <tr>
                            <td>Booking Date :</td>
                            <td>{{date('M d, Y')}}</td>
                        </tr>
                        <tr>
                            <td>Trip Departure Date :</td>
                            <td>{{$tripbooking->start_date}}</td>
                        </tr>
                        <tr>
                            <td>Trip Style : </td>
                            <td>{{$trip->styles->name}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr class="dash-hr" style="width:100%; margin-top: 5px;margin-bottom: 5px;">
        <div class="row" id="payementDetails">
            <div class="col-xs-12" style="margin-top: -10px; margin-bottom: -10px; font-size: 9px;">
                <div>
                    <b style="color:#2F4F4F; font-size: 15px;">
                        Payment Details:
                    </b>
                    <table class="table table-bordered" id="payementTable" style="position:relative;">
                        <thead>
                        <tr>
                            <th>
                                Description
                            </th>

                            <th>
                                Unit Price
                            </th>

                            <th>
                                Number of People
                            </th>
                            <th>
                                Customized Amount
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td ><b>{{$trip->name}}</b>
                                <span style="display: block">Trip Price (Original)</span>
                            </td>
                            <td>USD ${{$trip->price}}</td>
                            <td>{{$tripbooking->people}}</td>
                            <td><?php $triptotal = $customprice;
                            echo $triptotal?> </td>
                        </tr>
                        <tr>
                            <td><b>Discounts</b>
                                <span style="display: block">
                                    @if($discount != 0 && $discount != null)   Early Booking ({{$discount}}%), <?php $d=$discount ?> @else <?php $d = 0 ?> @endif
                                    @if($gdiscount != 0 && $gdiscount != null)  Group Discount ({{$gdiscount}}%), <?php $gd = $gdiscount ?> @else <?php $gd = 0?> @endif
                                    @if($sdiscount != 0 && $sdiscount != null)  Special Discount ({{$sdiscount}}%), <?php $sd = $sdiscount ?> @else <?php $sd = 0?> @endif
                                </span>
                            </td>
                            <td><?php
                                $tripP = $customprice;

                                $alldiscount = [];
                                array_push($alldiscount,$d);
                                array_push($alldiscount,$gd);
                                array_push($alldiscount,$sd);

                                foreach ($alldiscount as $ds){
                                    $price1 = $tripP - (($ds/100) * $tripP);
                                    $tripP = $price1;
                                }

                                $totaldiscount = round(($customprice - $tripP),2);
                                $totaldis = round(($totaldiscount/$tripbooking->people),2);

                                echo "USD $".$totaldis;
								?>
                            </td>
                            <td>{{$tripbooking->people}}<br></td>
                            <td>{{$totaldiscount }}</td>
                        </tr>
                        @if($disamo != null)
                            <tr>
                                <td colspan="3">Promo Code Discount: <?php $copondiscount = $disamo; ?></td>
                                <td>($ {{$copondiscount}})</td>
                            </tr>
                        @else  <?php $copondiscount = 0; ?> @endif
                        </tbody>
                        <tfoot>
                        <tr style="color: #0C9B8E;">
                            <td  colspan="3" style="text-align: right">
                                <b> Total Trip Amount:</b>
                            </td>
                            <td>
                                <b>USD $ {{$triptotal - $totaldiscount - $copondiscount}}</b>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            {{--<div id="waterMarkImg">--}}
            {{--<img src="https://i.imgur.com/trFIJFa.png"  />--}}
            {{--</div>--}}
            @if(count($equipments) > 0)
                <hr class="dash-hr" style="margin-top: 0px;">
                <div class="col-xs-12" style="margin-top: -15px;">
                    <b style="color:#2F4F4F; font-size: 15px;">
                        Extra Services (Equipments):</b>
                    <table class="table table-bordered" id="xtraServiceTable">
                        <thead>
                        <tr>
                            <th>Items</th>
                            <th>Days</th>
                            <th>Quantity</th>
                            {{--<th>Amount</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                    <?php $etotal= 0; $totalsaman = 0; $eqcount= 1;  ?>
                                    @foreach($equipments as $e)
                                        @if($eqcount == 1)
                                            {{$e['equipment_name']}} ({{$e['equipment_quantity']}})
                                            <?php $totalsaman += $e['equipment_quantity']; ?>
                                            <?php $etotal += ($e['equipment_price'] *
                                                $e['equipment_quantity'] * ((int) $trip->trekdays));
                                            ?>
                                        @else
                                            , {{$e['equipment_name']}} ({{$e['equipment_quantity']}})
                                            <?php $totalsaman += $e['equipment_quantity']; ?>
                                            <?php $etotal += ($e['equipment_price'] *
                                                $e['equipment_quantity'] * ((int) $trip->trekdays));
                                            ?>
                                        @endif

                                            <?php $eqcount++; ?>
                                    @endforeach

                            </td>
                            <td>{{$trip->trekdays}}</td>
                            <td>{{$totalsaman}}</td>
                            {{--<td>{{$etotal}}</td>--}}
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr style="color: #D4AF37;">
                            <td colspan="2" style="text-align: right;">
                                <b>Total Extra Service Amount:</b>
                            </td>
                            <td >
                                <b>USD $ {{$etotal}}</b>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if(count($allpacks) > 0)
                <hr class="dash-hr" style="margin-top: 0px;">
                <div class="col-xs-12" style="margin-top: -15px;">
                    <b style="color:#2F4F4F; font-size: 15px;">
                        Optional Activities:</b>
                    <table class="table table-bordered" id="xtraServiceTable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Unit Price</th>
                            <th>Pax</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
				        <?php $totalpacks = 0; ?>
                        @foreach($allpacks as $packs)
                            <tr>
                                <td>{{$packs->title}}</td>
                                <td>USD ${{$packs->price}}</td>
                                <td>{{$packs->pax}}</td>
                                <?php $totalOamount = $packs->price * $packs->pax; ?>
                                <td>USD ${{$totalOamount}}</td>
                                <?php $totalpacks =$totalpacks + $totalOamount; ?>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr style="color: #4d72ff;">
                            <td colspan="3" style="text-align: right;">
                                <b>Total Optional Activities Amount:</b>
                            </td>
                            <td >
                                <b>USD $ {{$totalpacks}}</b>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @include('frontend.InvoiceTemplate.priceresult')
            <div class="col-xs-12" style="margin-top: -15px;margin-bottom: -15px;">
                <table class="table table-bordered" id="confirmandDue" >

                    <tr>
                        <td >
                            <b>Confirmation Amount:</b>
                        </td>
                        <td>
                            <b>USD $ {{round($payment->paid_amount)}}</b>
                        </td>
                        <td >
                            <b >Due Amount:</b>
                        </td>
                        <td>
                            <b>USD $ {{round($payment->due_amount)}}</b>
                        </td>
                    </tr>

                </table>
            </div>
            <hr class="dash-hr">
            <div style="page-break-before:auto;"></div>
            <div class="col-xs-8" style="margin-top: -15px; page-break-after:always">
                <table id="customerService" >
                    <tr>
                        <td>
                            <p><b>Call our Cusomer Service Center 24/7:</b></p>
                            <p>Customer Support:
                                <span>(+977)-9841595962</span>
                                <span>,</span>
                                <span>(+977)-9801095962</span>
                            </p>
                            <p style="font-size: 12px">(Long distance charges may apply) </p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-xs-4" style="margin-top: -15px;">

            </div>
            @include('frontend.InvoiceTemplate.impotantnotes')
        </div>
    </div>
    <div class="row" style="margin-top: 0px" >
        <div class="col-xs-12"  >
            <hr style="border-width:2px;margin-top: 0px;
                    margin-bottom:0px;border-color: #EE6E73;">
            <div style="">
                <div id="trapezoidMid" style="">
                        <span>
                            www.swotahtravel.com
                        </span>
                </div>
            </div>
        </div>
    </div>
</div>
</body>



