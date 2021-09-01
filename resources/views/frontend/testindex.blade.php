@extends('layouts.master')
@section('content')
    @include('layouts.navbar')
    <div class="Modern-Slider">
        <!-- Item -->
        @foreach($coverImages as $image)
            <div class="item">
                <div class="img-fill">
                    <img data-src="{{$image->image_url}}" src="{{$image->image_url}}" class="lazyload" alt="">
                    <div class="info">
                        <div>
                            <h3>
                                {{$image->title}}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <section class="search-bar">
        <div class="container">
            <form class="header-search-form" action="{{route('search')}}">
                <input type="text" placeholder='@if($searchbar!=null) {{$searchbar->content}} @endif' type='text'
                       onfocus="this.placeholder = ''"
                       onblur="this.placeholder = '@if($searchbar!=null) {{$searchbar->content}} @endif'" name="q">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </section>
    @include('frontend.indexlayout.trippackages')
    @include('frontend.indexlayout.new1slider')
    @include('frontend.indexlayout.lastminute')
    @include('frontend.indexlayout.blogs')
    @include('layouts.reviewForm')
    @include('layouts.nayareview')
    @include('frontend.indexlayout.ourteam')
    @include('frontend.indexlayout.counter')
@endsection
@section('scripts')
    <script>

    </script>
@endsection