<?php

namespace linchpinstudios\blog\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use linchpinstudios\blog\models\BlogPosts as BlogPostsModel;

/**
 * BlogPosts represents the model behind the search form about `linchpinstudios\blog\models\BlogPosts`.
 */
class BlogPosts extends BlogPostsModel
{
    public function rules()
    {
        return [
            [['id', 'user_id', 'comments'], 'integer'],
            [['title', 'body', 'thumbnail', 'excerpt', 'status', 'slug', 'date', 'date_gmt', 'modified', 'modified_gmt'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = BlogPostsModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => [
                'defaultOrder'  => [
                    'date_gmt' => SORT_DESC,
                ],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'comments' => $this->comments,
            'date' => $this->date,
            'date_gmt' => $this->date_gmt,
            'modified' => $this->modified,
            'modified_gmt' => $this->modified_gmt,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'thumbnail', $this->thumbnail])
            ->andFilterWhere(['like', 'excerpt', $this->excerpt])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
