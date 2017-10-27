<?php

namespace app\models;

use yii\db\ActiveRecord;

class ProductsForSale extends ActiveRecord {

    public static function tablename() {
        return 'v_products_for_sale';
    }
}

?>
