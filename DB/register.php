<?php
	include "./database.php";
	include "./security.php";

	if(!isset($_POST["id"])){
		echo "<script>alert('올바르지 않은 데이터 입니다.');
		history.back();</script>";
	} else {
		//POST VALUE CHECK
		/*foreach ($_POST as $key => $value) {
			echo $key . " : " . $value . "<br>";
		}*/

		//ID check
	    // 영문소문자, 숫자, 언더바(_) 8~20자
		$idChk = preg_match("/^[a-zA-Z0-9_]{8,20}$/", $_POST["id"]);

		//PW check
	    // 영문 대소문자, 숫자, 특수문자(!,@,#,$,%,^,&,*)를 꼭 포함하여 8~20자
		$pwChk = preg_match("/^[a-zA-Z0-9\!\@\#\$\%\^\&\*]{8,20}$/", $_POST["pw"]);
		$pwChkN = preg_match("/[0-9]/", $_POST["pw"]);
		$pwChkL = preg_match("/[a-z]/", $_POST["pw"]);
		$pwChkU = preg_match("/[A-Z]/", $_POST["pw"]);
		$pwChkS = preg_match("/[\!\@\#\$\%\^\&\*]/", $_POST["pw"]);
		$pwChkResult = ($pwChk&&$pwChkN&&$pwChkL&&$pwChkU&&$pwChkS);

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
		$phonenumber = $_POST["phonenumber_head"].$_POST["phonenumber_body"].$_POST["phonenumber_tail"];
		$phonenumberChk = preg_match("/^[0-9]{9,12}$/", $phonenumber);

		//Email check
		$email = $_POST["email_id"]."@".$_POST["email_domain"];
		$emailChk = preg_match("/^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i", $email);

		if($idChk&&$pwChkResult&&$serverChk&&$usernameChkResult&&$phonenumberChk&&$emailChk){
			//echo "success!!<br>";

			// ID 중복체크 it will be 
			$sql = "SELECT * FROM USER_TB WHERE user_id = '".$_POST["id"]."';";
			$result =  mysqli_query($connect, $sql);
			$row = mysqli_fetch_array($result);

			if($row){
				echo "<script>alert('중복 된 ID 입니다.');
				history.back();</script>";
			} else {
				// PW hash
				$salt_str = base64_encode(random_bytes(32));
				$pw = base64_encode(hash('sha256', $_POST["pw"].$salt_str, false));
				// phone number, email encrypt
				$phonenumber = Encrypt($phonenumber, $secret_key, $secret_iv);
				$email = Encrypt($email, $secret_key, $secret_iv);
				// INSERT INFO
				$time = date("Y-m-d H:i:s");
				$sql = "INSERT INTO USER_TB(user_id,user_pw,server,user_name,phone,email,date) VALUES('".$_POST["id"]."', '".$pw."', ".$_POST["server"].",'".$_POST["userName"]."', '".$phonenumber."', '".$email."', '".$time."');";
				$result = mysqli_query($connect, $sql);
				// 가입된 정보 확인
				$sql = "SELECT * FROM USER_TB WHERE user_id='".$_POST["id"]."';";
				$result = mysqli_query($connect, $sql);
				$row = mysqli_fetch_array($result);
				// INSERT SALT
				$sql = "INSERT INTO SALT_TB (salt,user_no) VALUES('".$salt_str."',".$row["no"].");";
				$result = mysqli_query($connect, $sql);

				echo "<script>alert('Complete Register!!');
					window.location.href='/login.php';</script>";
			}

		} else {
			echo "<script>alert('올바르지 않은 데이터 입니다.');
			history.back();</script>";
		}
	}

	mysqli_close($connect);
?>