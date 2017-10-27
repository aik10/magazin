<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Products */


$this->title = 'Изменить товар: ' . $model->id;

$this->params['breadcrumbs'][] = ['label' => 'Товар', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';

?>

<div class="products-update">

    <h1><?= Html::encode('Изменение товара') ?></h1>

        <?= $this->render('_form', compact('model', 'categorys'))?>

</div>
