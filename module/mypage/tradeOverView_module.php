<?php
    session_start();
?>

<div class="user_trade_history_overview row">
   <div class="trade_all_overview card col-3 mx-4 py-2">
        <div class="card-header">
            <span>총 거래내역</span>
        </div>
        <div class="card-body">
            <div class="card-text trade_all">
                <span class="trade_ing">진행중</span><span class="trade_number">X건</span>
                <span class="trade_complete">거래완료</span><span class="trade_number">X건</span>
            </div>
        </div>
   </div>
   <div class="trade_sell_overview card col-3 mx-4 py-2">
        <div class="card-header">
            <span>판매내역</span>
        </div>
        <div class="card-body">
            <div class="card-text trade_sell">
                <span class="trade_ing">진행중</span><span class="trade_number">X건</span>
                <span class="trade_complete">거래완료</span><span class="trade_number">X건</span>
            </div>
        </div>
    </div>
    <div class="trade_buy_overview card col-3 mx-4 py-2">
        <div class="card-header">
            <span>구매내역</span>
        </div>
        <div class="card-body">
            <div class="card-text trade_buy">
                <span class="trade_ing">진행중</span><span class="trade_number">X건</span>
                <span class="trade_complete">거래완료</span><span class="trade_number">X건</span>
            </div>
        </div>
    </div>
</div>
<div class="user_trade_history_table">
    <table>
        <tbody>

<?php
    include "../../DB/database.php";

    $sql = "SELECT no, trade_type, trade_state, server, title, price, date FROM ITEM_TB WHERE user_no = ".$_SESSION["user_no"]." ORDER BY no DESC LIMIT 10;";
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
    
    mysqli_close($connect);
?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function(){
        countSellTrade();
        countBuyTrade();
        countAllTrade();
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

    function countAllTrade(){
        var ingCount = $(".trade_item_state_11").length + $(".trade_item_state_12").length + $(".trade_item_state_21").length + $(".trade_item_state_22").length;
        $(".trade_all > .trade_ing").next().html(ingCount+"건");
        var edCount = $(".trade_item_state_13").length + $(".trade_item_state_23").length;
        $(".trade_all > .trade_complete").next().html(edCount+"건");
    }

    function countSellTrade(){
        var ingCount = $(".trade_item_state_11").length + $(".trade_item_state_12").length;
        $(".trade_sell > .trade_ing").next().html(ingCount+"건");
        var edCount = $(".trade_item_state_13").length;
        $(".trade_sell > .trade_complete").next().html(edCount+"건");
    }

    function countBuyTrade(){
        var ingCount = $(".trade_item_state_21").length + $(".trade_item_state_22").length;
        $(".trade_buy > .trade_ing").next().html(ingCount+"건");
        var edCount = $(".trade_item_state_23").length;
        $(".trade_buy > .trade_complete").next().html(edCount+"건");
    }
</script>