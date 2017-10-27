<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form= ActiveForm::begin(['options' => ['style' => 'width:400px; margin:0px left']]); ?>

        <?= $form->field($model, 'c_name')->textInput() ?>

        <?= $form->field($model, 'c_description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'c_price')->textInput() ?>

        <?= $form->field($model, 'id_category')->dropDownList($categorys) ?>

    <!--     <?= $form->field($model, 'c_count')->textInput() ?> -->

        <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>