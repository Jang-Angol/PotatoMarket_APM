<?php
	include "database.php";

	session_start();

	$sql = "SELECT user_no FROM ITEM_TB WHERE no = $_POST[item_no];";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);

	if($_SESSION["user_no"]==$row["user_no"]){
		//DELETE TRADE
		$trade_sql = "DELETE FROM TRADE_TB WHERE item_no = $_POST[item_no];";
		$trade_result = mysqli_query($connect, $trade_sql);
		if($trade_result){
			echo 'DEL TRADE <br>';
		} else {
			echo "DEL TRADE FAIL <br>";
		}

		//DELETE IMG
		$img_sql = "SELECT no, img_src FROM ITEM_IMG_TB WHERE item_no = $_POST[item_no];";
		$img_result = mysqli_query($connect, $img_sql);
		while($img_row = mysqli_fetch_array($img_result)){
			unlink("..".$img_row["img_src"]);
			$delete_sql = "DELETE FROM ITEM_IMG_TB WHERE no = $img_row[no];";
			$delete_result = mysqli_query($connect, $delete_sql);
			if($delete_result){
				echo 'DEL IMG <br>';
			} else {
				echo "DEL IMG FAIL <br>";
			}
		}

		//DELETE OPT
		$opt_sql = "DELETE FROM ITEM_OPT_TB WHERE item_no = $_POST[item_no];";
		$opt_result = mysqli_query($connect, $opt_sql);
		if($opt_result){
			echo 'DEL OPT <br>';
		} else {
			echo "DEL OPT FAIL <br>";
		}

		//DELETE TAG
		$tag_sql = "DELETE FROM ITEM_TAG_TB WHERE item_no = $_POST[item_no];";
		$tag_result = mysqli_query($connect, $tag_sql);
		if($tag_result){
			echo 'DEL TAG <br>';
		} else {
			echo "DEL TAG FAIL <br>";
		}

		//DELETE ITEM
		$item_sql = "DELETE FROM ITEM_TB WHERE no = $_POST[item_no];";
		$item_result = mysqli_query($connect, $item_sql);
		if($item_result){
			echo 'DEL item <br>';
		} else {
			echo "DEL item FAIL <br>";
		}

		echo "<script>alert('삭제가 완료되었습니다.');
			window.location.href='/itemSell.php';</script>";

	} else {
		echo "<script>alert('정상적인 접근이 아닙니다.');
			history.back();</script>";
	}
?>
