<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var linchpinstudios\blog\models\BlogComments $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="blog-comments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'post_id')->textInput() ?>

    <?= $form->field($model, 'parent')->textInput() ?>

    <?= $form->field($model, 'notify_reply')->textInput() ?>

    <?= $form->field($model, 'notify_comments')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'date_gmt')->textInput() ?>

    <?= $form->field($model, 'approved')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'author_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'author_email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'author_url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'author_ip')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
