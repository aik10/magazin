<?php 

namespace app\controllers;

use yii\web\Controller;
use app\models\Man;
use app\models\Yii;

/**
* 
*/
class MyController extends Controller
{
     function actionForm () {
        $mans = new Man();
        return $this->render('db', compact('mans'));
     }


    function actionDb () {
        //добавление данных в бд
        //insert
        // $newMan = new Man();
        // $newMan->c_name = 'new';
        // $newMan->c_age = 18;
        // $newMan->c_sex = 0;
        // $newMan->save();

        //update
        // $manUpdate = Man::findOne(7);
        // $manUpdate->c_name = 'update';
        // $manUpdate->save();

        //delete
        // $manUpdate = Man::findOne(7);
        // $manUpdate->delete();
        // $manUpdate->deleteAll(['>', 'id', 3]);//без параметров - все удалится

        //получение данных из бд
        // $mans = Man::find()->orderBy(['c_age' => SORT_ASC])->all();
        $mans = Man::find()->asArray()->all();
        // $mans = Man::find()->asArray()->where('c_sex = 0')->all();
        // $mans = Man::find()->asArray()->where(['c_sex' => 0])->all();
        // $mans = Man::find()->asArray()->where(['like', 'c_name', 'lex'])->all();
        // $mans = Man::find()->asArray()->where(['<=', 'id', 3])->all();
        // $mans = Man::find()->asArray()->where('c_sex = 0')->limit(1)->all();
        // $mans = Man::find()->count();
        // $mans = Man::findOne(['c_sex' => 1]);
        // $mans = Man::findAll(['c_sex' => 1]);
        // $query = "SELECT * FROM man WHERE c_name LIKE '%lex%'";
        // $mans = Man::findBySql($query)->all();
        // $query = "SELECT * FROM man WHERE c_name LIKE :search";
        // $mans = Man::findBySql($query, [':search' => '%lex%'])->all();
        return $this->render('db', compact('mans'));
    }

    function actionTest($id = null) {
        $popa = 'POPA';
        $arr = [
            'one', 'two', 'tree'
        ];

        if (!$id) $id = 'test';
        return $this->render('hello', compact('popa', 'arr', 'id'));
    }
}

?>