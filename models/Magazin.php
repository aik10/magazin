<?php
namespace app\models;
use yii\db\ActiveRecord;
class Magazin extends ActiveRecord {
    public static function tablename() {
        return 't_magazins';
    }
    public function attributelabels() {
        return [
            'id' => 'Название магазина'
        ];
    }
    public function rules() {
        return [
            [['id', 'c_name'], 'required'],
            ['c_name', 'trim']
        ];
    }
}
?>