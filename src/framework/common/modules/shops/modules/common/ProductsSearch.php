<?php

namespace common\modules\shops\modules\common;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\products\Products;

/**
 * ProductsSearch represents the model behind the search form of `common\models\products\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_project', 'created_at'], 'integer'],
            [['name', 'latin_name', 'img', 'text', 'instaData'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Products::find()->orderBy(['instaData' => SORT_ASC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'id_project' => $this->id_project,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'instaData' => $this->instaData,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'latin_name', $this->latin_name])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
