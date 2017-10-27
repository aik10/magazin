<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'c_name') ?>

    <?= $form->field($model, 'c_description') ?>

    <?= $form->field($model, 'c_price') ?>

    <?= $form->field($model, 'id_category') ?>

    <?php // echo $form->field($model, 'c_category') ?>

    <?php // echo $form->field($model, 'c_count') ?>

    <?php // echo $form->field($model, 'c_date_create') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
