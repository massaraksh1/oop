<?php
class DataBase
{
	private $db;
	
	
	function __construct($host, $login, $pass, $dbname)
	{
		$this->db = mysql_connect($host,$login,$pass);
		mysql_select_db($dbname);
		mysql_query('SET NAMES utf-8');
	}	
	
	function create ($tablename, $column)
	{
		mysql_query("create table `$tablename` (`id` INT(11) NOT NULL AUTO_INCREMENT, $column, PRIMARY KEY(`id`))");
	}
	
	function insert ($tablename, $column, $value)
	{
		mysql_query("insert into `$tablename` ($column) values ($value)") or die (mysql_error ());
	}
	
	function select ($tablename)
	{
		$sql = mysql_query(" select * from `$tablename`;") or die (mysql_error ());
		$rows = mysql_num_rows($sql);
        for ($i=0; $i<$rows; $i++)
		{
			$sql1[$i] = mysql_fetch_array($sql);
		}
		return $sql1;
	}
}
?>