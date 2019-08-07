<?php namespace srad\controllers;
/**
 * Created by PhpStorm.
 * User: brad
 * Date: 7/8/18
 * Time: 5:33 PM
 */
use srad\components\ControllerComponent;

class MapController extends ControllerComponent {


    public function actionIndex()
    {
        $pageTitle = "Map";
        $json = json_encode([[
            "pageTitle" => $pageTitle,
            "pageContent" => $this->renderView("map/index")
        ]]);
        echo $json;

    }


}