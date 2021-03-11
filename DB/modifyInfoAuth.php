<?php
	include "database.php";

	session_start();

	$pw_sql = "SELECT user_pw FROM USER_TB WHERE no = $_SESSION[user_no];";
	$pw_result = mysqli_query($connect, $pw_sql);
	$pw_row = mysqli_fetch_array($pw_result);
	$user_pw = $pw_row["user_pw"];

	$salt_sql = "SELECT salt FROM SALT_TB WHERE user_no = $_SESSION[user_no];";
	$salt_result = mysqli_query($connect, $salt_sql);
	$salt_row = mysqli_fetch_array($salt_result);
	$salt_str = $salt_row["salt"];

	$secure_pw = base64_encode(hash('sha256', $_POST["pw"].$salt_str, false));

	if($user_pw == $secure_pw){
		echo<<<END
			<script>
				$.ajax({
						type: "post",
			            url: "../module/mypage/modifyInfo_module.php",
			            success : function connect(a){
			                $("#mypage_content").html(a); 
			            },
			            error : function error(){alert("error");}
					});
			</script>
END;
	} else {
		echo "<script>alert('비밀번호가 일치하지 않습니다.')</script>";
	}
?>
