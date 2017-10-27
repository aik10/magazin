<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Log */
/* @var $form yii\widgets\ActiveForm */

// $model->c_type = $type;
?>

<div class="log-form">
    <?php $form = ActiveForm::begin(['options'=> ['style'=> 'width:400px; margin:0px left;']]); ?>

    <?= $form->field($model, 'id_product')->dropDownList($model->getProductList($type), ['prompt' => 'Выберите товар из списка...']) ?>

    <!-- <?= $form->field($model, 'c_type')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'c_count')->textInput(['style'=>'width:180px']) ?>

    <?= $form->field($model, 'c_comment')->textarea(['rows' => 6]) ?>

    <!-- <?= $form->field($model, 'c_date')->textInput(['style'=> 'width:180px'])?> -->
    <?= $form->field($model, 'c_date')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Записать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
