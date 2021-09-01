(function(){
	$(document).ready(function(){
		$(":checkbox").labelauty();
		$(":radio").labelauty();
	});

	/**
	 * hover in and hove out
	 * background color blue
	 * @param  {[type]} argument) {		$(this).addClass("active")	} [description]
	 * @return {[type]}           [description]
	 */
	$(".bg-grey").hover(function(argument) {
		var that = $(this);
		that.addClass("active");

		that.mouseleave(function () {
			that.removeClass("active");
		});
	});

	/**
	 * active when click
	 */
	 $(".bg-grey").click(function(e) {
	 	e.preventDefault();
	 	console.log("hel");
		var this_click = $(this);
		this_click.addClass("active");

		this_click.mouseleave(function () {
			this_click.addClass("active");
		});
	});


}());