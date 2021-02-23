<?php
	$id = $_POST["id"];
	$pw = $_POST["pw"];
	echo("id: ".$id);
	echo('</br>');
	echo("pw: ".$pw);
	echo('<h4>SALT</h4>');
	$salt_str = "소금소금소금";
	$secure_pw = base64_encode(hash('sha256', $pw.$salt_str, false));
	echo("secure_pw: ".$secure_pw);
?>