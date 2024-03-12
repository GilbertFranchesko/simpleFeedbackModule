<?php

namespace App\Model;


class ClientModel extends Model
{   
    protected $tableName = "client";

    public function __construct() { parent::__construct($this->tableName); }

    public function loginQuery($login, $password)
    {
        $result = $this->makeQuery('SELECT * FROM `'.$this->tableName.'` WHERE `login`="'.$login.'" AND `password`="'.$password.'"');
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return $row;
    } 
    
}