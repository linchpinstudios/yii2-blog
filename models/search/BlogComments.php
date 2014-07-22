<?php

namespace linchpinstudios\blog\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use linchpinstudios\blog\models\BlogComments as BlogCommentsModel;

/**
 * BlogComments represents the model behind the search form about `linchpinstudios\blog\models\BlogComments`.
 */
class BlogComments extends BlogCommentsModel
{
    public function rules()
    {
        return [
            [['id', 'user_id', 'post_id', 'parent', 'notify_reply', 'notify_comments'], 'integer'],
            [['comment', 'approved', 'author_name', 'author_email', 'author_url', 'author_ip', 'date', 'date_gmt'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = BlogCommentsModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'post_id' => $this->post_id,
            'parent' => $this->parent,
            'notify_reply' => $this->notify_reply,
            'notify_comments' => $this->notify_comments,
            'date' => $this->date,
            'date_gmt' => $this->date_gmt,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'approved', $this->approved])
            ->andFilterWhere(['like', 'author_name', $this->author_name])
            ->andFilterWhere(['like', 'author_email', $this->author_email])
            ->andFilterWhere(['like', 'author_url', $this->author_url])
            ->andFilterWhere(['like', 'author_ip', $this->author_ip]);

        return $dataProvider;
    }
}
