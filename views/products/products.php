<?php

use yii\widgets\LinkPager;
use yii\helpers\Html;

$this->title = 'Products';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Список продуктов'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'список, продукты'
]);

?>

<div class='test'>
    text color
</div>

<div id = 'pages'>

    <div id='table_products'>
        <?php
            $trs = '';
            foreach ($products as $product) {
        //    echo $product['c_name']. '<br>';
        //    print_r($product);
                $td_id = Html::tag('td', $product['id'], ['width' => '5%']);
                $td_category = Html::tag('td', $product['c_category'], ['width' => '10%']);
                $td_name = Html::tag('td', $product['c_name'], ['width' => '10%']);
                $td_price = Html::tag('td', $product['c_price'], ['width' => '10%']);
                // $td_count = Html::tag('td', $product['c_count'], ['width' => '10%']);
                $td_description = Html::tag('td', $product['c_description'], ['width' => '30%']);
                $td_date_create = Html::tag('td', $product['c_date_create'], ['width' => '25%']);
                $trs .= Html::tag('tr', $td_id.$td_category.$td_name.$td_price.$td_count.$td_description.$td_date_create);
            }

//            return Html::tag('table', $trs);
            $tbl = Html::tag('table', $trs);
            echo $tbl;
        ?>
    </div>
<div id = 'pagination'>
<?= LinkPager::widget([
    'pagination' => $pagination,
    'firstPageLabel' => 'В начало',
    'lastPageLabel' => 'В конец',
    'prevPageLabel' => '&laquo;'
]) ?>
</div>
</div>

<?php
echo '<pre>' . print_r($products, true) . '</pre>';
?>


