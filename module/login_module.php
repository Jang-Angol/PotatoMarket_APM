<div class="login_contents container">
    <div class="logo">
        <span><a href="/">감자마켓</a></span>
    </div>
    <div class="login_box">
        <form method="post" id="loginForm" name="loginForm" action="DB/login.php" onsubmit="return loginChk();">
<?php
    if(isset($_COOKIE["potato_id"])){
        $saved_id = base64_decode($_COOKIE["potato_id"]);
        echo<<<END
            <div class="input_box">
                <input id="user_id" name="id" type="text" placeholder="아이디" minlength="8" value=$saved_id maxlength="20"/>
            </div>
            <div class="input_box">
                <input id="user_pw" name="pw" type="password" placeholder="비밀번호" minlength="8" maxlength="20"/>
            </div>
            <div class="input_box_chk">
                <input type="checkbox" id="chkSaveID" name="chkSaveID" checked/>
                <label for="chkSaveID">아이디저장</label>
            </div>
END;
    } else {
        echo<<<END
            <div class="input_box">
                <input id="user_id" name="id" type="text" placeholder="아이디" minlength="8" maxlength="20"/>
            </div>
            <div class="input_box">
                <input id="user_pw" name="pw" type="password" placeholder="비밀번호" minlength="8" maxlength="20"/>
            </div>
            <div class="input_box_chk">
                <input type="checkbox" id="chkSaveID" name="chkSaveID"/>
                <label for="chkSaveID">아이디저장</label>
            </div>
END;
    }
?>
            
            <div class="btn_login">
                <input type="submit" value="로그인"/>
            </div>
        </form>
        <ul class="bottom_bar">
            <li><a>아이디 찾기</a></li>
            <li><a>비밀번호 찾기</a></li>
            <li><a href="register.php">회원가입</a></li>
        </ul>
    </div>         
</div>
<script>

    //ID 영문소문자, 숫자, 언더바(_) 8~20자
    var useridCheck = /^[a-zA-Z0-9_]{8,20}$/;
    //PW 영문 대소문자, 숫자, 특수문자(!,@,#,$,%,^,&,*)를 꼭 포함하여 8~20자
    var passwordCheck = /^[a-zA-Z0-9\!\@\#\$\%\^\&\*]{8,20}$/;

    $("#user_id").keydown(function(key) {
        if (key.keyCode == 13) {
            if(loginChk()){
                loginForm.submit();
            }
        }
    });
    $("#user_pw").keydown(function(key) {
        if (key.keyCode == 13) {
            if(loginChk()){
                loginForm.submit();
            }
        }
    });

    function loginChk(){

        if(!useridCheck.test($("#user_id").val())){
            alert("유효하지 않은 아이디입니다.");
            return false;
        }
        if(!passwordCheck.test($("#user_pw").val())){
            alert("유효하지 않은 패스워드입니다.");
            return false;
        }
    }

</script>