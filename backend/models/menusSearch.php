<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Menus;

/**
 * menusSearch represents the model behind the search form about `backend\models\menus`.
 */
class menusSearch extends menus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id', 'parent_id', 'category_id', 'item_id'], 'integer'],
            [['menu_position', 'menu_title','menu_for'], 'safe'],
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
        $query = Menus::find();

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
            'menu_id' => $this->menu_id,
            'parent_id' => $this->parent_id,
            'category_id' => $this->category_id,
            'item_id' => $this->item_id,
        ]);

        $query->andFilterWhere(['like', 'menu_position', $this->menu_position])
            ->andFilterWhere(['like', 'menu_title', $this->menu_title])
            ->andFilterWhere(['like', 'menu_for', $this->menu_for]);


        return $dataProvider;
    }
}
