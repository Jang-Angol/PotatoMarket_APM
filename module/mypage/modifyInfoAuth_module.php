<div class="mypage_modify_info">
    <h5>비밀번호 확인</h5>
    <form method="post" id="modifyInfoAuthForm" name="modifyInfoAuthForm">
        <table class="info-list">
        	<tr><td><span><input id="user_pw" name="pw" type="password" class="form-control" placeholder="비밀번호" minlength="8" maxlength="20"></span></td></tr>
        </table>
        <div id="test"></div>
        <div class="register_button_bar">
            <button id="modifyAuth_button" type="button" class="btn">다음</button>
        </div>
    </form>
</div>
<script>
	var passwordCheck = /^[a-zA-Z0-9\!\@\#\$\%\^\&\*]{8,20}$/;

	$("#modifyAuth_button").click(function(){
		if(passwordCheck.test($("#user_pw").val())){
			var data = $("#modifyInfoAuthForm").serialize();

			$.ajax({
				type: "post",
	            url: "DB/modifyInfoAuth.php",
	            data: data,
	            success : function connect(a){
	                $("#test").html(a); 
	            },
	            error : function error(){alert("error");}
			});

		} else {
			alert("ERROR");
		}
		
	});
</script>