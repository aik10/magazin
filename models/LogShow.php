<?php

namespace app\models;

use app\models\Log;

/**
 * This is the model class for table "v_log_show".
 */
class LogShow extends Log
{

    public $c_date_start = null;
    public $c_date_end = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_log_show';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'id',
                'id_product',
                'c_date',
                'c_type',
                'c_comment',
                'c_product',
                'c_category',
                'c_count',
                'id_magazin',
                'c_magazin',
                'c_price',
                'c_summ',
                'c_type_show',
                'c_date_start',
                'c_date_end'
            ], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'c_product' => 'Товар',
            'c_date' => 'Дата',
            'c_type_show' => 'Тип',
            'c_comment' => 'Комментарий',
            'c_count' => 'Количество',
            'c_summ' => 'Сумма',
            'c_magazin' => 'Магазин',
            'c_category' => 'Категория',
            'c_price' => 'Цена',
            'c_date_start' => 'Начало поиска',
            'c_date_end' => 'Конец поиска'
        ];
    }
}
