@extends('layouts.master')
@section('title')
    @if(!empty($seo->meta_title))
        {{$seo->meta_title}}sdsd
    @else
        Blogs | Swotah Travel and Adventure
    @endif
@endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    @if(!empty($seo->meta_title))
        <meta name="title" content="{{$seo->meta_title}} | Swotah Travel and Adventure">
    @else
        <meta name="title" content="Blogs | Swotah Travel and Adventure">
    @endif
    @if(!empty($seo->meta_description))
        <meta name="description" content="{{$seo->meta_description}}">
    @else
        <meta name="description"
              content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    @endif

    @if(!empty($seo->keywords))
        <meta name="keywords" content="{{$seo->keywords}}">
    @else
        <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
    @endif
    <link rel="canonical" href="{{route('blog-path',$blog->slug)}}">
    <meta property="og:url" content="https://www.swotahtravel.com/blogs/{{$blog->slug}}"/>
    {{--<meta property="og:description" content="{!! $blog->article !!}" />--}}
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{ucfirst($blog->title)}}"/>
    <meta property="og:image" content="{{url('images/blogs/cover/'.$blog->cover_image)}}"/>
    <meta property="og:description"
          content="@if(!empty($seo->meta_description)) {{ucfirst($seo->meta_description)}} @endif"/>
@endsection
@section('styles')
    <style type="text/css">
        .top-payment img {
            margin-top: 0px !important;
        }
    </style>
@endsection

{{--end of content--}}
{{--Start of content section--}}
@section('content')
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    @include('layouts.navbar')
    <section class="allblogs mt-30">
        <div class="container">
            <div class="row ml-0 mr-0">
                <div class="col-lg-3 col-md-3 col-sm-12 pl-0 ">
                    <div class="blog-side-nav " id="sidesbar">
                        <div class="blog-menu" style="padding-top:5px">
                            <button>Menu</button>
                        </div>
                        <ul class="blog-ul-nav">
                            <li><a href="/blogs">All Blog</a></li>
                            @foreach($categories as $category)
                                <li @if(!empty($cat_id))
                                    @if($category->id == $cat_id)
                                    class="active"
                                    @endif
                                    @endif style="border-bottom: 1px solid grey">
                                    <a href="{{route('blog-path',$category->slug)}}">{{$category->title}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 pr-0">
                    <div class="blog-con-bg">
                        <div class="single-blog-head">
                            <div class="single-blog-user-img">
                                @if($blog->profile != null)
                                    <img src="{{url('images/blogs/profile/'.$blog->profile)}}"
                                         alt="Blog image"
                                         style="">
                                @elseif($blog->user->photo != null)
                                    <img src="{{url('images/profile/'.$blog->user->photo)}}"
                                         alt="Blog image"
                                         style="">
                                @else
                                    <img src="{{url('images/user.png')}}"
                                         alt="Blog image"
                                         style="">
                                @endif
                            </div>
                            <div class="single-blog-title">
                                <h1>Best Treks to do in Nepal in a Week or Less</h1>
                            </div>
                        </div>
                        <div class="author-blog">
                            <div class="single-blog-auth-date-view">
                                <p><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Written by : {{ucfirst($blog->author)}}
                                </p>
                                <p>
                                    <i class="fa fa-calendar"></i>&nbsp;&nbsp; {{date('M d, Y', strtotime($blog->created_at))}}
                                </p>
                                <p><i class="fa fa-eye"></i>&nbsp;&nbsp;71 Views</p>
                            </div>

                        </div>
                        <div class="share-social">
                            <div class="flex-box">
                                <li><a class="twitter-share-button"
                                       href="https://twitter.com/intent/tweet?url=https://www.swotahtravel.com/blogs/{{$blog->slug}}&text={{ucfirst($blog->title)}};
                                                            twitterBtn.href = shareUrl">
                                        <i class="fab fa-twitter"></i> Tweet</a></li>
                                <li>
                                    <div class="fb-share-button"
                                         data-href="https://www.swotahtravel.com/blogs/{{$blog->slug}}"
                                         data-layout="button_count" data-size="large"
                                         data-mobile-iframe="true">
                                        <a class="fb-xfbml-parse-ignore" target="_blank"
                                           href="https://www.facebook.com/sharer/sharer.php?u={{urlencode('https://www.swotahtravel.com/blogs/'.$blog->slug)}}"
                                           src=sdkpreparse">
                                            <i class="fa fa-facebook"></i> Share
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="fb-like"
                                         data-href="https://www.facebook.com/Swotah/"
                                         data-layout="standard" data-action="like" data-size="large"
                                         data-show-faces="true" data-share="false"></div>
                                </li>
                            </div>
                        </div>
                        <div class="single-blog-img">
                            <img src="{{url('images/blogs/cover/'.$blog->cover_image)}}"
                                 alt="{{ucfirst($blog->title)}}">
                        <!--  <img class="bRadius lazyload"
                                 src="https://www.swotahtravel.com/images/blogs/thumbnail/{{$blog->cover_image}}"
                                 alt="Blog image"/> -->
                        </div>
                        <div class="single-blog-content">
                            <p>
                                {!! ucfirst($blog->article) !!}
                            </p>
                        </div>
                        @foreach($blog->sections as $section)
                            <div class="blog-content">
                                <p class="contentPadding" style="margin-top: 2%;">
                                @foreach($section->images as $image)
                                    <figure class="center-align">
                                        <img data-src="{{url('images/blogs/'.$image->image)}}"
                                             class="responsive-img scaled lazyload" alt="">
                                        <figcaption>
                                            {{$image->caption}}
                                        </figcaption>
                                    </figure>
                                @endforeach
                                <p>
                                    {!! ucfirst($section->description) !!}
                                </p>
                            </div>
                        @endforeach
                        {{--facebook comment row--}}
                        <div class="row">
                            <div class="col s12" style="background-color:#FFFFFF;">
                                <div class="fb-comments" data-width="100%"
                                     data-href="https://swotahtravel.com/blogs/{{$blog->slug}}"
                                     data-numposts="2">
                                </div>
                            </div>
                        </div>
                        {{--facebook comment row end--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <!-- <script type="text/javascript">
        string= string.replace(/>\s+</g,'><');
    </script> -->
    <script type="text/javascript">
        $('.blog-menu button').on('click', function () {
            $('.blog-ul-nav').toggle();
        });
    </script>
@endsection
