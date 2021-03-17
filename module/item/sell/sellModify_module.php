<?php
    include "./DB/database.php";

    if((!isset($_SESSION["user_no"]))||(!isset($_POST["item_no"]))){
        echo "<script>alert('올바르지 않은 접근입니다.');
        window.location.href='/';</script>";
    } else {
        $sql = "SELECT * FROM ITEM_TB WHERE no = $_POST[item_no];";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        if($row){
            if($_SESSION["user_no"]!=$row["user_no"]){
                echo "<script>alert('올바르지 않은 접근입니다.');
                window.location.href='/';</script>";
            }
            //LOAD ITEM_INFO
            $server = $row["server"];
            $title = $row["title"];
            $price = $row["price"];
            $desc = $row["item_desc"];
            //LOAD ITEM 0PTION
            $opt = array();
            $opt_sql = "SELECT opt FROM ITEM_OPT_TB WHERE item_no = $row[no];";
            $opt_result = mysqli_query($connect, $opt_sql);
            while($opt_row = mysqli_fetch_array($opt_result)){
                array_push($opt, $opt_row["opt"]);
            }
            //LOAD ITEM TAG
            $tag = array();
            $tag_sql = "SELECT item_tag FROM ITEM_TAG_TB WHERE item_no = $row[no];";
            $tag_result = mysqli_query($connect, $tag_sql);
            while($tag_row = mysqli_fetch_array($tag_result)){
                array_push($tag, $tag_row["item_tag"]);
            }
            //LOAD ITEM IMG
            $img = array();
            $img_sql = "SELECT no, img_src FROM ITEM_IMG_TB WHERE item_no = $row[no];";
            $img_result = mysqli_query($connect, $img_sql);
            
            echo<<<END
<div class="main_contents">
    <hr style="margin: 20px 0px 0px; border: solid 1px #D3CDC2; width: 100%;">
    <form enctype="multipart/form-data" method="post" class="register-box" name="itemModifyForm" action="/DB/itemModify.php" onSubmit="return registerCheck();">
        <input type="hidden" name="trade_type" value="1"/>
        <input type="hidden" name="item_no" value="$_POST[item_no]"/>
        <div class="register-title">
            <span>
                <select class="server-select form-control" name="server" data-server=$server>
                    <option value="">서버</option>
                    <option value="1">LT</option>
                    <option value="2">HP</option>
                    <option value="3">MD</option>
                    <option value="4">WF</option>
                </select>
            </span>
            <span><input id="item-name" name="title" type="text" class="form-control" placeholder="아이템명을 입력해주세요.(30자 이내)" maxlength="30" value="$title" /></span>
        </div>
        <div class="register-img">
            <div class="preview">
END;
        while($row = mysqli_fetch_array($img_result)){
            echo "<div class='saved_img'><img img_id='$row[no]' class='prev_img' src='$row[img_src]'/><button class='img_delete' type='button'>X</button></div>";
        }
echo<<<END
            </div>
            <input type="file" id="item_img" name="item_img[]" accept="image/*" multiple onchange="setPreviewImage(event);"/>
        </div>
        <div class="register-info">
            <table>
                <tbody>
                    <tr>
                        <th>판매 가격</th>
                        <td class="item-price"><input id="price" name="price" type="number" class="form-control" placeholder="골드" value="$price"/><span id="price-preview"></span></td>
                    </tr>
                    <tr>
                        <th>아이템 옵션</th>
                        <td class="item-opt">
END;
                        for($i = 1; $i < 4 ; $i++){
                            if(isset($opt[$i-1])){
                                echo'<span><input id="item_opt'.$i.'" name="item_opt'.$i.'" type="text" class="form-control" placeholder="옵션'.$i.'" maxlength="8" value="'.$opt[$i-1].'"/></span> ';
                            } else {
                                echo'<span><input id="item_opt'.$i.'" name="item_opt'.$i.'" type="text" class="form-control" placeholder="옵션'.$i.'" maxlength="8"/></span> ';
                            }
                            
                        }
echo<<<END
                            
                        </td>
                    </tr>
                    <tr>
                        <th>설명</th>
                        <td><textarea id="item-desc" name="item_desc" rows="5" wrap="virtual" class="form-control" maxlength="255">$desc</textarea></td>
                    </tr>
                    <tr>
                        <th>검색 태그</th>
                        <td class="item-tag">
END;                    
                        if(count($tag) == 0){
                            echo '<span><input type="text" class="form-control" name="item_tag1" maxlength="8"placeholder="#태그"></span>';
                        }
                        foreach($tag as $key => $value){
                            echo '<span><input type="text" class="form-control" name="item_tag'.$key.'" maxlength="8"placeholder="#태그" value="'.$value.'"></span>';
                        }
echo<<<END
                            <button type="button" onclick="addTag();">+</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="submit-button">
            <button type="submit" >변경하기</button>
        </div>
    </form>
    <div class="back_button">
        <button onClick="history.back()">뒤로가기</button>
    </div>
</div>
END;

        } else {
            echo "<script>alert('올바르지 않은 접근입니다.');
            window.location.href='/login.php';</script>";
        }
    }
    


?>
<script>
    $(document).ready(function () {
      var server_select = $('.server-select').attr("data-server");
      $('.server-select > option[value=' + server_select + ']').attr('selected', 'selected');
    });
    //Regular Expression
    var titleCheck = /[^a-zA-Z0-9가-힣ㄱ-ㅎㅏ-ㅣ\,\.\?\!\(\)\s]/;
    var optionCheck = /[^가-힣0-9]/;
    var tagCheck = /[^가-힣0-9\#]/;
    var RegExpJS = /<script[^>]*>((\n|\r|.)*?)<\/script>/img;
    var sqlProtect = /[\'\"\;\\\#\=\&]/g;
    var imgCheck = /((\.jpg)|(\.jpeg)|(\.gif)|(\.jfif)|(\.png)|(\.bmp)|(\.heif)|(\.bpg)|(\.svg))+/im;
    var fileNameCheck = /((\.php)|(\%)|(\.asp)|(\.jsp)|(\.\.)|(\/)|(\\)|(\?)|(\&))+/img;

    var tagCount = 1;
    var delCount = 0;

    function setPreviewImage(event){

        $(".preview").children(".preview_img").remove();

        //file number check
        var maxfile = 4;
        var fileNumber = $("#item_img")[0].files.length + $(".prev_img").length;
        console.log(fileNumber);
        if(fileNumber>=maxfile){
            alert("error-file-number: file number is must lower than 4");
            $("#item_img").val(null);
            return 0;
        }

        for (var i = 0; i < $("#item_img")[0].files.length; i++){
            var reader = new FileReader();
            //file size check
            var maxSize = 5*1024*1000;//5MB
            var fileSize = $("#item_img")[0].files[i].size;
            if(fileSize>maxSize){
                alert("error-file-size: file size is must lower than 5MB");
                $("#item_img").val(null);
                $(".preview").children(".preview_img").remove();
                return 0;
            }

            //file name check
            var fileName = $("#item_img")[0].files[i].name;
            if(fileNameCheck.test(fileName)||RegExpJS.test(fileName)||(!imgCheck.test(fileName))){
                    alert("Filename is not allowed.");
                    $("#item_img").val(null);
                    $(".preview").children(".preview_img").remove();
                    return 0;
            }
            reader.onload = function(event) {
                    var img = document.createElement("img");
                    img.setAttribute("class", "preview_img");
                    img.setAttribute("src", event.target.result);
                    $(".preview").append(img);
            };

            reader.readAsDataURL(event.target.files[i]);
        }
    }
    $(".img_delete").click(function(){
        deleteImg(this);
    })

    function deleteImg(obj){
        var delBox = document.createElement("input");
        delBox.setAttribute("type", "hidden");
        delBox.setAttribute("name","del_img[]");
        delBox.setAttribute("value", $(obj).prev().attr("img_id"));
        $(".register-box").append(delBox);

        $(obj).parents(".saved_img").remove();
    }

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


    //item price preview converting
    $("#price").keyup(function(){convertPrice();});

    function convertPrice(){
        var price = $("#price").val();

        if($("#price").val()==""){ $("#price-preview").html(""); return 0;}
        if($("#price").val().indexOf(0) == 0){
            console.log("not valid price");
            alert("0으로 시작하는 가격은 입력할 수 없습니다.");
            return false;
        }

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