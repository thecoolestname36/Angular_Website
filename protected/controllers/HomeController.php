<?php namespace srad\controllers;
/**
 * Created by PhpStorm.
 * User: brad
 * Date: 7/8/18
 * Time: 5:33 PM
 */
use srad\components\ControllerComponent;

class HomeController extends ControllerComponent {


    public function actionIndex()
    {


        $pageTitle = "";
        $json = json_encode([[
            "pageTitle" => $pageTitle,
            "pageContent" => $this->renderView("home/index")
        ]]);
        echo $json;

    }


}