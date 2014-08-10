<?php

namespace linchpinstudios\blog\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $this->redirect('blogposts/index');
    }
}
