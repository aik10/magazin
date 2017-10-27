<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
    $textTitle = 'Все';
    if (isset($category)) {
        $textTitle = $category;
    }
?>

<div class = "products-index">

    <h1><?= Html::encode('Товары из категории ' . $textTitle) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => function($model, $key, $index, $grid) {
                if ($index % 2) {
                    return ['style' => 'background-color:#FAF0E6;'];
                } else {
                    return ['style' => 'background-color:#D3D3D3;'];
                }
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'c_name:ntext',
                'c_description:ntext',
                // 'c_price',
                [
                    'attribute' => 'c_price',
                    'options' => ['width' => 100]
                ],
                [
                    'attribute' => 'id_category',
                    'label' => 'Категория',
                    'format' => 'text',
                    'content' => function($data) {
                        return $data->category->c_name;
                    },
                    'filter' => $searchModel->getCategoryList()
                ],
                // 'c_count',
                // [
                //     'attribute' => 'c_count',
                //     'options' => ['width' => 100]
                // ],
                'c_date_create',
                // 'id_category',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',// {link}',
                    // 'buttons'=> [
                    //     'link' => function ($url,$model,$key) {
                    //         return Html::a('Действие', $url);
                    //     },
                    // ]
                ],
            ],
    ]); ?>

</div>
