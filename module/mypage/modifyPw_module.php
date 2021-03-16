<div class="mypage_modify_info">
    <h5>비밀번호 변경</h5>
    <form  method="post" id="modifyPwForm" name="modifyPwForm" action="DB/modifyPw.php" onsubmit="return registerChk();">
    <?php
    echo<<<END
        <table class="info-list">
	        <tr><th>PW</th></tr>
            <tr><td><span><input id="user_pw" name="pw" type="password" class="form-control" placeholder="비밀번호" minlength="8" maxlength="20"></span></td></tr>
            <tr id="error_pw" class="register_error"><td></span>대소문자, 숫자, 특수문자(!,@,#,$,%,^,&,*)를 하나 씩 포함하여 8~20자 입력해주세요.</span></td></tr>
            <tr id="pw_blink" class="register_error"><td><span>비밀번호를 입력해주세요.</span></td></tr>
            <tr><th>PW check</th></tr>
            <tr><td><span><input id="user_pw_check" type="password" class="form-control" placeholder="비밀번호 확인" minlength="8" maxlength="20"></span></td></tr>
            <tr id="error_pw_check" class="register_error"><td><span>비밀번호가 일치하지 않습니다.</span></td></tr>
            <tr id="pw_check_blink" class="register_error"><td><span>비밀번호 확인을 입력해주세요.</span></td></tr>
        </table>
    <div class="register_button_bar">
        <button id="modifyAuth_button" type="submit" class="btn">변경하기</button>
    </div>
END;
?>
	</form>
</div>
<script>
	//PW check
    // 영문 대소문자, 숫자, 특수문자(!,@,#,$,%,^,&,*)를 꼭 포함하여 8~20자
    var passwordCheck = /^[a-zA-Z0-9\!\@\#\$\%\^\&\*]{8,20}$/;
    var passwordCheckN = /[0-9]/;
    var passwordCheckL = /[a-z]/;
    var passwordCheckU = /[A-Z]/;
    var passwordCheckS = /[\!\@\#\$\%\^\&\*]/;

    function pwCheck(){
        $("#pw_blink").css("display","none");
        $("#error_pw").css("display","none");

        //PW check
        if($("#user_pw").val()==""){
            $("#pw_blink").css("display","block");
            return false;
        } else{
            if(!(passwordCheck.test($("#user_pw").val())&&passwordCheckN.test($("#user_pw").val())&&passwordCheckL.test($("#user_pw").val())&&passwordCheckU.test($("#user_pw").val())&&passwordCheckS.test($("#user_pw").val()))){
                $("#error_pw").css("display","block");
                return false;
            }
        }
    }

    function pwCheckCheck(){
        $("#pw_check_blink").css("display","none");
        $("#error_pw_check").css("display","none");

        //PW CHECK check
        if($("#user_pw_check").val()==""){
            $("#pw_check_blink").css("display","block");
            return false;
        } else{
            if($("#user_pw_check").val()!=$("#user_pw").val()){
                $("#error_pw_check").css("display","block");
                return false;
            }
        }
    }

    $("#user_pw").keyup(function(){
        pwCheck();
    });

    $("#user_pw_check").keyup(function(){
        pwCheckCheck();
    });

    function registerChk(){
        let success = true;

        //PW check
        success = pwCheck();

        //PW CHECK check
        success = pwCheckCheck();

        return success;

    }
</script>