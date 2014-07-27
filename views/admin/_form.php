<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Zelenin\yii\widgets\Summernote\Summernote;
use linchpinstudios\datetimepicker\DateTime;

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
    <div class="row">
        <div class="col-md-9">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => 555]) ?>
    
    <?= $form->field($model, 'body')->widget(Summernote::className(), [
        'clientOptions' => [
            'onImageUpload' => 'function(files, editor, welEditable) {
                    summernoteSendFile(files[0], editor, welEditable);
                }',
        ]
    ]);?>
    

    <?= $form->field($model, 'excerpt')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    
        </div>
        <div class="col-md-3">
        
            <?= $form->field($model, 'user_id')->dropDownList($model->authorList) ?>

            <?= $form->field($model, 'status')->dropDownList($tfArray) ?>
            
            <?= $form->field($model, 'comments')->dropDownList($tfArray) ?>
        
            <?= $form->field($model, 'date')->widget(DateTime::className(), ['options' => ['class' => 'form-control']]) ?>
    
            <?= $form->field($model, 'slug')->textInput(['maxlength' => 45]) ?>
    
        </div>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>



<script>
    
    function summernoteSendFile(file, editor, welEditable){
        
        data = new FormData();
        data.append("file", file);
        
        $.ajax({
            data: data,
            type: "POST",
            url: "<?php echo \Yii::$app->urlManager->createUrl(['filemanager/files/upload']); ?>",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                editor.insertImage(welEditable, data);
            }
        });
        
    }
    
</script>
