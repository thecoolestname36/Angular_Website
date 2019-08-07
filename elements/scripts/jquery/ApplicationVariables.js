function ApplicationVariables() {

    this.navTop = parseInt($("#navBar").offset().top, 10);
    this.navWidth = 0;
    this.siteWidth = parseInt($("#pageWrap").css("width"), 10);

}