<?php

namespace linchpinstudios\blog;

class Module extends \yii\base\Module
{
    /**
     * controllerNamespace
     * 
     * (default value: 'linchpinstudios\blog\controllers')
     * 
     * @var string
     * @access public
     */
    public $controllerNamespace = 'linchpinstudios\blog\controllers';
    
    
    /**
     * layout
     * 
     * (default value: null)
     * 
     * @var mixed
     * @access public
     */
    public $layout = null;
    
    
    
    
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
