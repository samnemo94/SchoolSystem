<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Permissions;

/**
 * PermissionsSearch represents the model behind the search form about `backend\models\Permissions`.
 */
class PermissionsSearch extends Permissions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permission_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['permission_page', 'permission_action', 'permission_description', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = Permissions::find();

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
            'permission_id' => $this->permission_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'deleted_by' => $this->deleted_by,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'permission_page', $this->permission_page])
            ->andFilterWhere(['like', 'permission_action', $this->permission_action])
            ->andFilterWhere(['like', 'permission_description', $this->permission_description]);

        return $dataProvider;
    }
}
