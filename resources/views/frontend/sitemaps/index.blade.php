@extends('layouts.master')
@section('title') Sitemap | Swotah Travel and Adventure @endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="Deposit and Cancellation Policy   | Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
{{--End of meta tags--}}
@section('styles')
    <style type="text/css">
        .video-section {
            display: block;
            overflow: hidden;
        }

        .white-bg {
            background: #f2f2f2;
            padding: 5px;
            box-shadow: 0px 0px 5px #000;
        }

        .video-image {
            position: relative;
        }

        .video-image img {
            width: 100%;

        }

        .play-icon a {
            left: 43%;
            top: 41%;
            position: absolute;
            background: rgba(255, 204, 0, 0.7);
            height: 60px;
            width: 60px;
            border-radius: 50%;
            text-align: center;
        }

        .play-icon a i {
            font-size: 21px;
            color: #fff;
            line-height: 60px;
        }

        .video-title h2 {
            margin-top: 5px;
            text-align: center;
            font-size: 14px;
            font-weight: 600;

        }

        .modal-dialog {
            max-width: 700px !important;
        }

        .video-description {
            background: #f2f2f2;
            padding: 5px;
        }

        .video-description h4 {
            font-size: 14px;
            font-weight: 600;
        }

        .video-description p {
            font-size: 13px;
            line-height: 20px;
        }

        .top-payment img {
            margin-top: -11px !important;
        }
    </style>
@endsection
@section('content')
    @include('layouts.navbar')
    <div class="container">
        <div class="section-title-black mt-30">
            <h2>Sitemaps</h2>
            <div class="title-bg">
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
            </div>
        </div>
    </div>
    <section class="video-section pb-30">
        <div class="container">
            @if(count($sitemapsDetails) >0 )
                <div class='row'>
                    @foreach($sitemapsDetails as $siteD)
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="white-bg">
                                <div class="video-image">
                                <!-- {{url('images/sitemaps/'.$siteD->sitemap_image)}} -->
                                    <img src="https://www.swotahtravel.com/images/sitemaps/swotah-travel-and-adventure-website-overview-1528976801.jpg">
                                    <div class="play-icon">
                                        <a class="play-tigger" onclick="videoPlay({{$siteD->id}})"
                                           href="javascript::"><i class="fa fa-play"></i></a>
                                    </div>
                                </div>
                                <div class="video-title">
                                    <h2>{{$siteD->sitemap_title}}</h2>
                                </div>
                            </div>
                        </div>
                        {{--videomodal--}}
                        <div id="videoModal{{$siteD->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{$siteD->sitemap_title}}</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="video-frame">
                                            {!! $siteD->sitemap_link !!}
                                        </div>
                                        <div class="video-description">
                                            <h4>Description</h4>
                                            <p>{!! $siteD->sitemap_description !!}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{--endmodal--}}

                    @endforeach
                </div>
            @else
                <div style="text-align: center;min-height: 300px;font-size:21px;color:#111">
                    <p> NO SITEMAP IS AVAILABLE</p>
                </div>

            @endif
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        function videoPlay(id) {
            $('#videoModal' + id).modal('show');
        }
    </script>
@endsection