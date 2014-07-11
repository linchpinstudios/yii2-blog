<?php

namespace linchpinstudios\blog\controllers;

class AdminController extends \yii\web\Controller
{
    public function actionCategories()
    {
        return $this->render('categories');
    }

    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTags()
    {
        return $this->render('tags');
    }

}
