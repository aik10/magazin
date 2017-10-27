<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searchLog */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $searchModel->titlelog;
$this->params['breadcrumbs'][] = $searchModel->titlelog;
?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="log-date-form">
    <?php $form = ActiveForm::begin(
        [
            'options'=> [
                'style'=> 'width:400px; margin:0px left;'
            ]
        ]
        ); ?>
    <?= $form->field($searchModel, 'c_date_start')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control', 'style' => 'width: 150px;']
    ]) ?>
    <?= $form->field($searchModel, 'c_date_end')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control', 'style' => 'width: 150px;']
    ]) ?>

    <div class="find-form-group">
        <?= Html::submitButton('Показать', [ 'class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div>
    <?php echo '</br>Итого: ' . $summ;?>
</div>

    <?php if ($typeIndex) {
        echo '<p><br>';
            echo Html::a('Добавить запись', ['create', 'type' => $typeIndex], ['class' => 'btn btn-success']);
        echo '</p>';
    }
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model, $key, $index, $grid) {
            if ($model->c_type == 'add') {
                return ['style' => 'background-color:#3CB371;'];
            } else {
                return ['style' => 'background-color:#CD5C5C;'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'id',
                'options' => ['width' => '100']
            ],
            // 'product.c_name',
            [
                'attribute' => 'id_product',
                'label' => 'Товар',
                'format' => 'text',
                'content' => function($data) {
                    return $data->product->c_name;
                },
                'filter' => $searchModel->getProductList($typeIndex)
            ],
            [
                'attribute' => 'c_count',
                'options' => ['width' => '70']
            ],
            [
                'attribute' => 'c_price',
                'options' => ['width' => '70']
            ],
            [
                'attribute' => 'c_summ',
                'options' => ['width' => '70']
            ],
            // 'c_date',
            [
                'attribute' => 'c_date',
                'format' =>  ['date', 'Y-MM-dd HH:mm:ss'],
                'options' => ['width' => '200']
            ],
            // 'type.c_text',
            [
                'attribute' => 'c_type',
                'label' => 'Тип',
                'format' => 'text',
                'content' => function($data) {
                    return $data->type->c_text;
                },
                'filter' => $searchModel->getTypeList()
            ],
            'c_comment:ntext',
            // 'c_count',
            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'template' => '{view} {update}',
            // ],
        ],
    ]); ?>
</div>
