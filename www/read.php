<?php

$fp = fopen("log.txt", "r"); // Открываем файл в режиме чтения
if ($fp) 
{
while (!feof($fp))
{
$mytext = fgets($fp, 999);
$text = unserialize($mytext);
echo $text[1][0] . " " . $text[1][1] . "<br>";
}
}
else echo "Ошибка при открытии файла";
fclose($fp);

?>