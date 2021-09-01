<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    #page-wrap {
        width: 800px;
        margin: 0 auto;
    }
    * {
        margin: 0;
        padding: 0;
    }
    #header {
        height: 30px;
        width: 100%;
        /*margin: 20px 0;*/
        background:#3a3b39;
        text-align: center;
        color: #1eafdc;
        font: bold 22px Helvetica, Sans-Serif;
        font-weight: 700;
        /*text-decoration: uppercase;*/
        letter-spacing: 20px;
        /*padding: 8px 0px;*/
    }
    div .text {
        /*border: 0;*/
        /*font: 15px Georgia, Serif;*/
        /*overflow: hidden;*/
        /*resize: none;*/
    }
    * {
        margin: 0;
        padding: 0;
    }

    * {
        margin: 0;
        padding: 0;
    }
    #logo {

        float: right;
        position: relative;
        border: 1px solid #fff;
        max-width: 540px;
        max-height: 100px;
        overflow: hidden;
    }
    * {
        margin: 0;
        padding: 0;
    }
    #customer {
        overflow: hidden;
    }
    * {
        margin: 0;
        padding: 0;
    }
    #customer-title {
        font-size: 20px;
        font-weight: bold;
        float: left;
        color: #1eafdc;
        background-color: inherit;
    }
    #terms {
        text-align: center;
        margin: 20px 0 0 0;
    }
    #terms h5 {
        text-transform: uppercase;
        font: 13px Helvetica, Sans-Serif;
        letter-spacing: 10px;
        border-bottom: 1px solid black;
        padding: 0 0 8px 0;
        margin: 0 0 8px 0;
    }
    #terms textarea {
        width: 100%;
        text-align: center;
        background: inherit;
    }

    body {
        font: 14px/1.4 Georgia, serif;
        font-family: Georgia,serif;
        font-style: normal;
        font-weight: normal;
        font-size: 14px;
        line-height: 1.4;
        font-size-adjust: none;
        font-stretch: normal;
        -x-system-font: none;
        font-feature-settings: normal;
        font-language-override: normal;
        font-kerning: auto;
        font-synthesis: weight style;
        font-variant-alternates: normal;
        font-variant-caps: normal;
        font-variant-east-asian: normal;
        font-variant-ligatures: normal;
        font-variant-numeric: normal;
        font-variant-position: normal;
    }

</style>
<div id="page-wrap">
    <div class= "text" id="header">INVOICE</div>
    <div id="identity">
        <div class="row">
            <div class = "col-md-6">
                <div id = "address" style = "font-size: 16px">Swotah Travel and Adventure Pvt Ltd</div>
                <div id = "address">
                    Gairidhara-2, Kathmandu, Nepal <br>
                    info@swotahtravel.com<br>
                    (+977) 9841595962
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php $total = 0;?>
    <?php $triptotal = 0;?>
    <div class="text" id="customer-title">{{$name->name}}</div>
    <br><br>
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th>Invoice #</th>
            <td>{{$name->bid}}</td>
        </tr>
        <tr>
            <th>Booking Date</th>
            <td>{{date('Y-m-d')}}</td>
        </tr>
        <tr>
            <td>Trip Departure Date</td>
            <td>{{date("Y-m-d", strtotime($name->tripbookings->start_date))}}</td>
        </tr>
        </tbody>
    </table>
    <br>
    @if($payment->chosen == 'confirm')
        <table class="table table-condensed">
            <thead style="background-color: lightgrey;">
            <tr>
            <tr>
                <th>Trip</th>
                <th>Price</th>
                @if($discount != 0)
                    <th>Early Booking Discount</th>
                @endif
                @if(!empty($tripdate->special_discount))
                    <th>Special Trip Discount</th>
                @endif
                <th>Number of people</th>
                <th>Total</th>
            </tr>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$tripdate->name}}</td>
                <td>USD ${{$tripdate->price}}</td>
                @if($discount != 0)
                    <td>{{$discount}}%</td>
                @endif
                @if(!empty($tripdate->special_discount))
                    @if($tripdate->special_discount != null)
                        <td>{{$tripdate->special_discount}} %</td>
                    @else
                        <td>No Trip Discount</td>
                    @endif
                @endif
                <td>{{$name->tripbookings->people}}</td>
                <td>
                    <?php $triptotal = (int)(($tripdate->price) - (($discount + $tripdate->special_discount)/100)
                            * $tripdate->price) * $name->tripbookings->people; ?>
                    USD ${{ $triptotal }}
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        @if($extra != 0)
            <h2 style="text-align: center;">Extra Services</h2>
            <table class="table table-condensed">
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
                <?php $count = count($equipments); ?>
                @foreach($equipments as $e)
                    @if($e['equipment_quantity'] != null or $e['equipment_quantity'] != 0)
                        <tr style = "color:black">
                            <td>{{$e['equipment_name']}}</td>
                            <td>USD ${{$e['equipment_price']}}</td>
                            <td>{{$e['equipment_quantity']}}</td>
                            <td>{{$tripdate->days}}</td>
                            <?php $total += ($e['equipment_price'] *
                                $e['equipment_quantity'] * ((int) $tripdate->days));
                            ?>
                            <td> USD $ {{($e['equipment_price'] *
                                                $e['equipment_quantity'] * ((int) $tripdate->days))}}</td>
                        </tr>
                    @else
                        @continue
                    @endif
                @endforeach
                <tr style = "color:black">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style = "color:black; text-decoration: solid;">Total: USD ${{$total}}</td>
                </tr>
                </tbody>
            </table>
        @endif
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>Confirmation Amount</th>
                <td>USD ${{$payment->paid_amount}}</td>

                <th>Amount Due</th>
                <td>USD ${{$payment->due_amount}}</td>
            </tr>
            </tbody>
        </table>
    @else
        <table class="table table-condensed">
            <thead style="background-color: lightgrey;">
            <tr>
                <th>Trip</th>
                <th>Price</th>
                @if($discount != 0)
                    <th>Early Booking Discount</th>
                @endif
                @if(!empty($tripdate->special_discount))
                    <th>Special Trip Discount</th>
                @endif
                <th>Number of people</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$tripdate->name}}</td>
                <td>USD ${{$tripdate->price}}</td>
                @if($discount != 0)
                    <td>{{$discount}}%</td>
                @endif
                @if(!empty($tripdate->special_discount))
                    @if($tripdate->special_discount != null)
                        <td>{{$tripdate->special_discount}} %</td>
                    @else
                        <td>No Trip Discount</td>
                    @endif
                @endif
                <td>{{$name->tripbookings->people}}</td>
                <td>
                    <?php $triptotal = (int)(($tripdate->price) - (($discount + $tripdate->special_discount)/100)
                            * $tripdate->price) * $name->tripbookings->people; ?>
                    USD ${{ $triptotal }}
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        @if($extra != 0)
            <h2 style="text-align: center;">Extra Services</h2>
            <table class="table table-condensed">
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
                <?php $count = count($equipments); ?>
                @foreach($equipments as $e)
                    @if($e['equipment_quantity'] != null)
                        <tr style = "color:black">
                            <td>{{$e['equipment_name']}}</td>
                            <td>USD ${{$e['equipment_price']}}</td>
                            <td>{{$e['equipment_quantity']}}</td>
                            <td>{{$tripdate->days}}</td>
                            <?php $total += ($e['equipment_price'] *
                                $e['equipment_quantity'] * ((int) $tripdate->days));
                            ?>
                            <td> USD $ {{($e['equipment_price'] *
                                                $e['equipment_quantity'] * ((int) $tripdate->days))}}</td>
                        </tr>
                    @else
                        @continue
                    @endif
                @endforeach
                <tr style = "color:black">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style = "color:black; text-decoration: solid;">Total: USD ${{$total}}</td>
                </tr>
                </tbody>
            </table>
        @endif
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>Grand Total</th>
                @if($extra == 0)
                    <td>USD ${{$triptotal}}</td>
                @else
                    <td>USD ${{$triptotal + $total}}</td>
                @endif
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>Confirmation Amount</th>
                <td>USD ${{$payment->paid_amount}}</td>
            </tr>
            </tbody>
        </table>
    @endif
    <div style = "text-align:center;background-color: @if($payment->status != "pending") lime @else orangered @endif"></div>
    <div class="text" id="customer-title">
        PAYMENT STATUS:
        <div style = "float:right">
            @if($payment->status != "pending")
                <span style="color:#3a3b39;">PAID</span>
            @else
                <span style="color:#3a3b39;">PENDING</span>
            @endif
        </div>

    </div>
</div>



