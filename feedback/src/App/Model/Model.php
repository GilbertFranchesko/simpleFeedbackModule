<?php

namespace App\Model;

use App\Services\DatabaseConnection;

class Model 
{
    protected $tableName;
    protected $dbConnect;

	public function __construct($tableName)
	{
        $this->tableName = $tableName;
		$this->dbConnect = DatabaseConnection::getInstance()->getConnection();
	}
	

	public function get($orderBy='id', $order="DESC", $limit=100)
	{
		$result = $this->dbConnect->query('SELECT * FROM `'.$this->tableName.'` ORDER BY `'.$orderBy.'` '.$order.' LIMIT '.$limit);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		return $row;
	}

	public function getWhere($field, $value)
	{
		$result = $this->dbConnect->query('SELECT * FROM `'.$this->tableName.'` WHERE `'.$field.'`="'.$value.'"');
		$row = $result->fetch_array(MYSQLI_ASSOC);
		return $row;
	}

	public function create($JSONObject)
	{

		$SQLFieldsQuery = "(";
		$SQLValuesQuery = "(";
		foreach($JSONObject as $key=>$value)
		{
			$SQLFieldsQuery .= "`".$key."`,";

			# PHP BUGS!!!
			if(is_bool($value) == true)
			{
				if($value == false) $value = 0;
				else if($value == true) $value = 1;
			}

			$SQLValuesQuery .= "'".$value."',";
		}
		$SQLFieldsQuery = substr_replace($SQLFieldsQuery, ')', -1);
		$SQLValuesQuery = substr_replace($SQLValuesQuery, ')', -1);

		$SQLQuery = "INSERT INTO `".$this->tableName."`".$SQLFieldsQuery." VALUES".$SQLValuesQuery."";
		$result = $this->dbConnect->query($SQLQuery);

		if($result ) return $result;
		else return $this->dbConnect->error;

	}

	public function update($ParametersArray, $WhereParams) 
	{
		$SQLValuesQuery = "";
		$SQLWhereQuery = "";
		foreach($ParametersArray as $field => $value)
		{
			# PHP BUGS
			if($value == false) $value = '0'; 
			$SQLValuesQuery .= "`".$field."` = '".$value."',";
		}
		$SQLValuesQuery = substr_replace($SQLValuesQuery, " ", -1);

		foreach($WhereParams as $key => $param)
		{
			$SQLWhereQuery .= "`".$key."` = '".$param."'";
		}

		$SQLQuery = "UPDATE `".$this->tableName."` SET ".$SQLValuesQuery." WHERE ".$SQLWhereQuery."";

		$result = $this->dbConnect->query($SQLQuery);
		return $result;

	}

	public function makeQuery($query)
	{
		return $this->dbConnect->query($query);
	}

}