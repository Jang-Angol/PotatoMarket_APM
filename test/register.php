<?php
	foreach ($_POST as $key => $value) {
		echo $key . " : " . $value . "\n";
	}
	$salt_str = "소금소금소금\n";
	$secure_pw = base64_encode(hash('sha256', $_POST["pw"].$salt_str, false));
	echo("secure_pw: ".$secure_pw . "\n");
?>