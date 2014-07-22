<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var linchpinstudios\blog\models\BlogTerms $model
 */

$this->title = 'Update Blog Terms: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Blog Terms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="blog-terms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
