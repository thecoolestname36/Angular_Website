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
        url: "https://docs.google.com/document/d/e/2PACX-1vTkwJFtcuyRVnntPXlCwIQzXTGkebw1zf98o5T3IH_8N0wu6qByN2pXlhycSL-c2yUJh50ic-AbsgPF/pub?chrome=false&output=html",
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
            url: "https://docs.google.com/document/d/e/2PACX-1vQglRtJOuTjidlvwPyGPv48JgdBMd60v_RY7luYt42i-WfajIie2HWe-GzeSUSAPelBWELaJpaa067H/pub?chrome=false&output=html",
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
