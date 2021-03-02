<div class="container">
    <div class = "user-register container">
        <h4>회원가입</h4>
        <form method="post" id="registerForm" name="registerForm" action="DB/register.php" onsubmit="return registerChk();">
            <table class="info-list">
                <tr><th>ID</th></tr>
                <tr><td><span><input id="user_id" name="id" type="text" class="form-control" placeholder="아이디" minlength="8" name="pw" maxlength="20"></span></td></tr>
                <tr id="error_id" class="register_error"><td><span>아이디는 영문 8~20자로 입력해주세요.</span></td></tr>
                <tr id="id_blink" class="register_error"><td><span>아이디를 입력해주세요.</span></td></tr>
                <tr><th>PW</th></tr>
                <tr><td><span><input id="user_pw" name="pw" type="password" class="form-control" placeholder="비밀번호" minlength="8" maxlength="20"></span></td></tr>
                <tr id="error_pw" class="register_error"><td></span>대소문자, 숫자, 특수문자(!,@,#,$,%,^,&,*)를 하나 씩 포함하여 8~20자 입력해주세요.</span></td></tr>
                <tr id="pw_blink" class="register_error"><td><span>비밀번호를 입력해주세요.</span></td></tr>
                <tr><th>PW check</th></tr>
                <tr><td><span><input id="user_pw_check" type="password" class="form-control" placeholder="비밀번호 확인" minlength="8" maxlength="20"></span></td></tr>
                <tr id="error_pw_check" class="register_error"><td><span>비밀번호가 일치하지 않습니다.</span></td></tr>
                <tr id="pw_check_blink" class="register_error"><td><span>비밀번호 확인을 입력해주세요.</span></td></tr>
                <tr><th>서버/캐릭터명</th></tr>
                <tr>
                    <td>
                        <span>
                            <select id="user_server" name="server" class="server-select form-control">
                                <option value="">서버</option>
                                <option value="1">LT</option>
                                <option value="2">HP</option>
                                <option value="3">MD</option>
                                <option value="4">WF</option>
                            </select>
                        </span>
                        <span><input id="user_name" name="userName" type="text" class="form-control" placeholder="캐릭터명"></span>
                    </td>
                </tr>
                <tr id="error_user_name" class="register_error"><td><span>올바르지 않은 닉네임입니다.</span></td></tr>
                <tr id="user_server_blink" class="register_error"><td><span>서버를 선택해주세요.</span></td></tr>
                <tr id="user_name_blink" class="register_error"><td><span>닉네임을 입력해주세요.</span></td></tr>
                <tr><th>Phone</th></tr>
                <tr id="user_phonenumber">
                    <td>
                        <ul class="phonenumber clearfix">
                            <li>
                                <span>
                                    <input id="phonenumber_head" class="form-control" list="user_phonenumber_head" value="010">
                                    <datalist id="user_phonenumber_head">
                                        <option value="010">
                                        <option value="011">
                                        <option value="016">
                                        <option value="019">
                                        <option value="017">
                                        <option value="018">
                                    </datalist>
                                </span>
                            </li>
                            <li>
                                <span>
                                    <input id="phonenumber_body" type="text" class="form-control" maxlength="4">
                                </span>
                            </li>
                            <li>
                                <input id="phonenumber_tail" type="text" class="form-control" maxlength="4">
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr id="error_user_phonenumber" class="register_error"><td><span>숫자만 입력해주세요.</span></td></tr>
                <tr id="user_phonenumber_blink"class="register_error"><td><span>연락처를 입력해주세요.</span></td></tr>
                <tr><th>Email</th></tr>
                <tr id="user_email">
                    <td>
                        <ul class="user-email clearfix">
                            <li>
                                <span>
                                    <input id="email_id" type="text" value="" class="form-control" placeholder="Email">
                                </span>
                            </li>
                            <li>
                                <input id="email_domain" class="form-control" list="user_email_domain">
                                <datalist id="user_email_domain">
                                       <option value="naver.com">
                                       <option value="hanmail.net">
                                       <option value="gmail.com">
                                       <option value="nate.com">
                                       <option value="hotmail.com">
                                       <option value="paran.com">
                                       <option value="korea.com">
                                       <option value="chol.com">
                                       <option value="daum.net">
                                       <option value="yahoo.com">
                                       <option value="hanafos.co.kr">
                                       <option value="msn.com">
                                       <option value="kebi.com">
                                       <option value="netian.com">
                                       <option value="freechal.com">
                                       <option value="empal.com">
                                 </datalist>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr id="error_user_email" class="register_error"><td><span>올바르지 않은 이메일 주소입니다.</span></td></tr>
                <tr id="user_email_blink" class="register_error"><td><span>이메일 주소를 입력해주세요.</span></td></tr>
            </table>
            <div class="register_button_bar">
                <button id="register_button" type="submit" class="btn">가입하기</button>
            </div>
        </form>
    </div>
</div>
<script>
    //ID check
    // 영문소문자, 숫자, 언더바(_) 8~20자
    var useridCheck = /^[a-zA-Z0-9_]{8,20}$/;
    //PW check
    // 영문 대소문자, 숫자, 특수문자(!,@,#,$,%,^,&,*)를 꼭 포함하여 8~20자
    var passwordCheck = /^[a-zA-Z0-9\!\@\#\$\%\^\&\*]{8,20}$/;
    var passwordCheckN = /[0-9]/;
    var passwordCheckL = /[a-z]/;
    var passwordCheckU = /[A-Z]/;
    var passwordCheckS = /[\!\@\#\$\%\^\&\*]/;
    //캐릭터명 체크
    // 한글 2~8자+숫자 영문 3~12자+숫자
    // 한글,영문 혼용 불가
    // 첫글자로 숫자가 들어가면 안됨
    var userNameCheckKor = /^[가-힣]+[0-9]*$/;
    var userNameCheckEng = /^[a-zA-Z]+[0-9]*$/;

    //phonenumber check
    var phonenumberCheck = /^[0-9]{3,4}$/;

    //email 체크
    var emailCheck = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;


    function idCheck(){
        $("#id_blink").css("display","none");
        $("#error_id").css("display","none");
        //ID check
        if($("#user_id").val()==""){
            $("#id_blink").css("display","block");
            return false;
        } else{
            if(!useridCheck.test($("#user_id").val())){
                $("#error_id").css("display","block");
                return false;
            }
        }
    }

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

    function userNameCheck(){
        $("#user_server_blink").css("display","none");
        $("#user_name_blink").css("display","none");
        $("#error_user_name").css("display","none");

        //USER SERVER check
        if($("#user_server").val()==""){
            $("#user_server_blink").css("display","block");
            return false;
        }

        //USER NAME check
        if($("#user_name").val()==""){
            $("#user_name_blink").css("display","block");
            return false;
        } else{
            if(!(userNameCheckKor.test($("#user_name").val())||userNameCheckEng.test($("#user_name").val()))){
                $("#error_user_name").css("display","block");
                return false;
            }
        }
    }

    function phoneNumCheck(){
        $("#user_phonenumber_blink").css("display","none");
        $("#error_user_phonenumber").css("display","none");

        //PHONE NUMBER check
        if(($("#phonenumber_head").val()=="")||($("#phonenumber_body").val()=="")||($("#phonenumber_tail").val()=="")){
            $("#user_phonenumber_blink").css("display","block");

            return false;
        } else{
            if(!(phonenumberCheck.test($("#phonenumber_head").val())&&phonenumberCheck.test($("#phonenumber_body").val())&&phonenumberCheck.test($("#phonenumber_tail").val()))){
                $("#error_user_phonenumber").css("display","block");
                return false;
            }
        }
    }

    function email_Check(){
        $("#user_email_blink").css("display","none");
        $("#error_user_email").css("display","none");

        //EMAIL check
        if($("#email_id").val()==""||$("#email_domain").val()==""){
            $("#user_email_blink").css("display","block");
            return false;
        } else{
            let email = $("#email_id").val() + "@" + $("#email_domain").val();
            if(!emailCheck.test(email)){
                $("#error_user_email").css("display","block");
                return false;
            }
        }
    }

    $("#user_id").keyup(function(){
        idCheck();
    });

    $("#user_pw").keyup(function(){
        pwCheck();
    });

    $("#user_pw_check").keyup(function(){
        pwCheckCheck();
    });

    $("#user_name").keyup(function(){
        userNameCheck();
    });

    $("#phonenumber_head").keyup(function(){
        phoneNumCheck();
    });

    $("#phonenumber_body").keyup(function(){
        phoneNumCheck();
    });

    $("#phonenumber_tail").keyup(function(){
        phoneNumCheck();
    });

    $("#email_domain").keyup(function(){
        email_Check();
    });

    $("#register_button").click(function(){
        let phonenumber = document.createElement("input");
        phonenumber.setAttribute("name","phonenumber");
        phonenumber.setAttribute("display","none");
        phonenumber.setAttribute("value", $("#phonenumber_head").val() + $("#phonenumber_body").val() + $("#phonenumber_tail").val() );

        registerForm.append(phonenumber);


        let email = document.createElement("input");
        email.setAttribute("name","email");
        email.setAttribute("display","none");
        email.setAttribute("value", $("#email_id").val() +"@"+ $("#email_domain").val() );

        registerForm.append(email);
    });

    function registerChk(){
        let success = true;

        //ID check
        success = idCheck();


        //PW check
        success = pwCheck();

        //PW CHECK check
        success = pwCheckCheck();

        //USER SERVER check
        success = userNameCheck();

        //PHONE NUMBER check
        success = phoneNumCheck();

        //EMAIL check
        success = email_Check();

        if(success==true){
            return true;
        }

    }

</script>