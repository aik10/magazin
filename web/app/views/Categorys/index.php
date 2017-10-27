<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorys';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorys-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Categorys', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'c_name:ntext',
            'c_date_create',
            'c_deleted',
            'c_date_delete',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
