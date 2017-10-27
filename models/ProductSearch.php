<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products;

/**
 * ProductSearch represents the model behind the search form about `app\models\Products`.
 */
class ProductSearch extends Products
{
    // public $category;
    // public $catid;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_category'], 'integer'],
            [['c_name'], 'safe'],
            [['c_price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Products::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query ->andFilterWhere([
            'id' => $this->id,
            'c_price' => $this->c_price,
            'id_category' => $this->id_category,
            // 'c_count' => $this->c_count,
            // 'c_date_create' => $this->c_date_create,
            // 'id_magazin' => Yii::$app->session['magazin']->id
        ]);

        $query->andFilterWhere(['like', 'c_name', $this->c_name]);
            // ->andFilterWhere(['like', 'c_description', $this->c_description]);
            // ->andFilterWhere(['like', 'id_category', $this->catid]);

        return $dataProvider;
    }
}
