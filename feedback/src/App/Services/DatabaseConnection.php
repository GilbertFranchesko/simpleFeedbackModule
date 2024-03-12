<?php

namespace App\Services;

use Exception;
use mysqli;

require_once './config.php';

class DatabaseConnection {

    private static $instance = null;

    private $connectionParams = array();
    private $connection;

    private $params = DB_CONFIG;

    public function __construct()
    {
        if($this->params == array()) throw new Exception("[Connection] params is empty!");
        $this->setParams($this->params);
        $this->connect();
    }

    public function getConnection() { return $this->connection; }

    public static function getInstance() {
        if(!self::$instance) { self::$instance = new DatabaseConnection(); } 
        
        return self::$instance;
    }

    private function setParams($params){ $this->connectionParams = $params; }

    private function connect()
    {
        $this->connection = new mysqli(
            $this->connectionParams['hostname'],
            $this->connectionParams['username'],
            $this->connectionParams['password'],
            $this->connectionParams['database'],
        );
    }

}