<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_log_type".
 *
 * @property string $c_code
 * @property string $c_text
 *
 * @property TLog[] $tLogs
 */
class LogType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_log_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_code', 'c_text'], 'string'],
            [['c_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_code' => 'Код',
            'c_text' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTLogs()
    {
        return $this->hasMany(TLog::className(), ['c_type' => 'c_code']);
    }
}
