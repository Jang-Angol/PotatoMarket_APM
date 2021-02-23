<?php
    //find from DB
    if(!isset($_GET["id"])){
        echo '<script>alert("존재하지 않는 페이지 입니다.")</script>';
        echo("<script>location.href='itemSell.php';</script>");
    } else if($_GET["id"]==1){
        $trade_state = "trade_item_state_sell";
        $server = "server_icon_wolf";
        $item_name = "랑그히리스 체이서 아머(남성용)";
        $trade_user_name = "WF앙골군";
        $trade_item_date = "2021.01.27";
        $item_img = "../img/item1.png";
        $item_price = "1억5천만골드";
        $item_opt = "희미 21, 의기 20, 어퍼19";
        $item_desc = "전해 4 방보개조입니다.";
        $item_tag = "#남랑그 #랑그갑 #어퍼갑 #희미";
    } else if($_GET["id"]==2){
        $trade_state = "trade_item_state_reservation";
        $server = "server_icon_lute";
        $item_name = "라멜라 무사 신발";
        $trade_user_name = "LT앙골군";
        $trade_item_date = "2021.02.22";
        $item_img = "../img/fashion.png";
        $item_price = "6천만골드";
        $item_opt = "파힛 16 공속 7";
        $item_desc = "파힛쓸때 좋습니다. 돌깍 개 걸을 필요없이 잡습니다.";
        $item_tag = "#라멜라 #파힛신 #공속7";
    } else if($_GET["id"]==3){
        $trade_state = "trade_item_state_complete";
        $server = "server_icon_harp";
        $item_name = "랑그히리스 체이서 써클릿";
        $trade_user_name = "HP앙골군";
        $trade_item_date = "2021.02.21";
        $item_img = "../img/fashion3.jpg";
        $item_price = "1억골드";
        $item_opt = "볼조19 아마12";
        $item_desc = "망각인이 혼수상태보다 볼조는 효율 더 좋아요";
        $item_tag = "#볼조 #아마";
    } else{
        echo '<script>alert("존재하지 않는 페이지 입니다.")</script>';
        echo("<script>location.href='itemSell.php';</script>");
    }
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
                <img src="{$item_img}">
            </div>
        </div>
        <div class="trade_item_info">
            <table>
                <tbody>
                    <tr>
                        <th>판매 가격</th>
                        <td class="item-price"><span>{$item_price}</span></td>
                    </tr>
                    <tr>
                        <th>아이템 옵션</th>
                        <td class="item-opt"><span>{$item_opt}</span></td>
                    </tr>
                    <tr>
                        <th>설명</th>
                        <td><p>
                            {$item_desc}
                        </p></td>
                    </tr>
                    <tr>
                        <th>검색 태그</th>
                        <td class="item-tag"><span>{$item_tag}</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="trade_button">
            <button class="trade_apply">구매 신청</button><button id="apply_list_view_button"><span id="trade_number">2</span></button>
        </div>
END;
?>
        <?php
            include "./module/item/tradeApply_module.php";
        ?>
        <div class="trade_apply_table">
            <table>
                <tbody>
                    <tr class="trade_apply_table_header"><th>신청 상태</th><th>신청 가격</th></tr>
                    <tr><td><span>구매신청</span></td><td><span>1억5천숲</span></td></tr>
                    <tr><td><span>구매신청</span></td><td><span>1억6천숲</span></td></tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="back_button">
        <button onClick="history.back()">뒤로가기</button>
    </div>
</div>
<script>
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
</script>