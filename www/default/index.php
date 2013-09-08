<h2>Default server - Nothing very interesting here</h2>
<p>Helper scripts:</p>
<ul>
	<li><a href="/hosts.php">/etc/hosts entry for host</a></li>
	<li><a href="/info.php">phpinfo()</a></li>
</ul>

<h3>Add the folllowing line to host /etc/hosts</h3>
<p>Try these servers:</p>
<ul>
	<?php
	$file = file('/etc/hosts', FILE_IGNORE_NEW_LINES);
	$array = trim(str_replace('127.0.1.1', '', $file[1]));
	foreach (explode(' ', $array) as $server)
		echo "<li><a href='http://$server/' target='_blank'>$server</a></li>";
	?>
</ul>
