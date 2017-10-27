<?php

namespace app\controllers;

use yii\web\controller;
use app\models\Test;

class TestController extends controller {

    function actionTest () {

        $testData = Test::find()->All();
        return $this->render('test', compact('testData'));
    }


}

?>