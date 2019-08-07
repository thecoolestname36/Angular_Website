<?php namespace srad\controllers;
/**
 * Created by PhpStorm.
 * User: brad
 * Date: 7/8/18
 * Time: 5:33 PM
 */
use srad\components\ControllerComponent;

class ScheduleController extends ControllerComponent {


    public function actionIndex()
    {
        $pageTitle = $this->createUrl;
        $json = json_encode([[
            "pageTitle" => $pageTitle,
            "pageContent" => $this->renderView("schedule/index")
        ]]);
        echo $json;

    }

    public function actionWeddingParty()
    {
        $pageTitle = "Wedding Party Schedule";
        $json = json_encode([[
            "pageTitle" => $pageTitle,
            "pageContent" => $this->renderView("schedule/weddingParty")
        ]]);
        echo $json;

    }


}
