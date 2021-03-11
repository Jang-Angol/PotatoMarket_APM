<?php
	include "database.php";

	$trade_no = $_POST["trade_no"];

	$sql = "UPDATE TRADE_TB SET apply_accept = 0 WHERE no = $trade_no";
	$result = mysqli_query($connect, $sql);
?>