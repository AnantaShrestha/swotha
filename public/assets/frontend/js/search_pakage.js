(function(){
	$("#select2-multiple").select2({
        maximumSelectionLength: 1
    });

	$("#select2-multiple").on("select2:select", function (e) {
		var option = e.params.data.text;
		var showClass = option.replace(/\s/g, "");
		$("."+showClass).attr("hidden", false);
	});

	$("#select2-multiple").on("select2:unselect", function (e) {
		var option = e.params.data.text;
		var showClass = option.replace(/\s/g, "");
		$("."+showClass).attr("hidden", true);
	});
	
}());





(function(){
	var filters_params = [ 
		'trek_hike', 'expedition', 
		'adventure_sports_display', 'travel_deal_display',
		'family_tours_display', 'hotels_display',
		'biking_display','parks_display','parks_display',
		'overland_tours_display','culture&tour', 'awakening_tours'
	];


	$('.groups_eg_g').SumoSelect({triggerChangeCombined: false});



	var filter_params = function (idArg) {

		$(".options li").bind('click', function(event, ui) {
			alert($(this).attr('class'));
			$.each(filters_params, function (key, value) {
				if($(value).hasClass("open")){
					$("."+value+"_display").attr("hidden", false);
				}else{
					$(value).attr("hidden", true);
	    		}
	        });
		})
	}

}());


/**
 * facet search useing 
 * vue js
 */
