<div id="modal1" class="modal">
    <div class="modal-content">
        <div class="center-align" style="border: 2px solid black; padding: 5px; height: 100%;">
            <h4 style="font-weight: 500;">Swotah Travel and Adventure Pvt. Ltd</h4>
            <div><span id="kotitlem">&nbsp;</span><span id="cfnamem">&nbsp;</span><span id="cmnamem">&nbsp;</span><span id="clnamem"></span></div>
            <table class="" style="width: 35%;margin-left: 30%;">
                <tr>
                    <td>Invoice No:</td>
                    <td>{{$invoiceNo}}</td>
                </tr>
                <tr>
                    <td>Booking Date:</td>
                    <td>{{date("j F, Y")}}</td>
                </tr>
                <tr>
                    <td>Trip Departure Date:</td>
                    <td>{{date('j F, Y',strtotime($tripdate->start_date))}}</td>
                </tr>
            </table>
            <table class="striped">
                <thead style="text-align: center;background: lightgray;padding: 2px;">
                <tr>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Pax</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody style="padding: 3px; margin-top: 0;">
                <tr>
                    <td><b>{{$tripdate->trips->name}}</b></td>
                    <td><span style="text-decoration:line-through;">${{$tripdate->trips->price}}</span><br>${{$tripdate->price}}</td>
                    <td><span class="pax">1</span></td>
                    <td>USD $ <span class="triptotal">{{$tripdate->price}}</span></td>
                </tr>
				<?php
				$start_date = strtotime($tripdate->start_date);
				$year = strtotime('-1 year ago');
				$_100days = strtotime('-100 day ago');
				$_60days = strtotime('-60 day ago');
				$earlybookdiscount = 0;
				$confirm = 100;

				if ($start_date >= $year) {
					$confirm = 15;
					$earlybookdiscount = 10;
				}
				if ($start_date >= $_100days and $start_date < strtotime('-364 day ago')) {
					$confirm = 20;
					$earlybookdiscount = 5;
				}
				if ($start_date >= $_60days and $start_date < strtotime('-99 day ago')) {
					$confirm = 25;
					$earlybookdiscount = 0;
				}
				if ($start_date >= strtotime('-30 day ago') and $start_date < strtotime('-59 day ago')) {
					$confirm = 50;
					$earlybookdiscount = 0;
				}
				if ($start_date < strtotime('-30 day ago')) {
					$confirm = 100;
					$earlybookdiscount = 0;
				}
				?>
                <tr style="background-color: lightgray;">
                    <td>
                        <b>Discounts</b><br>
                        <table id="discounts" class="responsive-table">
                            <tr>
                                @if($tripdate->trips->special_discount != 0 && $tripdate->trips->special_discount != null)
                                    <td> Special Trip Discount({{$tripdate->trips->special_discount}}%)</td>
									<?php $std = $tripdate->trips->special_discount; ?>
                                @else
									<?php $std = 0; ?>
                                @endif

                                @if($tripdate->discount !=0 && $tripdate->discount != null)
                                    <td> Last Minute Deal Discount({{$tripdate->discount}}%)</td>
									<?php $lmdd = $tripdate->discount; ?>
                                @else
									<?php $lmdd = 0; ?>
                                @endif
                                <td><span id="gdiscount"></span></td>
                                <td><span id="ebcdiscount"></span></td>
                            </tr>
                        </table>
                    </td>
                    <td><span class="discountone"></span></td>
                    <td><span class="disperson"></span></td>
                    <td>(USD $<span class="discountallperson">0</span>)</td>
                </tr>
                <tr style="background-color: lightgray;">
                    <td>
                        <b>Coupon Discount</b>
                    </td>
                    <td></td>
                    <td></td>
                    <td>$ <span class="coupon"></span></td>
                </tr>
                <tr>
                    <td>
                        <b>Total</b>
                    </td>
                    <td></td>
                    <td></td>
                    <td>$1650</td>
                </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col l6 m6 s12">
                    <h6>Rental Services</h6>
                    <table id="rentals" class="">
                        <thead style="text-align: center;background: lightgray;padding: 2px;">
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Days</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody style="padding: 3px; margin-top: 0;">
                        </tbody>
                        <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>$ <span id="eqsubtotal1">0</span></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col l6 m6 s12">
                    <h6>Optional Activties</h6>
                    <table id="acts" class="">
                        <thead style="text-align: center;background: lightgray;padding: 2px;">
                        <tr>
                            <th>Name</th>
                            <th>Pax</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody style="padding: 3px; margin-top: 0;">
                        </tbody>
                        <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>$ <span id="actssubtotal1">0</span></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>