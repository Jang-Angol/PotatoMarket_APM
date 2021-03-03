<?php

	include  "./database.php";

	if(isset($_SESSION["user_no"])){
    	echo "<script>alert('올바르지 않은 Access 입니다.');
		history.back();</script>";
		exit();
    }

	if(isset($_POST["id"])&&isset($_POST["pw"])){
		$id = $_POST["id"];
		$pw = $_POST["pw"];

		// value check
		$idCheck = preg_match("/^[a-zA-Z0-9_]{8,20}$/", $id);
		$pwCheck = preg_match("/^[a-zA-Z0-9\!\@\#\$\%\^\&\*]{8,20}$/", $pw);

		if($idCheck&&$pwCheck){

		} else{
			echo "<script>alert('Not valid value');</script>";
			header("Location: /login.php");
		}
	
	} else {
		echo "<script>alert('Page is not alowed');</script>";
		header("Location: /");
	}
	// id check + saltstring
	$sql = "SELECT * FROM USER_TB WHERE user_id = '".$id."';";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);

	if($row){
		//echo "id is valid<br>";
		// find salt string
		$user_no = $row["no"];
		//echo "user_no: ".$user_no."<br>";
		$user_pw = $row["user_pw"];
		//echo "user_pw: ".$user_pw."<br>";
		$user_name = $row["user_name"];
		$user_server = $row["server"];

		$sql = "SELECT * FROM SALT_TB WHERE user_no='".$user_no."';";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);
		$salt_str = $row["salt"];
		//echo "salt_str: ".$salt_str."<br>";
		$secure_pw = base64_encode(hash('sha256', $pw.$salt_str, false));
		// pw check
		if($secure_pw!=$user_pw){
			//echo "login Failed";
			echo "<script>alert('비밀번호가 일치하지 않습니다.');
			window.location.href='/login.php';</script>";
		} else {
			//echo "login success";
			if(isset($_POST["chkSaveID"])){
				$c_id = base64_encode($id);
				setcookie("potato_id",$c_id, time()+3600*24*100,"/login.php");
			} else {
				setcookie("potato_id","", time(),"/login.php");
			}
			session_start();
			$_SESSION["user_no"] = $user_no;
			$_SESSION["user_name"] = $user_name;
			$_SESSION["user_server"] = $user_server;
			header("Location: /");
		}
	} else {
		//echo "id is not valid<br>";
		echo "<script>alert('존재하지 않는 아이디 입니다.');
		window.location.href='/login.php';</script>";
	}

	mysqli_close($connect);
?>