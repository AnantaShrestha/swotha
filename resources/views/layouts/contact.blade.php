@extends('layouts.master')
@section('title')
    Contact Us | Swotah Travel and Adventure
@endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('metatags')
    {{--Here goes all the meta information for index page--}}
    <meta name="title" content="Contact Us | Swotah Travel and Adventure">
    <meta name="description"
          content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection
@section('styles')
    <style type="text/css">
        .top-payment a img {
            margin-top: -11px !important;
        }
    </style>
@endsection
@section('content')
    @include('layouts.navbar')
    <section class="inner-page-heading-title pt-30">
        <div class="container">
            <div class="section-title-black">
                <h2>CONTACT US</h2>
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
    <section class="contact-us pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 pl-0">
                    <form action="/contact" method="post">
                        {{csrf_field()}}
                        {!! Recaptcha::field('home', 'g-recaptcha-response', ['id' => 'recaptcha-id0', 'class' => 'form-element']) !!}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="name" class="contact-control validate"
                                           placeholder="Enter your Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="email" name="email" class="contact-control validate"
                                           placeholder="Enter your Email">

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="tel" name="phone" class="contact-control validate"
                                           placeholder="Enter your Phone Number">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="subject" class="contact-control validate"
                                           placeholder="Subject">

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea class="contact-control validate" placeholder="Enter your Message" rows="4"
                                              name="message"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4" style="text-align:center">
                                <div class="form-group">
                                    <button class="contact-btn" type="submit">Submit</button>
                                </div>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>
                    </form>
                </div>
                <div class='col-lg-4 col-md-4 col-sm-12'>
                    <div class="inner-package-head-title mb-30">
                        <h3>Location</h3>
                    </div>
                    <div class="right-contact-details mb-20">
                        <ul>
                            <li><span><i class="fa fa-map-marker"></i></span>&nbsp;&nbsp;Swotah Travel and Adventure
                                Pvt. Ltd.
                            </li>
                            <li><span><i class="fa fa-envelope"></i></span>&nbsp;&nbsp;info@swotahtravel.com</li>

                            <li><span><i class="fa fa-phone"></i></span>&nbsp;&nbsp;+977-1-4004750</li>
                            <li><span><i class="fa fa-mobile"></i></span>&nbsp;&nbsp;+977 9841595962</li>


                        </ul>
                    </div>
                    <div class="inner-package-head-title mb-30">
                        <h3>Business Hours</h3>
                    </div>
                    <div class="right-contact-details">
                        <ul>
                            <li><span><i class="fas fa-address-book"></i></span>&nbsp;&nbsp;Sunday - Friday</li>
                            <li><span><i class="fa fa-clock"></i></span>&nbsp;&nbsp;9:30 AM - 6:30 PM</li>

                            <li><span><i class="fa fa-times"></i></span>&nbsp;&nbsp;Saturday (Close)</li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="google-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3531.9935804403012!2d85.32375221468308!3d27.7174844827877!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1910283e3a2d%3A0x823fdf6a59f71833!2sSwotah+Travel+and+Adventure!5e0!3m2!1sen!2snp!4v1515067357123"
                width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
@endsection

