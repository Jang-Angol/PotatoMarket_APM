<?php
	include "database.php";

	if(!isset($_SESSION["user_no"])){
		echo "<script>alert('올바르지 않은 접근입니다.');
            window.location.href='/login.php';</script>";
	} else {
		$item_no = $_POST["item_no"];

		$trade_type = $_POST["trade_type"];
		$server = $_POST["server"];
		$title = $_POST["title"];
		$price = $_POST["price"];
		$item_desc = $_POST["item_desc"];
		$time = date("Y-m-d H:i:s");

		foreach ($_POST as $key => $value) {
			echo $key . " : " . $value . "<br>";
		}

		$opt = array();
		if(isset($_POST["item_opt1"])&&($_POST["item_opt1"]!="")){
			array_push($opt,$_POST["item_opt1"]);
		}
		if(isset($_POST["item_opt2"])&&($_POST["item_opt2"]!="")){
			array_push($opt,$_POST["item_opt2"]);
		}
		if(isset($_POST["item_opt3"])&&($_POST["item_opt3"]!="")){
			array_push($opt,$_POST["item_opt3"]);
		}
		var_dump($opt);

		$tag = array();
		if(isset($_POST["item_tag1"])&&($_POST["item_tag1"]!="")){
			array_push($tag,$_POST["item_tag1"]);
		}
		if(isset($_POST["item_tag2"])&&($_POST["item_tag2"]!="")){
			array_push($tag,$_POST["item_tag2"]);
		}
		if(isset($_POST["item_tag3"])&&($_POST["item_tag3"]!="")){
			array_push($tag,$_POST["item_tag3"]);
		}
		if(isset($_POST["item_tag4"])&&($_POST["item_tag4"]!="")){
			array_push($tag,$_POST["item_tag3"]);
		}
		var_dump($tag);
		/*

			TODO: Check POST Value


		*/
		//UPDATE ITEM_TB
		$sql = "UPDATE ITEM_TB SET ";
		//UPDATE ITEM_OPT_TB

		//UPDATE ITEM_TAG_TB

		//UPDATE IMG

		//UPDATE ITEM_IMG_TB
	}
	mysqli_close($connect);
?>
