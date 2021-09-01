 <div id="termandcondition" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Terms And Condition / Deposit and Cancellation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>


            <div class="modal-body">
                  <div class="termsNcondtion">
                    <h2 class="titleHeadtwo inner-title"><span> Terms And Condition</span></h2>
                    @if(!empty($termsDetails))

                        {!! $termsDetails->terms_details !!}
                    @else
                        <div style="text-align: center;min-height: 300px;">
                            <p> NO TERMS AND CONDITIONS</p>
                        </div>
                    @endif

                 </div>
                  <br>
                <hr>
                <br>
                <div class="depositNcancel">
                    <h2 class="titleHeadtwo inner-title"><span> Deposit and Cancellation </span></h2>
                    @if(!empty($depositDetails))
                        {!! $depositDetails->deposit_details !!}
                    @else
                        <div style="text-align: center;min-height: 300px;">
                            <p> NO DEPOSIT AND CANCELLATION POLICY</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn modal-close waves-effect waves-green btn-flat"
               style="background:red;color: white;margin:2px;" onclick="disagreeTermsCondition()">Disgree</a>
            <a href="javascript:;" class="btn modal-close waves-effect waves-green btn-flat"
               style="background:#008EB0;color: white;margin:2px;" onclick="agreeTermsCondition()">Agree </a>
            </div>
        </div>
    </div>
</div>