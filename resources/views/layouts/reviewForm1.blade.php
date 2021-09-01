
<style>
    .pull-left{
        display: flex;justify-content: center;
        flex-direction: row-reverse;

    }

    @media only screen and (max-width: 500px) {
        .in-stars {
            margin-left: 20%;
        }
    }

    textarea{
        color: black;
    }
    input:not([type]), input[type=text], input[type=password],input[select],
    input[type=email], input[type=url], input[type=time], input[type=date],
    input[type=datetime], input[type=datetime-local], input[type=tel], input[type=number],
    input[type=search], textarea.materialize-textarea {
        background-color: transparent;
        outline: none;
        border: 1px solid #008EB0;
        border-radius:0px;
        outline: none;
        height: 3rem;
        width: 100%;
        font-size: 1rem;
        margin: 0 0 20px 0;
        padding: 0;
        box-shadow: none;
        box-sizing: content-box;
        transition: all 0.3s;
    }
    .select-wrapper input.select-dropdown {
        position: relative;
        cursor: pointer;
        background-color: transparent;
        border: 1px solid #008EB0;
        outline: none;
        height: 3rem;
        line-height: 3rem;
        width: 100%;
        font-size: 1rem;
        margin: 0 0 20px 0;
        padding: 0;
        display: block;
    }

    .select-wrapper:focus.valid input.select-dropdown:focus.valid{
        border: 1px solid #4CAF50;
        box-shadow: 0 1px 0 0 #4CAF50;
    }
    #alignreview{
        padding-top: 4%;
        padding-bottom: 4%;
        padding-top: 2%;
        padding-bottom: 2%;
    }

    form p {
        text-align: center;
        font-weight: bold;
    }

    input:not([type]).valid, input:not([type]):focus.valid,
    input[type="text"].valid, input[type="text"]:focus.valid,
    input[type="password"].valid, input[type="password"]:focus.valid,
    input[type="email"].valid, input[type="email"]:focus.valid, input[type="url"].valid,
    input[type="url"]:focus.valid, input[type="time"].valid, input[type="time"]:focus.valid,
    input[type="date"].valid, input[type="date"]:focus.valid, input[type="datetime"].valid,
    input[type="datetime"]:focus.valid, input[type="datetime-local"].valid, input[type="datetime-local"]:focus.valid,
    input[type="tel"].valid, input[type="tel"]:focus.valid, input[type="number"].valid, input[type="number"]:focus.valid,
    input[type="search"].valid, input[type="search"]:focus.valid, textarea.materialize-textarea.valid,
    textarea.materialize-textarea:focus.valid {
        border: 1px solid #4CAF50;
        box-shadow: 0 1px 0 0 #4CAF50;
    }

    input:not([type]).invalid, input:not([type]):focus.invalid, input[type="text"].invalid,
    input[type="text"]:focus.invalid, input[type="password"].invalid, input[type="password"]:focus.invalid,
    input[type="email"].invalid, input[type="email"]:focus.invalid, input[type="url"].invalid, input[type="url"]:focus.invalid,
    input[type="time"].invalid, input[type="time"]:focus.invalid, input[type="date"].invalid, input[type="date"]:focus.invalid, input[type="datetime"].invalid, input[type="datetime"]:focus.invalid, input[type="datetime-local"].invalid, input[type="datetime-local"]:focus.invalid, input[type="tel"].invalid, input[type="tel"]:focus.invalid, input[type="number"].invalid, input[type="number"]:focus.invalid, input[type="search"].invalid, input[type="search"]:focus.invalid, textarea.materialize-textarea.invalid, textarea.materialize-textarea:focus.invalid {
        border: 1px solid #F44336;
        box-shadow: 0 1px 0 0 #F44336;
    }

    .input-field.col label {
        left: 0.35rem;
        margin-top: -10px;
    }

</style>
{{--<link rel="stylesheet" href="{{url('css/frontend/booking.min.css')}}">--}}
<div class="container-fluid" style="text-align: center;background-color:darkgrey;">
    <h1 class="s-fon">Share Your Experience with Swotah</h1>
</div>
<div class="clear"></div>
<div class="container hoverable z-depth-5 center-align" style=";background-color:#ffffff;margin-bottom: 15px;">
    <form action = "/review" method = "post" id= "alignreview">
        <div class="row" >
            {{csrf_field()}}
            {{--<input type="hidden" name = "total_rating" value="0">--}}
            {{-- <div class="col l12 m12 s12" style="display: flex;">--}}
            {{--<div class="input-field col l6 m12 s12">--}}
            {{--<input type="text" name="title" class="validate" required >--}}
            {{--<label for="hoina" style="color: black;font-weight:bold;font-size: 18px;">Title for Your Experience </label>--}}
            {{--</div>--}}
            <div class="col s1 m1 l1"></div>
            <div class="input-field col l3 m3 s3">
                <input id="name" type="text"  name  = "name" class="validate" required>
                <label for="name" style="color: black;font-weight:bold;font-size: 18px;">Name</label>
            </div>
            <div class="input-field col l3 m3 s3">
                <input id="name" type="email" name  = "email" class="validate"
                       @if(Auth::user()) value="{{Auth::user()->email}}" @endif required>
                <label for="name" style="color: black;font-weight:bold;font-size: 18px;">Email</label>
            </div>
            <div class="input-field col l4 m4 s4" style="color: black;font-weight:bold;font-size: 18px;">
                <select onchange="this.className=this.options[this.selectedIndex].className" name = "country" required>
                    <option value="" disabled selected >Nationality</option>
                    @foreach($countries as $country)
                        <option value="{{$country['name']}}">{{$country['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col s1 m1 l1"></div>
            @if(!Request::is('test'))
                <div class="input-field col l3 m6 s3" style="color: black;font-weight:bold;font-size: 18px;">
                    <select onchange="this.className=this.options[this.selectedIndex].className" name = "trip_id" required>
                        <option value="" disabled selected >Select a Trip</option>
                        @if(!Request::is('trip/*'))
                            <option value="0">General</option>
                        @endif

                        @if(Request::is('/'))
                            @foreach($trips as $trip)
                                <option value="{{$trip->id}}">{{$trip->name}}</option>
                            @endforeach
                        @elseif(Request::is('destination/*'))
                            @foreach($destination->trips as $trip)
                                <option value="{{$trip->id}}">{{$trip->name}}</option>
                            @endforeach
                        @elseif(Request::is('region/*'))
                            @foreach($city->trips as $trip)
                                <option value="{{$trip->id}}">{{$trip->name}}</option>
                            @endforeach
                        @elseif(Request::is('trip/*'))
                            <option value="{{$trip->id}}" selected>{{$trip->name}}</option>
                        @elseif(Request::is('venture/*'))
                            @foreach($theme->trips as $trip)
                                <option value="{{$trip->id}}">{{$trip->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            @endif
        </div>

        <h5 class="center-align"><strong>How would you recommend us for your friends and family?</strong></h5>


        <div class="input-field stars" style="border: none; margin-top: -18px">
            <label class="ma-stars" style="color: black;font-weight:bold;font-size: 5px;">
            </label>
            <div class="pull-left">


                <input class="star star-1" id="exp-star-1" type="radio" name="overall" value = "1" required/>
                <label class="star star-1" for="exp-star-1"></label>
                <input class="star star-2" id="exp-star-2" type="radio" name="overall" value = "2"/>
                <label class="star star-2" for="exp-star-2"></label>
                <input class="star star-3" id="exp-star-3" type="radio" name="overall" value = "3"/>
                <label class="star star-3" for="exp-star-3"></label>
                <input class="star star-4" id="exp-star-4" type="radio" name="overall" value = "4"/>
                <label class="star star-4" for="exp-star-4"></label>
                <input class="star star-5" id="exp-star-5" type="radio" name="overall" value = "5"/>
                <label class="star star-5" for="exp-star-5"></label>
                <input class="star star-6" id="exp-star-6" type="radio" name="overall" value = "6"/>
                <label class="star star-6" for="exp-star-6"></label>
                <input class="star star-7" id="exp-star-7" type="radio" name="overall" value = "7"/>
                <label class="star star-7" for="exp-star-7"></label>
                <input class="star star-8" id="exp-star-8" type="radio" name="overall" value = "8"/>
                <label class="star star-8" for="exp-star-8"></label>
                <input class="star star-9" id="exp-star-9" type="radio" name="overall" value = "9"/>
                <label class="star star-9" for="exp-star-9"></label>
                <input class="star star-10" id="exp-star-10" type="radio" name="overall" value = "10"/>
                <label class="star star-10" for="exp-star-10"></label>

            </div>
        </div>




        {{--<div class="center-align">--}}
        {{--<strong class="" style="color:white; font-size: 20px;padding: 5px;"></strong>--}}
        {{--</div>--}}
        {{--<hr>--}}
        <div class="col s2 m2 l2"></div>

        <div class="col s9 m9 l9">
            <div class="input-field hide-on-med-and-down center-align">
            <textarea id="review0" name="review0" class="materialize-textarea" style="border: 1px solid black;
            color:black; min-height:200px;"
                      data-length="2000" required></textarea>
                <label for="review0" style="color: black;" id="changefont"> Describe the place and the activity,
                    Say what you liked best & least,
                    Give your insights and personal experience of a journey</label>
            </div>
        </div>
        <div class="col s2 m2 l2"></div>

        <div class="col s8 m8 l8">
            <div class="input-field col show-on-medium-and-down hide-on-med-and-up" >
                <textarea id="review1" name="review1" class="materialize-textarea" style="border: 1px solid black;" data-length="2000" required></textarea>
                <label for="review1">Your experience</label>
            </div>
        </div>
        <div id="modal1" class="modal">
            <div class="modal-content">
                <div class="row">
                    <h5 class="center-align">Would you like to provide detailed reviews? </h5>


                    <div class="input-field col l4 m12 s12 stars" >
                        <label class="ma-stars"><strong>Staff Rating:</strong></label><br>
                        <div class="pull-left in-stars">
                            <input class="star star-1" id="staff-star-1" type="radio" name="staff" value = "1"/>
                            <label class="star star-1" for="staff-star-1"></label>
                            <input class="star star-2" id="staff-star-2" type="radio" name="staff" value = "2"/>
                            <label class="star star-2" for="staff-star-2"></label>
                            <input class="star star-3" id="staff-star-3" type="radio" name="staff" value = "3"/>
                            <label class="star star-3" for="staff-star-3"></label>
                            <input class="star star-4" id="staff-star-4" type="radio" name="staff" value = "4"/>
                            <label class="star star-4" for="staff-star-4"></label>
                            <input class="star star-5" id="staff-star-5" type="radio" name="staff" value = "5"/>
                            <label class="star star-5" for="staff-star-5"></label>




                        </div>
                    </div>
                    <div class="input-field col l4 m12 s12 stars">
                        <label class="ma-stars"><strong>Price Value:</strong></label><br>
                        <div class="pull-left in-stars">
                            <input class="star star-1" id="value-star-1" type="radio" name="value" value = "1"/>
                            <label class="star star-1" for="value-star-1"></label>
                            <input class="star star-2" id="value-star-2" type="radio" name="value" value = "2"/>
                            <label class="star star-2" for="value-star-2"></label>
                            <input class="star star-3" id="value-star-3" type="radio" name="value" value = "3"/>
                            <label class="star star-3" for="value-star-3"></label>
                            <input class="star star-4" id="value-star-4" type="radio" name="value" value = "4"/>
                            <label class="star star-4" for="value-star-4"></label>
                            <input class="star star-5" id="value-star-5" type="radio" name="value" value = "5"/>
                            <label class="star star-5" for="value-star-5"></label>



                        </div>
                    </div>
                    <div class="input-field col l4 m12 s12 stars">
                        <label class="ma-stars"><strong>Meals:</strong></label><br>
                        <div class="pull-left in-stars">
                            <input class="star star-1" id="meal-star-1" type="radio" name="meal" value = "1"/>
                            <label class="star star-1" for="meal-star-1"></label>
                            <input class="star star-2" id="meal-star-2" type="radio" name="meal" value = "2"/>
                            <label class="star star-2" for="meal-star-2"></label>
                            <input class="star star-3" id="meal-star-3" type="radio" name="meal" value = "3"/>
                            <label class="star star-3" for="meal-star-3"></label>
                            <input class="star star-4" id="meal-star-4" type="radio" name="meal" value = "4"/>
                            <label class="star star-4" for="meal-star-4"></label>
                            <input class="star star-5" id="meal-star-5" type="radio" name="meal" value = "5"/>
                            <label class="star star-5" for="meal-star-5"></label>




                        </div>
                    </div>
                    <div class="input-field col l4 m12 s12 stars">
                        <label class="ma-stars"><strong>Accomodation:</strong></label><br>
                        <div class="pull-left in-stars">
                            <input class="star star-1" id="accomodation-star-1" type="radio" name="accomodation" value = "1"/>
                            <label class="star star-1" for="accomodation-star-1"></label>
                            <input class="star star-2" id="accomodation-star-2" type="radio" name="accomodation" value = "2"/>
                            <label class="star star-2" for="accomodation-star-2"></label>
                            <input class="star star-3" id="accomodation-star-3" type="radio" name="accomodation" value = "3"/>
                            <label class="star star-3" for="accomodation-star-3"></label>
                            <input class="star star-4" id="accomodation-star-4" type="radio" name="accomodation" value = "4"/>
                            <label class="star star-4" for="accomodation-star-4"></label>
                            <input class="star star-5" id="accomodation-star-5" type="radio" name="accomodation" value = "5"/>
                            <label class="star star-5" for="accomodation-star-5"></label>




                        </div>
                    </div>
                    <div class="input-field col l4 m12 s12 stars">
                        <label class="ma-stars"><strong>Transportation:</strong></label><br>
                        <div class="pull-left in-stars">
                            <input class="star star-1" id="transportation-star-1" type="radio" name="transportation" value = "1"/>
                            <label class="star star-1" for="transportation-star-1"></label>
                            <input class="star star-2" id="transportation-star-2" type="radio" name="transportation" value = "2"/>
                            <label class="star star-2" for="transportation-star-2"></label>
                            <input class="star star-3" id="transportation-star-3" type="radio" name="transportation" value = "3"/>
                            <label class="star star-3" for="transportation-star-3"></label>
                            <input class="star star-4" id="transportation-star-4" type="radio" name="transportation" value = "4"/>
                            <label class="star star-4" for="transportation-star-4"></label>
                            <input class="star star-5" id="transportation-star-5" type="radio" name="transportation" value = "5"/>
                            <label class="star star-5" for="transportation-star-5"></label>




                        </div>
                    </div>
                    <div class="input-field col l4 m12 s12 stars">
                        <label class="ma-stars"><strong>Guide & Porter:</strong></label><br>
                        <div class="pull-left in-stars">
                            <input class="star star-1" id="guide-star-1" type="radio" name="guide" value = "1"/>
                            <label class="star star-1" for="guide-star-1"></label>
                            <input class="star star-2" id="guide-star-2" type="radio" name="guide" value = "2"/>
                            <label class="star star-2" for="guide-star-2"></label>
                            <input class="star star-3" id="guide-star-3" type="radio" name="guide" value = "3"/>
                            <label class="star star-3" for="guide-star-3"></label>
                            <input class="star star-4" id="guide-star-4" type="radio" name="guide" value = "4"/>
                            <label class="star star-4" for="guide-star-4"></label>
                            <input class="star star-5" id="guide-star-5" type="radio" name="guide" value = "5"/>
                            <label class="star star-5" for="guide-star-5"></label>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="center-align" style="margin-top: 20px;">
            <button type="submit"  class="btn waves-effect waves-light">Submit your review</button>
        </div>
    </form>
</div>