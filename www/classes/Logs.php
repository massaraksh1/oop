<?php

class Logs
{
	private $messages;
	
	function __construct($message)
	{
		$this->messages = $message;
	}
	
	function messlogdb()
	{
		$db = new DataBase(HOST, LOGIN, PASSWORD, DBNAME);
		$date = date("Y-m-d H:i:s");
		$text = serialize($this->messages);
		$db->insert("logs", "`message`, `dates`", "'{$this->messages}', '$date'");
	}
	
	function messlogfile($link)
	{
		$date = date("Y-m-d H:i:s");
		$mess[1][0] = $this->messages;
		$mess[1][1] = $date;
		
		$fp = fopen($link, "a");
		$text = serialize($mess) . "\r\n";
		$go = fwrite($fp, $text);
		fclose($fp);
	}
}
?>