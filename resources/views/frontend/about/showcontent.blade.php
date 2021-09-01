@extends('layouts.master')
@section('title')
    Corporate Social Responsibility | Swotah Travel and Adventure
@endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="Corporate Social Responsibility | Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
{{--End of meta tags--}}
{{--External css--}}
@section('styles')
    <link rel="stylesheet" href="{{url('css/frontend/destination.min.css')}}">
    <style>
        table td {
            border: 2px solid black;
        }

    </style>
@endsection
{{--end of content--}}
{{--Start of content section--}}
@section('content')
    {{--Navbar--}}
    @include('layouts.navbar')
    {{--Navbar End--}}
    {{--Index page image and video--}}
    <br>
    <br>
    <br>

  <!--   @if($contents)
       
        <h1 class="titleHeadtwo"><span> Corporate Social Responsibility </span></h1>
        <p style="text-align:center;">
            <img class="responsive-img" src="{{url('images/about/'.$contents->cover_image)}}"
                 style="width:600px;min-height:400px;" alt="Corporate Social Responsibility"></p>
        <div class="container row">
            <p class="card">
                {!! $contents->description !!}
            </p>
            @foreach($contents->images as $c)
                <div class="col s12 m6">
                    <div class="card">
                        <img class="responsive-img lazyload" data-src="{{url('images/about/'.$c->image)}}"
                             style="dth:600px;height:400px" alt="Corporate Social Responsibility">
                    </div>
                </div>
            @endforeach
        </div>
    @endif -->

     <section class="all-footer-inner-page">
      <div class="container">
    @if($contents)
        <div class="section-title-black">
          <h2> Corporate Social Responsibility </h2>
          <div class="title-bg">
            <span class="line-bg"></span>
            <span class="line-bg"></span>
            <span class="line-bg"></span>
            <span class="line-bg"></span>
            <span class="line-bg"></span>
          </div>
        </div>
        <div class="allfooter-content">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                     <p>
                     <img class="responsive-img" src="{{url('images/about/'.$contents->cover_image)}}"
                            style="width:100%;" alt="Corporate Social Responsibility"></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="csr-content">
                      <p>{!! $contents->description !!}
                    </div>
                    <div class="row" style="margin-top:30px">
                         @foreach($contents->images as $c)
                        <div class='col-lg-4 col-md-4 col-sm-12'>
                            <div class="cs-img">
                                <img style="width:100%" class="responsive-img lazyload" src="{{url('images/about/'.$c->image)}}"
                              alt="Corporate Social Responsibility">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
           
        </div>
    @endif

  </div>
</section>
@endsection