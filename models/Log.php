<?php

namespace app\models;

use Yii;
use app\models\LogType;
use app\models\Products;
use app\models\ProductsForSale;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_log".
 *
 * @property integer $id
 * @property integer $id_product
 * @property string $c_date
 * @property string $c_type
 * @property string $c_comment
 * @property integer $c_count
 *
 * @property TLogType $cType
 * @property TProducts $idProduct
 */
class Log extends \yii\db\ActiveRecord
{

    public $titlelog;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'c_type', 'c_count'], 'required'],
            [['id_product', 'c_count'], 'integer'],
            [['c_date', 'id_magazin'], 'safe'],
            [['c_comment'], 'string'],
            [['c_type'], 'string', 'max' => 4],
            [['c_type'], 'exist', 'skipOnError' => true, 'targetClass' => LogType::className(), 'targetAttribute' => ['c_type' => 'c_code']],
            [['id_product'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['id_product' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_product' => 'Товар',
            'c_date' => 'Дата',
            'c_type' => 'Тип',
            'c_comment' => 'Комментарий',
            'c_count' => 'Количество',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(LogType::className(), ['c_code' => 'c_type']);
    }

    public function getTypeList()
    {
        $type = LogType::find()->all();
        return ArrayHelper::map($type, 'c_code', 'c_text');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'id_product']);
    }

    public function getProductList($type) {
        if ($type == 'add') {
            //при добавлении ПРИХОД в журнал список всех продуктов
            $products = Products::find()->orderBy(['c_name' => 'SORT_ASC'])->all();
        } else {
            // при добавлении в РАСХОД в журнал отображать список товаров в магазине
            $products = ProductsForSale::find()->where(['id_magazin' => Yii::$app->session['magazin']->id])->orderBy(['c_name' => 'SORT_ASC'])->all();
        }

        // $products = Products::find()->where(['id_magazin' => Yii::$app->session['magazin']->id])->orderBy(['c_name' => 'SORT_ASC'])->all();
        // foreach ($products as $key => $value) {
        //    $products[$key]->c_name = $value->c_name . ' (' . $value->c_count . ' шт.)';
        // }

        return ArrayHelper::map($products, 'id', 'c_name');
    }
}
