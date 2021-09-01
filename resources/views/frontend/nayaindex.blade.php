@extends('layouts.master')
@section('title')
    <title>Swotah Travel and Adventure | Trekking packages for Nepal,
        Trekking costs in nepal
    </title>
@endsection
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="description" content="Swotah Travel and Adventure is an Adventure Company in Kathmandu, Nepal.If Nepal's on top of your bucket list,
         let us help you inspire, plan and prepare better!">
    <meta property="og:description" content="Swotah Travel and Adventure is an Adventure Company in Kathmandu, Nepal.If Nepal's on top of your bucket list,
         let us help you inspire, plan and prepare better!">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, nepal trekking packages,
    trekking guide in nepal,short treks in nepal,nepal trekking companies,trekking in nepal costs, trekking in nepal himalaya
    trekking in nepal best time of year, trekking in himalaya, bucket list,Nepal travel, Adventure, Mountains, Tours">
@endsection
{{--End of meta tags--}}
{{--External css--}}
@section('styles')
    {{--<link rel="stylesheet" href="{{url('css/frontend/index.css')}}">--}}
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans"/>
@endsection
{{--end of content--}}
{{--Start of content section--}}
@section('content')
    {{--Navbar--}}
    @include('layouts.navbar')
    {{--Navbar End--}}
    {{--Index page image and video--}}
@endsection
