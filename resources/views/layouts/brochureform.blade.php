<div id="brochureModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width:500px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Request a Brochure </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" action="/request-a-brochure" style="margin-bottom:0px">
                {{csrf_field()}}
                {!! Recaptcha::field('home', 'g-recaptcha-response', ['id' => 'recaptcha-id01', 'class' => 'form-element']) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label><strong>Name</strong></label>
                            <input type="text" name="name" class="validate form-control" placeholder="Name" required
                                   autocomplete="off">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label><strong>Email</strong></label>
                            <input type="email" name="email" class="validate form-control" placeholder="Email" required
                                   autocomplete="off">
                        </div>
                        <div class="form-group col-lg-12">
                            <label><strong>Country</strong></label>

                            <select name="country"
                                    required autocomplete="off" class="form-control col-12-select">
                                <optgroup>
                                    @foreach($countries as $country)
                                        <option value="{{$country['name']}}"
                                                style="font-size: 14px;">{{$country['name']}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group col-lg-12">
                            <label><strong>Please help us know your interests or plans about your next adventure
                                    !</strong></label>
                            <textarea rows="3" id="textarea101" name="interest" class="form-control" required
                                      autocomplete="off" style="height: 60px;color:black;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="reserve-submit-btn" name="submit">Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
