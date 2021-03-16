<?php
	include "./database.php";

	session_start();

	if(!isset($_POST["pw"])){
		echo "<script>alert('올바르지 않은 데이터 입니다.');
		history.back();</script>";
	} else {
		//PW check
	    // 영문 대소문자, 숫자, 특수문자(!,@,#,$,%,^,&,*)를 꼭 포함하여 8~20자
		$pwChk = preg_match("/^[a-zA-Z0-9\!\@\#\$\%\^\&\*]{8,20}$/", $_POST["pw"]);
		$pwChkN = preg_match("/[0-9]/", $_POST["pw"]);
		$pwChkL = preg_match("/[a-z]/", $_POST["pw"]);
		$pwChkU = preg_match("/[A-Z]/", $_POST["pw"]);
		$pwChkS = preg_match("/[\!\@\#\$\%\^\&\*]/", $_POST["pw"]);
		$pwChkResult = ($pwChk&&$pwChkN&&$pwChkL&&$pwChkU&&$pwChkS);

		if($pwChkResult){
			// PW hash
			$salt_str = base64_encode(random_bytes(32));
			$pw = base64_encode(hash('sha256', $_POST["pw"].$salt_str, false));
			//CHANGE PW
			$sql = "UPDATE USER_TB SET user_pw = '$pw' WHERE no = $_SESSION[user_no];";
			$result = mysqli_query($connect, $sql);
			if($result){
				$sql = "UPDATE SALT_TB SET salt = '$salt_str' WHERE user_no = $_SESSION[user_no];";
				$result = mysqli_query($connect, $sql);
				if($result){
					session_destroy();
					echo "<script>alert('Complete Modify!!');
					window.location.href='/login.php';</script>";
				} else {
					echo "<script>alert('올바르지 않은 데이터 입니다.');
					history.back();</script>";
				}
			}
		} else {
			echo "<script>alert('Error');
			history.back();</script>";
		}
	}
	mysqli_close();
?>
