<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use dosamigos\fileupload\FileUploadUI;

/**
 * @var yii\web\View $this
 * @var linchpinstudios\blog\models\BlogPosts $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="blog-posts-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => 555]) ?>
    
    
    <?= $form->field($model, 'body')->widget(TinyMce::className(), [
        'options' => ['rows' => 10],
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]);?>
    
    <?= FileUploadUI::widget([
            'model' => $model,
            'attribute' => 'thumbnail',
            'url' => ['/blog/admin/upload'],
            'gallery' => false,
            'fieldOptions' => [
                    'accept' => 'image/*'
            ],
            'clientOptions' => [
                    'maxFileSize' => 2000000
            ]
        ]);
    ?>
    
    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'comments')->textInput() ?>

    <?= $form->field($model, 'excerpt')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
