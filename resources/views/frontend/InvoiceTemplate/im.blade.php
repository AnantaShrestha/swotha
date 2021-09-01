<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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

<div class="container" style="background-color: white;margin-top: -15px!important;
    margin-bottom:0px;padding: 0px;">
    <div class="row">
        <h2 style="text-align: center;color: #EE6E73;font-weight: bold;position: relative;font-family:'Palatino Linotype'">
            SWOTAH-INVOICE
        </h2>
        <h4 style="font-size: 25px;font-weight: bolder;
        color:#009688; padding: 2px 3px;
        border-top: 2px solid #009688;
        border-bottom: 2px solid #009688;
        border-radius: 3px;letter-spacing: 2px;
        text-align: center;position:absolute;
        top:-1px;right:10px;margin-top: 0px;">
            PENDING
        </h4>
    </div>
    <div style="padding: 2px 10px 6px;border: 2px solid #EE6E73;border-bottom:0px;margin-top: 0px; ">
        <div class="row">
            <div id="logoAndCompInfo">
                <div class="col-xs-6" >
                    <b style="color:#23334B;font-size: 20px; ">
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
                    <b style="color:#2F4F4F; font-size: 20px;
                        border-bottom: solid 1px #2F4F4F;text-align: center">
                        Client Details:
                    </b>
                    <table class="table no-bordered-table" id="clientTable">
                        <tbody>
                        <tr></tr>
                        <tr>
                            <td>Client Name:</td>
                            <td>Max</td>
                        </tr>
                        <tr>
                            <td>Passport Number:</td>
                            <td>12345678910</td>
                        </tr>
                        <tr>
                            <td>Date of Birth:</td>
                            <td>07-07-1997</td>
                        </tr>
                        <tr>
                            <td style="position: relative">
                                 <span style="position: absolute; top: 3px">
                                     Client Address:
                                 </span>
                            </td>
                            <td style="border: solid 2px #F2F2F2 !important; padding:2px 10px!important; max-width: 150px; max-height:80px; ">
                                20 Maple Avenue San Pedro, CA 90731
                                lorem ipsum lorem ipsum lorem ipsum
                                lorem ipsum lorem ipsum lorem ipsum
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Trip Details--}}
            <div class="col-xs-6" >
                <div style="background-color: #F2F2F2;border-radius:2px;padding:1px 5px;">
                    <b style="color:#2F4F4F; font-size: 20px; border-bottom: solid 1px #2F4F4F;text-align: center">
                        Trip Details :
                    </b>
					<?php $total=0?>

                    <table class="table no-bordered-table trip-table">
                        <tbody>
                        <tr>
                            <td>Booking ID :</td>
                            <td>323444</td>
                        </tr>
                        <tr>
                            <td>Trip Title :</td>
                            <td>Rara Trek</td>
                        </tr>
                        <tr>
                            <td>Trip Code : </td>
                            <td>12345678</td>
                        </tr>
                        <tr>
                            <td>Number of Adults (pax): </td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>Booking Date :</td>
                            <td>Nov 14, 2017</td>
                        </tr>
                        <tr>
                            <td>Trip Departure Date :</td>
                            <td>Nov 14, 2017</td>
                        </tr>
                        <tr>
                            <td>Trip Style : </td>
                            <td>Deluxe</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr class="dash-hr" style="width:100%; margin-top: 5px;margin-bottom: 5px;">
        <div class="row" id="payementDetails">
            <div class="col-xs-12" style="margin-top: -10px; margin-bottom: -10px;">
                <div>
                    <b style="color:#2F4F4F; font-size: 22px;">
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
                                Amount
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td ><b>Everest Yoga Trek</b>
                                <span style="display: block">Trip Price (Original)</span>
                            </td>
                            <td>$100</td>
                            <td>13</td>
                            <td>$2000</td>
                        </tr>
                        <tr>

                            <td><b>Discounts</b>
                                <span style="display: block">
                                    Early Booking (10%), Group Discount (10%),
                                    Special Discount (5%), Last minute deals (10%), Coupon (5%)
                                </span>
                            </td>

                            <td>$100</td>
                            <td>13</td>
                            <td>$200</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr style="color: #0C9B8E;">
                            <td  colspan="3" style="text-align: right">
                                <b> Total Trip Amount:</b>
                            </td>
                            <td>
                                <b>$1800</b>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{--<div id="waterMarkImg">--}}
                {{--<img src="https://i.imgur.com/trFIJFa.png"  />--}}
            {{--</div>--}}

            <hr class="dash-hr" style="margin-top: 0px;">

            <div class="col-xs-12" style="margin-top: -15px;">
                <b style="color:#2F4F4F; font-size: 18px;">
                    Extra Services (Equipments):</b>
                <table class="table table-bordered" id="xtraServiceTable">
                    <thead>
                    <tr>
                        <th>Items</th>
                        <th>Days</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            Trekking poles (1), Down jackets and Down pants (1), Sleeping bags (1),
                            Trekking boots (1), Trekking poles (1), Rain jackets (1), Trekking poles (1),
                            Down jackets and Down pants (1), Sleeping bags (1),
                            Trekking boots (1), Trekking poles (1), Rain jackets (1), Trekking poles (1), Rain jackets (1)
                        </td>
                        <td>15</td>
                        <td>5</td>
                        <td>
                            $75
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr style="color: #D4AF37;">
                        <td colspan="3" style="text-align: right;">
                            <b>Total Extra Service Amount:</b>
                        </td>
                        <td >
                            <b>$75</b>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="col-xs-12" style="margin-top: -15px;">
                <table class="table " id="grandTotal"  style="border: 1px solid lightgray">
                    <tr style="color: #b71c1c">
                        <td  style="text-align: right;">
                            <b>
                                Grand Total
                                (
                                <span class="round" style="background-color: #0C9B8E;"></span>&nbsp;<span>+</span>
                                <span class="round" style="background-color: #D4AF37;"></span>&nbsp;<span>=</span>
                                <span class="round" style="background-color: #b71c1c;"></span>
                                )
                                :
                            </b>
                            &nbsp;&nbsp;&nbsp;
                            <b><span style="font-size: 20px;">$1875</span>
                                (
                                <span style="color: #0C9B8E;"> Total Trip Amount</span>
                                +
                                <span style="color:#D4AF37; ">Total Extra Service Amount</span>
                                )
                            </b>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col-xs-12" style="margin-top: -15px;margin-bottom: -15px;">
                <table class="table table-bordered" id="confirmandDue" >

                    <tr>
                        <td >
                            <b  >Confirmation Amount:</b>
                        </td>
                        <td>
                            <b>USD $333</b>
                        </td>
                        <td >
                            <b >Due Amount:</b>
                        </td>
                        <td>
                            <b>USD $1450</b>
                        </td>
                    </tr>

                </table>
            </div>
            <hr class="dash-hr">
            <div class="col-xs-8" style="margin-top: -15px;">
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
                <div style=" border: 1px solid lightgray;padding:0px;">
                    <table  id="stampAndSign" style="margin-left:15%; margin-top:-4%;">
                        <tbody >
                        <tr>
                            <td >
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <b style="font-size: 12px;">
                                    Authorized Stamp & Signature
                                </b>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-xs-12" style="margin-top: 1px;" >
                <div style="border: 1px solid lightgray; padding:2px;">

                    <b style="color:#c62828; font-size: 12px; border-bottom: solid 1px #c62828;margin-left: 10px;">
                        Important Notes:
                    </b>

                    <div style="padding-top:1px;padding-left:2px;" id="#importantNote">
                       <span>
                           * In order to get <b>"Early Bird Discount"</b>, please make sure that you <b>Grand Total Amount.</b>
                        </span><br>
                        <span>
                            * Please make sure to use provided <b>coupon code</b> for your next booking in order to apply <b>loyalty discount.</b>
                        </span><br>
                        <span>
                            * Please note that <b> 10% </b> of <b> Total Trip Amount </b> or <b> $200 </b> (whichever is greater), is <b> 'Non Refundable'. </b>
                        </span><br>
                        <span>
                            * Please note that all your discounts are calculated on already discounted price.
                        </span><br>
                        <span>
                            * Please make sure that you bring the printed copy of your final invoice.
                        </span>
                    </div>
                </div>
            </div>

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



