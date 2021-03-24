<?php
	error_reporting(E_ALL);
    ini_set("display_errors", 1);

    session_start();

    if(!isset($_SESSION["user_no"])){
    	echo "<script>alert('로그인 후 등록이 가능합니다..');
        window.location.href='/login.php';</script>";
        exit();
    }
    if(!isset($_POST["trade_type"])){
    	echo "<script>alert('올바르지 않은 Access 입니다.');
		history.back();</script>";
		exit();
    }

    include "./database.php";

	//POST VALUE CHECK
	/*foreach ($_POST as $key => $value) {
		echo $key . " : " . $value . "<br>";
	}*/

	$trade_type = $_POST["trade_type"];
	$server = $_POST["server"];
	$title = $_POST["title"];
	$price = $_POST["price"];
	$item_desc = $_POST["item_desc"];
	$time = date("Y-m-d H:i:s");

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

	$titleCheck = preg_match("/^[a-zA-Z0-9가-힣ㄱ-ㅎㅏ-ㅣ\,\.\?\!\(\)\s]*$/", $title);
	$optCheck = true;
	$tagCheck = true;
	foreach ($opt as $value) {
		if(preg_match("/[^가-힣0-9]/", $value)){
			$optCheck = false;
		}
	}
	foreach ($tag as $value) {
		if(preg_match("/[^가-힣0-9]/", $value)){
			$tagCheck = false;
		}
	}
	$priceCheck = preg_match("/^[0-9]*$/", $price);
	$RegExpJs = preg_match("/<script[^>]*>((\n|\r|.)*?)<\/script>/im", $item_desc);
	$sqlProtect = preg_match("/[\'\"\;\\\#\=\&]/", $item_desc);

	/*var_dump($titleCheck);
	var_dump($optCheck);
	var_dump($tagCheck);
	var_dump($priceCheck);
	var_dump($RegExpJs);
	var_dump($sqlProtect);*/

	if($titleCheck&&$optCheck&&$tagCheck&&$priceCheck&&(!$RegExpJs)&&(!$sqlProtect)){
		$sql = "INSERT INTO ITEM_TB(user_no,trade_type,server,title,price,item_desc,date) VALUES(".$_SESSION["user_no"].", ".$trade_type.", ".$server.", '".$title."', ".$price.", '".$item_desc."', '".$time."');";
		//var_dump($sql);
		$result = mysqli_query($connect, $sql);
		//var_dump($result);
		if($result){
			echo "Success!";
			$item_no = mysqli_insert_id($connect);
			if(count($opt)>0){
				foreach($opt as $key => $value){
					$sql = "INSERT INTO ITEM_OPT_TB(item_no,opt) VALUES(".$item_no.", '".$value."');";
					$result = mysqli_query($connect, $sql);
					if(!$result){
						echo "Item_opt error<br>";
						exit();
						echo "<script>alert('올바르지 않은 Data 입니다.');
						history.back();</script>";
						exit();
					}
				}
			}
			if(count($tag)>0){
				foreach($tag as $key => $value){
					$sql = "INSERT INTO ITEM_TAG_TB(item_no,item_tag) VALUES(".$item_no.", '".$value."');";
					$result = mysqli_query($connect, $sql);
					if(!$result){
						echo "Item_tag error<br>";
						exit();
						echo "<script>alert('올바르지 않은 Data 입니다.');
						history.back();</script>";
						exit();
					}
				}
			}
		} else {
			echo "fail!";
			exit();
			echo "<script>alert('올바르지 않은 Data 입니다.');
			history.back();</script>";
			exit();
		}

		if (empty($_FILES['item_img'])){
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
				$name = strtolower($_FILES['item_img']['name'][$f]);
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
	} else{
		echo "<script>alert('올바르지 않은 Data 입니다.');
				/*history.back();*/</script>";
	}
	


	mysqli_close($connect);

	if($trade_type == 1){
		//header("Location: /itemSell.php");
	} elseif ($trade_type ==2) {
		//header("Location: /itemBuy.php");
	}
	

?>