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
        if ($route === 'blog' || $route === 'blog/blogposts' || $route === 'blog/blogposts/index'){
            return 'blog';
        }
        if ($route === 'blog/view' || $route === 'blog/blogposts/view') {
            if (isset($params['year'], $params['month'], $params['day'], $params['urlSlug'])) {
                return 'blog/' . $params['year'] . '/' . $params['month'] . '/' .$params['day'] . '/' . $params['urlSlug'];
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
            
            $blogPost = BlogPosts::find()->where('publishDate LIKE :publishDate AND urlSlug = :urlSlug',[':publishDate'=>$date,':urlSlug'=>$matches[4]])->one();
            
            if($blogPost){
                $params['id'] = $blogPost->id;
                return ['blog/view',$params];
            }else{
                return false;  // this rule does not apply
            }
        }
        return false;  // this rule does not apply
    }
}