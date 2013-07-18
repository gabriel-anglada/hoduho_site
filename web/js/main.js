$(document).ready(function() {
	$("#carousel").carouFredSel({
		items				: 1,
        scroll : {
			items			: 1,
			duration		: 2000,
            fx              : "crossfade",
			pauseOnHover	: true,
			auto			: true,
			width			: 300
        }
	});
});