<?php
	include "./database.php";

	//POST VALUE CHECK
	foreach ($_POST as $key => $value) {
		echo $key . " : " . $value . "<br>";
	}

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
	$phonenumberChk = preg_match("/^[0-9]{9,12}$/", $_POST["phonenumber"]);

	//Email check
	$emailChk = preg_match("/^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i", $_POST["email"]);

	if($idChk&&$pwChkResult&&$serverChk&&$usernameChkResult&&$phonenumberChk&&$emailChk){
		echo "success!!<br>";

		// ID 중복체크
		$sql = "SELECT * FROM USER_TB WHERE user_id = ".$_POST["id"].";";

		$result =  mysqli_query($connect,$sql);

		$row = mysqli_fetch_array($result);

		// PW hash
		$salt_str = base64_encode(random_bytes(32));
		$pw = base64_encode(hash('sha256', $_POST["pw"].$salt_str, false));


		if($row==1){
			echo "<script>alert('중복 된 ID 입니다.');</script>";
		} else {
			$sql = "INSERT INTO USER_TB(user_id,user_pw,server,user_name,phone,email,date) VALUES(".$_POST["id"].",".$pw.",".$_POST["server"].")";
		}

	} else {
		echo "<script>alert('올바르지 않은 데이터 입니다.');</script>";
	}

	mysqli_close();
?>