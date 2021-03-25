<div class="warning_table">
    <table>
        <tbody>
<?php
	session_start();

    include "../../DB/database.php";

    if(!isset($_SESSION["user_no"])){
        echo "<script>alert('로그인 후 이용이 가능합니다..');
            window.location.href='/login.php';</script>";
    } else {
    	$sql = "SELECT category, reason, duedate FROM WARN_TB WHERE user_no = $_SESSION[user_no];";
    	$result = mysqli_query($connect, $sql);
    	if($row = mysqli_fetch_array($result)){
    		switch ($row["category"]) {
    			case 1:
    				$category = "활동정지";
    				break;
    			case 2:
    				$category = "영구정지";
    				break;
    			default:
    				# code...
    				break;
    		}
    		echo<<<END
    		<tr><td class="warning_type">$category</td><td class="warning_reason">$row[reason]</td><td class="warning_due">$row[duedate]</td></tr>
END;
			while($row = mysqli_fetch_array($result)){
				switch ($row["category"]) {
	    			case 1:
	    				$category = "활동정지";
	    				break;
	    			case 2:
	    				$category = "영구정지";
	    				break;
	    			default:
	    				# code...
	    				break;
	    		}
    		echo<<<END
    		<tr><td class="warning_type">$category</td><td class="warning_reason">$row[reason]</td><td class="warning_due">$row[duedate]</td></tr>
END;
			}
    	} else {
    		echo "<div class='warn_blink'>받은 경고내역이 없습니다</div>";
    	}
    }
?>
        </tbody>
    </table>
</div>