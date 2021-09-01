<div id="invoiceModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width:1000px">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Swotah Travel and Adventure Pvt. Ltd</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body" style="height:400px;overflow-y:scroll">
                <div style="text-align:center">
                    <span class="boookingName" id="kotitlem">&nbsp;</span>
                    <b> <span class="boookingName" id="cfnamem">&nbsp; </span>
                        <span class="boookingName" id="cmnamem">&nbsp;</span>
                        <span class="boookingName" id="clnamem"></span> </b>
                </div>
                <div class='pop-table'>
                    <table class="invoiceTable modalTable">
                        <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Booking Date</th>
                            <th>Trip Departure Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$invoiceNo}}</td>
                            <td>{{date("j F, Y")}}</td>
                            <td><span id="janedin1"></span></td>

                        </tr>
                        </tbody>
                    </table>
                    <table class=" modalTable">
                        <thead>
                        <tr>
                            <th>DESCRIPTION</th>
                            <th>PRICE</th>
                            <th>PAX</th>
                            <th>TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><b>{{$trips->name}}</b></td>
                            <td>${{$trips->price}}</td>
                            <td><span class="pax">{{$trips->min_group_size}}</span></td>
                            <td>USD $ <span class="triptotal">
										{{$trips->min_group_size * $trips->price}}
									</span></td>
                        </tr>
                        @if(count($allequipments) > 0)
                            <tr>
                                <td><b>Rental Services</b></td>
                                <td></td>
                                <td></td>
                                <td>USD $<span id="eqsubtotal2">0</span></td>
                            </tr>
                        @endif
                        @if(count($extrapackages) > 0 )
                            <tr>
                                <td><b>Optional Activities</b></td>
                                <td></td>
                                <td></td>
                                <td>USD $<span id="actssubtotal2">0</span></td>
                        @endif
                        <tr>
                            <td>
                                <b>Discounts</b><br>
                                <table id="discounts" class="responsive-table">
                                    <tr>
                                        @if($trips->special_discount != 0 && $trips->special_discount != null)
                                            <td> Special Trip Discount({{$trips->special_discount}}%)</td>
                                            <input type="hidden" name="specialdis" value="{{$trips->special_discount}}">
                                            <?php $std = $trips->special_discount; ?>
                                        @else
                                            <?php $std = 0; ?>
                                        @endif
                                        <td>
                                            <span id="gdiscount"></span>
                                        </td>
                                        <input class="gdiscount" type="hidden" name="groupdiscount" value="0">
                                        <td>
                                            <span id="ebcdiscount"></span>
                                        </td>
                                        <input class="ebcdiscount" type="hidden" name="earlybookdiscount" value="0">
                                    </tr>
                                </table>
                            </td>
                            <td><span class="discountone"></span></td>
                            <td><span class="disperson"></span></td>
                            <td>(USD $<span class="discountallperson">0</span>)</td>
                        </tr>
                        <tr>
                            <td>
                                <b>Promo Code Discount</b>
                            </td>
                            <td></td>
                            <td></td>
                            <td>($ <span class="coupon"></span>)</td>
                        </tr>
                        <tr style="background-color: lightgray;font-weight: bolder;font-size: 16px;color:#111;">
                            <td>
                                <b>Total</b>
                            </td>
                            <td></td>
                            <td></td>
                            <td>$ <span id="grandytotal0"></span></td>
                        </tr>
                        </tr>
                        </tbody>
                    </table>
                    @if(count($allequipments) > 0 && count($extrapackages) > 0)
                        <div class="inner-package-head-title mb-20 mt-20"><h3>Rental Service</h3></div>
                        <table id="rentals" class=" highlight modalTable">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Days</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>$ <span id="eqsubtotal1">0</span></td>
                            </tr>
                            </tfoot>
                        </table>
                        <div class="inner-package-head-title mb-20 mt-20"><h3>Optional Activities</h3></div>

                        <table id="acts" class=" highlight modalTable mb-30">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Pax</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td>$ <span id="actssubtotal1">0</span></td>
                            </tr>
                            </tfoot>
                        </table>
                    @elseif(count($allequipments) > 0)
                        <div class="inner-package-head-title mb-20 mt-20"><h3>Rental Service</h3></div>
                        <table id="rentals" class=" highlight modalTable">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Days</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>$ <span id="eqsubtotal1">0</span></td>
                            </tr>
                            </tfoot>
                        </table>


                    @elseif(count($extrapackages) > 0)
                        <div class="inner-package-head-title mb-20 mt-20"><h3>Optional Activities</h3></div>

                        <table id="acts" class=" highlight modalTable mb-30">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Pax</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td>$ <span id="actssubtotal1">0</span></td>
                            </tr>
                            </tfoot>
                        </table>


                    @endif
                </div>

            </div>
        </div>

    </div>
</div>

