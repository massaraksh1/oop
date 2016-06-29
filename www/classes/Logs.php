<?php
abstract class Logs
{
	public $messages;
	public $dates;
	
	function __construct($message)
	{
		$this->messages = $message;
		$this->dates = date("Y-m-d H:i:s");
	}
	
	abstract function MessToLog();
}

class LogsBD extends Logs
{
	
	function MessToLog()
	{
		$date = date("Y-m-d H:i:s");
		$text = serialize($this->messages);
		$sql = "insert into `".TABLE."` (`message`, `dates`) values ('$text', '{$this->dates}')";
		try {
		$db = new PDO("mysql:host=".HOST.";dbname=".DBNAME, LOGIN, PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
		
		$stmt = $db->exec($sql);
		if (!$stmt) 
		{
			$log = new LogsFile($this->messages);
			$log->MessToLog();
			$log = null;
			
            $err = new LogsFile($db->errorInfo());
			$err->MessToLog();
			$err = null;
        }
		
		}
		catch(PDOException $e){
			$log = new LogsFile($this->messages);
			$log->MessToLog();
			$log = null;
			
			$mess = 'Ошибка соединения: ' . $e->getMessage();
            $err = new LogsFile($mess);
			$err->MessToLog();
			$err = null;
		}
	}
}


class LogsFile extends Logs
{
	function MessToLog()
	{
		$mess[1][0] = $this->messages;
		$mess[1][1] = $this->dates;
		
		if (is_writable(PATH))
		{
			$fp = fopen(PATH, "a");
			$text = serialize($mess) . "\r\n";
		    $go = fwrite($fp, $text);
		    fclose($fp);
		}
		else
		{
			$log = new LogsBD($this->messages);
			$log->MessToLog();
			$log = null;
			
			$mess = "Файл " . PATH . " недоступен для записи";
			$err = new LogsBD($mess);
			$err->MessToLog();
			$err = null;
		}
	}
}
?>