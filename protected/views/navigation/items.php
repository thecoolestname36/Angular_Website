<?php

//[
//	{"navTitle":"Home", "navLink": "#/" },
//	{"navTitle":"Map", "navLink": "#/map" }
//]
//


$navItems = array();
$navItems[] = array(
  "navTitle" => "Home",
  "navLink" => "#/Home"
);
$navItems[] = array(
    "navTitle" => "RSVP",
    "navLink" => "#/rsvp"
);
$navItems[] = array(
    "navTitle" => "Schedule",
    "navLink" => "#/schedule"
);
$navItems[] = array(
  "navTitle" => "Map",
  "navLink" => "#/map"
);

$json = json_encode($navItems);
echo $json;