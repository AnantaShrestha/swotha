@extends('layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{url('css/footerfaq.css')}}">
@endsection
@section('title')
    <title>FAQ | Swotah Travel and Adventure</title>
@endsection
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="FAQ | Swotah Travel and Adventure">
    <meta name="description" content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
@section('content')
    @include('layouts.navbar')
    <div class="container containerPadding">
        <h1  class="titleHeadtwo" style="margin-top: 60px;"> <span class="reviewTitle"> FAQ </span> </h1>
        <div class="row" style="display: flex;flex-wrap:wrap;">
            @foreach($faq as $one)
                @if(count($one->questions) > 0)
                <div class=" col l4 m4 s12" style="margin-left:initial;">
                    <div style="padding:10px;background:white;">
                        <h6 style="font-weight: bold;"><a style="color:black;"
                                                          href="/faq/{{$one->id}}">{{$one->topic}}</a></h6>
                        <ul class="points1">
                            @foreach($one->questions->take(3) as $question)
                                <li>
                                    <a href="/faq/{{$one->id}}" class="one">{{$question->question}}</a>
                                </li>
                            @endforeach
                            @if(count($one->questions)>1)
                                <a class="all" href="/faq/{{$one->id}}">View all questions</a>
                            @endif
                        </ul>
                    </div>

                </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
