

function ResponsiveJQuery() {

    this.execOnResize = function () {
        var win = $(window);
        this.resizeFitWidth(win, $("#pageWrap"), $(document).width());
        this.changeElementFitWidth(win, $("#body #leftPanel"), 450, "displayToBlock");
        this.changeElementFitWidth(win, $("#body #rightPanel"), 1200, "displayToBlock");
        this.changeElementFitWidth(win, $("#body #content"), 1200, "displayToBlock");

    };

	this.resizeFitWidth = function (parent, child, initWidth) {

		if ($(parent).width() < initWidth) {
			$(child).width($(parent).width());
		} else {
			$(child).width(initWidth);
		}
	};

	this.changeElementFitWidth = function(parent, elemToChange, widthToChange, changeClass) {
		if ($(parent).width() < widthToChange) {
			$(elemToChange).addClass(changeClass);
		} else {
			$(elemToChange).removeClass(changeClass);
		}
	};

    // Init functions here
    this.execOnResize();
}