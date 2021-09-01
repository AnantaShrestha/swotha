@extends('layouts.master')
@section('title')
    Fixed Departures | Swotah Travel and Adventure
@endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="Fixed Departures | Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <style>
        #departureTable_filter label input {
            border: 1px solid #777 !important;
        }

        #departureTable_length {
            /* display: flex; */
            float: left;
        }

        div.dataTables_wrapper div.dataTables_filter {
            float: right;
        }

        #departureTable thead {
            background: #111;
            color: #fff;
            font-size: 12px;
        }

        #departureTable tbody {
            font-size: 13px;
        }

        #departureTable_filter label input {
            border: 1px solid #ddd;
            line-height: 35px;
        }

        #departureTable_info {
            float: left;
        }

        div.dataTables_wrapper div.dataTables_info {
            padding-top: 0px !important;
        }

        table.dataTable thead .sorting::before, table.dataTable thead .sorting_asc::before, table.dataTable thead .sorting_desc::before, table.dataTable thead .sorting_asc_disabled::before, table.dataTable thead .sorting_desc_disabled::before {

            font-size: 18px;
        }

        .paginate_button.current {
            background: #111;
        }

        table.dataTable thead .sorting::after, table.dataTable thead .sorting_asc::after, table.dataTable thead .sorting_desc::after, table.dataTable thead .sorting_asc_disabled::after, table.dataTable thead .sorting_desc_disabled::after {
            font-size: 18px;
        }

        #departureTable {
            border: 1px solid #ddd;
        }

        #departureTable_previous {
            background: #111;
            color: #fff;
            padding: 5px 7px;
        }

        #departureTable_next {
            background: #111 /*#0161ba*/;
            color: #fff;
            padding: 5px 7px;
        }

        .paginate_button {
            background: #fc0;
            padding: 5px 7px;
            color: #fff;
        }

        .top-payment img {
            margin-top: -11px !important;
        }
    </style>
@endsection
@section('content')
    <?php
    use App\HoldDates;
    ?>
    @include('layouts.navbar')
    <div class="container">
        <div class="section-title-black mt-30">
            <h2>Fixed Departures</h2>
            <div class="title-bg">
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
            </div>
        </div>
    </div>
    <section class="all-departure-table pb-30">
        <div class="container">
            <div class="fix-dep">
                <table class="table table-striped  table-hover " id="departureTable">
                    <thead>
                    <tr>
                        <th>Trip Name</th>
                        <th>Gallery</th>
                        <th>Seats Availability</th>
                        <th>Departure Date</th>
                        <th>Days</th>
                        @if(Auth::user())
                            <th>Price</th>
                        @endif
                        <th>Reserve</th>
                        <th>Book</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($allfixed))
                        @foreach($allfixed as  $deal)
                            <tr>
                                <td><a href="/{{$deal->trips->slug}}" target="_blank" style="color:#111">{{$deal->trips->name}}</a></td>
                                <td><a href="/{{$deal->trips->slug}}" target="_blank">
                                        <img src="{{url('images/trips/thumbnail/'.$deal->trips->cover_image)}}"
                                             class="imgallery lazyload" alt="{{$deal->trips->name}}"
                                             style="width:100px">
                                    </a></td>

                                <td>
                                 <span class="waves-effect waves-light tableBtn lastmintooltipBtn tooltipped"
                                       style="color:white;
                                               background-color: @if($deal->remainingseats >= 10) #20a56e @elseif($deal->remainingseats >= 5)
                                               #d5d50b @else red @endif" data-tooltip="
                                    @if($deal->remainingseats >= 10)
                                         There are good number of seats available. Be one of the first ones to book the trip for this date!
@elseif($deal->remainingseats >= 5)
                                         Only limited seats are available for this departure date. Please make sure to book or hold as soon as possible!
@else
                                         The number of seats for this trip is almost full or may not be available. Please leave an enquiry for more details!
@endif" data-position="top"> Available
                            </span>
                                </td>
                                <td>{{$deal->start_date}}</td>
                                <td>{{$deal->trips->days}} days</td>
                                @if(Auth::user())
                                    <td><strike style="">$ {{$deal->trips->price}}<br></strike>
                                        <span style="color:#D8343D;font-size:15px; font-weight: 600;">
                                        <i class="fa fa-fire" aria-hidden="true"></i> $ {{round($deal->price - $deal->discount/100 * $deal->price)}}</span>
                                    </td>
                                @endif
                                @if(strtotime($deal->start_date) > strtotime('-1 month ago'))
                                    <td>
                                        <?php
                                        if (Auth::user()) {
                                            $seats = HoldDates::where([
                                                ['user_id', '=', Auth::user()->id],
                                                ['is_confirmed', '=', 1],
                                            ])->get();
                                            $singleTotal = 0;
                                            $allTotal = 0;
                                            $temp = 0;
                                            foreach ($seats as $seat) {
                                                if ($deal->id == $seat->trip_id) {
                                                    if (strtotime($seat->trips->start_date) == strtotime($deal->start_date)) {
                                                        $singleTotal += $seat->seats;
                                                    }
                                                }

                                                $allTotal += $seat->seats;
                                            }
                                        }
                                        ?>
                                        @if($deal->remainingseats > 0)
                                            @if((Auth::user()))
                                                <a onclick="holdPop({{$deal->id}})"
                                                   class="waves-effect waves-light tableBtn lastminBookBtn  modal-trigger tooltipped hbb"
                                                   data-tooltip="Please note that if seats are available, you can hold up to 7 seats of any
                                        particular trip, and 14 seats in total, at a given period of time.">Reserve</a>
                                            @else
                                                <a class="waves-effect waves-light tableBtn lastminBookBtn  hbb"
                                                   href="/login"
                                                   title="Login to Hold">Reserve</a>
                                            @endif
                                        @endif

                                        {{--this is change--}}
                                        <div id="hold{{$deal->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width:400px">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Reserve</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;
                                                        </button>

                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="font-size:12px;margin-bottom:5px">Please note that if
                                                            seats are available, you can hold up to 7 seats of any
                                                            particular trip, and 14 seats in total, at a given period of
                                                            time.</p>
                                                        <form action="/hold/{{$deal->id}}" method="post" id="form">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name='deal_id' value="{{$deal->id}}">
                                                            <div class="form-group">
                                                                <select name="seats" id="seats" class="form-control">
                                                                    <option selected disabled="disabled">Select No. Of
                                                                        Seats
                                                                        to Reserve
                                                                    </option>
                                                                    <?php
                                                                    if ($deal->remainingseats > 7) {
                                                                        $seats = 7;
                                                                    } else {
                                                                        $seats = $deal->remainingseats;
                                                                    }
                                                                    ?>
                                                                    @for($i=1; $i<=7; $i++)
                                                                        <option value="{{$i}}"
                                                                        @if(Auth::user() && (((($singleTotal+$i) > 7))|| ((($allTotal+$i)) > 14) || ($i > $deal->remainingseats)))
                                                                            {{'disabled'}}
                                                                                @endif
                                                                        >{{$i}}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit"
                                                                        class="reserve-submit-btn" name="submit"
                                                                        @if(Auth::user() && (($allTotal+1) > 14 || ($singleTotal+1) > 7)))
                                                                        {{'disabled'}}
                                                                        @endif
                                                                >
                                                                    Continue
                                                                </button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--endof hold pop up--}}

                                    </td>
                                @else
                                    <td>
                                        <span style="visibility:hidden;"> . </span>
                                    </td>
                                @endif

                                <td><a href="/book/{{$deal->id}}" class="waves-effect waves-light  tableBtn">Book</a>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <!--/Table -->
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            let targets;
            @if(Auth::user())
                targets=[1,2,6,7];
            @else
                targets=[1,2,5,6];
            @endif
            $('#departureTable').DataTable({
                "processing": true,
                "responsive": false,
                "columnDefs": [
                    { "orderable": false, "searchable":false ,"targets": targets }
                ]
            });
            
        });
        function holdPop(id)
            {
                $('#hold'+id).modal('show');
            }
    </script>
@endsection

