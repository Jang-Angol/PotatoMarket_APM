<?php
    if(!isset($_SESSION["user_no"])){
        echo "<script>alert('로그인 후 등록이 가능합니다..');
        window.location.href='/login.php';</script>";
    }
?>
<div class="main_contents">
    <hr style="margin: 20px 0px 0px; border: solid 1px #D3CDC2; width: 100%;">
    <form method="post" class="register-box" name="itemRegisterForm" action="/DB/itemRegister.php" onsubmit="return registerCheck();">
        <input type="hidden" name="trade_type" value="2" />
        <div class="register-title">
            <span>
                <select class="server-select form-control" name="server">
                    <option value="">서버</option>
                    <option value="1">LT</option>
                    <option value="2">HP</option>
                    <option value="3">MD</option>
                    <option value="4">WF</option>
                </select>
            </span>
            <span><input id="item-name" name="title" type="text" class="form-control" placeholder="아이템명을 입력해주세요."></span>
        </div>
        <div class="register-info">
            <table>
                <tbody>
                    <tr>
                        <th>구매 가격</th>
                        <td class="item-price"><input id="price" name="price" type="number" class="form-control"/><span id="price-preview"></span></td>
                    </tr>
                    <tr>
                        <th>아이템 옵션</th>
                        <td class="item-opt"><span><input id="item_opt1" name="item_opt1" type="text" class="form-control" placeholder="옵션1" maxlength="8"/></span> , <span><input id="item_opt2" name="item_opt2" type="text" class="form-control" placeholder="옵션2" maxlength="8"/></span> , <span><input id="item_opt3" name="item_opt3" type="text" class="form-control" placeholder="옵션3" maxlength="8"/></span></td>
                    </tr>
                    <tr>
                        <th>설명</th>
                        <td><textarea name="item_desc" rows="5" wrap="virtual" class="form-control"/></textarea></td>
                    </tr>
                    <tr>
                        <th>검색 태그</th>
                        <td class="item-tag"><span><input type="text" class="form-control" name="item_tag1" maxlength="8"placeholder="#태그"></span><button type="button" onclick="addTag();">+</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="submit-button">
            <button type="submit">등록하기</button>
        </div>
    </form>
    <div class="back_button">
        <button onClick="history.back()">뒤로가기</button>
    </div>
</div>
<script>
    //Regular Expression
    var titleCheck = /[^a-zA-Z0-9가-힣ㄱ-ㅎㅏ-ㅣ\,\.\?\!\(\)]/;
    var optionCheck = /[^가-힣0-9]/;
    var tagCheck = /[^가-힣0-9#]/;
    var RegExpJS = /<script[^>]*>((\n|\r|.)*?)<\/script>/img;
    var sqlProtect = /[\'\"\;\\\#\=\&]/g;

    var tagCount = 1;

    function addTag(){
        if (tagCount < 4){
            var tag = document.createElement("input");
            tag.setAttribute("type","text");
            tag.setAttribute("name","item_tag"+(tagCount+1));
            tag.setAttribute("class","form-control");
            tag.setAttribute("maxlength","8");
            tag.setAttribute("style","margin-left:10px;");
            tag.setAttribute("placeholder","#태그");
            $(".item-tag > span").append(tag);
            tagCount ++;
        } else{
            alert("태그는 4개까지만 가능합니다.");
        }
    }

    function registerCheck(){
        //server check
        if($(".server-select").val()==""){
            console.log("error-server")
            return 0;
        }
        //title check
        if($("#item-name").val()==""){
            console.log("error-title-blink");
            return 0;
        } else {
            if(titleCheck.test($("#item-name").val())){
                console.log("error-title");
                return 0;
            }
        }
        //price check
        if($("#price").val()==""){
            console.log("error-price-blink");
            return 0;
        } else {
            if($("#price").val().length>11){
                return 0;
            }
        }
        //opt check
        if(optionCheck.test($("#item_opt1").val())||optionCheck.test($("#item_opt2").val())||optionCheck.test($("#item_opt3").val())){
            console.log("error-option");
            return 0;
        }
        //desc check
        if(RegExpJS.test($("#item-desc").val())||sqlProtect.test($("#item-desc").val())){
            console.log("error-desc");
            alert("허용되지 않는 양식입니다.");
        }
        //tag check
        var tagResult = true;
        $(".item-tag > span").children("input").each(function(){
            if(tagCheck.test($(this).val())){tagResult=false; return false;}
        });

        if(!tagResult){
            console.log("error-tag");
            return 0;
        }

        return 1;

    }


    //item price preview converting
    $("#price").keyup(function(){convertPrice();});

    function convertPrice(){
        var price = $("#price").val();

        if($("#price").val()==""){ $("#price-preview").html(""); return 0;}

        if(price.length>11){
            alert("가격은 최대 999억까지 가능합니다.");
        }
        if(price.length<5){

            $("#price-preview").html(price+"골드");

        } else if(5<=price.length&&price.length<9){
            //ten thousand
            var low = price.substring(price.length-4,price.length);
            var middle = price.substring(0,price.length-4);
            
            if(low=="0000"){ low = "";}

            $("#price-preview").html(middle+"만"+low+"골드");

        } else if(9<=price.length&&price.length<12){
            
            var low = price.substring(price.length-4,price.length);
            var middle = price.substring(price.length-8,price.length-4);
            var high = price.substring(0,price.length-8);

            if(low=="0000"){low = "";}
            if(middle=="0000"){middle = "";}

            if(middle==""){
                $("#price-preview").html(high+"억"+low+"골드");
            } else {
                $("#price-preview").html(high+"억"+middle+"만"+low+"골드");
            }
        }
    }

</script>