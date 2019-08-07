
$(document).ready(function() {

	document.applicationVariables = new ApplicationVariables();
    document.responsiveJQuery = new ResponsiveJQuery();
    document.navbarControl = new NavbarControl();
	// Action listeners

	$(window).resize(function() {

        document.responsiveJQuery.execOnResize();
        document.navbarControl.execOnResize();
        document.navbarControl.navBarTextControl($("#navBar"), $("#pageWrap").width(), document.applicationVariables);
	});
    $(this).on('scroll', function() {
        document.navbarControl.navBarScrollControl();
    });

    $(".navLink").on('click', function() {
    });

});
