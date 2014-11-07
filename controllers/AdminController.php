<?php

namespace linchpinstudios\blog\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use linchpinstudios\blog\assets\BlogAssets;
use linchpinstudios\blog\models\BlogPosts;
use linchpinstudios\blog\models\BlogTerms;
use linchpinstudios\blog\models\BlogTermRelationships;
use linchpinstudios\blog\models\search\BlogPosts as BlogPostsSearch;
use linchpinstudios\filemanager\assets\FilemanagerTinyAssets;

/**
 * BlogPostsController implements the CRUD actions for BlogPosts model.
 */
class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error',],
                        'allow' => ['true'],
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
    public function beforeAction($action) {
        
        $result = parent::beforeAction($action);
        
        $options = [
           'deleteURL'          => \Yii::$app->urlManager->createUrl('photo/delete'),
        ];
        
        Yii::$app->view->registerJs("filemanagertiny.init(".json_encode($options).");", View::POS_END, 'my-options');
        
        
        return $result;
    }
    
    

    /**
     * Lists all BlogPosts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogPostsSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single BlogPosts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BlogPosts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        BlogAssets::register($this->view);
        FilemanagerTinyAssets::register($this->view);
        
        $model = new BlogPosts;
        $terms = new BlogTerms;
        $categories = BlogTerms::find()->termType()->orderBy('name')->all();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                BlogTermRelationships::deleteAll('post_id = '.$model->id);
                $termRelations = new BlogTermRelationships;
                $categoryTerms = Yii::$app->request->post();
                foreach ($categoryTerms['categories'] as $c) {
                    $termRelations->isNewRecord = true;
                    $termRelations->id = null;
                    $termRelations->post_id = $model->id;
                    $termRelations->term_id = $c;
                    $termRelations->save();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                    'terms' => $terms,
                    'categories' => $categories,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'terms' => $terms,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Updates an existing BlogPosts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
        BlogAssets::register($this->view);
        FilemanagerTinyAssets::register($this->view);
        
        $model = $this->findModel($id);
        $terms = new BlogTerms;
        $categories = BlogTerms::find()->termType()->orderBy('name')->all();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                BlogTermRelationships::deleteAll('post_id = '.$model->id);
                $termRelations = new BlogTermRelationships;
                $categoryTerms = Yii::$app->request->post();
                foreach ($categoryTerms['categories'] as $c) {
                    $termRelations->isNewRecord = true;
                    $termRelations->id = null;
                    $termRelations->post_id = $model->id;
                    $termRelations->term_id = $c;
                    $termRelations->save();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                    'terms' => $terms,
                    'categories' => $categories,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'terms' => $terms,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Deletes an existing BlogPosts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionUpload()
    {
        $allowed = array('png', 'jpg', 'gif','zip');

        if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){
        
            $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        
            if(!in_array(strtolower($extension), $allowed)){
                return '{"status":"error"}';
                exit;
            }
        
            if(move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'.$_FILES['file']['name'])){
                $tmp='@web/images/uploads/'.$_FILES['file']['name'];
                //return '@web/images/uploads/'.$_FILES['file']['name'];
                echo '{"status":"success"}';
                exit;
            }
        }
        
        return '{"status":"error"}';
    }

    /**
     * Finds the BlogPosts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogPosts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogPosts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
