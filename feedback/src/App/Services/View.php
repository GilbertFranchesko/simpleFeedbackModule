<?php

namespace App\Services;

class View {

    protected static $viewPrefixPath = './src/App/View/';
    protected static $viewPrefix = 'View';

    public static function showView($viewName, $params=null) 
    {
        require_once View::$viewPrefixPath."/".$viewName."".View::$viewPrefix.".php"; 
    }

}