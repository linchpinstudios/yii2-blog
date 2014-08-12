<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use linchpinstudios\datetimepicker\DateTime;
use dosamigos\tinymce\TinyMce;

/**
 * @var yii\web\View $this
 * @var linchpinstudios\blog\models\BlogPosts $model
 * @var yii\widgets\ActiveForm $form
 */

$tfArray = [
    '1' => 'Enabled',
    '0' => 'Disabled',
]

?>

<div class="blog-posts-form">

    <?php $form = ActiveForm::begin(); ?>
    
        <div class="row">
            <div class="col-md-9">
                
                <?= $form->field($model, 'title')->textInput(['maxlength' => 555]) ?>
                
                
                <?= $form->field($model, 'body')->widget(TinyMce::className(), [
                    'options' => ['rows' => 25],
                    'language' => 'en',
                    'clientOptions' => [
                        'plugins' => [
                            "advlist autolink lists link charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen image",
                            "insertdatetime media table contextmenu paste filemanager"
                        ],
                        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image filemanager"
                    ]
                ]); ?>
                

                <?= $form->field($model, 'excerpt')->textarea(['rows' => 6]) ?>
    
    
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
        
        
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?= $form->field($model, 'user_id')->dropDownList($model->authorList) ?>
            
                        <?= $form->field($model, 'status')->dropDownList($tfArray) ?>
                        
                        <?= $form->field($model, 'comments')->dropDownList($tfArray) ?>
                    
                        <?= $form->field($model, 'date')->widget(DateTime::className(), ['options' => ['class' => 'form-control']]) ?>
                
                        <?= $form->field($model, 'slug')->textInput(['maxlength' => 45]) ?>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-body">
                        
                        <h3><?= Html::t('Categories') ?></h3>
                        
                        <?= Html::checkboxList('categories',null,['Category 1','Category 2']) ?>
                        
                    </div>
                </div>
            </div>
        </div>
    
    <?php ActiveForm::end(); ?>

</div>

