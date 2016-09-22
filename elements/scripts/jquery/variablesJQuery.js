var jQueryInitVars;

$(document).ready(function() {

	jQueryInitVars = {
		navTop: parseInt($("#navBar").offset().top, 10),
		navWidth: 0,
		siteWidth: parseInt($("#pageWrap").css("width"), 10)
	};

});