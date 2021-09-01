<section class="package-section" style="padding-top:10px">
    <div class="section-title-black">
      <h2> {{$parallaxes[0]->title}}</h2>
      <div class="title-bg">
        <span class="line-bg"></span>
        <span class="line-bg"></span>
        <span class="line-bg"></span>
        <span class="line-bg"></span>
        <span class="line-bg"></span>
        <p>{{$parallaxes[0]->description}}</p>
      </div>
    </div>
    <div class="package-block">
        <div class="row ml-0 mr-0">
            @foreach($packages as $package)
                @if($package->rank==1)
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl-0 pr-0 bo" style="height:390px">
                        <div class="single-package">
                            <div class="package-image " style="height:390px">
                                <img data-src="{{url('/images/tripPackages/thumbnail/'.$package->image)}}" src="@if($package->image_url_thumb != null) {{$package->image_url_thumb}} @else {{url('/images/tripPackages/thumbnail/'.$package->image)}} @endif"
                                 alt="{{$package->title }}" class="p-scale-img lazyload">
                                <div class="package-content">
                                    <div class="package-title popular-package">
                                        <h1><a href="/{{$package->slug}}">{{$package->title }}</a></h1>
                                        <p>Starting From : ${{$package->trips->min('price')}}</p>
                                    </div>
                                    <div class="package-trip">
                                        <p><strong>{{count($package->trips)}}</strong><br>Trips</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl-0 pr-0 bo" style="height:390px">
                <div class="row ml-0 mr-0">
                    @foreach($packages as $package)
                        @if($package->rank==2)
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl-0 pr-0" style="height:195px">
                                <div class="single-package">
                                    <div class="package-image " style="height:195px">
                                        <img data-src="{{url('/images/tripPackages/thumbnail/'.$package->image)}}" src="@if($package->image_url_thumb != null) {{$package->image_url_thumb}} @else {{url('/images/tripPackages/thumbnail/'.$package->image)}} @endif"
                                        alt="{{$package->title }}" class="p-scale-img lazyload">
                                        <div class="package-content">
                                            <div class="package-title">
                                                <h1><a href="{{$package->slug}}">{{$package->title}}</a></h1>
                                                    <p>Starting From : ${{$package->trips->min('price')}}</p>
                                            </div>
                                            <div class="package-trip">
                                                <p><strong>{{count($package->trips)}}</strong><br>Trips</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($package->rank==4)
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl-0 pr-0" style="height:195px">
                                <div class="single-package">
                                    <div class="package-image " style="height:195px">
                                        <img data-src="{{url('/images/tripPackages/thumbnail/'.$package->image)}}" src="@if($package->image_url_thumb != null) {{$package->image_url_thumb}} @else {{url('/images/tripPackages/thumbnail/'.$package->image)}} @endif"
                                        alt="{{$package->title }}" class="p-scale-img lazyload">
                                        <div class="package-content">
                                            <div class="package-title">
                                                <h1><a href="{{$package->slug}}">{{$package->title}}</a></h1>
                                                <p>Starting From : ${{$package->trips->min('price')}}</p>
                                            </div>
                                            <div class="package-trip">
                                                <p><strong>91</strong><br>Trips</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @foreach($packages as $package)
                        @if($package->rank==3)
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl-0 pr-0" style="height:195px">
                                <div class="single-package">
                                    <div class="package-image" style="height:195px">
                                        <img data-src="{{url('/images/tripPackages/thumbnail/'.$package->image)}}" src="@if($package->image_url_thumb != null) {{$package->image_url_thumb}} @else {{url('/images/tripPackages/thumbnail/'.$package->image)}} @endif"
                                        alt="{{$package->title }}" class="p-scale-img lazyload">
                                        <div class="package-content">
                                            <div class="package-title">
                                                <h1><a href="{{$package->slug}}">{{$package->title}}</a></h1>
                                                    <p>Starting From : ${{$package->trips->min('price')}}</p>
                                            </div>
                                            <div class="package-trip">
                                                <p><strong>{{count($package->trips)}}</strong><br>Trips</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($package->rank==5)
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl-0 pr-0" style="height:195px">
                                <div class="single-package">
                                    <div class="package-image" style="height:195px">
                                        <img data-src="{{url('/images/tripPackages/thumbnail/'.$package->image)}}" src="@if($package->image_url_thumb != null) {{$package->image_url_thumb}} @else {{url('/images/tripPackages/thumbnail/'.$package->image)}} @endif"
                                        alt="{{$package->title }}" class="p-scale-img lazyload">
                                        <div class="package-content">
                                            <div class="package-title">
                                                <h1><a href="{{$package->slug}}">{{$package->title}}</a></h1>
                                                <p>Starting From : ${{$package->trips->min('price')}}</p>
                                            </div>
                                            <div class="package-trip">
                                                <p><strong>91</strong><br>Trips</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
            @foreach($packages as $package)
                @if($package->rank>=6 && $package->rank<=9)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 pl-0 pr-0" style="height:195px">
                        <div class="single-package">
                            <div class="package-image " style="height:195px">
                               <img data-src="{{url('/images/tripPackages/thumbnail/'.$package->image)}}" src="@if($package->image_url_thumb != null) {{$package->image_url_thumb}} @else {{url('/images/tripPackages/thumbnail/'.$package->image)}} @endif"
                                 alt="{{$package->title }}" class="p-scale-img lazyload">
                                <div class="package-content">
                                    <div class="package-title popular-package">
                                        <h1><a href="{{$package->slug}}">{{$package->title }}</a></h1>
                                        <p>Starting From : ${{$package->trips->min('price')}}</p>
                                    </div>
                                    <div class="package-trip">
                                        <p><strong>{{count($package->trips)}}</strong><br>Trips</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 @endif
            @endforeach

        </div>
    </div>
  </section>