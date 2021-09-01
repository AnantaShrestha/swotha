@extends('layouts.master')
<title>Blogs | Swotah Travel and Adventure
</title>
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="Blogs | Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
<style type="text/css">
</style>
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('content')
    @include('layouts.navbar')
    <section class="inner-page-heading-title pt-30">
        <div class="container">
            <div class="section-title-black">
                <h2>BLOGS</h2>
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
    <section class="allblogs">
        <div class="container">
            <div class="review-tab-panel mb-30">
                <ul class="flex-box review-tab-list">
                    <li class="review-tab-control active btn-arrow-right"><a href="#latestblogs">Latest Blogs</a></li>
                    <li class="review-tab-control btn-arrow-left"><a href="#mostviewedblogs">Most Viewed Blogs</a></li>
                </ul>
            </div>
            <div class="row ml-0 mr-0">
                <div class="col-lg-3 col-md-3 col-sm-12 pl-0">
                    <div class="blog-side-nav " id="sidesbar">
                        <div class="blog-menu">
                            <button>Menu</button>
                        </div>
                        <ul class="blog-ul-nav">
                            <li><a href="/blogs" @if(empty($cat_id)) class="active" @endif>All Blog</a></li>
                            @foreach($categories as $category)
                                <li style="border-bottom: 1px solid grey"><a
                                            href="{{route('blog-path',$category->slug)}}" @if(!empty($cat_id))
                                    @if($category->id == $cat_id)
                                    class="active"
                                            @endif
                                            @endif>{{$category->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 pr-0">

                    <div class=" inner-review-tab-panel active" id="latestblogs">
                        <div class="row">
                            @foreach($blogsrecent as $blog)
                                @if($blog->is_published == 1)
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mb-30">
                                        <div class="inner-package-list-single">
                                            <div class='package-list-img'>
                                                <img class="bRadius lazyload"
                                                     src="https://www.swotahtravel.com/images/blogs/thumbnail/{{$blog->cover_image}}"
                                                     alt="Blog image"/>
                                            <!-- <img class="bRadius lazyload"
                                                                 data-src="{{url('images/blogs/thumbnail/'.$blog->cover_image)}}"
                                                                 alt="Blog image"/> -->
                                                <div class="blog-date-time">
                                                        <span>
                                                            <div class="tarik">{{date('M d', strtotime($blog->created_at))}}</div>
                                                            <div class="year">{{date('Y', strtotime($blog->created_at))}}</div>
                                                        </span>
                                                </div>

                                            </div>
                                            <div class="package-list-detail">
                                                <div class="package-list-head">
                                                    <h3><a href="/blogs/{{$blog->slug}}">{{ucfirst($blog->title)}}</a>
                                                    </h3>
                                                </div>
                                                <div class="inner-package-description">
                                                    <p><?php
                                                        $blogPreview = strip_tags($blog->article);
                                                        echo '<span style="font-size: 13px;font-weight:normal;">' . substr($blogPreview, 0, 100) . '....' . '</span>';
                                                        ?>

                                                        <a href="/blogs/{{$blog->slug}}">
                                                            Continue&nbsp;reading
                                                        </a></p>
                                                </div>

                                                <div class="read-more-btn">
                                                    <p>Written by&nbsp;<a href=""
                                                                          style="background: yellow; color:black">{{ucfirst($blog->author)}}</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="inner-review-tab-panel" id="mostviewedblogs">
                        <div class="row">
                            @foreach($blogsviewed as $blog)
                                @if($blog->is_published == 1)
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mb-30">
                                        <div class="inner-package-list-single">
                                            <div class='package-list-img'>
                                                <img class="bRadius lazyload"
                                                     src="https://www.swotahtravel.com/images/blogs/thumbnail/{{$blog->cover_image}}"
                                                     alt="Blog image"/>
                                            <!-- <img class="bRadius lazyload"
                                                                 data-src="{{url('images/blogs/thumbnail/'.$blog->cover_image)}}"
                                                                 alt="Blog image"/> -->
                                                <div class="blog-date-time">
                                                        <span>
                                                             <div class="tarik">{{date('M d', strtotime($blog->created_at))}}</div>
                                                            <div class="year">{{date('Y', strtotime($blog->created_at))}}</div>
                                                        </span>
                                                </div>

                                            </div>
                                            <div class="package-list-detail">
                                                <div class="package-list-head">
                                                    <h3><a href="/blogs/{{$blog->slug}}">{{ucfirst($blog->title)}}</a>
                                                    </h3>
                                                </div>
                                                <div class="inner-package-description">
                                                    <p><?php
                                                        $blogPreview = strip_tags($blog->article);
                                                        echo '<span style="font-size: 13px;font-weight:normal;">' . substr($blogPreview, 0, 100) . '....' . '</span>';
                                                        ?>
                                                        <a href="/blogs/{{$blog->slug}}">
                                                            Continue&nbsp;reading
                                                        </a></p>
                                                </div>

                                                <div class="read-more-btn">
                                                    <p>Written by&nbsp;<a href="">{{ucfirst($blog->author)}}</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('.blog-menu button').on('click', function () {
            $('.blog-ul-nav').toggle();
        });
    </script>
@endsection