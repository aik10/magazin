<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Categorys;

/**
 * CategorysSearch represents the model behind the search form about `app\models\Categorys`.
 */
class CategorysSearch extends Categorys
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'c_deleted'], 'integer'],
            [['c_name', 'c_date_create', 'c_date_delete'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Categorys::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'c_date_create' => $this->c_date_create,
            'c_deleted' => $this->c_deleted,
            'c_date_delete' => $this->c_date_delete,
        ]);

        $query->andFilterWhere(['like', 'c_name', $this->c_name]);

        return $dataProvider;
    }
}
