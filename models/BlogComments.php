<?php

namespace linchpinstudios\blog\models;

use Yii;
use common\models\User;
use yii\behaviors\TimeStampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "blog_comments".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $post_id
 * @property string $comment
 * @property string $approved
 * @property integer $parent
 * @property string $author_name
 * @property string $author_email
 * @property string $author_url
 * @property string $author_ip
 * @property integer $notify_reply
 * @property integer $notify_comments
 * @property string $date
 * @property string $date_gmt
 *
 * @property BlogPosts $post
 * @property User $user
 */
class BlogComments extends \yii\db\ActiveRecord
{


    public function behaviors()
    {
        return [
            'date' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'date',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'date',
                ],
                'value' => function() { 
                    return (empty($this->date) ? date('Y-m-d H:i:s') : date('Y-m-d H:i:s',strtotime($this->date)));
                },
            ],
            'dateGMT' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'date_gmt',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'date_gmt',
                ],
                'value' => function() { 
                    return (empty($this->date) ? gmdate('Y-m-d H:i:s') : gmdate('Y-m-d H:i:s',strtotime($this->date)));
                },
            ],
        ];
    }
    
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'post_id', 'parent', 'notify_reply', 'notify_comments'], 'integer'],
            [['comment'], 'string'],
            [['author_email'], 'email'],
            [['author_url'], 'url'],
            [['date', 'date_gmt'], 'safe'],
            [['approved'], 'string', 'max' => 20],
            [['author_name', 'author_email', 'author_url', 'author_ip'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'post_id' => 'Post ID',
            'comment' => 'Comment',
            'approved' => 'Approved',
            'parent' => 'Parent',
            'author_name' => 'Name',
            'author_email' => 'Email',
            'author_url' => 'Website',
            'author_ip' => 'Author Ip',
            'notify_reply' => 'Notify Reply',
            'notify_comments' => 'Notify Comments',
            'date' => 'Date',
            'date_gmt' => 'Date Gmt',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(BlogPosts::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
