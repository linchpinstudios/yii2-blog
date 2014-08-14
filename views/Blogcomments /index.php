<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var linchpinstudios\blog\models\search\BlogComments $searchModel
 */

$this->title = 'Blog Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-comments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Blog Comments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'post_id',
            'comment:ntext',
            'approved',
            // 'parent',
            // 'author_name',
            // 'author_email:email',
            // 'author_url:url',
            // 'author_ip',
            // 'notify_reply',
            // 'notify_comments',
            // 'date',
            // 'date_gmt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
