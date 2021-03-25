<?php
	include "database.php";

	if(isset($_POST["user_id"])){
		$sql = "SELECT no FROM USER_TB WHERE user_id = '$_POST[user_id]';";
		$result = mysqli_query($connect, $sql);
		if($row = mysqli_fetch_array($result)){
			echo "false";
		} else {
			echo "true";
		}
	} else {
		echo "<script>alert('올바르지 않은 Access 입니다.');
		history.back();</script>";
	}

	
?>
