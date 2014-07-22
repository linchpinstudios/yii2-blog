<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var linchpinstudios\blog\models\search\BlogPosts $searchModel
 */

$this->title = 'Blog Posts';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="blog-posts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Blog Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'comments',
            'title',
            'body:ntext',
            // 'thumbnail',
            // 'excerpt:ntext',
            // 'status',
            // 'slug',
            // 'date',
            // 'date_gmt',
            // 'modified',
            // 'modified_gmt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
