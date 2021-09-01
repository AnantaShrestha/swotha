$(document).ready(function () {
    setTimeout(function () {
        $(".custom-notification").addClass("active");
    }, 1500);
    $(".close-notification").click(function (e) {
        e.preventDefault();
        $(".custom-notification").removeClass("active");
    });
    const mySwiper = new Swiper('.swiper-container', {
        loop: true,
        speed: 6000,
         autoplay: {
             delay: 6000
         },
        autoplay: true,
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflowEffect: {
            rotate: 0,
            stretch: 80,
            depth: 200,
            modifier: 1,
            slideShadows: false,
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

    });

});

function reserveModal(id) {
    $('#holdModal' + id).modal('show');
}

$('.currencyButton').on('click', function () {
    $('#currencyModal').modal('show');
});

$('#currencySubmit').on('click', function () {

// $('#currencyChange').addClass('hide');
    $('.loadingStatus').removeClass('hide');

    var toConvert = $('#currencyChange').val();
    $.ajax({
        type: "POST",
        async: false,
        url: "/currency/convert",
        data: {
            '_method': 'POST',
            '_token': $('input[name=_token]').val(),
            'toConvert': toConvert
        },
        success: function (data) {
            console.log(data);
            //Converting the original price
            $('.originalPrice').each(function () {
                var price = $(this).html();
                var convertedPrice = Math.round(price * data[0]);
                $(this).closest('.oldPrice').find('.oldConverted').html(" <strike>" + data[2] + " " + convertedPrice + "</strike>");
            });
            //Converting the discounted price
            $('.price').each(function () {
                var price = $(this).html();
                var convertedPrice = Math.round(price * data[0]);
                $(this).closest('.newPrice').find('.newConverted').html(" &nbsp;" + data[2] + " " + convertedPrice + "</strike>");
                $('.price').css("font-size", "16px");
            });

            $('.loadingStatus').addClass('hide');
            $('#currencyChange').removeClass('hide');
            $('#currencyButton').text(data[1]);
            $('#currencyModal').modal('toggle');
        }

    });
});