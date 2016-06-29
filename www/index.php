<?php
include 'classes/DataBase.php';
include 'config.php';
include 'classes/Logs.php';



//$mess = new DataBase(HOST, LOGIN, PASSWORD, DBNAME);
$mess = "hi people";


//$dbx->create("Logs", "message TEXT NOT NULL, dates DATETIME");

$logs = new LogsFile($mess);
$logs->MessToLog();


//$logs->messLogfile(PATH);
$dbx = new Database(HOST, LOGIN, PASSWORD, DBNAME);
$arr = $dbx->select("Logs");
for($i=0; $i < count($arr); $i++)
{
	echo $arr[$i]['id'] . " " . unserialize($arr[$i]['message']) . " " . $arr[$i]['dates'] . "<br>";
}
?>