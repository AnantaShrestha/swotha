<div class="col-xs-12" style="margin-top: -15px;">
    <table class="table " id="grandTotal"  style="border: 1px solid lightgray">
        <tr style="color: #b71c1c;">
            <td  style="text-align: right;">
                <b>
                    Grand Total
                    (
                    <span class="round" style="background-color: #b71c1c;"></span>
                    <span>=</span>
                    <span class="round" style="background-color: #0C9B8E;"></span>
                    @if(count($equipments) > 0)
                        &nbsp;<span>+</span>
                        <span class="round" style="background-color: #D4AF37;"></span>
                        &nbsp;<span>+</span>
                    @endif
                    @if(count($allpacks) > 0)
                        <span class="round" style="background-color: #4d72ff;"></span> @endif &nbsp;
                    )
                    :
                </b>
                &nbsp;&nbsp;&nbsp;
                <b><span style="font-size: 15px;">USD $ {{round($payment->paid_amount + $payment->due_amount)}}</span>
                    (
                    <span style="color: #0C9B8E;"> Total Trip Amount</span>
                    @if(count($equipments) > 0)
                        +
                        <span style="color:#D4AF37; ">Total Extra Service Amount</span>
                        +
                    @endif
                    @if(count($allpacks) > 0)
                        <span style="color:#4d72ff; ">Total Optional Activities Amount</span> @endif &nbsp;
                    )
                </b>
            </td>
        </tr>
    </table>
</div>