<?php
    session_start();

    include "../../DB/database.php";

    $trade_count = 4;
    $page = isset($_POST["page"]) ? intval($_POST["page"]) : 1;
    $offset = ($page-1)*$trade_count;

    $count_sql = "SELECT COUNT(*) as trade_count FROM ITEM_TB WHERE user_no = ".$_SESSION["user_no"].";";

    $count_result = mysqli_query($connect, $count_sql);
    $count_row = mysqli_fetch_array($count_result);
    $trade_counts = $count_row["trade_count"];

    $pages = $trade_counts/4 + 1;

    //Sell count
    $sell_ing_count_sql = "SELECT COUNT(*) as sell_ing_trade_count FROM ITEM_TB WHERE user_no = ".$_SESSION["user_no"]." AND trade_type = 1 AND (trade_state = 1 OR trade_state = 2);";

    $sell_ing_count_result = mysqli_query($connect, $sell_ing_count_sql);
    $sell_ing_count_row = mysqli_fetch_array($sell_ing_count_result);
    $sell_ing_trade_counts = $sell_ing_count_row["sell_ing_trade_count"];

    $sell_ed_count_sql = "SELECT COUNT(*) as sell_ed_trade_count FROM ITEM_TB WHERE user_no = ".$_SESSION["user_no"]." AND trade_type = 1 AND trade_state = 3;";

    $sell_ed_count_result = mysqli_query($connect, $sell_ed_count_sql);
    $sell_ed_count_row = mysqli_fetch_array($sell_ed_count_result);
    $sell_ed_trade_counts = $sell_ed_count_row["sell_ed_trade_count"];
    //Buy count
    $buy_ing_count_sql = "SELECT COUNT(*) as buy_ing_trade_count FROM ITEM_TB WHERE user_no = ".$_SESSION["user_no"]." AND trade_type = 2 AND (trade_state = 1 OR trade_state = 2);";

    $buy_ing_count_result = mysqli_query($connect, $buy_ing_count_sql);
    $buy_ing_count_row = mysqli_fetch_array($buy_ing_count_result);
    $buy_ing_trade_counts = $buy_ing_count_row["buy_ing_trade_count"];

    $buy_ed_count_sql = "SELECT COUNT(*) as buy_ed_trade_count FROM ITEM_TB WHERE user_no = ".$_SESSION["user_no"]." AND trade_type = 2 AND trade_state = 3;";

    $buy_ed_count_result = mysqli_query($connect, $buy_ed_count_sql);
    $buy_ed_count_row = mysqli_fetch_array($buy_ed_count_result);
    $buy_ed_trade_counts = $buy_ed_count_row["buy_ed_trade_count"];
?>

<div class="user_trade_history_overview row">
   <div class="trade_all_overview card col-3 mx-4 py-2">
        <div class="card-header">
            <span>총 거래내역</span>
        </div>
        <div class="card-body">
            <div class="card-text trade_all">
                <span class="trade_ing">진행중</span><span class="trade_number"><?php echo $sell_ing_trade_counts + $buy_ing_trade_counts;?>건</span>
                <span class="trade_complete">거래완료</span><span class="trade_number"><?php echo $sell_ed_trade_counts + $buy_ed_trade_counts;?>건</span>
            </div>
        </div>
   </div>
   <div class="trade_sell_overview card col-3 mx-4 py-2">
        <div class="card-header">
            <span>판매내역</span>
        </div>
        <div class="card-body">
            <div class="card-text trade_sell">
                <span class="trade_ing">진행중</span><span class="trade_number"><?php echo $sell_ing_trade_counts;?>건</span>
                <span class="trade_complete">거래완료</span><span class="trade_number"><?php echo $sell_ed_trade_counts;?>건</span>
            </div>
        </div>
    </div>
    <div class="trade_buy_overview card col-3 mx-4 py-2">
        <div class="card-header">
            <span>구매내역</span>
        </div>
        <div class="card-body">
            <div class="card-text trade_buy">
                <span class="trade_ing">진행중</span><span class="trade_number"><?php echo $buy_ing_trade_counts;?>건</span>
                <span class="trade_complete">거래완료</span><span class="trade_number"><?php echo $buy_ed_trade_counts;?>건</span>
            </div>
        </div>
    </div>
</div>
<div class="user_trade_history_table">
    <table>
        <tbody>

<?php

    $sql = "SELECT no, trade_type, trade_state, server, title, price, date FROM ITEM_TB WHERE user_no = ".$_SESSION["user_no"]." ORDER BY no DESC LIMIT $offset, $trade_count;";

    $result = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_array($result)){
        switch($row["trade_type"]){
            case 1:
                $type = "Sell";
                break;
            case 2:
                $type = "Buy";
                break;
            default:
                exit;
        }
    echo<<<END
        <tr><td class="trade_state trade_item_state_$row[trade_type]$row[trade_state]"></td><td class="trade_ server server_icon_$row[server]"></td><td class="trade_title"><a href="item{$type}View.php?id=$row[no]">$row[title]</a></td><td class="trade_price">$row[price]</td><td class="trade_time">$row[date]</td></tr>
END;
        while($row = mysqli_fetch_array($result)){
            switch($row["trade_type"]){
                case 1:
                    $type = "Sell";
                    break;
                case 2:
                    $type = "Buy";
                    break;
                default:
                    exit;
            }
    echo<<<END
        <tr><td class="trade_state trade_item_state_$row[trade_type]$row[trade_state]"></td><td class="trade_ server server_icon_$row[server]"></td><td class="trade_title"><a href="item{$type}View.php?id=$row[no]">$row[title]</a></td><td class="trade_price">$row[price]</td><td class="trade_time">$row[date]</td></tr>
END;
        }
    } else {
        echo "<div class='trade_history_blink'>등록된 거래가 없습니다</div>";
    }
?>
        </tbody>
    </table>
</div>
<div class="contents_bottom_bar">
    <?php
        echo "<span class='pages'>";
        for ($i = 1; $i < $pages; $i++){
            echo "<span><a class='page' page_no='$i'>$i</a></span>";
        }
        echo "</span>";

        mysqli_close($connect);
    ?>
</div>
<script>
    $(".page").click(function(){
        var hiddenForm = document.createElement("form");
        hiddenForm.setAttribute("method", "post");
        $("<input></input>").attr({type:"hidden", name:"page", value:$(this).attr("page_no")}).appendTo(hiddenForm);
        var data = $(hiddenForm).serialize();
        $.ajax({
            type: "post",
            url: "module/mypage/tradeOverView_module.php",
            data: data,
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });    

    //item price converting
    $(".trade_price").each( function() {convertPrice(this)});

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
</script>