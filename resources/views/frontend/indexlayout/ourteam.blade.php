<section class="team-section">
    <div class="container">
        <div class="section-title-black">
            <h2 class="">Meet Our Travel Experts</h2>
            <div class="title-bg">
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
                <span class="line-bg"></span>
            </div>
        </div>
        <div class="row ml-0 mr-0">
            <div id="team-slider" class="owl-carousel">
                @if(!empty($vipmembers))
                    @foreach($vipmembers as $vipmember)
                        <div class="team">
                            <div class="team-content">
                                <a href="/our-team/member-{{$vipmember->id}}">
                                    <div class="pic">
                                        <img src="https://www.swotahtravel.com/images/teampics/thumbnail/{{$vipmember->photo}}"
                                             data-src="https://www.swotahtravel.com/images/teampics/thumbnail/{{$vipmember->photo}}"
                                             alt="{{$vipmember->fullname}}" class="lazyload">
                                    </div>
                                    <h3 class="name">{{$vipmember->fullname}}</h3>
                                    <span class="title">- {{$vipmember->position}}</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="view-all-btn">
                <p><a href="/our-team" target="_blank" class="btn-viewAll">View All Members</a></p>
            </div>
        </div>
    </div>
</section>