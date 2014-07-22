<?php

namespace linchpinstudios\blog\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use linchpinstudios\blog\models\BlogTerms as BlogTermsModel;

/**
 * BlogTerms represents the model behind the search form about `linchpinstudios\blog\models\BlogTerms`.
 */
class BlogTerms extends BlogTermsModel
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'slug', 'description', 'type'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = BlogTermsModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
