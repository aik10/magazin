<?php

namespace app\models;

use yii\db\ActiveRecord;

class Man extends ActiveRecord {

    public $name;
    public $age;
    public $sex;

    public function attributeLabels() {
        return [
            'name'=> 'Имя',
            'age'=> 'Возраст',
            'sex'=> 'Пол'
        ];
    }

    public function rules() {
        return [
            [['name', 'sex', 'age'], 'required'],//, 'message' => 'Поле обязательно']
            ['age', 'number', 'min' => 0],
            ['age', 'number', 'max' => 150],
            // ['name', 'string', 'min' => 2, 'tooShort' => 'Мало'],
            // ['name', 'string', 'max' => 5, 'tooLong' => 'Много']
            ['name', 'string', 'length' => [2, 5]],
            ['name', 'trim']
        ];
    }

// public static function tablename() {
//     return 'man';
// }

}

?>