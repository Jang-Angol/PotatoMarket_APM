<?php
    include"../../DB/database.php";

    $sql = "SELECT * FROM PROPOSAL_TB ORDER BY no DESC LIMIT 8;";
    $result = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($result)){
    	$user_sql = "SELECT server, user_name FROM USER_TB WHERE no = $row[user_no];";
    	$user_result = mysqli_query($connect, $user_sql);
    	$user_row = mysqli_fetch_array($user_result);
    	echo<<<END
	    <div class="proposal card mb-3">
	        <div class="card-body">
	            <div class="card-title"><span class="server_icon_$user_row[server]"></span><span class="user_name">$user_row[user_name]</span></div>
	            <div class="card-text"><p>$row[content]</p></div>
	        </div>
	    </div>    
END;
    }
    	echo<<<END
    	<div class="paging">
	        < 1 2 3 4 5 >
	    </div>
END;
    mysqli_close($connect);
?>