$(document).ready(function () {
    $('#itenary').on('change', function () {
        if ($(this).val() == 1) {
            $(this).val(0);
            $('.itenirary-head').text('Detailed Itinerary');
            $('.itinerary').each(function () {
                let action = $(this).find('.panel-collapse');
                action.addClass('show');
            });
            $('.switch').attr('title', 'Collapse All');
            $('.switch').text('Collapse All');
        } else {
            $(this).val(1);
            $('.itenirary-head').text('Brief Itinerary');
            $('.itinerary').each(function () {
                let action = $(this).find('.panel-collapse');
                action.removeClass('show');
            });
            $('.switch').attr('title', 'Expand All');
            $('.switch').text('Expand All');


        }
    });
    $('.moredescriptionscroll').on('mouseenter', function () {

        overscroll($(this));
    });
    $('.moredescriptionscroll').on('touchstart', function () {
        overscroll($(this));
    });
    $('.enquiryPop').on('click', function () {
        $('#enquiryModal').modal('show');
    });
    $('.bookNowPop').on('click', function () {
        $('#bookEnquiry').modal('show');
    });
    $('.seegroupdiscount').on('click', function () {
        $('#discountModal').modal('show');
    });

    $('.facts-content').on('mouseenter', function () {

        overscroll($(this));
    });
    $('.facts-content').on('touchstart', function () {

        overscroll($(this));
    });

    overscroll($('.itenary-over'));


    function overscroll(classname) {
        $(classname).niceScroll({
            cursorcolor: "#777",
            cursoropacitymin: 0.3,
            background: "#ddd",
            cursorborder: "0",
            autohidemode: false,
            cursorminheight: 30,
            cursorwidth: 8,
        });

        $(classname).getNiceScroll().resize();
        $("html").mouseover(function () {
            $(classname).getNiceScroll().resize();
        });
    }

    $('.tripdate').on("click", function () {
        var date = $(this).data("id");
        var tripid = $(this).data("tripid");
        $('.fixed-months a').css({'background-color': '', 'opacity': ''});
        $(this).css("cssText", "background-color:#fc0 !important;");
        // $(this).css('color','black');


        $.ajax({
            type: 'POST',
            url: "show/fixeddepbymonth",
            data: {
                '_token': $('input[name=_token]').val(),
                'date': date,
                'tripid': tripid
            },
            success: function (data) {
                // if(data.trips.length > 0) {
                all = data.trips;
                // console.log(all);
                arrayLength = all.length;
                $('#fixeddep tbody').empty();
                for (var i = 0; i < arrayLength; i++) {
                    var markup =
                        "<tr id='actsrow' class=''>" +
                        "<td>" + all[i]['start_date'] + "</td>" +
                        "<td>" + all[i]['finish_date'] + "</td>" +
                        "<td>" + all[i]['remainingseats'] + "</td>" +
                        "<td> $ " + all[i]['price'] + "</td>" +
                        "<td><a href='/holdthetrip/" + all[i]['id'] + "' class='waves-effect waves-light tableBtn '>Reserve</a></td>" +
                        "<td><a href='/book/" + all[i]['id'] + "' class='waves-effect waves-light tableBtn '>Book</a></td>" +
                        "</tr>";
                    $("#fixeddep tbody").append(markup).slideDown("fast");
                }
                // }else {
                //     alert("No any data available !");
                // }
            },
        });

    });
    $('.date-haru div:first .fixed-months .tripdate').click();

    $(window).scroll(function () {
        var scrollDistance = $(window).scrollTop();
        $('.page-scroll').each(function (i) {
            if ($(this).position().top <= scrollDistance + 160) {
                $('.package-tabs li.active').removeClass('active');
                $('.package-tabs li').eq(i).addClass('active');
            }
        });
    }).scroll();

    $('.scroll__to').click(function () {
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top - 140

        }, 500);

        return false;
    });

    $('.book-group-tour').click(function () {
        $('.fixed-departure').click();
    })
});
