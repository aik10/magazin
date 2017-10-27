<?php
 use yii\grid\GridView;
 use yii\helpers\Url;
 use yii\helpers\Html;
?>

 <?= Html::a(yii::t('app', 'Дообавить {modelClass}', [
     'modelClass' => 'товар',
]), ['create'], ['class' => 'btn btn-success']) ?>

<?php
 echo GridView::widget([
     'dataProvider' => $dataProvider,
     'columns' => [
         'id',
         'c_category',
         'c_name',
         'c_price',
         // 'c_count',
         'c_description',
         [
             'attribute' => 'c_date_create',
             'format' => ['date', 'php:d.m.Y H:m:i']
         ],
         [
             'class' => 'yii\grid\ActionColumn',
             'header'=>'Действия',
             'template' => '{update} {link}',
             'buttons' => [
                 'link' => function ($url,$model) {
                     return Html::a(
                         '<span class="glyphicon glyphicon-screenshot"></span>',
                         $url);
                 }
             ],
         ],

         // More complex one.
//         [
//             'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
//             'value' => function ($data) {
//                 return $data->name; // $data['name'] for array data, e.g. using SqlDataProvider.
//             },
//         ],
     ],
 ]);


?>