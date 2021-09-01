@extends('layouts.master')
@section('title')
    {{$destination->country_name}} | Swotah Travel and Adventure
@endsection

@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="{{$destination->country_name}} | Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
    <link rel="canonical" href="{{route('show-path',$destination->slug)}}">

@endsection
{{--End of meta tags--}}
{{--External css--}}
@section('styles')
    <style type="text/css">
        .top-payment img {
            margin-top: -11px !important;
        }
    </style>
@endsection
{{--end of content--}}
{{--Start of content section--}}

@section('content')
    @include('layouts.navbar')
    <div class="Modern-Slider">
        <div class="inner-bg-img" style="  background:url('{{url('images/tripPackages/cover/'.$destination->image)}}');background-size:cover;background-repeat: no-repeat;">
        <!-- <img class="responsive-img" src="{{url('images/tripPackages/cover/'.$all->image)}}"
                                   alt="{{$all->title}}"> -->
            <div class="inner-bg">
                <div class="container">
                    <div class="inner-heading">
                        <h1>
                            {{$destination->country_name}}
                            <div class="title-bg">
                                <span class="line-bg"></span>
                                <span class="line-bg"></span>
                                <span class="line-bg"></span>
                                <span class="line-bg"></span>
                                <span class="line-bg"></span>
                            </div>
                        </h1>

                    </div>
                    <div class="cateogry_package_content">

                        <p>{{$destination->about}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="inner-package-list">
        <div class="container">
            <div class="row">
                @foreach($destination->cities as $region)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 mb-30">
                        <div class="inner-package-list-single">
                            <div class='package-list-img'>
                                <img src="{{url('images/cities/thumbnail/'.$region->cover_image)}}"
                                      alt="{{$region->name}}">

                            </div>
                            <div class="package-list-detail">
                                <div class="package-list-head">
                                    <h3><i class="fa fa-map-marker"></i>&nbsp;&nbsp;
                                        <a href="/{{$region->slug}}">{{$region->name}}</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
 <!--    @include('layouts.reviewForm')
    @include('layouts.nayareview') -->
@endsection
@section('scripts')
@endsection
