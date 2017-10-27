<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Log */

$this->title = 'Запись в ' . $model->titlelog;
$this->params['breadcrumbs'][] = ['label' => 'Журнал', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->titlelog;
?>
<div class="log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'type' => $type
    ]) ?>

</div>
