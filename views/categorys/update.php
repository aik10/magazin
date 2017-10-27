<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Categorys */

$this->title = 'Изменить категорию: ' . $model->c_name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->c_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div>

    <h1> <?= Html::encode($this->title) ?> </h1>
    <?= $this->render('_form', compact('model')); ?>

</div>

