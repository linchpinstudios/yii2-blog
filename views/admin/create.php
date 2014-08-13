<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var linchpinstudios\blog\models\BlogPosts $model
 */

$this->title = 'Create Blog Posts';
$this->params['breadcrumbs'][] = ['label' => 'Blog Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-posts-create">

    <?= $this->render('_form', [
        'model' => $model,
        'terms' => $terms,
        'categories' => $categories,
    ]) ?>

</div>
