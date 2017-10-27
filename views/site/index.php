<?php

use yii\widgets\ActiveForm;
// use yii\widgets\Html;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Магазин';

?>
<div class="site-index">

    <div class="jumbotron">
        <h2>Внимание!</h2>
        <p class="lead">Для какого магазина будете вносить данные?</p>
        <div class="row center">
            <div class="col-md-12 text-center">
                <div class="dropdown btn-group">
                    <?php $form= ActiveForm::begin(); ?>
                    <?= $form->field($magazin, 'id')->dropDownList($magazins, ['style'=>'width:400px', 'onchange'=> 'this.form.submit()', 'prompt' => 'Выберите магазин...'])?>
<!--                 <div class="form-group">
                    <?= Html::submitButton($magazin->isNewRecord ? 'Создать' : 'Изменить', ['class' => $magazin->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div> -->
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="body-content">

    <!-- Контент -->

    </div>
</div>
