<div id="enquiryModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="width:400px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Enquiry</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" id="enquiry" action="/enquiry" enctype="multipart/form-data" style="margin-bottom:0px">
                <div class="modal-body">
                    {{csrf_field()}}
                    {!! Recaptcha::field('home', 'g-recaptcha-response', ['id' => 'recaptcha-id0', 'class' => 'form-element']) !!}
                    <input type="hidden" name="trip_id" value="{{$trip->id}}">
                    <div class="form-group">
                        <label style="font-size:16px;font-weight:700">Name</label>
                        <input type="text" name="name" class="form-control" required autocomplete="off"
                               placeholder="Enter Your Name">
                    </div>
                    <div class="form-group">
                        <label style="font-size:16px;font-weight:700">Email</label>
                        <input id="name" type="email" name="email" class="form-control" required autocomplete="off"
                               placeholder="Enter Your Email">
                    </div>
                    <div class="form-group">
                        <label style="font-size:16px;font-weight:700">Nationality</label>
                        <select class="form-control"
                                onchange="this.className=this.options[this.selectedIndex].className"
                                name="nationality" required autocomplete="off">
                            <option value="" disabled selected><b>Your Nationality</b></option>
                            @foreach($countries as $country)
                                <option value="{{$country['name']}}">{{$country['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label style="font-size:16px;font-weight:700">Your Enquiry</label>
                        <textarea rows='3' id="textarea1" name="interest" class="form-control" data-length="5000"
                                  required
                                  autocomplete="off" placeholder="Tell us more"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="reserve-submit-btn">Post
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<div id="bookEnquiry" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="width:400px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">You can choose the Booking Type !</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-footer">
                <div class="center-align padding-tb-20">
                    <a href="{{url('book-trip',$trip->id)}}">
                        <button type="submit" class="btn-enquiry">
                            Private Tour
                        </button>
                    </a>
                    &nbsp;
                    &nbsp;
                    <button class="reserve-submit-btn book-group-tour" data-dismiss="modal">
                        Group Tour
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>