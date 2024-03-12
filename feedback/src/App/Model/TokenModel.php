<?php

namespace App\Model;


class TokenModel extends Model
{   
    protected $tableName = "token";

    public function __construct() { parent::__construct($this->tableName); }
    
}