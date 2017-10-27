<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php $product = ActiveForm::begin(['options'=> ['style'=>'width:500px;margin:‌​0px auto;']])?>
<?= $product->field($products, 'id_category')->dropDownList($categorys)?>
<?= $product->field($products, 'c_name')?>
<?= $product->field($products, 'c_price')?>
<!-- <?= $product->field($products, 'c_count')->input('number')?> -->
<?= $product->field($products, 'c_description')->textarea(['rows' => 5])?>
<?= Html::submitButton(
    'Сохранить',
    [
        'class' => 'btn btn-success',
        'name' => 'saveProduct',
        'value' => 'saveProduct'
    ]
)?>
<?php ActiveForm::end()?>


m3a <green>
85m0ab020696