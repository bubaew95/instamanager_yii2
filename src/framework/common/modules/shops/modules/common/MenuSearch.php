<?php

namespace common\modules\shops\modules\common;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\menu\Menu;

/**
 * MenuSearch represents the model behind the search form of `common\models\menu\Menu`.
 */
class MenuSearch extends Menu
{
    public $my_meny;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_shop', 'lft', 'rgt', 'depth', 'position', 'created_at', 'updated_at'], 'integer'],
            [['name', 'icon'], 'safe'],
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
        $query = Menu::find()->where(['id_shop' => $this->my_meny]);

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
            'id_shop' => $this->id_shop,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'depth' => $this->depth,
            'position' => $this->position,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }
}
