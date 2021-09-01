$(window).scroll(function(){

    if ($(window).scrollTop() >= 4) {
        $('#header').addClass('fixed-header');
        if($(this).find('#book-side'))
             $('#book-side').addClass('fixed-booksidebar');
        if($(this).find('#package-trip-tap '))
            $('#package-trip-tap ').addClass('fixed-trip-nav');
    }
    else {
        $('#header').removeClass('fixed-header');
        if($(this).find('#book-side'))
            $('#book-side').removeClass('fixed-booksidebar')
    }
    if($(window).scrollTop() >=10)
    	$('#sidesbar').addClass('fixed-sidebar');
    else
    	$('#sidesbar').removeClass('fixed-sidebar');



});
