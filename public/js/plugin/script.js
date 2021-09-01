function SearchInit(){
        this.disableZoom=function(){
            let style = document.createElement('style'); 
                style.innerHTML = "input,select:focus, textarea {font-size: 16px !important;}";
                document.head.appendChild(style);
                let javascriptFunction = style = document.createElement('style'); style.innerHTML = "input,select:focus, textarea {font-size: 16px !important;}"; 
                document.head.appendChild(style);
        }
        this.load_search = function(){
               $('.navigation-search').toggle();
        }
        this.moderSlider=function(){
             $(".Modern-Slider").slick({
                    autoplay: true,
                    autoplaySpeed: 10000,
                    speed: 600,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    pauseOnHover: false,
                    dots: true,
                    pauseOnDotsHover: true,
                    cssEase: 'linear',
                    draggable: false,
                    prevArrow: false,
                    nextArrow: false,
            });
        }
        this.compareSlider=function(){

        }
        this.teamSlider=function(){
            $("#team-slider").owlCarousel({
                items: 5,
                itemsDesktop: [1024, 4],
                itemsDesktopSmall: [979, 3],
                itemsTablet: [768, 3],
                itemsMobile: [650, 2],
                pagination: true,
                autoPlay: true
            });
        }
        this.gallerySlider=function(){
            $("#gallery-slider").owlCarousel({
                    items: 1,
                    itemsDesktop: [1000, 1],
                    itemsDesktopSmall: [979, 1],
                    itemsTablet: [768, 1],
                    itemsMobile: [650, 1],
                    pagination: true,
                    autoPlay: true,
                    nav: true
            });
   
        }
        this.reviewSlider=function(){
             $("#review-slider").owlCarousel({
                items: 2,
                itemsDesktop: [1000, 2],
                itemsDesktopSmall: [979, 2],
                itemsTablet: [768, 2],
                itemsMobile: [650, 1],
                pagination: true,
                autoPlay: true,
                nav: true
             });
        }
        this.tabPanelList=function(currentTab){
            let href =currentTab.find('a');
            let id = href.attr('href');
            currentTab.addClass("active");
            $(".inner-package-tab-panel.active").removeClass("active").fadeOut(5);
            $(id).fadeIn(500).addClass("active");
        }
        this.reviewTab=function(currentTab){
            let href = currentTab.find('a');
            let id = href.attr('href');
            currentTab.addClass("active");
            $(".inner-review-tab-panel.active").removeClass("active").fadeOut(200);
            $(id).fadeIn(500).addClass("active");
        }
        this.panel=function(){
             $('.panel-collapse').on('show.bs.collapse', function () {
                $(this).siblings('.panel-heading').addClass('active');
            });

            $('.panel-collapse').on('hide.bs.collapse', function () {
                $(this).siblings('.panel-heading').removeClass('active');
            });

        }
        this.overFlowControl=function(){
            $('.control-over').on('touchstart',function(){
                $('.loaded').css('overflow','hidden')
            });
             $('.control-over').on('touchend',function(){
                $('.loaded').css('overflow','visible')
            })
        }
        this.init = function(){
            let _this = this;
            $(document).ready(function(){
                setTimeout(function () {
                    $('body').addClass('loaded');
                }, 2000);
                _this.disableZoom();
                _this.moderSlider();
                _this.teamSlider();
                _this.gallerySlider();
                _this.reviewSlider();
                _this.panel();
                _this.overFlowControl();
                $('.nav li').hover(function () {
                    $(this).find('ul').first().stop().toggle(200);
                }, function () {
                    $(this).find('ul').stop().hide(200);
                });
                $('.fixed-search').on('click',function(){
                    _this.load_search();
                });
                $('.bar-ic').on('click', function (e) { 
                    $('.mobile-nav').css('left', '0px');
                });
                $('.cl-ic').on('click', function () {
                    $('.mobile-nav').css('left', '-320px');
                });
                $(".tab-list li").click(function (e) {
                    e.preventDefault();
                     $(".tab-list li").removeClass("active");
                    _this.tabPanelList($(this))
                });
                $(".review-tab-list li").click(function (e) {
                    e.preventDefault();
                    $(".review-tab-list li").removeClass("active");
                    _this.reviewTab($(this));

                });

                $(document).on('change', '.star', (function () {
                    $('#modal59').modal('show');

                }));

                $(document).on('change', '.recommend-star', (function () {
                    var starValue = $('input[name=recomendation_scale]:checked').val();

                    if (starValue <= 5) {
                        $('#modal-no-recommend').modal('show');
                    }
                }));


                $(document).on('change', '.star', (function () {
                    $('#modal59').modal('show');

                }));

                $(document).on('change', '.recommend-star', (function () {
                    var starValue = $('input[name=recomendation_scale]:checked').val();

                    if (starValue <= 5) {
                        $('#modal-no-recommend').modal('show');
                    }
                }));

                $(document).ready(function () {
                    $('.brochure').on('click', function () {
                        $('#brochureModal').modal('show');
                    });
                });

            });
           
        }
}
let init_obj =  new SearchInit();
    init_obj.init();
(function ($) {
    $.fn.removeStyle = function (style) {
        var search = new RegExp(style + '[^;]+;?', 'g');

        return this.each(function () {
            $(this).attr('style', function (i, style) {
                return style && style.replace(search, '');
            });
        });
    };
}(jQuery));

$(document).ready(function (e) {
    function t(t) {
        e(t).bind("click", function (t) {
            t.preventDefault();
            e(this).parent().fadeOut()
        })
    }

    e(".has-drop").click(function () {

        e(this).parents(".child-mb").children(".mobile-dropdown").toggleClass("show-mobile-dropdown");
    });
});
$(document).ready(function () {
    $(".submit_newsettler").click(function () {
        var e = $(".subscribe-email").val();
        if ("" === e) $("#alertmessage").css("display", "inline-block"), $("#alertmessage").text("Please fill the email").fadeOut(2e3);
        else {
            var a = validateEmail(e);
            if (!1 === a && ($("#alertmessage").css("display", "inline-block"), $("#alertmessage").text("Invalid Email").fadeOut(2e3)), !0 === a) {
                var t = $("input[name=_token]").val();
                $.ajax({
                    type: "post",
                    url: "/emailsubscribe",
                    data: {
                        _token: t,
                        email: e
                    },
                    success: function (e) {
                        $("#alertmessage").css("display", "inline-block"), $("#alertmessage").text(e[1]).fadeOut(5e3)
                    }
                })
            }
        }
    })

    function validateEmail(e) {
        return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(e)
    }
     $.fn.slickPause = function() {
    var _ = this;
    return _.each(function(index, element) {
        var st = element.slick.$slideTrack.get(0);
        element.slick.$slideTrack.css({
            transition: '',
            webkitTransform: window.getComputedStyle(st).webkitTransform,
            transform: window.getComputedStyle(st).transform
        });
       element.slick.animating = false;
        element.slick.autoPlayClear();
        element.slick.paused = true;

    });
};
    $('.compare-slider').slick({
        rows:2,
        speed: 900,
        arrow:false,
        autoplay: true,
        autoplaySpeed: 0,
        cssEase: 'linear',
        slidesToShow: 6,
        slidesToScroll: 0.5,
        infinite: true,
        swipeToSlide: true,
        centerMode: true,
        pauseOnHover: true,
        responsive: [
            {
              breakpoint: 750,
              settings: {
                slidesToShow: 3,
              }
            },
            {
              breakpoint: 480,
              settings: {
                speed: 2000,
                slidesToShow: 2,
                slidesToScroll:1,
              }
            },
            {
              breakpoint: 360,
              settings: {
                   speed: 2000,
                   slidesToShow: 1,
                   slidesToScroll:1,
              }
            },
        ]
       
    });
    var width = $("body").width();
    if(width > 1024) {
        jQuery('.compare-slider').slick("slickSetOption", "slidesToScroll", 0.5, false);    
    }  
    $('.upload-image-btn').on('click', function () {
        $('#uploadAnonymousModal').modal('show');
    });
    $("form#uploadAnonymous").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            async: false,
            url: "/upload-image",
            data: formData,
            success: function (data) {
                // alert('success');
                $('.uploadAnonymousPhoto').html('<img src="' + data[0] + '" alt="">');
                //$('#photo').val(data[1]);
                $('#uploadAnonymousModal').modal('hide');

            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    <!--Start of Tawk.to Script-->/*so that it can appear on every pages of website*/
    // <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/59241c9c76be7313d291e0e6/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
    // </script>
    // <!--End of Tawk.to Script-->

});
