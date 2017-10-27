<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Categorys;
use yii\helpers\ArrayHelper;

class Products extends ActiveRecord {

    public static function tablename() {
        return 't_products';
    }

    public function attributelabels() {
        return [
            'c_name' => 'Название товара',
            'c_description' => 'Описание товара',
            'c_price' => 'Цена',
            'id_category' => 'Категория',
            'c_date_create' => 'Дата создания'
        ];
    }

    public function rules() {
        return [
            [['id_category', 'c_name', 'c_price'], 'required'],//, 'message' => 'Поле обязательно']
            [['c_price'], 'number', 'min' => 0],
            [['c_name', 'c_description'], 'trim'],
           [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Categorys::className(), 'targetAttribute' => ['id_category' => 'id']]
        ];
    }

    public static function primaryKey()
    {
        return ['id'];
    }

    public function getCategory()
    {
        return $this->hasOne(Categorys::className(), ['id' => 'id_category']);
    }

    public function getCategoryList() {
        $categorys = Categorys::find()->orderby(['c_name' => 'SORT_ASC'])->all();
        return ArrayHelper::map($categorys, 'id', 'c_name');
    }
}

?>
