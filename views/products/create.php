<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Товар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="products-create">

    <h1><?= Html::encode('Добавить товар') ?></h1>

    <?= $this->render('_form', compact('model', 'categorys')) ?>

</div>
