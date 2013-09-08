<pre>
<h3>Add the folllowing line to host /etc/hosts</h3>
<?php
$file = '/etc/hosts';
$array = file($file, FILE_IGNORE_NEW_LINES);
$line = str_replace('127.0.1.1', $_SERVER["SERVER_ADDR"], $array[1]);
echo($line);
?>
</pre>