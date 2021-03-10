<?php
	include  "./database.php";

	$item_no = $_POST["item_no"];
	$apply_state = $_POST["apply_state"];
	$apply_price = $_POST["apply_price"];
	$apply_user_no = $_POST["apply_user_no"];
	
	if(isset($_POST["reservationChk"])){
		if(isset($_POST["reservation_date"])){
			$reservation_date = $_POST["reservation_date"];
			$sql = "INSERT INTO TRADE_TB(item_no,apply_state,apply_price,apply_user_no,reservation_date) VALUES($item_no, 3, $apply_price, $apply_user_no, '$reservation_date');";
		}
	} else {
		$sql = "INSERT INTO TRADE_TB(item_no,apply_state,apply_price,apply_user_no) VALUES($item_no, $apply_state, $apply_price, $apply_user_no);";
	}
	var_dump($sql);
	if($result = mysqli_query($connect, $sql)){
		echo "success";
	} else {
		echo "Not Valid Value";
		var_dump($result);
	}

	mysqli_close($connect);
	
?>