@extends('layouts.master')
@section('title')
    <title> Swotah Travel and Adventure | My Wishlist </title>
@endsection
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="description" content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
{{--End of meta tags--}}
{{--External css--}}
@section('styles')
    <link rel="stylesheet" href="{{url('css/frontend/index.min.css')}}">
@endsection
{{--end of content--}}
{{--Start of content section--}}
@section('content')
    {{--Navbar--}}
    @include('layouts.navbar')
    {{--Navbar End--}}
    {{--Index page image and video--}}
    <img class="responsive-img img-content" src="{{url('blog_image/chitwan/chi2.jpeg')}}" alt="">
    <div class="container">
        <form class = "form" action="{{route('search')}}">
            <div class="input-field input-field-composed input-field-home">
                <input id="search" class="type-effect input-boxed" type="text" name="q" placeholder="" required>
                <button type="submit" class="btn btn-composed-input" id="search-btn-cover">
                    <i class="material-icons" style=" color: white!important;
                        font-size: 2.3rem; margin-left: -13px; margin-top: -4px;">search</i>
                </button>
            </div>
        </form>
    </div>
    {{--End of images and videos--}}
    <div class="clear first"></div>
    {{--Start of popular destinations--}}
    <div class="container">
        <div class = "title-wrapper">
          <span class="title teal">
              <strong class = "flow-text">BucketList</strong><!--Padding is optional-->
          </span>
        </div>
    </div>
    <div class="first clear"></div>
    <div class="row" id = "items">
        @foreach($wishes as $wish)
            <div class="col l4 m6 s12">
                <a href="/trip/{{$wish->trips->slug}}">
                    <div class="card indexproducts z-depth-5 waves-effect waves-block waves-light">
                        <div class="card-image indexprodimage">
                            <img data-src="images/trips/thumbnail/{{$wish->trips->cover_image}}" class="lazyload" alt="{{$wish->trips->name}}">
                            <span class="card-title" style = "background:#37474f;padding:0px">{{$wish->trips->name}}</span>
                            <a href = "/removewish/{{$wish->id}}"  class="btn-small btn-floating halfway-fab waves-effect waves-light push red tooltipped"
                               data-position="bottom" data-delay="10" data-tooltip="Remove from Bucket list">
                                <i class="material-icons">favorite</i>
                            </a>
                            <a href="/trip/{{$wish->trips->slug}}#departures" class="btn-small green btn-floating  halfway-fab waves-effect waves-light tooltipped"
                               data-position="bottom" data-delay="10" data-tooltip="View Departure Dates"><i class="material-icons">date_range</i>
                            </a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="clear"></div>
    {{--Start of  Reviews--}}
    @include('layouts.reviewForm')
    @include('layouts.nayareview')
    @include('layouts.footer')
@endsection
@section('scripts')
@endsection



