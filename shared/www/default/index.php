<h2>Default server - Nothing very interesting here</h2>

<p>Helper scripts:</p>

<pre>
<b>Add the folllowing line to host /etc/hosts:</b>
<?php
$file = '/etc/hosts';
$fileContents = file($file, FILE_IGNORE_NEW_LINES);
$line = str_replace('127.0.1.1', $_SERVER["SERVER_ADDR"], $fileContents[1]);
echo($line);
?>
</pre>

Or check <a href="/info.php">phpinfo()</a>

<h3>Add the folllowing line to host /etc/hosts</h3>
<p>Try these servers:</p>
<ul>
	<?php
	$vhosts = trim(str_replace('127.0.1.1', '', $fileContents[1]));
	foreach (explode(' ', $vhosts) as $vhost){
		echo "<li><a href='http://$vhost/' target='_blank'>$vhost</a></li>";
		if(!isset($firstServer))
    		$firstServer = $vhost;
	}
	echo "<li><a href='http://$firstServer:8989' target='_blank'>Clarity (observe logs)</a></li>";
	?>
</ul>
