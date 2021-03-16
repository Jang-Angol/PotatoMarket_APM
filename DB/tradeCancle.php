<?php
	include "database.php";

	$trade_no = $_POST["trade_no"];
	$item_no = $_POST["item_no"];

	$sql = "UPDATE TRADE_TB SET apply_accept = 0 WHERE no = $trade_no";
	$result = mysqli_query($connect, $sql);

    //RESERVATION CANCLE
    $reserv_sql = "UPDATE ITEM_TB SET trade_state = 1 WHERE no = $item_no;";
    $reserv_result = mysqli_query($connect, $reserv_sql);
    if($reserv_result){
    	echo "item_state_change(1234)";
    }

    mysqli_close($connect);
?>