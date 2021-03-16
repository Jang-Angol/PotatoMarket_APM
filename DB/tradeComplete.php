<?php
	include "database.php";

	session_start();

	$sql = "SELECT user_no FROM ITEM_TB WHERE no = $_POST[item_no];";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);

	if($_SESSION["user_no"] == $row["user_no"]){
		$sql = "SELECT * FROM TRADE_TB WHERE item_no = $_POST[item_no] AND apply_accept = 1;";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);
		if($row){
			$sql = "UPDATE ITEM_TB SET trade_state = 3, price = '$row[apply_price]' WHERE no = $_POST[item_no];";
			//var_dump($sql);
			$result = mysqli_query($connect, $sql);
			//var_dump($result);
			echo "<script>alert('거래가 완료되었습니다.');
				history.back();</script>";
		} else {
			echo "<script>alert('수락 중인 거래가 없습니다.');
				history.back();</script>";
		}
	} else {
		echo "<script>alert('올바르지 않은 접근입니다.');
				history.back();</script>";
	}

	
	mysqli_close($connect);
?>