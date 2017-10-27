<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categorys */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorys-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'c_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'c_date_create')->textInput() ?>

    <?= $form->field($model, 'c_deleted')->textInput() ?>

    <?= $form->field($model, 'c_date_delete')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
