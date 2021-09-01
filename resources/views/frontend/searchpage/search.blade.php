@extends('layouts.master')
@section('title')
    Search Trips
@endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('metatags')
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('css/instantsearch.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/search.css')}}">
    <style type="text/css">
        .ais-body.ais-clear-all--body div {
            color: #fc0;
            font-size: 27px;
        }

        .top-payment img {
            margin-top: -11px !important;
        }
    </style>
@endsection

@section('content')
    @include('layouts.navbar')
    <section class="search-page pt-30 pb-30">
        <div class="row ml-0 mr-0">
            <div class="col-lg-3 col-md-3 col-sm-12 pl-0 fixed-side-bar">
                <div class="blog-side-nav " id="sidesbar">
                    <ul id="search-nav-bar" class="blog-ul-nav fixed-ul-nav">
                        <div id="clear-all"></div>
                        <br>
                        <div class="facet" id="price"></div>
                        <div class="facet" id="days"></div>
                        <div class="facet" id="altitude"></div>
                        <div class="facet" id="physical_rating"></div>
                        <div class="facet" id="poplularity"></div>
                        <div class="facet" id="traveldeal"></div>
                        <div class="facet" id="special_discount"></div>
                        <div class="facet" id="ratings">
                        </div>
                        <div class="facet" id="style">
                        </div>
                        <div class="facet" id="start_location">
                        </div>
                        <div class="facet" id="dates">
                        </div>
                        <div class="facet" id="venture">
                        </div>
                        <div class="facet" id="regions">
                        </div>
                        <div class="facet" id="country">
                        </div>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 pr-0 scroll-height">
                <div id="results">
                    <div class="search-wrapper">
                        <!-- <h2  class="titleHeadtwo"> <span class="reviewTitle"> Search </span> </h2> -->
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div id='search1-box'>
                                    <div class="formContent homesearchBox">
                                        <input id="q" value="{{$query}}" placeholder="Search more trips"
                                               class="searchAlgoinput">
                                    </div>
                                </div>
                            </div>
                            <span class="col-md-2" id="sort-by-price"></span>
                            <span class="col-md-2" id="sort-by-day"></span>
                        </div>
                    <!--  <img height="30px" style="float: right; top: 30px; margin-top: -66px;" width="30px"
                        src="{{url('images/algolia.svg')}}" alt="algolia"> -->
                    </div>
                    <div class="card-panel panelHead">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12" id="stats"></div>
                            <div class="col-lg-5 col-md-3 col-sm-12"></div>

                            <!-- <div class="col-md-2" id="sort-by-rating"></div> -->
                        </div>
                    </div>
                    {{--yaha chai results haru aaucha search ko--}}
                    <div id="hits"></div>
                </div>
                <div id="pagination"></div>

            </div>
        </div>
    </section>
    <div id="modal20" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-body">
                    <a class="modal-action close btn center" type="button" data-dismiss="modal" style="width:100%;">Click
                        to select another trip </a>
                </div>

            </div>

        </div>
    </div>
    <div id="modal2" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body" style="text-align:center">
                    You have selected two trips. You can compare these trips or add another. <br><br>
                    <a class="modal-action close  btn center" type="button" data-dismiss="modal" style="width:100%;">Add
                        another trip</a>
                    <span class="CompareOr">OR</span>
                    <a href="javascript:ViewComparison();" class="modal-action close  btn center" type="button"
                       data-dismiss style="width:100%;">Compare Trips</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/instantsearch.min.js')}}"></script>
    <script src="{{asset('js/plugin/search.js')}}"></script>
    <script src="{{asset('js/plugin/compare.js')}}"></script>
    <script src="{{asset('js/plugin/nicescroll.js')}}"></script>
    <script type="text/javascript">
        overscroll($('#search-nav-bar'));

        function overscroll(classname) {
            $(classname).niceScroll({
                cursorcolor: "#777",
                cursoropacitymin: 0.3,
                background: "#ddd",
                cursorborder: "0",
                autohidemode: false,
                cursorminheight: 30
            });

            $(classname).getNiceScroll().resize();
            $("html").mouseover(function () {
                $(classname).getNiceScroll().resize();
            });
        }
    </script>
@endsection



