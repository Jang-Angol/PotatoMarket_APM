<?php
	session_start();
	if(isset($_SESSION["user_no"])){
		session_destroy();
		header("Location: /");
	} else {
		echo "<script>alert('it's not the right access.')</script>";
		header("Location: /");
	}
?>