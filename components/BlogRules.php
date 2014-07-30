<?php
namespace linchpinstudios\blog\components;

use yii\web\UrlRule;
use linchpinstudios\blog\models\BlogPosts;
use linchpinstudios\blog\models\BlogTerms;

class BlogRules extends UrlRule
{
    public $connectionID = 'db';

    public function createUrl($manager, $route, $params)
    {
        if ($route === 'blog' || $route === 'blogposts' || $route === 'blogposts/index'){
            return 'blog';
        }
        if ($route === 'blog/view' || $route === 'blogposts' || $route === 'blogposts/view' || $route === 'blog/blogposts/view') {
            if (isset($params['year'], $params['month'], $params['day'], $params['slug'])) {
                return 'blog/' . $params['year'] . '/' . $params['month'] . '/' .$params['day'] . '/' . $params['slug'];
            } elseif (isset($params['year'], $params['month'], $params['day'])) {
                return 'blog/' . $params['year'] . '/' . $params['month'] . '/' .$params['day'];
            } elseif (isset($params['year'], $params['month'])) {
                return 'blog/' . $params['year'] . '/' . $params['month'];
            } elseif (isset($params['year'])) {
                return 'blog/' . $params['year'];
            }
        }
        
        if ($route === 'blog/blogposts/category' || $route === 'blog/blogposts/category'){
            if (isset($params['category'])){
                return 'blog/blogposts/category/' . strtolower(str_replace(' ','-',$params['category']));
            }
        }
        
        return false;  // this rule does not apply
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        
        if ($pathInfo == 'blog' || $pathInfo == 'blog/index'){
            
            $params = [];
            return ['blog/blogposts/index',$params];
            
        }
        
        if (preg_match('%^blog/category/(.*)%', $pathInfo, $matches)){
            
            $category = str_replace('-', ' ', $matches[1]);
            
            $blogPost = BlogCategories::find()->where('category LIKE :category',[':category'=>$category])->one();
            
            if($blogPost){
                $params = [
                    'id' => $blogPost->id,
                ];
                
                return ['blog/category',$params];
            }else{
                return false;
            }
            
        }
        
        if (preg_match('%^blog/(\w+)/(\w+)/(\w+)/(.*)%', $pathInfo, $matches)) {
            // check $matches[1] and $matches[3] to see
            // if they match a manufacturer and a model in the database
            // If so, set $params['manufacturer'] and/or $params['model']
            // and return ['car/index', $params]
            
            $date = $matches[1].'-'.$matches[2].'-'.$matches[3].'%';
            
            $blogPost = BlogPosts::find()->where('date LIKE :date AND slug = :slug',[':date'=>$date,':slug'=>$matches[4]])->one();
            
            if($blogPost){
                $params['id'] = $blogPost->id;
                return ['blog/blogposts/view',$params];
            }else{
                return false;  // this rule does not apply
            }
        }
        return false;  // this rule does not apply
    }
}