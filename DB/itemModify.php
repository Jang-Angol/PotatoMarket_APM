<?php
	include "database.php";

	session_start();

	if(!isset($_SESSION["user_no"])){
		//echo "<script>alert('올바르지 않은 접근입니다.');
        //    window.location.href='/';</script>";
	} else {
		$item_no = $_POST["item_no"];

		if($_POST["trade_type"]==1){
			$trade_type = "Sell";
		} else if($_POST["trade_type"]==2){
			$trade_type = "Buy";
		}

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
		//var_dump($opt);

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
		//var_dump($tag);
		
		/*

			TODO: Check POST Value


		*/

		//UPDATE ITEM_TB
		$sql = "UPDATE ITEM_TB SET server = $server, title = '$title', price = '$price', item_desc = '$item_desc' WHERE no = $item_no;";
		$result = mysqli_query($connect, $sql);
		if($result){
			echo "success<br>";
		} else {
			echo "fail<br>";
		}

		//UPDATE ITEM_OPT_TB
		$sql = "DELETE FROM ITEM_OPT_TB WHERE item_no = $item_no;";
		$result = mysqli_query($connect, $sql);
		if(count($opt)>0){
			foreach($opt as $value){
				$opt_sql = "INSERT INTO ITEM_OPT_TB(opt,item_no) VALUES('$value', $item_no);";
				$opt_result = mysqli_query($connect, $opt_sql);
				if(!$result){
					echo "Item_opt error<br>";
				}
			}
		}

		//UPDATE ITEM_TAG_TB
		$sql = "DELETE FROM ITEM_TAG_TB WHERE item_no = $item_no;";
		//$result = mysqli_query($connect, $sql);
		if(count($tag)>0){
			foreach($tag as $value){
				$tag_sql = "INSERT INTO ITEM_TAG_TB(item_tag,item_no) VALUES('$value', $item_no);";
				$tag_result = mysqli_query($connect, $tag_sql);
				if(!$result){
					echo "Item_tag error<br>";
				}
			}
		}

		
		//DELETE IMG
		if(!empty($_POST["del_img"])){
			foreach ($_POST["del_img"] as $key => $value) {
				$img_sql = "SELECT img_src FROM ITEM_IMG_TB WHERE no = $value AND item_no = $item_no";
				$img_result = mysqli_query($connect, $img_sql);
				$img_row = mysqli_fetch_array($img_result);
				if($img_row){
					if(unlink("..".$img_row["img_src"])){
						$img_sql = "DELETE FROM ITEM_IMG_TB WHERE no = $value AND item_no = $item_no;";
						$img_result = mysqli_query($connect, $img_sql);
						if(!$img_result){
							echo "fail<br>";
						}
					} else {
						echo "fail<br>";
					}
				}
			}
		}

		//UPDATE IMG
		if (empty($_FILES['item_img'])||(!isset($_FILES['itm_img']))){
			echo "File is none<br>";
		} else {
			//IMG UPLOAD
			// 설정
			$upload_dir = '../upload/'.$_SESSION["user_no"];
			if(!is_dir($upload_dir)){
				mkdir($upload_dir,0757,true);
			}
			$allowed_ext = array('jpg','jpeg','png','gif', 'jfif', 'bmp');
			
			foreach ($_FILES['item_img']['name'] as $f => $name) {   

				// 변수 정리
				$error = $_FILES['item_img']['error'][$f];
				$name = $_FILES['item_img']['name'][$f];
				$ext = array_pop(explode('.', $name));
				// 오류 확인
				if( $error != UPLOAD_ERR_OK ) {
					switch( $error ) {
						case UPLOAD_ERR_INI_SIZE:
						case UPLOAD_ERR_FORM_SIZE:
							echo "파일이 너무 큽니다. ($error)";
							break;
						case UPLOAD_ERR_NO_FILE:
							echo "파일이 첨부되지 않았습니다. ($error)";
							break;
						default:
							echo "파일이 제대로 업로드되지 않았습니다. ($error)";
					}
					exit;
				}
				 
				// 확장자 확인
				if( !in_array($ext, $allowed_ext) ) {
					echo "허용되지 않는 확장자입니다.";
					exit;
				}

				// 파일명 변조
				$fileName = $f.substr(base64_encode($title),0,10).$time.'.'.$ext;
				 
				// 파일 이동
			    if(move_uploaded_file($_FILES['item_img']['tmp_name'][$f], "$upload_dir/$fileName")){
			        
			        echo 'success';

			        // save src to DB
			        $sql = "INSERT INTO ITEM_IMG_TB(item_no,img_src) VALUES(".$item_no.", '".substr($upload_dir,2)."/".$fileName."');";
			        $result = mysqli_query($connect, $sql);
			        if(!$result){
			        	echo "IMG UPLOAD ERROR";
			        	exit();
			        	echo "<script>alert('올바르지 않은 Data 입니다.');
						history.back();</script>";
						exit();
			        }

			    }else{
			        echo 'error';
			        echo "<script>alert('올바르지 않은 Data 입니다.');
					history.back();</script>";
					exit();
			    }
			}
		}

		echo "<script>alert('Complete Modify!!');
			window.location.href='/item$trade_type.php';</script>";
	}
	mysqli_close($connect);
?>
