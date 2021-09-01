@extends('layouts.master')
@section('title')
    FAQ | Swotah Travel and Adventure
@endsection
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="FAQ | Swotah Travel and Adventure">
    <meta name="robots" content="noindex">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">

@endsection
@section('styles')
    <style type="text/css">
        .top-payment img {
            margin-top: -11px !important;
        }

        .tabwrapper.center-block {
            height: auto;
        }

        .panel-body p {
            font-size: 12px;
            font-weight: 500;
        }

        .blog-side-nav ul li {
            line-height: 40px !important;
        }
    </style>
@endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('content')
    @include('layouts.navbar')
    <section class="inner-page-heading-title pt-30">
        <div class="container">
            <div class="section-title-black">
                <h2>FAQ</h2>
                <div class="title-bg">
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                    <span class="line-bg"></span>
                </div>
            </div>

        </div>
    </section>
    <section class='all-faq'>
        <div class="container">
            <div class="row ml-0 mr-0">
                <div class="col-lg-3 col-md-3 col-sm-12 pl-0 ">
                    <div class="blog-side-nav " id="sidesbar">
                        <div class="blog-menu">
                            <button>Menu</button>
                        </div>
                        <ul class="faq-tabs">

                            @foreach($faq as $key=>$topic)
                                @if(count($topic->questions) > 0)
                                    <li><a class="scroll__to" href="#{{str_replace(' ', '', $topic->topic )}}"
                                           @if($key==0) class="active" @endif>{{$topic->topic}}</a></li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 pr-0 ">
                    <div class="faq-bg">
                        @foreach($faq as $one)
                            @if(!empty($one->questions) && count($one->questions) > 0)
                                <div id="{{str_replace(' ', '', $one->topic )}}" class="inner-package-head-title mb-20 page-scroll">
                                    <h3>{{$one->topic}}</h3>
                                </div>
                                <div class="tabwrapper center-block mb-20">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        @foreach($one->questions as $question)

                                            <div class="faqs panel panel-default">
                                                <div class="panel-heading active" role="tab" id="{{$question->id}}">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                           href="#collapse{{$question->id}}" aria-expanded="true"
                                                           aria-controls="collapse{{$question->id}}">
                                                            {{$question->question}}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse{{$question->id}}" class="panel-collapse collapse in"
                                                     role="tabpanel" aria-labelledby="{{$question->id}}">
                                                    <div class="panel-body">
                                                        {!! $question->description !!}

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(window).scroll(function () {
            var scrollDistance = $(window).scrollTop();
            $('.page-scroll').each(function (i) {
                if ($(this).position().top <= scrollDistance) {
                    $('.faq-tabs li a.active').removeClass('active');
                    $('.faq-tabs li a').eq(i).addClass('active');
                }
            });
        }).scroll();
    </script>
    <script type="text/javascript">
        $('.blog-menu').on('click', function () {
            $('.faq-tabs').toggle();
        });
        $('.scroll__to').click(function () {
            $('html, body').animate({
                scrollTop: $($(this).attr('href')).offset().top - 100

            }, 500);

            return false;
        });
    </script>
@endsection