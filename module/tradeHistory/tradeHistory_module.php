<div class="banner">
	<img src="../img/trade.jpg"/>
</div>
<div class="main_contents">
	<div class="category_bar">
	    <ul>
	        <li class="current"><a>전체</a></li>
	        <li><a>판매중</a></li>
	        <li><a>구매중</a></li>
	        <li><a>예약중</a></li>
	        <li><a>거래완료</a></li>
	    </ul>
	</div>
	<div class="trade_history_table">
	    <table>
	        <tbody>
<?php
	include "./DB/database.php";

	$sql = "SELECT no, trade_type, trade_state, title, server, price, date FROM ITEM_TB ORDER BY no DESC LIMIT 10;";
	$result = mysqli_query($connect, $sql);
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
		<tr><td class="trade_item_state_$row[trade_type]$row[trade_state]"></td><td class="server_icon_$row[server]"></td><td class="trade_title"><a href="item{$type}View.php?id=$row[no]">$row[title]</a></td><td class="trade_price">$row[price]</td><td class="trade_time">$row[date]</td></tr>

END;
	}
	mysqli_close($connect);

?>
	        </tbody>
	    </table>
	</div>
</div>
<script>
	$(".category_bar > ul > li").click(function(){
        $(".category_bar > ul > li").removeClass("current");
        $(this).addClass("current");
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