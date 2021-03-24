<?php
    session_start();

    if(!isset($_SESSION["user_no"])){
        echo "<script>alert('로그인 후 등록이 가능합니다..');
        window.location.href='/login.php';</script>";
    }
?>
<div class="report_register">
    <form enctype="multipart/form-data" method="post" id="reportRegisterForm" name="reportRegisterForm" action="/DB/reportRegister.php" onsubmit="return reportCheck();">
        <div class="report_register_contents">
            <div class="register-title">
                <span>
                    <select class="category-select form-control" name="category">
                        <option value="">카테고리</option>
                        <option value="1">사기</option>
                        <option value="2">규정위반</option>
                        <option value="3">광고</option>
                        <option value="4">부적절한 게시물</option>
                    </select>
                </span>
                <span><input type="text" class="form-control" name="title" placeholder="제목을 입력해주세요."></span>
            </div>
            <div class="register-table">
                <table>
                    <tbody>
                        <tr><th>내용</th><td><textarea class="form-control" name="content" rows="10"></textarea></td></tr>
                        <tr><th>링크</th><td><input id="report_link" name="link" type="text"/></td></tr>
                        <tr><th>스크린샷</th><td><input type="file" name="report_img[]" accept="image/*" multiple class="form-control-file"/></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="report_button">
            <button type="button">신고하기</button>
        </div>
    </form>
</div>
<div class="back_button">
    <button onClick="backReportList()">뒤로가기</button>
</div>
<script>
    function backReportList(){
        $.ajax({
            type: "post",
            url: "module/mypage/report/reportList_module.php",
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    }

    //Regular Expression
    var titleCheck = /[^a-zA-Z0-9가-힣ㄱ-ㅎㅏ-ㅣ\,\.\?\!\(\)\s]/;
    var RegExpJS = /<script[^>]*>((\n|\r|.)*?)<\/script>/img;
    var sqlProtect = /[\'\"\;\\\#\=\&]/g;

    function reportCheck(){
        //server check
        if($(".server-select").val()==""){
            console.log("error-server");
            alert("서버를 골라주세요.");
            return false;
        }
        //title check
        if($("#item-name").val()==""){
            console.log("error-title-blink");
            alert("제목을 입력해주세요.");
            return false;
        } else {
            if(titleCheck.test($("#item-name").val())){
                console.log("error-title");
                return false;
            }
        }

        
        if($("#price").val()==""){
            console.log("error-price-blink");
            alert("가격을 입력해주세요.");
            return false;
        } else if($("#price").val().indexOf(0) == 0){
            console.log("not valid price");
            alert("0으로 시작하는 가격은 입력할 수 없습니다.");
            return false;
        } else {
            if($("#price").val().length>11){
                alert("가격은 최대 999억까지 가능합니다.");
                return false;
            }
        }
        //opt check
        if(optionCheck.test($("#item_opt1").val())||optionCheck.test($("#item_opt2").val())||optionCheck.test($("#item_opt3").val())){
            console.log("error-option");
            alert("허용되지 않는 양식입니다.");
            return false;
        }
        //desc check
        if(RegExpJS.test($("#item-desc").val())||sqlProtect.test($("#item-desc").val())){
            console.log("error-desc");
            alert("허용되지 않는 양식입니다.");
            return false;
        }
        //tag check
        var tagResult = true;
        $(".item-tag > span").children("input").each(function(){
            if(tagCheck.test($(this).val())){tagResult=false; return false;}
        });

        if(!tagResult){
            console.log("error-tag");
            alert("허용되지 않는 양식입니다.");
            return false;
        }

        return true;

    }
</script>