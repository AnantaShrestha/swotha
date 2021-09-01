<section class="blog-section">
    <div class="container">
        <div class="section-title-black">
            <h2 class="">BLOGS</h2>
            <div class="title-bg">
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
            </div>
        </div>
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach($allBlogs as $blog)
                    <div class="swiper-slide">
                        <div class="slider-item">
                            <div class="image-item">
                                <img data-src="https://www.swotahtravel.com/images/blogs/thumbnail/{{$blog->cover_image}}"
                                     src="https://www.swotahtravel.com/images/blogs/thumbnail/{{$blog->cover_image}}"
                                     class="blogImg lazyload blur-up" alt="{{$blog->title}}">
                            </div>
                            <div class="item-content">
                                <h2><a href="/blogs/{{$blog->slug}}">{{$blog->title}}</a></h2>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev nav-btn"><i class="fa fa-chevron-left"></i></div>
            <div class="swiper-button-next nav-btn"><i class="fa fa-chevron-right"></i></div>

        </div>

    </div>
    <div class="view-all-btn mt-30">
        <p><a href="/blogs" class="btn-viewAll-white">View All</a></p>
    </div>
</section>