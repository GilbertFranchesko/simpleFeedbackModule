<?php


namespace App\Controller;

use App\Services\Router;
use App\Controller\Feedback;
use App\Controller\Client;

class Api extends Controller {

    protected $model = null; # or you can use the model for logging your API requests.

    public function __construct() { parent::__construct($this->model);}

    public function index($headers, $dataBodyJSON, $userID)
    {
        var_dump($headers);
    }


    public function client()
    {
        $kernelURI = explode("/", $_SERVER['REQUEST_URI']);
        $params = array_slice($kernelURI, 3);
        
        Router::APIStart(Client::class, $params, false);
    }

    public function feedback()
    {
        $kernelURI = explode("/", $_SERVER['REQUEST_URI']);
        $params = array_slice($kernelURI, 3);
        
        Router::APIStart(Feedback::class, $params);
    }


}