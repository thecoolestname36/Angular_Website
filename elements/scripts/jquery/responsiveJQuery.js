

var responsive = {

	navBarScrollControl: function (doc, elem, changeClass) {
		if (doc.jQueryInitVars.navTop >= $(doc).scrollTop()) {
			$(elem).removeClass(changeClass);
		} else {
			$(elem).addClass(changeClass);
		}
	},

	resizeFitWidth: function (parent, child, initWidth) {
		if ($(parent).width() < initWidth) {
			$(child).width($(parent).width());
		} else {
			$(child).width(initWidth);
		}
	},

	changeElementFitHeight: function(parentElem, childHeight) {
		$(parentElem).height(childHeight);
	},

	changeElementFitWidth: function(parent, elemToChange, widthToChange, changeClass) {
		if ($(parent).width() < widthToChange) {
			$(elemToChange).addClass(changeClass);
		} else {
			$(elemToChange).removeClass(changeClass);
		}
	},

	navBarTextControl: function(navBar, superWidth, vars) {

		// Function declarations
		var controller = function(navBar, superWidth) {
			if (navBar.width() > superWidth) {
				var r = -1;
				if (vars.navWidth == 0){
					vars.navWidth = navBar.width();
					r = 1;
				}
				return r;
			} else {
				var r = -1;
				if (vars.navWidth < superWidth && vars.navWidth !=0) {
					vars.navWidth = 0;
					r = 0;
				}
				return r;
			};
		};

		var changeNavItems = function(state) {
			var homeText = "Home", homeIcon = "<i class=\"fa fa-home\"></i>";
			navBar.find("a").each(function() {
				// This is the base state
				if (state == 0) {


					// Home
					if($(this).html() === homeIcon || $(this).html() === homeText) {
						$(this).html(homeText);
					}
				}
				if (state == 1) {
					// Home
					if($(this).html() === homeIcon || $(this).html() === homeText) {
						$(this).html(homeIcon);
					}
				}
			});
		};

		// Run the controller
		var x = controller(navBar, superWidth);

		if (x > -1) {
			changeNavItems(x);
		}
	}
};