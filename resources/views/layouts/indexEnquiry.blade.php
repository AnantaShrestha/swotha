<div id="enq-btn" class="modal"  style="overflow:hidden;border: 4px solid teal;">
    <form action = "/enquiry" method = "post" style="padding: 10px;">
        {{csrf_field()}}
        <input type="hidden" name = "trip_id" id="trip_id_one" value="">
        <div class="row">
            <div class="input-field col l4 m12 s12  ">
                <input id="name" type="text" name= "name" class="validate" required autocomplete="off" value="{{(Auth::user())?(Auth::user()->name):''}}" >
                <label for="name"><b>Name</b></label>
            </div>
            <div class="input-field col l5 m12 s12 ">
                <input id="name" type="email"  name  = "email" class="validate" required autocomplete="off" value="{{((Auth::user())&&(Auth::user()->email != ''))?(Auth::user()->email):''}}">
                <label for="name"><b>Email</b></label>
            </div>
            <div class="input-field col l3 m12 s12" style="color: teal;font-weight:600;">
                <select onchange="this.className=this.options[this.selectedIndex].className"
                        name = "nationality" style="color: teal;" required autocomplete="off">
                    <option value="" disabled selected><b>Your Nationality</b></option>
                    @foreach($countries as $country)
                        <option value="{{$country['name']}}">{{$country['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-field col l12 m12 s12 ">
                <textarea id="textarea1" name="interest" class="materialize-textarea" style="border: 2px solid #26a69a;color:teal" required autocomplete="off"></textarea>
                <label for="review" style="color: teal" id="changefont"> <strong>Your Enquiry</strong></label>
            </div>
        </div>
        <div class="col l12 center-align">
            <button type="submit" class="waves-effect waves-light btn">Place Enquiry</button>
        </div>
    </form>
</div>