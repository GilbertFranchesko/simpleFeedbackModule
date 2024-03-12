<?php

namespace App\Controller;

interface CRUDInterface 
{
    public function get($params, $headers);
    public function getPK($pk, $value);
}


class CRUDController extends Controller {
    protected $model = null;

    public function __construct($model) { $this->setModel($model); }

    public function get($headers, $params, $userID=0) 
    {
        echo json_encode(array("data" => $this->model->get($params->order_by, $params->order, $params->limit)));
    }


}