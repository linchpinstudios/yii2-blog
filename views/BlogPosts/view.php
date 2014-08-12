<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
use linchpinstudios\blog\widgets\Categories;
use linchpinstudios\blog\widgets\Comments;

/**
 * @var yii\web\View $this
 * @var common\models\BlogPosts $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'] = [['label' => 'Blog', 'url' => ['/blog']],$this->title];

?>
<div class="blog-wrapper">
    <div class="row">
        <div class="col-md-12">
            <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => [
                        'class' => 'breadcrumbs',
                    ]
                ]); ?>
        </div>
    </div>
	<div class="row">
		<div class="col-md-8 columns">
            <div class="row">
                <div class="col-md-12">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <ul class="list-inline">
        	            <li><div><i class="icon-calendar"></i> <?= date('M d, Y',strtotime($model->date)) ?></div></li>
        	            <li><div><i class="icon-comment"></i> Comments</div></li>
        	        </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 columns blog-content">
                    <?= $model->body; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 columns">
                    <?= Comments::widget(['id' => $model->id]) ?>
                </div>
            </div>
		</div>
		<div class="col-md-4 columns">
			<?= Categories::widget() ?>
		</div>
	</div>
</div>