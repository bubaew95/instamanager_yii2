<?php

namespace common\modules\insta\modules\common\insta;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\instagram\InstagramDataModel;

/**
 * MediaSearch represents the model behind the search form of `common\models\instagram\InstagramDataModel`.
 */
class MediaSearch extends InstagramDataModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_instagram', 'id_product', 'likes', 'comments'], 'integer'],
            [['media_id', 'link'], 'safe'],
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
        $query = InstagramDataModel::find()->with('product');

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
            'id_instagram' => $this->id_instagram,
            'id_product' => $this->id_product,
            'likes' => $this->likes,
            'comments' => $this->comments,
        ]);

        $query->andFilterWhere(['like', 'media_id', $this->media_id])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
