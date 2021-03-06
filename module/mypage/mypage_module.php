<?php
	if(!isset($_SESSION["user_no"])){
        echo "<script>alert('로그인 후 이용이 가능합니다..');
        window.location.href='/login.php';</script>";
    }
?>
<div class="mypage">

	<?php

		include "./module/mypage/mypage_nav.php";

	?>

	<div class="mypage_contents container">

		<div id="mypage_content"></div>
	
	</div>

</div>
