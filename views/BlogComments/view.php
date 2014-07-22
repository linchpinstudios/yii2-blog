<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var linchpinstudios\blog\models\BlogComments $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Blog Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-comments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'post_id',
            'comment:ntext',
            'approved',
            'parent',
            'author_name',
            'author_email:email',
            'author_url:url',
            'author_ip',
            'notify_reply',
            'notify_comments',
            'date',
            'date_gmt',
        ],
    ]) ?>

</div>
