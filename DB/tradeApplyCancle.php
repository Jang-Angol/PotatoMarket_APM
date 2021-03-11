<?php
	include "database.php";

	$trade_no = $_POST["trade_no"];

	$sql = "DELETE FROM TRADE_TB WHERE no = $trade_no;";
	$result = mysqli_query($connect, $sql);
?>
