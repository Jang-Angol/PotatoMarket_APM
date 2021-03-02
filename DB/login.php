<?php

	include  "./database.php";

	// post value check
	$id = $_POST["id"];
	$pw = $_POST["pw"];
	/*echo("id: ".$id);
	echo('</br>');
	echo("pw: ".$pw);
	echo('</br>');*/
	
	// id check + saltstring
	$sql = "SELECT * FROM USER_TB WHERE user_id = '".$id."';";
	$result = mysqli_query($connect, $sql);

	if($result){
		//echo "id is valid<br>";
		// find salt string
		$row = mysqli_fetch_array($result);
		$user_no = $row["no"];
		//echo "user_no: ".$user_no."<br>";
		$user_pw = $row["user_pw"];
		//echo "user_pw: ".$user_pw."<br>";
		$sql = "SELECT * FROM SALT_TB WHERE user_no='".$user_no."';";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);
		$salt_str = $row["salt"];
		//echo "salt_str: ".$salt_str."<br>";
		$secure_pw = base64_encode(hash('sha256', $pw.$salt_str, false));
		// pw check
		if($secure_pw!=$user_pw){
			echo "login Failed";
		} else {
			echo "login success";
		}
	} else {
		echo "id is not valid<br>";
	}

	mysqli_close($connect);
?>