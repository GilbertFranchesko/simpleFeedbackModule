<?php

namespace App\Model;


class FeedbackModel extends Model
{   
    protected $tableName = "feedback";

    public function __construct() { parent::__construct($this->tableName); }
    
}