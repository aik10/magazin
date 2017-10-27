<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Log */

$this->title = 'Журнал: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Журнал', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_product',
            'c_date',
            'c_type',
            'c_comment:ntext',
            'c_count',
        ],
    ]) ?>

</div>
