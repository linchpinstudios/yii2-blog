<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var linchpinstudios\blog\models\search\BlogComments $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="blog-comments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'post_id') ?>

    <?= $form->field($model, 'comment') ?>

    <?= $form->field($model, 'approved') ?>

    <?php // echo $form->field($model, 'parent') ?>

    <?php // echo $form->field($model, 'author_name') ?>

    <?php // echo $form->field($model, 'author_email') ?>

    <?php // echo $form->field($model, 'author_url') ?>

    <?php // echo $form->field($model, 'author_ip') ?>

    <?php // echo $form->field($model, 'notify_reply') ?>

    <?php // echo $form->field($model, 'notify_comments') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'date_gmt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
