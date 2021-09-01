@extends('layouts.master')
@section('title')
{{$about->aboutname}} | Swotah Travel and Adventure
@endsection
@section('innertop','inner-top')
@section('metatags')
{{--Here goes all the meta information for index page--}}
@if( $about->meta_title != null )
<meta name="title" content="{{$about->meta_title}}">
@else
<meta name="title" content="About us - Swotah Travel and Adventure">
@endif
@if($about->meta_description != null)
<meta name="description" content="{{$about->meta_description}}">
@else
<meta name="description"
content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
@endif
@if($about->meta_keywords != null)
<meta name="keywords" content="{{$about->meta_keywords}}">
@else
<meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endif
@endsection
{{--End of meta tags--}}
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('styles')
<style type="text/css">
  .top-payment img {
  }

  table {
    width: auto !important;
  }
</style>
@endsection
@section('content')
@include('layouts.navbar')
    <!--  <div class="Modern-Slider">
      <div class="inner-bg-img" style="background:url('asset('/images/about/cover/'.$about->cover_image)');">
          <div class="inner-bg">
              <div class="container">
                  <div class="inner-heading pb-150">
                      <h1>{{$about->aboutname}} </h1>
                  </div>
                  
              </div>
          </div>
      </div>
    </div> -->
    <section class="all-footer-inner-page">
      <div class="container">
        @if($about)
        <div class="section-title-black">
          <h2>{{$about->aboutname}}</h2>
          <div class="title-bg">
            <span class="line-bg"></span>
            <span class="line-bg"></span>
            <span class="line-bg"></span>
            <span class="line-bg"></span>
            <span class="line-bg"></span>
          </div>
        </div>
        <div class="allfooter-content">
          {!! $about->content !!}
          @if($sections)

          
          <div class="row" style="margin-top:30px">
           @foreach($sections as $section)
           <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="csr-img">
             <a href="/{{$about->slug}}/detail-{{$section->id}}">
              <img class="responsive-img lazyload"
              src="{{url('images/about/'.$section->cover_image)}}"
              style="width:100%;height:330px;" alt="{{$section->title}}">
              <!-- <img src="https://www.swotahtravel.com/images/about/file-284.jpg"> -->
            </a>
          </div>
          <div class="csr-content">
            <div class="card-title-csr">{{$section->title}}</div>

            <p>
              {!! substr($section->description, 0, 200) !!}
              <a href="/{{$about->slug}}/detail-{{$section->id}}">...(Continue Reading)</a>
            </p>
          </div>
        </div>
        @endforeach
      </div>
      @endif
    </div>
    @else
    <h2 style="text-align: center; padding: 100px;">THE PAGE IS UNDER CONSTRUCTION</h2>
    @endif

  </div>
</section>
@endsection
