/**
 * Created by brad on 1/28/18.
 */





$(document).ready(function() {


    $('input[name=Attending]').change(function() {
        if(this.checked) {
            $("#attending-comment-neg").fadeOut(100,function() {
                $("#attending-comment").fadeIn();
            });
        } else {
            $("#attending-comment").fadeOut(100, function() {
                $("#attending-comment-neg").fadeIn();
            });
        }
    });



    $('input[name=PlusOne]').change(function() {
        if(this.checked) {
            $("#plus-one-comment").fadeIn();
        } else {
            $("#plus-one-comment").fadeOut();
        }
    });



    $("#rsvp_form_btn_next").prop('disabled', false);
    // process the form
    $('#form-a').submit(function(event) {
        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'FirstName'              : $('input[name=FirstName]').val(),
            'LastName'              : $('input[name=LastName]').val(),
            'Part'              : 1
        };

        $("#rsvp_form_btn_next").prop('disabled', true);
        $("#rsvp_form_btn_next_icon").html('<i class="fa fa-cog fa-spin fa-fw"></i>');

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'protected/Main.php?request=Rsvp/Form', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
        }).success(function(data) {
            if(data.code == 200) {
                $('input[name=FirstName]').prop('disabled', true);
                $('input[name=LastName]').prop('disabled', true);
                $("#rsvp_form_btn_next").slideUp(400, function() {
                    $("#rsvpFormB").slideDown();
                });

                $("#rsvp_form_btn_submit").prop('disabled', false);
                $('input[name=Attending]').prop( "checked", data.Attending );
                if( $('input[name=Attending]').prop( "checked") == true) {
                    $("#attending-comment").fadeIn();
                }
                $('input[name=PlusOne]').prop( "checked", data.PlusOne );
                if( $('input[name=PlusOne]').prop( "checked" ) == true) {
                    $("#plus-one-comment").fadeIn();
                }
                $('#rsvpForm_Comment').val(data.Comment)

            } else {
                alert(data.message);
                $("#rsvp_form_btn_next").prop('disabled', false);
            }
            $("#rsvp_form_btn_next_icon").html('<i class="fa fa-arrow-right"></i>');
        }).error(function() {
            alert("Im sorry, there was an error.");
            $("#rsvp_form_btn_next_icon").html('<i class="fa fa-arrow-right"></i>');
        });
        event.preventDefault();
    });
    $('#form-b').submit(function(event) {

        $("#rsvp_form_btn_submit").prop('disabled', true);
        $("#rsvp_form_btn_submit_icon").html('<i class="fa fa-cog fa-spin fa-fw"></i>');
        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'FirstName'              : $('input[name=FirstName]').val(),
            'LastName'              : $('input[name=LastName]').val(),
            'Attending'              : $('input[name=Attending]').prop( "checked" ),
            'PlusOne'              : $('input[name=PlusOne]').prop( "checked" ),
            'Comment'              : $('#rsvpForm_Comment').val(),
            'Part'              : 2
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'protected/Main.php?request=Rsvp/Form', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
        }).success(function(data) {
            if(data.code == 200) {
                alert("Your response has been successfully updated!");
            } else {
                alert(data.message);
            }
            $("#rsvp_form_btn_submit").prop('disabled', false);
            $("#rsvp_form_btn_submit_icon").html('<i class="fa fa-arrow-right"></i>');
        }).error(function() {
            alert("Im sorry, there was an error.");
            $("#rsvp_form_btn_next").prop('disabled', true);
            $("#rsvp_form_btn_submit").prop('disabled', false);
            $("#rsvp_form_btn_submit_icon").html('<i class="fa fa-arrow-right"></i>');
        });
        event.preventDefault();
    });
});