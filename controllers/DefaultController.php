<?php

namespace linchpinstudios\blog\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        
        // Redirects to the blogpost controller.
        $this->redirect(['/'.$this->module->id.'/blogposts/index']);
    }
}
