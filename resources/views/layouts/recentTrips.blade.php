<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <link rel="stylesheet"  href="{{url('css/lightslider.min.css')}}">
    <link rel="stylesheet" href="{{url('css/frontend/index.min.css')}}">
    <link rel="stylesheet" href="{{url('css/frontend.min.css')}}">
    {{--<link type="text/css" rel="stylesheet" href="css/lightslider.css" />--}}
     <style>
         .trips span .rectangle{
             position: absolute;
             top: 35px;
             left: -3px;
             z-index: 1;
             width: 100px;
             padding:4px 10px;
         }

         #recomend{
             /*color:red;*/
         }
         .trips .btn:hover{
             background-color: #1999b7;
         }
         .trips .card-container {
             position: relative;
             flex-wrap: wrap;
             overflow: hidden;
             padding-top: 15px;
             padding-bottom: 15px;
             display: flex;
             justify-content: center;
         }

         .trips .card {
             /*min-width: px;*/
             width: 420px;
             position: relative;
             margin: 10px 10px;
             height: 350px;
             border-radius: 7px;
             background-size: cover;
             background: rgba(0, 0, 0, 0.7);
             box-shadow: 5px 5px 10px 1px rgba(0, 0, 0, 0.3);
             transition: 0.2s all linear;
             border: 1px solid rgba(128, 128, 128, 0.15);
             box-sizing: border-box;
         }


         /*@media only screen and (max-width: 1350px) {*/
         /*.card{*/
         /*width: 420px;*/
         /*}*/

         /*}*/

         @media only screen and (max-width: 1335px) and (min-width: 1200px) {
             .trips .card{
                 width: 374px;
             }

         }

         @media only screen and (max-width: 1200px) and (min-width: 977px) {
             .trips .card{
                 width: 460px;
             }

         }


         @media only screen and (max-width: 896px)and (min-width:816px) {
             .trips .card{
                 width: 380px;
                 /*height:338px;*/
             }

         }

         @media only screen and (max-width: 816px)and (min-width:756px)  {
             .trips .card{
                 width: 350px;
                 /*height: 334px;*/
             }

         }

         @media only screen and (max-width: 756px) {
             .trips .card{
                 width: 600px;
             }

         }


         .trips .card .card-social {
             position: absolute;
             height: 55px;
             width: 100%;
             border-bottom-right-radius: 5px;
             border-bottom-left-radius: 5px;
             top: 275px;
         }
         .trips .card .card-social ul {
             padding: 0;
             margin: auto -20px;;
             list-style: none;
             width: 100%;
             height: 100%;
             display: flex;
             justify-content:space-around;
         }
         .trips .card .card-social ul li {
             height: 100%;
             line-height: 75px;
             font-size: 1.5em;
             color: rgba(255, 255, 255, 0.85);
             text-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
         }
         .trips .card .card-social ul li:hover {
             text-shadow: 7px 7px 5px rgba(0, 0, 0, 0.7);
             transition: all 0.1s linear;
         }

         .trips .card .card-image {
             width: 100%;
             height: 275px;
             position: relative;
             border-top-right-radius: 5px;
             border-top-left-radius: 5px;
         }
         .trips .card .card-info {
             position: relative;
             width: 100%;
             height: 35px;
             line-height: 35px;
             top: -265px;
             border-top-right-radius: 5px;
             border-top-left-radius: 5px;
             font-family: "Open Sans";
             color: rgba(255, 255, 255, 0.85);
         }
         .trips .card .card-info .card-title {
             line-height: 20px;
             height: 45px;
             position: relative;
             top: 0px;
             text-align: center;
             /*font-size: 25px;*/
             font-size: medium;
             margin-top: -10px;
             background: rgba(0, 0, 0, 0.6);
             box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.3);
         }
         .trips .card .card-info .card-detail {
             line-height: 1.5em;
             font-size: 1em;
             height: 220px;
             background: rgba(0, 0, 0, 0.6);
             position: relative;
             top: 5px;
             padding: 5px 20px 0px 20px;
             opacity: 0;
             transform: scaleY(0);
             transform-origin: center top;
             box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.3);
         }
         .trips .card:hover {
             box-shadow: 10px 10px 10px 1px rgba(0, 0, 0, 0.3);
         }
         .trips .card:hover .card-info .card-title {
             box-shadow: 10px 10px 10px 1px rgba(0, 0, 0, 0.3);
             transition: 0.3s all linear;
         }
         .trips .card:hover .card-info .card-detail {
             opacity: 1;
             box-shadow: 10px 10px 10px 1px rgba(0, 0, 0, 0.3);
             transition: 0.35s all linear;
             transition-delay: 0.1s;
             transform: scaleY(1);
         }

    	ul{
			list-style: none outside none;
		    padding-left: 0;
            margin: 0;
		}
        .demo .item{
            margin-bottom: 60px;
        }
        .demo{
			width: 800px;
		}
        </style>
</head>
<body>
    @if($recentTrips)
       {{-- <div class="container">
            <div class = "title-wrapper1">
            <span class="title teal">
                <span class="flow-text" style="color: white;" ><b>Recently Viewed</b></span>
            </span>
            </div>--}}
        {{--</div>--}}
    <div class="container" style="text-align: center;background-color:#e1e9f0;">
        <h1 class="s-fon">Recently Viewed</h1>
    </div>
    <ul id="lightSlider" class="trips">
        @foreach($recentTrips as $ft)
        <li class="">
            <a href="/trip/{{$ft->slug}}">
                <div class="card indexproducts z-depth-5 waves-effect waves-block waves-light">
                    <div class="card-image indexprodimage">
                                <span>
                                    @if(!empty($ft->customtrip->recommended))
                                        @if($ft->customtrip->recommended == 1)
                                            <div class="rectangle center-align" style="background-color: tomato;padding:1px 1px;">
                                                <i class="shine"></i>
                                                <span id="recomend" style="font-size: 14px;">Trending</span>
                                            </div>
                                        @endif
                                    @endif
                                </span>
                        <img src="{{url('https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179002/static_webp/default_img.webp')}}"
                             data-src="images/trips/thumbnail/{{$ft->cover_image}}" style=" border-bottom:red;"
                             alt="{{$ft->name}}" class="lazyload">
                        <span class="card-title hbb imc" style=" padding:5px">{{$ft->name}}</span>
                        @if(!Auth::user())
                            <a href="/wish/{{$ft->id}}"
                               class="btn-small btn-floating halfway-fab waves-effect waves-light hbb push tooltipped"
                               data-position="bottom" data-delay="10" data-tooltip="Add to Bucket list">
                                <i class="material-icons">favorite</i>
                            </a>

                        @else
                            @if(!Auth::user())
                                <a class="btn-small wsh btn-floating  halfway-fab waves-effect waves-light push tooltipped"
                                   id="{{$ft->id}}" data-id="{{$ft->id}}" data-name="{{Auth::user()->is_active}}"
                                   data-value="{{$ft->id}}" data-position="bottom"
                                   data-delay="10" data-tooltip="Remove from Bucket list"> <i
                                            class="material-icons">favorite</i></a>
                            @else
                                @if(!empty($ft->wish) && $ft->wish->user_id == Auth::user()->id)
                                    <a class="btn-small rmv red btn-floating  halfway-fab waves-effect waves-light push tooltipped"
                                       id="{{$ft->id}}" data-id="{{$ft->id}}"
                                       data-name="{{Auth::user()->is_active}}" data-value="{{$ft->id}}"
                                       data-position="bottom"
                                       data-delay="10" data-tooltip="Remove from Bucket list"> <i
                                                class="material-icons">favorite</i></a>
                                @else
                                    <a class="btn-small wsh hbb btn-floating  halfway-fab waves-effect waves-light push tooltipped"
                                       id="{{$ft->id}}"
                                       data-id="{{$ft->id}}" data-name="{{Auth::user()->is_active}}"
                                       data-value="{{$ft->id}}" data-position="bottom"
                                       data-delay="10" data-tooltip="Add to Bucket list"><i class="material-icons">favorite</i>
                                    </a>
                                @endif
                            @endif
                        @endif
                        <a href="/trip/{{$ft->slug}}#departures"
                           class="btn-small hbb btn-floating  halfway-fab waves-effect waves-light tooltipped"
                           data-position="bottom" data-delay="10" data-tooltip="View Departure Dates"><i
                                    class="material-icons">date_range</i>
                        </a>
                        <a id="one"
                           class="btn-small hbb btn-floating  halfway-fab waves-effect waves-light pusheye tooltipped"
                           data-position="bottom" data-delay="10" data-tooltip="Total views:{{count($ft->views)}}">
                            <img src="{{url('images/eyes.png')}}" alt="views">
                        </a>
                    </div>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
    @endif
</body>
</html>
