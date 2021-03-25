<?php
/*	error_reporting(E_ALL);
    ini_set("display_errors", 1);
*/
    session_start();

    if(!isset($_SESSION["user_no"])){
    	echo "<script>alert('로그인 후 등록이 가능합니다..');
        window.location.href='/login.php';</script>";
        exit();
    }

    include "./database.php";

	//POST VALUE CHECK
	/*foreach ($_POST as $key => $value) {
		echo $key . " : " . $value . "<br>";
	}*/

	

	$user_no = $_SESSION["user_no"];
	$category = $_POST["category"];
	$title = $_POST["title"];
	$content = $_POST["content"];
	if(isset($_POST["link"])){
		$link = $_POST["link"];
	}
	$time = date("Y-m-d H:i:s");

	$titleCheck = preg_match("/^[a-zA-Z0-9가-힣ㄱ-ㅎㅏ-ㅣ\,\.\?\!\(\)\s]*$/", $title);
	$RegExpJs = preg_match("/<script[^>]*>((\n|\r|.)*?)<\/script>/im", $content);
	$sqlProtect = preg_match("/[\'\"\;\\\#\=\&]/", $content);

	/*var_dump($titleCheck);
	var_dump($RegExpJs);
	var_dump($sqlProtect);*/

	if($titleCheck&&(!$RegExpJs)&&(!$sqlProtect)){
		if(isset($link)){
			$sql = "INSERT INTO REPORT_TB(user_no, category, title, content, link) VALUES($user_no, $category, '$title', '$content', '$link');";
		} else {
			$sql = "INSERT INTO REPORT_TB(user_no,category,title,content) VALUES($user_no, $category, '$title', '$content');";
		}
		//var_dump($sql);
		$result = mysqli_query($connect, $sql);
		//var_dump($result);
		if($result){
			//echo "Success!";
			$report_no = mysqli_insert_id($connect);
		} else {
			echo "fail!";
			exit();
			echo "<script>alert('올바르지 않은 Data 입니다.');
				history.back();</script>";
			exit();
		}

		if (empty($_FILES['report_img'])||(!isset($_FILES['report_img']))){
			//echo "File is none<br>";

		} else {
			//IMG UPLOAD
			// 설정
			$upload_dir = '../report/'.$_SESSION["user_no"];
			if(!is_dir($upload_dir)){
				mkdir($upload_dir,0757,true);
			}
			$allowed_ext = array('jpg','jpeg','png','gif', 'jfif', 'bmp');
			
			foreach ($_FILES['report_img']['name'] as $f => $name) {   

				// 변수 정리
				$error = $_FILES['report_img']['error'][$f];
				$name = strtolower($_FILES['report_img']['name'][$f]);
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
							echo "<script>alert('Success!!');
								history.back();</script>";
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
			    if(move_uploaded_file($_FILES['report_img']['tmp_name'][$f], "$upload_dir/$fileName")){
			        
			        //echo 'success';

			        // save src to DB
			        $sql = "INSERT INTO REPORT_IMG_TB(report_no,img_src) VALUES(".$report_no.", '".substr($upload_dir,2)."/".$fileName."');";
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
	
	echo "<script>alert('Success!!');
				history.back();</script>";


	mysqli_close($connect);
	

?>