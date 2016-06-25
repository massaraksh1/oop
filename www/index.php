<?php
include 'classes/DataBase.php';
include 'config.php';
include 'classes/Logs.php';



//$mess = new DataBase(HOST, LOGIN, PASSWORD, DBNAME);
$mess = "hello";

$dbx = new Database(HOST, LOGIN, PASSWORD, DBNAME);
//$dbx->create("Logs", "message TEXT NOT NULL, dates DATETIME");

$logs = new Logs($mess);

//$logs->messLogdb();
//$logs->messLogfile(PATH);

$arr = $dbx->select("Logs");
for($i=0; $i < count($arr); $i++)
{
	echo $arr[$i]['id'] . " " . unserialize($arr[$i]['message']) . " " . $arr[$i]['dates'] . "<br>";
}
?>