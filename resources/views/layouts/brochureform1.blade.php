<div id="brochureform" class="modal brochure" style="overflow:hidden;border: 4px solid teal;">
    <div class="modal-content" >
        <form action = "/request-a-brochure" method="post">
            <div class="row">
                <div class="input-field col l4 m12 s12  ">
                    <input id="name" type="text" name= "name" class="validate" required autocomplete="off" style="color: black;">
                    <label for="name"><b>Name</b></label>
                </div>
                <div class="input-field col l5 m12 s12 ">
                    <input id="name" type="email"  name  = "email" class="validate" required autocomplete="off" style="color: black;">
                    <label for="name"><b>Email</b></label>
                </div>
                <div class="input-field col l3 m12 s12" style="color: teal;font-weight:600;">
                    <select onchange="this.className=this.options[this.selectedIndex].className" name = "country" style="color: teal;" required autocomplete="off">
                        <option value="" disabled selected><b>Your Nationality</b></option>
                        @foreach($countries as $country)
                            <option value="{{$country['name']}}">{{$country['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col l12 m12 s12 ">
                    <textarea style="color: black;border: 1px solid teal" id="textarea1" name="interest" class="materialize-textarea" style="border: 2px solid #26a69a;color:teal" required autocomplete="off"></textarea>
                    <label for="review" style="color: teal" id="changefont"> <strong>Please help us know your interests or plans about your next adventure !</strong></label>
                </div>
            </div>
            <div class="col l12 center-align">
                <button type="submit" class="waves-effect waves-light btn">Request for Brochure</button>
            </div>
        </form>
    </div>
</div>