$(document).ready(function() {
	$("#carousel").carouFredSel({
		items				: 1,
		direction			: "left",
		scroll : {
			items			: 1,
			easing			: "elastic",
			duration		: 1000,							
			pauseOnHover	: true,
			auto			: true,
			width			: 300
		}					
	});	
});