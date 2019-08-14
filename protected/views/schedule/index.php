<?php
$var = 0;
?>
<style>
    .row-headers-background {
        display:none;
    }
</style>
<div id="schedule"></div>
<button id="loadWeddingParty" type="button">Wedding Party Schedule</button>
<script>

    $.ajax({
        url: "{google-docs-url}?chrome=false&output=html",
        async: false
    }).done(function( warmlyDocData ) {
        warmlyDoc = document.implementation.createHTMLDocument('warmlyDoc');
        warmlyDoc.documentElement.innerHTML = warmlyDocData;
        $("#schedule").html(warmlyDoc.getElementById("contents").innerHTML);
        delete warmlyDoc;
    }).fail(function( jqXHR, textStatus, errorThrown) {
        $("#schedule").html("There was an error loading the data :(");
        $("#schedule").slideDown(300);
    });


    var loadDetailedInformation = function() {
        $("#loadingContent").fadeIn();
        $.ajax({
            url: "{google-docs-url}?chrome=false&output=html",
            async: false
        }).done(function( warmlyDocData ) {
            warmlyDoc = document.implementation.createHTMLDocument('warmlyDoc');
            warmlyDoc.documentElement.innerHTML = warmlyDocData;
            $("#schedule").html(warmlyDoc.getElementById("contents").innerHTML);
            delete warmlyDoc;
            $("#loadingContent").fadeOut();
            $('html, body').animate({
		scrollTop: $($("#scrolledTop")).offset().top
	    }, 500, 'linear');
        }).fail(function( jqXHR, textStatus, errorThrown) {
            $("#schedule").html("There was an error loading the data :(");
            $("#schedule").slideDown(300);
        });
    };

    $("#loadWeddingParty").on("click", loadDetailedInformation);



/**
    var setDetailedInformation = function() {

        $.ajax({
        }).done(function( warmlyDocData ) {
            warmlyDoc = document.implementation.createHTMLDocument('warmlyDoc');
            warmlyDoc.documentElement.innerHTML = warmlyDocData;
            $("#weddingPartyInfo").html(warmlyDoc.getElementById("contents").innerHTML);
            delete warmlyDoc;
        }).fail(function( jqXHR, textStatus, errorThrown) {
            $("#weddingPartyInfo").html("There was an error loading the data :(");
            $("#weddingPartyInfo").slideDown(300);
        });


    }
*/

</script>
