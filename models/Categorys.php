<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_categorys".
 *
 * @property integer $id
 * @property string $c_name
 * @property string $c_date_create
 * @property integer $c_deleted
 * @property string $c_date_delete
 *
 * @property TProducts[] $tProducts
 */
class Categorys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_categorys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_name'], 'string'],
            [['c_date_create', 'c_date_delete'], 'safe'],
            [['c_deleted'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'c_name' => 'Название категории',
            'c_date_create' => 'Дата создания',
            'c_date_delete' => 'Дата удаления',
            'c_deleted' => 'Удалено'

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTProducts()
    {
        return $this->hasMany(TProducts::className(), ['id_category' => 'id']);
    }
}
