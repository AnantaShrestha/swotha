<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
{{--<link rel="stylesheet" href="{{url('css/frontend/master.css')}}">--}}
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    #logoAndCompInfo h5{
        margin:0px;
        /*padding: 0px;*/
    }
    .invoice-container row{
        padding:30px;
        margin-top:20px;
    }

    .invoice-container{
        padding: 5px 40px;
    }

    .invoice-container p{
        margin:0px;
    }

    .invoice-container{
        position: relative;
        background-color: #ffffff;
    }

    .bordered-table{
        /*width: auto;*/
        border: solid 1px #23334B;
    }

    #grandTotal td, #xtraServiceTable tfoot td, #payementTable tfoot td{
        font-size: 20px;
        font-weight: bold;
        text-align: right;
        /*color:#2F4F4F;*/
    }

    .client-table td, .trip-table td{
        padding-top:4px;
        padding-bottom: 4px;
    }

    .trip-table tr td:last-child{
        border: solid 2px #FFFFFF;
        text-align: center;
        padding: 5px 40px;
    }


    #payementTable td,#xtraServiceTable td,#payementTable th,#xtraServiceTable th{
        padding:6px 10px;
        border: 2px solid lightgray;
    }

    .pendingTag{
        font-family: "Times New Roman";
        letter-spacing: 5px;
        padding: 2px 1px;
        /*border-top: 4px solid #b71c1c;*/
        /*border-bottom: 4px solid #b71c1c;*/
        border-top: 4px solid #009688;
        border-bottom: 4px solid #009688;
        /*border-top: 4px solid #2F4F4F;*/
        /*border-bottom: 4px solid #2F4F4F;*/
        border-radius: 3px;
        font-size: 28px;
        font-weight: bold;
        /*color:#b71c1c;*/
        color:#009688;
        /*color:#2F4F4F;*/
        opacity: 0.8;
        /*margin: 7px;*/
    }

    .pendingTagWrapper{
        position: absolute;
        top:20px;
        right:35px;
        /*border: 2px groove red;*/
    }

    #confirmandDue td{
        text-align:center;
        font-size: 20px;
        border-right: 1px solid lightgray ;
    }

    #confirmandDue td:last-child{
        border-right: none;
    }

    #payementStatus td{
        font-weight: bold;
        text-align: right;
        font-size: 20px;
    }

    #stampAndSign td{
        padding: 2px 2px;
    }

    #customerService p{
        margin: 1px;
    }

    #payementTable{
        position: relative;
    }

    #waterMarkImg img{
        position: absolute;
        /*top: 30%;*/
        top: 0;
        left: 0;
        /*left: 40%;*/
        height:100%;
        width:100%;
        opacity: 0.05;
        /*background-position: center;*/
        background-size:200px 200px ;
        background-repeat: no-repeat;
        /*background-position: 50% 0;*/
    }

</style>

<div class="container invoice-container">

    <div  class="pendingTagWrapper">
        <span style="" class="pendingTag">
            PENDING
        </span>
    </div>
    {{--upper row--}}
    <div class="row  upper-padding">

        <div class="col s12" id="titleWrapper">
            <div class="center-align">
                <strong>
                    <h4>
                        <b style="color: #23334B;font-size:40px;">
                            Invoice
                        </b>
                    </h4>
                </strong>
                <hr>
            </div>
        </div>

        {{--Logo And Company Info--}}
        <div id="logoAndCompInfo" >


            {{--Comapany Info--}}
            <div class="col s6" style="padding-top: 20px">
                <b clas="upcaseHeading"><b style="color:#23334B;font-size: 25px; ">Swotah Travel and Adventure Pvt. Ltd. </b></b>
                <p>Gairidhara-2, Kathmandu, Nepal</p>
                <p>Tel : (+977)-1-4004750</p>
                <p>GPO Box : 612, 44600, Sundhara, Kathmandu </p>
                <p>Email : info@swotahtravel.com, swotahadventure@gmail.com</p>

            </div>
            {{--Comapany Info--}}
            {{--Logo Pan and Reg--}}
            <div class="col s6" style="margin-top: -15px;">
                <div id="swotahLogo" class="right-align" style="padding: 10px 10px 5px 10px" >
                    <img src="{{url('images/invoice/officialLogo.png') }}"
                         class="responsive-img"
                         style="height: auto; max-width: 170px;">
                </div>
                {{--<div style="margin-top:100px;"></div>--}}
                <div class="right-align" style=" padding-right: 10px; margin-top:8px;">
                    <p>PAN No.:604349574</p>
                    <p>Reg. No:158282/073/074</p>
                </div>
            </div>
            {{--Logo Pan and Reg--}}
        </div>
        {{--Logo And Company Info--}}
    </div>
    {{--upper row--}}

    {{--client and trip info row--}}
    <div class="row" style="border: 2px solid #F2F2F2">
        {{--Client Details--}}
        <div class="col s6" style="padding: 5px; ">
            <b style="color:#2F4F4F; font-size: 20px; border-bottom: solid 1px #2F4F4F;text-align: center">
                Client Details:
            </b>

            <table class="table  client-table">
                <tbody>
                <tr></tr>
                <tr>
                    <td>Client Name:</td>
                    <td>Agi Drahoslav Xavier Maksim Mészáros </td>
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
                    <td style="border: solid 2px #F2F2F2; padding:2px 5px; max-width: 150px; max-height:80px; ">
                        {{--<div style="height: 400px; width:400px;">--}}
                        20 Maple Avenue San Pedro, CA 90731
                        lorem ipsum lorem ipsum lorem ipsum
                        lorem ipsum lorem ipsum lorem ipsum
                        lorem ipsum lorem ipsum lorem ipsum

                        {{--</div>--}}
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
        {{--Client Details--}}

        {{-- Trip Details--}}
        <div class="col s6"  style="background-color: #F2F2F2;padding: 5px;">
            <b style="color:#2F4F4F; font-size: 20px; border-bottom: solid 1px #2F4F4F;text-align: center">
                Trip Details :
            </b>
            <table class="table trip-table">
                <tbody>
                <tr>
                    <td>Booking ID :</td>
                    <td>12345678910</td>
                </tr>
                <tr>
                    <td>Trip Title :</td>
                    <td>Everest Yoga Trek</td>
                </tr>
                <tr>
                    <td>Trip Code : </td>
                    <td>12345678</td>
                </tr>
                <tr>
                    <td>Number of Adults(pax): </td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>Departure Date :</td>
                    <td>08-08-2018</td>
                </tr>
                <tr>
                    <td>Trip Style : </td>
                    <td>Deluxe</td>
                </tr>

                </tbody>
            </table>
        </div>
        {{-- Trip Details--}}
    </div>
    {{--client and trip info row--}}

    <div class="row">
        <div class="12">
            <div>
                <b style="color:#2F4F4F; font-size: 22px;">
                    Payement Details:
                </b>
                <table class="table bordered bordered-table centered" id="payementTable">
                    <thead>
                    <tr>
                        <th><p style="">Description</p></th>

                        <th>
                            Unit Price
                        </th>

                        <th>
                            <p style="">
                                Number of People
                            </p>
                        </th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td >Everest Yoga Trek
                            <p>Trip Price(Original):</p>
                        </td>
                        <td>$1000</td>
                        <td>2</td>
                        <td>$2000</td>
                    </tr>
                    <tr>
                        <td >Discount:
                            <p>
                                Early Booking(10%), Group(10%)
                                Special Discount(5%),Last Minute deals(10%),Coupon(5%)
                            </p>
                        </td>
                        <td>$100</td>
                        <td>2</td>
                        <td>$200</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td  colspan="3" style="text-align: right">
                            Total Trip Amount:</b>
                        </td>
                        <td>$1800</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div id="waterMarkImg">
            <img src="{{url('images/invoice/officialLogo1.png')}}">
        </div>

        <div class="col s12" style=" margin-top: 10px;">
            <b style="color:#2F4F4F; font-size: 18px;">
                Extra Services(Equipments):</b>
            <table class="table bordered bordered-table centered" id="xtraServiceTable">
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
                        Trekking Poles(1), Down Jacket and Down Pant(1), Sleeping Bags(1),
                        Trekking Boots(1), Trekking Poles(1), Rain Jacket(1), Trekking Poles(1),
                        Down Jacket and Down Pant(1), Sleeping Bags(1),
                        Trekking Boots(1), Trekking Poles(1), Rain Jacket(1), Trekking Poles(1), Rain Jacket(1)
                    </td>
                    <td>15</td>
                    <td>5</td>
                    <td>
                        $75
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" >
                        Total Service Amount:
                    </td>
                    <td style="text-align: center">
                        $75
                    </td>
                </tr>
                </tfoot>


            </table>
        </div>


        <div class="col s12 grey lighten-3" style="margin: 5px 0px 5px 0px">
            <table class="table grey lighten-3" id="grandTotal" >

                <tr>
                    <td colspan="3" style="padding-left: 100px">
                        <b style="text-align:right" >Grand Total:</b>
                    </td>
                    <td>
                        $1875 ( Total Trip Amount + Extra Service Charge)
                        {{--(Trip Total Amount + Extra Service Charge)--}}
                    </td>
                </tr>

            </table>
        </div>

        <div class="col s12" style="margin: 5px 0px 5px 0px; border: 2px solid lightgray">
            <table class="" id="confirmandDue" >

                <tr>
                    <td colspan="" style="">
                        <b style="" >Confirmation Amount:</b>
                    </td>
                    <td>
                        <b>$333</b>
                    </td>
                    <td colspan="" style="">
                        <b style="" >Amount Due:</b>
                    </td>
                    <td>
                        <b>$1400</b>
                    </td>
                </tr>

            </table>
        </div>

        <div class="col s8" style="margin: 5px 0px 5px 0px;">
            <table id="customerService" >
                <tr>
                    <td>
                        <p><b>Call our Cusomer Service Center 24/7:</b></p>
                        <p>Customer Support:
                            <span>(+977)-1-4004750</span>
                            <span>,</span>
                            <span>(+977)-1-4004750</span>
                        </p>
                        <p style="font-size: 12px">(Long distance charge may apply) </p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="col s4" style="margin: 5px 0px 5px 0px; border: 2px solid lightgray;">
            <table  id="stampAndSign" >

                <tr>
                    <td class="center-align">
                        <img src="{{url('images/invoiceStamp/stamp1.jpg')}}"
                             class="responsive-img" style="max-height: 120px;max-width: 120px;">
                    </td>
                </tr>
                <tr>
                    <td class="center-align">
                        <b style="font-size: 12px;">
                            Authorized Stamp & Signature
                        </b>
                    </td>
                </tr>

            </table>
        </div>
        <div class="col s12" style="border: 2px solid lightgray; padding:20px;" >
            <b style="color:#c62828; font-size: 20px; border-bottom: solid 2px #c62828;margin-left: 10px;">
                Important Note:
            </b>

            <p>
                * To get early bird discount please make sure to deposit full amount while booking the trip
            </p>
            <p>
                * Make sure to use coupon code for discount in your next booking which is sent in your e-mail
            </p>
            <p>
                * Pleae note that  10% of <b>Grand Total</b> or $200 (whichever is greater) is not refundable amount
            </p>
            <p>
                * Please make sure that all your discounts are calculated on discounted price
            </p>
        </div>
    </div>
</div>