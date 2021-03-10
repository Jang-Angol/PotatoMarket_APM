<?php
    include "./DB/database.php";

    if(!isset($_GET["id"])){
        echo '<script>alert("존재하지 않는 페이지 입니다.")</script>';
        echo("<script>location.href='itemSell.php';</script>");
    }

    // READ ITEM INFO
    $sql = "SELECT * FROM ITEM_TB WHERE no = ".$_GET["id"].";";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    if(!$row){
        echo '<script>alert("존재하지 않는 페이지 입니다.")</script>';
        echo("<script>location.href='itemSell.php';</script>");
    } else {
        if($row["trade_type"]!=1){
            echo("<script>location.href='itemBuyView.php?id=$_GET[id]';</script>");
        }
    }
    
    $trade_state = "trade_item_state_".$row["trade_type"].$row["trade_state"];
    $server = "server_icon_".$row["server"];
    $item_name = $row["title"];
    $item_desc = $row["item_desc"];
    $item_price = $row["price"];
    $trade_item_date = $row["date"];

    //GET TRADE COUNT
    $trade_result = mysqli_query($connect, "SELECT COUNT(*) as trade_count FROM TRADE_TB WHERE item_no = $row[no];");
    $trade_row = mysqli_fetch_array($trade_result);
    $trade_count = $trade_row["trade_count"];

    //READ USER INFO
    $user_sql = "SELECT user_name, server FROM USER_TB WHERE no = ".$row["user_no"].";";
    $user_result = mysqli_query($connect, $user_sql);
    $user_row = mysqli_fetch_array($user_result);
    //CONVERTING USER server
    switch($user_row["server"]){
            case 0:
                $user_server = "DEV";
                break;
            case 1: 
                $user_server = "LT";
                break;
            case 2:
                $user_server = "HP";
                break;
            case 3:
                $user_server = "MD";
                break;
            case 4:
                $user_server = "WF";
                break;
            default:
                echo "Not valid value";
                exit;
    }
    $trade_user_name = $user_server.$user_row["user_name"];

    //READ IMG
    $img_sql = "SELECT img_src FROM ITEM_IMG_TB WHERE item_no = ".$row["no"].";";
    $img_result = mysqli_query($connect, $img_sql);
    //READ OPT
    $opt_sql = "SELECT opt FROM ITEM_OPT_TB WHERE item_no = ".$row["no"].";";
    $opt_result = mysqli_query($connect, $opt_sql);
    //READ TAG
    $tag_sql = "SELECT item_tag FROM ITEM_TAG_TB WHERE item_no = ".$row["no"].";";
    $tag_result = mysqli_query($connect, $tag_sql);

    //FORM FOR TRADE TABLE
    echo<<<END
        <form id="itemDataForm" name="itemDataForm" method="post">
            <input type="hidden" name="item_no" value="$_GET[id]"/>
            <input type="hidden" name="user_no" value="$row[user_no]"/>
        </form>
END;    
?>
<div class="main_contents">
    <hr style="margin: 20px 0px 0px; border: solid 1px #495464; width: 100%;">
<?php
        echo <<<END
            <div class="trade_item_title">
            <span class="trade_state {$trade_state}"></span>
            <span class="trade_server {$server}"></span>
            <span class="item_name">{$item_name}</span>
            <span class="trade_user_name">{$trade_user_name}</span>
            <span class="trade_item_date">{$trade_item_date}</span>
        </div>
        <div class="trade_item_img">
            <div class="img-box">
END;
        while($img_row = mysqli_fetch_array($img_result)){
            echo "<img src = '$img_row[img_src]'/><br>";
        }
        echo<<<END
            </div>
        </div>
        <div class="trade_item_info">
            <table>
                <tbody>
                    <tr>
                        <th>판매 가격</th>
                        <td class="item-price"><span>{$item_price}</span>
                            <a id="price" style='display:none;'>{$item_price}</a>
                        </td>
                    </tr>
                    <tr>
                        <th>아이템 옵션</th>
                        <td class="item-opt">
END;
        while($opt_row = mysqli_fetch_array($opt_result)){
            echo "<span>$opt_row[opt]</span>";
        }
                        
        echo<<<END
                        </td>
                    </tr>
                    <tr>
                        <th>설명</th>
                        <td><p>
                            {$item_desc}
                        </p></td>
                    </tr>
                    <tr>
                        <th>검색 태그</th>
                        <td class="item-tag">
END;
        while($tag_row = mysqli_fetch_array($tag_result)){
            echo "<span>$tag_row[item_tag]</span>";
        }
                        
        echo<<<END
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="trade_button">
END;
        if(isset($_SESSION["user_no"])&&($_SESSION["user_no"]==$row["user_no"])){
            echo '<button class="trade_complete">거래완료</button>';
        }
        else {
            echo '<button class="trade_apply">구매 신청</button>';
        }
        echo<<<END
            <button id="apply_list_view_button"><span id="trade_number">{$trade_count}</span></button>
        </div>
END;
?>
        <?php
            include "./module/item/tradeApply_module.php";
        ?>
        <div class="trade_apply_table"></div>

    </div>
    <div class="back_button">
        <button onClick="history.back()">뒤로가기</button>
    </div>
</div>
<script>
    $(document).ready(function(){
        loadTradeTable();
    });
    $(".trade_apply").click(function(){
        $(".modal").attr("style","display:block;");
    });
    $("#apply_list_view_button").click(function(){
        if($(".trade_apply_table").css("display")=="none"){
            $(".trade_apply_table").attr("style","display:block;");
        } else{
            $(".trade_apply_table").attr("style","display:none;");
        }
    });
    //item price preview converting
    $(".item-price > span").each( function() {convertPrice(this)});

    function convertPrice(obj){
        var price = $(obj).html();

        if($(obj).html()==""){ $(obj).html(""); return 0;}

        if(price.length>11){
            alert("가격은 최대 999억까지 가능합니다.");
        }
        if(price.length<5){

            $(obj).html(price+"골드");

        } else if(5<=price.length&&price.length<9){
            //ten thousand
            var low = price.substring(price.length-4,price.length);
            var middle = price.substring(0,price.length-4);
            
            if(low=="0000"){ low = "";}

            $(obj).html(middle+"만"+low+"골드");

        } else if(9<=price.length&&price.length<12){
            
            var low = price.substring(price.length-4,price.length);
            var middle = price.substring(price.length-8,price.length-4);
            var high = price.substring(0,price.length-8);

            if(low=="0000"){low = "";}
            if(middle=="0000"){middle = "";}

            if(middle==""){
                $(obj).html(high+"억"+low+"골드");
            } else {
                $(obj).html(high+"억"+middle+"만"+low+"골드");
            }
        }
    }

    function loadTradeTable(){
        var data = $("#itemDataForm").serialize();

        $.ajax({
            type: "post",
            url: "module/item/tradeTable_module.php",
            data: data,
            success : function connect(a){

                $(".trade_apply_table").html(a); 

            },
            error : function error(){alert("error");}
        });
    }
</script>