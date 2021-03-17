<?php
	include "database.php";

	session_start();

	if(!isset($_SESSION["user_no"])){
		echo "<script>alert('Invalid access');
			history.back();</script>";
	} else {
		$content = $_POST["content"];
		$RegExpJSChk = preg_match_all('/<script[^>]*>((\n|\r|.)*?)<\/script>/im', $content);
    	$sqlProtectChk = preg_match_all('/[\'\"\;\\\#\=\&]/', $content);
    	if($RegExpJSChk||$sqlProtectChk){
    		echo "<script>alert('Invalid value')</script>";
    	} else {
    		$sql = "INSERT INTO PROPOSAL_TB(user_no,content) VALUES($_SESSION[user_no],'$content');";
    		$result = mysqli_query($connect, $sql);
    		if($result){
    			//echo "success";
    		} else {
    			echo "fail";
    			//echo $sql;
    			//echo $result;
    		}
    	}
	}

	mysqli_close($connect);
?>
