<?php

namespace App\Controller;


class Controller {
    
    protected $model = null;

    public function __construct($model)
    {
        $this->setModel($model);

    }

    public function setModel($model) 
    { 
        if($model == null) return;
        $this->model = new $model; 
    }
    public function getModel() { return $this->model; }
}

