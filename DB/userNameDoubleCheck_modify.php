<?php
	include "database.php";

	session_start();

	if(isset($_POST["user_name"])&&isset($_POST["user_server"])){
		$sql = "SELECT no FROM USER_TB WHERE user_name = '$_POST[user_name]' AND server = $_POST[user_server];";
		$result = mysqli_query($connect, $sql);
		if($row = mysqli_fetch_array($result)){
			if(($_SESSION["user_name"]==$_POST["user_name"])&&($_SESSION["user_server"]==$_POST["user_server"])){
				echo "true";
			} else {
				echo "false";
			}
		} else {
			echo "true";
		}
	} else {
		echo "<script>alert('올바르지 않은 Access 입니다.');
		history.back();</script>";
	}

	
?>
