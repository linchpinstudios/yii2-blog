<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var linchpinstudios\blog\models\BlogComments $model
 */

$this->title = 'Create Blog Comments';
$this->params['breadcrumbs'][] = ['label' => 'Blog Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-comments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
