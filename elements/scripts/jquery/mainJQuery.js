
$(document).ready(function() {

	// Global Vars Object
	document.jQueryInitVars = jQueryInitVars;

	// init functions
	execOnLoad(window, document);

	// Action listeners
	$(this).scroll(function() {
		execOnScroll(this);
	});
	$(window).resize(function() {
		execOnResize(this, document.jQueryInitVars);
	});

});

// Init function
var execOnLoad = function (win, doc) {
	execOnResize(win, doc.jQueryInitVars);
	execOnScroll(doc);
};

// Action listener functions
var execOnResize = function (win, vars) {
	responsive.resizeFitWidth(win, $("#pageWrap"), vars.siteWidth);
	responsive.changeElementFitWidth(win, $("#body #leftPanel"), 450, "displayToBlock");
	responsive.changeElementFitWidth(win, $("#body #rightPanel"), 800, "displayToBlock");
	responsive.changeElementFitWidth(win, $("#body #content"), 800, "displayToBlock");
	responsive.changeElementFitHeight($("#navigationWrap"), $("#navBar").height() + 20);
	responsive.navBarTextControl($("#navBar"), $("#pageWrap").width(), vars);
};

var execOnScroll = function(doc) {
	responsive.navBarScrollControl(doc, $("#navBar"), "navFixedTop");
};


