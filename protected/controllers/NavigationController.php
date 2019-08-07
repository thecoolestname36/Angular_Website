<?php namespace srad\controllers;
/**
 * Created by PhpStorm.
 * User: brad
 * Date: 7/8/18
 * Time: 5:37 PM
 */
use srad\components\ControllerComponent;

class NavigationController extends ControllerComponent {

    public function __construct()
    {
    }

    public function actionIndex() {
        $navItems = array();
        $navItems[] = array(
            "navTitle" => "Home",
            "navLink" => "#/Home"
        );
        $navItems[] = array(
            "navTitle" => "RSVP",
            "navLink" => "#/Rsvp"
        );
        $navItems[] = array(
            "navTitle" => "Map",
            "navLink" => "#/Map"
        );
        $navItems[] = array(
            "navTitle" => "Schedule",
            "navLink" => "#/Schedule"
        );

        $json = json_encode($navItems);
        echo $json;
    }


}
