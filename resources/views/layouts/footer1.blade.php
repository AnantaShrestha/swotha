<div class="subcribe">
    <div class="container">
        <div class="row ml-0 mr-0">
            <div class="col-lg-6 col-md- col-sm-5 col-xs-12 pl-0">
                <div class="subcribe-content">
                    <h1>Subscribe for Our Newsletter</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 pr-0">
                <div class="flex-box">
                    <div class="form-groups flex">
                        <input id="subscribe-email" type="email" name="subscribe" class="subscribe-email"
                               placeholder="Subscribe To Our Newletter">
                    </div>
                    <div class="form-groups">
                        <button class="subscribe-btn submit_newsettler">Subscribe</button>
                    </div>
                    <br>
                </div>
                <span id="alertmessage"
                      style="font-size:12px;background-color: #ddd;border-radius: 20px;padding: 5px;display: none;margin-top:5px;"></span>
            </div>
        </div>
    </div>
</div>

<div id="topFooter">
    <div classs="container">
        @if(!Auth::user())
            <div class="login-content">
                <h3>Please login, if you already have an agent account.&nbsp;&nbsp;<a href="/login">Agent Login</a></h3>

            </div>
        @endif
        <div class="login-content" style="margin-top:15px">
            <h3>New Agency?&nbsp;&nbsp;<a href="/agent/register">Register Here</a></h3>
        </div>
    </div>
</div>
<footer class="footer-section">
    <div class="container">
        <div class="row ml-0 mr-0" style="margin-bottom:30px">
            <div class="col-md-3 col-sm-6 col-xs-12 pl-0">
                <div class="footer-header">
                    <h3>TRIPS</h3>
                </div>
                <div class="footer-content">
                    <ul>
                        <li><a href="/travel-insurance" target="_blank">Travel Insurance</a></li>
                        <li><a href="/before-you-come" target="_blank">Before You Come</a></li>
                        {{--            <li><a href="/partner"  target="_blank">Find Fellow Traveler(s)</a></li>--}}
                        <li><a href="/fixed-departures" style="margin:7px 0;">
                                <img style="height: 30px"
                                     src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179003/static_webp/fixed.webp"></a>
                        </li>
                    </ul>
                    <ul class="fixed-departure">
                        <li><a href="http://www.mylovenepal.com/" target="_blank">My Love Nepal</a></li>
                        <li><a href="https://www.lonelyplanetnepal.com/" target="_blank">Lonely Planet Nepal</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 pl-0">
                <div class="footer-header">
                    <h3>About Us</h3>
                </div>
                <div class="footer-content">
                    <ul>
                        <li><a href="/corporate-social-responsibility" target="_blank">CSR</a></li>
                        <li><a href="/volunteerism" target="_blank">Volunteer</a></li>
                        <li><a href="/why-swotah" target="_blank">Why Swotah</a></li>
                        <li><a href="/our-team" target="_blank"> Swotah Team</a></li>

                        <li><a href="/contact-us" target="_blank"> Contact Us</a></li>
                    </ul>
                    <h3 style="font-size:16px;color:#fff;margin-top:15px;font-weight:800;margin-bottom:15px">Payment
                        Method</h3>
                    <ul class="flex-box">
                        <li>
                            <img src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179006/static_webp/visacard.png">
                        </li>
                        <li>
                            <img src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179004/static_webp/meromaster.png">
                        </li>
                        <li>
                            <img src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179002/static_webp/americanexpress.png">
                        </li>
                        <li>
                            <img src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179004/static_webp/maestrocard.png">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 pl-0">
                <div class="footer-header">
                    <h3>General</h3>
                </div>
                <div class="footer-content">
                    <ul>
                        <li><a href="/faq" target="_blank">FAQ</a></li>
                        <li><a href="/blogs" target="_blank"> Blogs</a></li>
                        <li><a href="/visa-information" target="_blank">Visa Information</a></li>
                        <li><a href="/difficulty-level" target="_blank"> Difficulty level</a></li>
                        <li><a href="/nepal-at-glance" target="_blank"> Nepal at Glance</a></li>
                        <li><a href="javascript:;" class="brochure">Request a Brochure</a></li>
                    </ul>
                </div>
                {{--request brocure modal--}}
                @include('layouts.brochureform')

                {{--end of request brocure modal--}}
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 pl-0">
                <div class="footer-header">
                    <h3>Contact Us</h3>
                </div>
                <div class="footer-content">
                    <ul class="contact">
                        <li class="flex-box"><p class="footer-icon"><img
                                        src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179005/static_webp/pobox-img.png">
                            </p>
                            <p class="icon-content">PO Box: 612,
                                GPO: 44600, Dillibazar, Kathmandu </p></li>
                        <li class='flex-box'><p class="footer-icon"><img
                                        src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179003/static_webp/location.png">
                            </p>
                            <p class="icon-content">Gairidhara-2, Kathmandu, Nepal</p></li>
                        <li class='flex-box'><p class="footer-icon"><img
                                        src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179003/static_webp/gmail.png">
                            </p>
                            <p class="icon-content">
                                <a href="mailto:info@swotahtravel.com">info@swotahtravel.com</a><br>
                                <a href="mailto:b2b@swotahtravel.com">b2b@swotahtravel.com </a></p></li>
                        <li class='flex-box'><p class="footer-icon"><img
                                        src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179004/static_webp/mobile.png">
                            </p>
                            <p class="icon-content">+977 9841595962, +977-1-4004750</p></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row ml-0 mr-0 mb-20">
            <div class="col-lg-3 col-md-3 col-sm-6  pl-0">
                <div class="footer-header">
                    <h3>Our Association</h3>
                </div>
                {{--<style type="text/css">

                </style>--}}
                <div class="foot-img">
                    <img alt="Our association"
                         data-src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179002/static_webp/associate1.png"
                         src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179002/static_webp/associate1.png">
                    <img alt="Our association"
                         data-src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179002/static_webp/associate2.png"
                         src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179002/static_webp/associate2.png">
                    <img alt="Our association"
                         data-src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179002/static_webp/a3.png"
                         src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179002/static_webp/a3.png">
                    <img alt="Our association"
                         data-src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179002/static_webp/associate4.png"
                         src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179002/static_webp/associate4.png">
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 pl-0">
                <div class="footer-header">
                    <h3>Let's get social</h3>
                </div>
               {{-- <style type="text/css">

                </style>--}}
                <div class="footer-content">
                    <ul class="so-icon flex-box">
                        <li class="facebook"><a href="https://facebook.com/Swotah" rel="noreferrer" target="_blank"><i
                                        class="fab fa-facebook-f"></i></a></li>
                        <li class="twitter"><a href="https://twitter.com/SwotahTravel" rel="noreferrer" target="_blank"><i
                                        class="fab fa-twitter"></i></a></li>
                        <li class="instagram"><a href="https://www.instagram.com/swotahnepal/" rel="noreferrer" target="_blank"><i
                                        class="fab fa-instagram"></i></a></li>
                        <li class="youtube"><a href="https://www.youtube.com/channel/UCIEAl1j63bbDVsYpe3lvQXw"
                                               rel="noreferrer" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        <li class="linkdin"><a
                                    href="https://www.linkedin.com/company/swotah-travel-and-adventure-pvt-ltd"
                                    rel="noreferrer" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>


                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 pl-0">
                <div class="footer-header">
                    <h3>Find us on</h3>
                </div>
                <div class="foot-img second-last-foot-img">
                    <a href="https://www.tourradar.com/swotah-travel-and-adventure" rel="noreferrer" target="_blank"><img
                                src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179005/static_webp/touradar.png"></a>
                    <a href="https://www.tripadvisor.com/Attraction_Review-g293890-d12396701-Reviews-Swotah_Travel_and_Adventure_Pvt_Ltd-Kathmandu_Kathmandu_Valley_Bagmati_Zone_Cent.html"
                       rel="noreferrer" target="_blank"> <img
                                src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179005/static_webp/tripadvisor-logo.png">
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="foot-img last-foot-img">
                    <a href="#"><img class=" lazyloaded" alt="More than a decade in the mountain"
                                     src="https://res.cloudinary.com/images-swotahtravel-com/image/upload/v1561179003/static_webp/exce-newly.png"></a>
                    <a rel="noreferrer" target="_blank" href="https://www.travelersagainstplastic.org/"> <img
                                src="https://res.cloudinary.com/lonely-planet-nepal/image/upload/v1576449399/noplastic_c2ljiu.png"></a>
                </div>
            </div>
        </div>
        <div class="last-footer">
            <div class="row ml-0 mr-0">
                <div class="col-lg-6 col-md-6 col-sm-12 pl-0">
                    <div class="flex-box last-nav">
                        <p><a href="/deposit-and-cancellation-policy" rel="noreferrer" target="_blank">Deposit and Cancellation
                                Policy</a></p>
                        <p><a href="/terms-and-condition" rel="noreferrer" target="_blank">Terms and Condition</a></p>
                        <p><a href="/sitemaps" rel="noreferrer" target="_blank">Site Map</a></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                    <div class="copyright">
                        <p>Copyright © Swotah Travel and Adventure Pvt. Ltd <?php echo date('Y') ?>. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
