/**
 * Created by brad on 1/27/18.
 */

function NavbarControl() {

    this.navbarClass = '';

    this.navBarElement = $("#navBar");

    this.execOnResize = function() {
        //this.navBarElement(win, $("#pageWrap"), $(document).width());
    };

    this.navBarScrollControl = function () {
        if (document.applicationVariables.navTop >= $(document).scrollTop()) {
            if(this.navbarClass == 'navFixedTop') {
                this.navBarElement.removeClass('navFixedTop');
                this.navbarClass = '';
            }
        } else {
            if(this.navbarClass == '') {
                this.navBarElement.addClass('navFixedTop');
                this.navbarClass = 'navFixedTop';
            }
        }
    };

    this.navBarTextControl = function(navBar, superWidth, vars) {

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
    };

    this.navBarScrollControl();

}