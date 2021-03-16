<?php
	include "./database.php";
	include "./security.php";

	session_start();

	if(!isset($_POST)){
		echo "<script>alert('올바르지 않은 데이터 입니다.');
		history.back();</script>";
	} else {

		//SERVER check
		$serverChk = ($_POST["server"]!="");
		
		//캐릭터명 체크
	    // 한글 2~8자+숫자 영문 3~12자+숫자
	    // 한글,영문 혼용 불가
	    // 첫글자로 숫자가 들어가면 안됨
		$usernameChkKor = preg_match("/^[가-힣]+[0-9]*$/", $_POST["userName"]);
		$usernameChkEng = preg_match("/^[a-zA-Z]+[0-9]*$/", $_POST["userName"]);
		$usernameChkResult = ($usernameChkKor||$usernameChkEng);

		//Phonenumber check
		$phonenumber = $_POST["phonenumber_head"]."-".$_POST["phonenumber_body"]."-".$_POST["phonenumber_tail"];
		$phonenumberChk = preg_match("/^[0-9\-]{11,14}$/", $phonenumber);

		//Email check
		$email = $_POST["email_id"]."@".$_POST["email_domain"];
		$emailChk = preg_match("/^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i", $email);

		if($serverChk&&$usernameChkResult&&$phonenumberChk&&$emailChk){

			// phone number, email encrypt
			$phonenumber = Encrypt($phonenumber, $secret_key, $secret_iv);
			$email = Encrypt($email, $secret_key, $secret_iv);
			// INSERT INFO
			$time = date("Y-m-d H:i:s");
			$sql = "UPDATE USER_TB SET server = $_POST[server], user_name = '$_POST[userName]', phone = '$phonenumber', email = '$email', date = '$time' WHERE no = $_SESSION[user_no];";
			$result = mysqli_query($connect, $sql);
			if($result){
				$_SESSION["user_name"] = $_POST["userName"];
				$_SESSION["user_server"] = $_POST["server"];
				echo "<script>alert('Complete Modify!!');
					window.location.href='/';</script>";
			} else {
				echo "<script>alert('올바르지 않은 데이터 입니다.');
					history.back();</script>";
			}
			

		} else {
			echo "<script>alert('올바르지 않은 데이터 입니다.');
				history.back();</script>";
		}
	}
	mysqli_close($connect);
?>
