@extends('layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{url('css/faq.css')}}">
@endsection
@section('content')
    @include('layouts.navbar')
    <div id="primary-content-wrap" class="wrap clearfix">
        <div class="primary-content">
            <div class="row">
                <div class="col l11" id="foot" style="margin-top: 65px;">
                    <h4 class="topic">Where is Nepal?</h4>
                    <p class="nepalinfo">Nepal, a country that resides on lap of Himalayas is situated between the two
                        giant countries China and India. Nepal is a landlocked country prominently dominated by hills
                        and mountains. Although Nepal is known as hilly country, it has diverse geographical variation.
                        From sky piercing mountain to Plain and flatlands, this country has it all. Despite its tiny
                        size in map of world, Nepal boasts bio diversity in flora and fauna only few countries can
                        offer. Nepal is not the destination for Natural beauty alone, it is rich in culture, language,
                        architecture and heritages. So if you are thinking of vacation where you can get more experience
                        in fleeting time, Nepal should be in your priority list.</p>
                    <h4 class="topic">Can I get on arrival visa?</h4>
                    <p class="nepalinfo">Yes, you can get visa of Nepal on arrival provided that you have passport and
                        other documents along with Photographs. Here is the amount of on arrival visa in Nepal.</p>
                    <table>
                        <tr>
                            <td><h5>Visa Facility</h5></td>
                            <td><h5>Duration</h5></td>
                            <td><h5>Fee</h5></td>
                        </tr>
                        <tr>
                            <td>Multiple entry</td>
                            <td>15 days</td>
                            <td>US$ 25 or equivalent Nepali currency</td>
                        </tr>
                        <tr>
                            <td>Multiple Entry</td>
                            <td>30 days</td>
                            <td>US$ 40 or equivalent Nepali currency</td>
                        </tr>
                        <tr>
                            <td>Multiple entry</td>
                            <td>90 days</td>
                            <td>US$ 100 or equivalent Nepali currency</td>
                        </tr>
                    </table>
                    <h4 class="topic"> What is the best season for trekking in Nepal?</h4></a>
                    <p class="nepalinfo">Trekking season in Nepal is mainly from March to May and September to November.
                        However trips can be done all year long, some trekking routes are open throughout the year.
                        Contact us for preparing a trip according to your convenience.</p>
                    <h4 class="topic">Do you provide Trekking/Expedition gears?</h4>
                    <p class="nepalinfo">While you can bring the gears for trekking according to your preference, we do
                        provide the essentials needed for the trekking and expedition. We can provide full gears if
                        requested on rent.</p>
                    <h4 class="topic">What kind of Hotels can I expect in Nepal?</h4>
                    <p class="nepalinfo">We book your hotel according to your travel needs. You can find hotels from 5
                        stars to simple guesthouse as per your choice. Trekking en route accommodation will be rather
                        basic i.e. Teahouse, Guesthouse etc.</p>
                    <h4 class="topic">Can I take a package after I’ve arrived to Nepal?</h4>
                    <p class="nepalinfo">Once you enter the Nepal, you’re free to travel anywhere in Nepal. So you can
                        take any travel package and travel freely with permits within the time limit of your visa.</p>
                    <h4 class="topic">Is there strict dressing code in Nepal?</h4>
                    <p class="nepalinfo">Nepal is a Liberal country and you can dress yourself with western dresses
                        provided that you don’t go overboard with skin show. We suggest you to dress modestly specially
                        in Villages and religious site. </p>
                    <h4 class="topic">I have heard about load shedding in Nepal, Will I be able to charge my
                        gadgets?</h4>
                    <p class="nepalinfo">Load shedding in Nepal now is a past thing; even during the power cuts hotels
                        in city will have generators to serve you. However, trekking in the remote places you will have
                        to pay to charge your gadgets because of the electricity shortage.</p>

                </div>
            </div>
        </div>

        <div class="sidenav">
            <div class="floating-div">
                <h4 class="heading center">FAQ</h4>
                <a class="active" href="/nepal">Nepal</a></li>
                <a href="/visainformation">Visa Information</a>
                <a href="/foodaccomodation">Food And Accomodation</a>
                <a href="/safety">Safety</a>
                <a href="/activity">Activities</a>
                <a href="/camping">Camping</a>
                <a href="/amenities">Amenities</a>
                <a href="/paymentsecure">Payment Security</a>
            </div>
        </div>
    </div>
    <!-- .wrap -->
@endsection
@section('scripts')
    <script>
        // variables
        var topPosition = $('.floating-div').offset().top - 10;
        var floatingDivHeight = $('.floating-div').outerHeight();
        var footerFromTop = $('footer').offset().top;
        var absPosition = footerFromTop - floatingDivHeight - 3;
        var win = $(window);
        var floatingDiv = $('.floating-div');

        win.scroll(function () {
            if (window.matchMedia('(min-width: 768px)').matches) {
                if ((win.scrollTop() > topPosition) && (win.scrollTop() < absPosition)) {
                    floatingDiv.addClass('sticky');
                    floatingDiv.removeClass('abs');

                } else if ((win.scrollTop() > topPosition) && (win.scrollTop() > absPosition)) {
                    floatingDiv.removeClass('sticky');
                    floatingDiv.addClass('abs');

                } else {
                    floatingDiv.removeClass('sticky');
                    floatingDiv.removeClass('abs');
                }
            }
        });
    </script>
@endsection