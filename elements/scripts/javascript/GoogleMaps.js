/**
 * Created by brad on 1/27/18.
 */

function GoogleMaps() {

    this.googleMapsApiSize = function() {

        var contentWidth = $("#content").width() - 15;
        var googleMapsAPI = $("#mapImage");
        googleMapsAPI.css('width',contentWidth);
        googleMapsAPI.css('height',contentWidth * 0.55);

        var googleMapsAPI = $("#googleMapsA");
        googleMapsAPI.css('width',contentWidth);
        googleMapsAPI.css('height',contentWidth * 0.55);

        var googleMapsAPI = $("#googleMapsB");
        googleMapsAPI.css('width',contentWidth);
        googleMapsAPI.css('height',contentWidth * 0.55);

        var googleMapsAPI = $("#googleMapsC");
        googleMapsAPI.css('width',contentWidth);
        googleMapsAPI.css('height',contentWidth * 0.55);

    };

}
var googleMaps = new GoogleMaps();
googleMaps.googleMapsApiSize();

$(document).ready(function() {
    document.googleMapsApp = new GoogleMaps();
    $(window).resize(function() {
        document.googleMapsApp.googleMapsApiSize();
    });
});
