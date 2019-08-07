<?php
/**
 * @var $this \srad\controllers\HomeController
 */
?>
<link rel="stylesheet" type="text/css" href="elements/styles/css/appStyles/page-rsvp.css">

<div id="rsvpFormA">
    <form id="form-a" action="<? echo $this->createRequestUrl('Rsvp/Form'); ?>" method="POST">
        <!-- FirstName -->
        <label for="FirstName">First Name</label>
        <p id="first-name-group" class="form-group">
            <input type="text" class="form-control" name="FirstName" placeholder="First Name" required/>
            <!-- errors will go here -->
        </p>
        <!-- LastName -->
        <label for="name">Last Name</label>
        <p id="last-name-group" class="form-group">
            <input type="text" class="form-control" name="LastName" placeholder="Last Name" required/>
            <!-- errors will go here -->
        </p>
        <button id="rsvp_form_btn_next" class="button" type="submit" disabled="true" class="btn btn-success">Next <span id="rsvp_form_btn_next_icon"><i class="fa fa-arrow-right"></i></span></button>
    </form>
</div>

<div id="rsvpFormB">
    <form id="form-b" action="<? echo $this->createRequestUrl('Rsvp/Form'); ?>" method="POST">
        <!-- Attending -->
        <label for="name">Attending?</label>
        <p id="attending-group" class="form-group">
            <input type="checkbox" class="form-control onoff" name="Attending"/>
            <span id="attending-comment" style="display:none;">We're so excited to see you!</span>
            <span id="attending-comment-neg" style="display:none;">We're sorry you can't make it!</span>
            <!-- errors will go here -->
        </p>
        <!-- PlusOne -->
        <label for="name">Plus One?</label>
        <p id="plus-one-group" class="form-group">
            <input type="checkbox" class="form-control onoff" name="PlusOne"/>
            <span id="plus-one-comment" style="display:none;">We're excited to have your plus one!</span>
            <!-- errors will go here -->
        </p>
        <!-- Comment -->

        <input type="textarea" class="form-control-hidden" name="Comment" placeholder="Comments"/>
        <p id="comment-group" class="form-group">
            <textarea id="rsvpForm_Comment" class="form-control" name="Comment" placeholder="Comments"/>
            <!-- errors will go here -->
        </p>
        <button id="rsvp_form_btn_submit" class="button" type="submit" disabled="true" class="btn btn-success">Submit <span id="rsvp_form_btn_submit_icon"><i class="fa fa-arrow-right"></i></span></button>
    </form>
</div>

<script type="text/javascript" src="elements/scripts/javascript/RSVPForm.js"></script>
<script>
    document.responsiveJQuery.execOnResize();
</script>
