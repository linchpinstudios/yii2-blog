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

<div class="row">
    <div class="col-md-9">
    
    <div class="blog-posts-index">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
    
                //'id',
                'user_id',
                'comments',
                'title',
                // 'body:ntext',
                // 'thumbnail',
                // 'excerpt:ntext',
                'status',
                'slug',
                'date',
                // 'date_gmt',
                // 'modified',
                // 'modified_gmt',
    
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    
    </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= Html::a('Create Blog Posts', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>