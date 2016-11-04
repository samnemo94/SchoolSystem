<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ItemLanguage;

/**
 * ItemLanguageSearch represents the model behind the search form about `backend\models\ItemLanguage`.
 */
class ItemLanguageSearch extends ItemLanguage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_language_id', 'item_id', 'language_id'], 'integer'],
            [['item_title', 'item_description', 'item_short_description', 'item_image'], 'safe'],
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
        $query = ItemLanguage::find();

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
            'item_language_id' => $this->item_language_id,
            'item_id' => $this->item_id,
            'language_id' => $this->language_id,
        ]);

        $query->andFilterWhere(['like', 'item_title', $this->item_title])
            ->andFilterWhere(['like', 'item_description', $this->item_description])
            ->andFilterWhere(['like', 'item_short_description', $this->item_short_description])
            ->andFilterWhere(['like', 'item_image', $this->item_image]);

        return $dataProvider;
    }
}
