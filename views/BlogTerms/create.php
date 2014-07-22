<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var linchpinstudios\blog\models\BlogTerms $model
 */

$this->title = 'Create Blog Terms';
$this->params['breadcrumbs'][] = ['label' => 'Blog Terms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-terms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
