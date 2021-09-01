@section('styles')
    <style type="text/css">
        #indexBlogContent .card:hover {
            border: 2px solid white;
            transition: 0.5s;
            transform: scale(1.05);
        }

        #indexBlogContent .card:hover img {
            opacity: 1 !important;
            transition: 0.8s;
        }

        #indexBlogContent .card {
            border: 4px solid white;
        }

        @media only screen and (min-width: 768px) {
            .blogImg {
                height: 230px;
            }
        }

        #indexBlogSection .owl-carousel .owl-nav button.owl-next {
            position: absolute;
            top: 0;
            right: 10px;
        }

        #indexBlogSection .owl-carousel .owl-nav button.owl-prev {
            position: absolute;
            top: 0;
            left: 10px;
        }

        #indexBlogSection .owl-carousel .owl-nav button.owl-next span {
            font-size: 150px;
            color: white;
        }

        #indexBlogSection .owl-carousel .owl-nav button.owl-prev span {
            font-size: 150px;
            color: white;
        }

        #indexBlogSection .owl-theme .owl-nav [class*=owl-]:hover {
            background: transparent;
        }

        #indexBlogSection .owl-carousel .owl-nav button.owl-prev span:hover {
            color: black;
        }

        #indexBlogSection .owl-carousel .owl-nav button.owl-next span:hover {
            color: black;
        }

        #indexBlogSection .owl-theme .owl-dots .owl-dot span {
            background: #00b1ff;
        }


        #indexBlogSection .owl-theme .owl-dots .owl-dot.active span,
        #indexBlogSection .owl-theme .owl-dots .owl-dot:hover span {
            background: black;
        }

    </style>
@endsection
<div id="indexBlogSection" style="background: #e0e0e0;padding:10px 0px 40px 0px;">
    <div class="container-fluid">
        <div id="indexBlogContent" class="blog_temp1" style="position: relative;">
            <div class="owl-2" style="width: 100%;">
                <h1 class="titleHeadtwo"><span class="reviewTitle"> Recent Blogs </span></h1>
                <div class="owl-carousel recentblogCourosel owl-theme">
                    @foreach($allBlogs as $blog)
                        <div class="item">
                            <a href="/blogs/{{$blog->slug}}" target="_blank">
                                <div class="card">
                                    <div class="card-image" style="position: relative;">
                                        <img src="{{url('images/blogs/thumbnail/'.$blog->cover_image)}}"
                                             class="blogImg">
                                        <div id="blogImageContent" style="position: absolute;width: 100%;">
                                            <h3 class="card-title"
                                                style="text-transform:capitalize; background-color: #211E1E;padding:5px 10px;">{{$blog->title}}</h3>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="indexBlogContent" class="blog_temp2" style="position: relative;">
            <div class="owl-2" style="width: 100%;">
                <h2 class="titleHeadtwo"><span class="reviewTitle">Mostly Viewed Blogs </span></h2>

                <div class="owl-carousel mostblogCourosel owl-theme">
                    @foreach($blogsviewed as $blog)
                        <div class="item">
                            <a href="/blogs/{{$blog->slug}}" target="_blank">
                                <div class="card">
                                    <div class="card-image" style="position: relative;">
                                        <img src="{{url('images/blogs/thumbnail/'.$blog->cover_image)}}"
                                             class="blogImg">
                                        <div id="blogImageContent" style="position: absolute;width: 100%;">
                                            <h3 class="card-title"
                                                style="text-transform:capitalize; background-color: #211E1E;padding:5px 10px;">{{$blog->title}}</h3>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div style="text-align: center;margin-top: 10px;margin-bottom:10px;">
            <button class="waves-effect waves-light btn" onclick="changeRecentBlogs()" style="margin-bottom: 10px;">
                Recent
            </button>
            <button class="waves-effect waves-light btn" onclick="changeReviewedBlogs()" style="margin-bottom: 10px;">
                Mostly Reviewed
            </button>
            <a href="/blogs" target="_blank" class="waves-effect waves-light btn"
               style="padding:0 15px; font-size: 15px;margin-bottom: 10px;">Show All</a>

        </div>
    </div>
</div>

