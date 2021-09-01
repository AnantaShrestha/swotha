
/**
 * hide and show menu bar
 * @param  {[type]} e) {               e.preventDefault();    i++;    if(i % 2 ! [description]
 * @return {[type]}    [description]
 */

(function(){
	var i = 0;
    $("#btn").click(function (e) {
        e.preventDefault();
        i++;
        if(i % 2 !== 0){
           $("#hidden-menu").addClass("hidden-menu-transition");
           $(".menu-bg").show();
           $(".destination-caret-up").show();
        }else{     
            $("#hidden-menu").removeClass("hidden-menu-transition");
        	$(".menu-bg").hide();
        	$(".destination-caret-up").hide();
        }
    });


	$(window).scroll(function () {
		if($(this).scrollTop() > 1){
			$(".header-top").addClass("sticky");
			$(".logo").addClass("after_scroll_logo");
			$(".info").addClass("after_scroll_info");
			$("#hidden-menu").addClass("after_scroll_hidden-menu");
			$(".header-right small").hide();
			$(".navbar-wrapper").find("nav").attr("id", "");

			//manage caret margin
			$(".menu-bg").addClass("after_scroll_menu_bg");
			$(".destination-caret-up").hide();

			$("#btn").hide();
		}else{
			$(".header-top").removeClass("sticky");
			$(".logo").removeClass("after_scroll_logo");
			$(".info").removeClass("after_scroll_info");
			
			$(".navbar-wrapper").find("nav").attr("id", "hidden-menu");
			$("#hidden-menu").removeClass("after_scroll_hidden-menu");

			//manage caret margin after scroll
			$(".menu-bg").removeClass("after_scroll_menu_bg");
			$(".destination-caret-up").show();

			$(".header-right small").show();
			$("#btn").show();
		}
	});


}());

var e = document.getElementById('btn');e.addEventListener('click', function() {  if (this.className == 'on') this.classList.remove('on');  else this.classList.add('on');});

/**
 * drop down for destination
 */
(function(){
	var menus = [ '.destination_display', '.themes_display', '.about_display', '.travel_deal_display'];
	
	var dropdown = function (selector) {
		var i = 0;
		
		$(selector).on('click', function (e) {
			
			e.preventDefault();
	        i++;
			$.each(menus, function (key, value) {
    			if(value === selector+"_display"){
    				$(value).toggleClass("open");
					if($(value).hasClass("open")){
						$(value).attr("hidden", false);
    				}else{
    					$(value).attr("hidden", true);
    				}
    				
    			}else{
    				$(value).removeClass("open");
        			$(value).attr("hidden", true);
        		}
	        });
		});
	};
	
	dropdown(".destination");
	dropdown(".themes");
	dropdown(".about");
	dropdown(".travel_deal");

}());
