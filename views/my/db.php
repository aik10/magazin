<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

    //echo '<pre>' . print_r($mans, true) . '</pre>';
    // foreach ($mans as $man) {
    //     echo $man->c_name . '<br>';
    // }

?>
<?php $form = ActiveForm::begin() ?>
<?= $form->field($mans, 'name')?>
<?= $form->field($mans, 'age')?>
<?= $form->field($mans, 'sex')?>
<?= Html::submitButton('Отправить', ['class' => 'btn btn-success'])?>
<?php ActiveForm::end()?>