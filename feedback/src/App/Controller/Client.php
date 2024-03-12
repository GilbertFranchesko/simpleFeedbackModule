<?php

namespace App\Controller;

use App\Model\ClientModel;
use App\Services\Tokenize;
use Exception;

class Client extends CRUDController {
    protected $model = ClientModel::class;

    public function __construct() { parent::__construct($this->model);}

    public function login($headers, $dataBodyJSON, $userID)
    {
        if($userID != 0 || $userID != null) throw new Exception("You are logging.");

        $login = $dataBodyJSON->login;
        $password = $dataBodyJSON->password;

        $result = $this->model->loginQuery($login, $password);
        if($result == null) throw new Exception("Login or password is invalid.");

        $jwt = Tokenize::generateToken($result);
        Tokenize::saveToken($jwt, $result['id']);

        echo json_encode(array("access" => $jwt));
    }

    public function info($headers, $dataBodyJSON, $userID)
    {
        var_dump($dataBodyJSON);
    }
}