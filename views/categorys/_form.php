<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categorys */
/* @var $form yii\widgets\ActiveForm */
// )->textarea(['rows' => 6])
?>


<div class = "form-categorys">

    <?php $form = ActiveForm::begin(['options' => ['style'=> 'width: 400px;']])?>
    <?= $form -> field($model, 'c_name')->textInput() ?>
<!-- 
    <?= $form -> field($model, 'c_date_create')->textInput() ?>

    <?= $form -> field($model, 'c_deleted')->textInput() ?>

    <?= $form -> field($model, 'c_date_delete')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end();?>

</div>