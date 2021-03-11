<?php
    include "../../DB/database.php";
    include "../../DB/security.php";

    session_start();

    $sql = "SELECT server, user_name, phone, email FROM USER_TB WHERE no = $_SESSION[user_no];";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    $server = $row["server"];
    $user_name = $row["user_name"];
    $d_email = Decrypt($row["email"], $secret_key, $secret_iv);
    $email = explode("@", $d_email);
    $d_phonenumber= Decrypt($row["phone"], $secret_key, $secret_iv);
    $phonenumber = explode("-", $d_phonenumber);
?>
<div class="mypage_modify_info">
    <h5>내 정보 수정</h5>
    <form>
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
            <tr><th>서버/캐릭터명</th></tr>
            <tr>
                <td>
                    <span>
                        <select id="user_server" name="server" class="server-select form-control" data-server=$server>
                            <option value="">서버</option>
                            <option value="1">LT</option>
                            <option value="2">HP</option>
                            <option value="3">MD</option>
                            <option value="4">WF</option>
                        </select>
                    </span>
                    <span><input id="user_name" name="userName" type="text" class="form-control" placeholder="캐릭터명" value=$user_name></span>
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
                                <input id="phonenumber_head" name="phonenumber_head" class="form-control" list="user_phonenumber_head" value=$phonenumber[0]>
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
                                <input id="phonenumber_body" name="phonenumber_body" type="text" class="form-control" maxlength="4" value=$phonenumber[1]>
                            </span>
                        </li>
                        <li>
                            <input id="phonenumber_tail" name="phonenumber_tail" type="text" class="form-control" maxlength="4" value=$phonenumber[2]>
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
                                <input id="email_id" name="email_id" type="text" value=$email[0] class="form-control" placeholder="Email">
                            </span>
                        </li>
                        <li>
                            <input id="email_domain" name="email_domain" class="form-control" list="user_email_domain" value=$email[1]>
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
            <button id="register_button" type="submit" class="btn">변경하기</button>
        </div>
END;
    ?>
    </form>
</div>
<script>
    $(document).ready(function () {
      var server_select = $('#user_server').attr("data-server");
      console.log(server_select);
      $('#user_server > option[value=' + server_select + ']').attr('selected', 'selected');
    });

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

    function registerChk(){
        let success = true;

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

        return success;

    }
</script>