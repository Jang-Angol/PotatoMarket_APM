<?php
    include "./DB/database.php";
?>
<div class="banner">
	<img src="../img/trade.jpg"/>
</div>
<div class="main_contents">
<?php
	$item_count = 8;
	$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
	$offset = ($page-1)*$item_count;

	if(!isset($_GET["trade"])){
		if(!isset($_GET["p_search"])){
			echo<<<END
			<div class="category_bar">
			    <ul>
			        <li class="trade_all current"><a href="?">전체</a></li>
			        <li class="trade_sell"><a href="?trade=1">판매중</a></li>
			        <li class="trade_buy"><a href="?trade=2">구매중</a></li>
			        <li class="trade_complete"><a href="?trade=3">거래완료</a></li>
			    </ul>
			</div>
END;
	        $sql = "SELECT no, trade_type, trade_state, title, server, price, date FROM ITEM_TB ORDER BY no DESC LIMIT $offset, $item_count;";
	        $count_sql = "SELECT COUNT(*) as item_count FROM ITEM_TB;";
	    } else {
	    	if(preg_match("/[^a-zA-Z0-9가-힣ㄱ-ㅎㅏ-ㅣ\,\.\?\!\(\)\s]/", $_GET["p_search"])){
	    		echo "<script>alert('올바르지 않은 Data 입니다.');
						history.back();</script>";
	    	} else {
			echo<<<END
			<div class="category_bar">
			    <ul>
			        <li class="trade_all current"><a href="?p_search=$_GET[p_search]">전체</a></li>
			        <li class="trade_sell"><a href="?trade=1&p_search=$_GET[p_search]">판매중</a></li>
			        <li class="trade_buy"><a href="?trade=2&p_search=$_GET[p_search]">구매중</a></li>
			        <li class="trade_complete"><a href="?trade=3&p_search=$_GET[p_search]">거래완료</a></li>
			    </ul>
			</div>
END;
	    		$sql = "SELECT no, trade_type, trade_state, server, title, price, date FROM ITEM_TB WHERE title LIKE '%$_GET[p_search]%' ORDER BY no DESC LIMIT $offset, $item_count;";
	        	$count_sql = "SELECT COUNT(*) as item_count FROM ITEM_TB WHERE title LIKE '%$_GET[p_search]%';";
	    	}        
	    }
	} else {
		if(!isset($_GET["p_search"])){
			echo<<<END
			<div class="category_bar">
			    <ul>
			        <li class="trade_all current"><a href="?">전체</a></li>
			        <li class="trade_sell"><a href="?trade=1">판매중</a></li>
			        <li class="trade_buy"><a href="?trade=2">구매중</a></li>
			        <li class="trade_complete"><a href="?trade=3">거래완료</a></li>
			    </ul>
			</div>
END;
			if($_GET["trade"] == 1){
		        $sql = "SELECT no, trade_type, trade_state, title, server, price, date FROM ITEM_TB WHERE trade_type = 1 ORDER BY no DESC LIMIT $offset, $item_count;";
		        $count_sql = "SELECT COUNT(*) as item_count FROM ITEM_TB WHERE trade_type = 1;";
			} else if($_GET["trade"] ==2){
		        $sql = "SELECT no, trade_type, trade_state, title, server, price, date FROM ITEM_TB WHERE trade_type = 2 ORDER BY no DESC LIMIT $offset, $item_count;";
		        $count_sql = "SELECT COUNT(*) as item_count FROM ITEM_TB WHERE trade_type = 2;";
			} else if($_GET["trade"] ==3){
		        $sql = "SELECT no, trade_type, trade_state, title, server, price, date FROM ITEM_TB WHERE trade_state = 3 ORDER BY no DESC LIMIT $offset, $item_count;";
		        $count_sql = "SELECT COUNT(*) as item_count FROM ITEM_TB WHERE trade_state = 3;";
			} else {
	        	echo "<script>alert('Not valid value');</script>";
	            echo "<script>location.href='/';</script>";
			}
	    } else {
	    	if(preg_match("/[^a-zA-Z0-9가-힣ㄱ-ㅎㅏ-ㅣ\,\.\?\!\(\)\s]/", $_GET["p_search"])){
	    		echo "<script>alert('올바르지 않은 Data 입니다.');
						history.back();</script>";
	    	} else {
				echo<<<END
				<div class="category_bar">
				    <ul>
				        <li class="trade_all current"><a href="?p_search=$_GET[p_search]">전체</a></li>
				        <li class="trade_sell"><a href="?trade=1&p_search=$_GET[p_search]">판매중</a></li>
				        <li class="trade_buy"><a href="?trade=2&p_search=$_GET[p_search]">구매중</a></li>
				        <li class="trade_complete"><a href="?trade=3&p_search=$_GET[p_search]">거래완료</a></li>
				    </ul>
				</div>
END;
				if($_GET["trade"] == 1){
		    		$sql = "SELECT no, trade_type, trade_state, server, title, price, date FROM ITEM_TB WHERE title LIKE '%$_GET[p_search]%' AND trade_type = 1 ORDER BY no DESC LIMIT $offset, $item_count;";
		        	$count_sql = "SELECT COUNT(*) as item_count FROM ITEM_TB WHERE title LIKE '%$_GET[p_search]%' AND trade_type = 1;";
				} else if($_GET["trade"] ==2){
		    		$sql = "SELECT no, trade_type, trade_state, server, title, price, date FROM ITEM_TB WHERE title LIKE '%$_GET[p_search]%' AND trade_type = 2 ORDER BY no DESC LIMIT $offset, $item_count;";
		        	$count_sql = "SELECT COUNT(*) as item_count FROM ITEM_TB WHERE title LIKE '%$_GET[p_search]%' AND trade_type = 2;";
				} else if($_GET["trade"] ==3){
		    		$sql = "SELECT no, trade_type, trade_state, server, title, price, date FROM ITEM_TB WHERE title LIKE '%$_GET[p_search]%' AND trade_state = 3 ORDER BY no DESC LIMIT $offset, $item_count;";
		        	$count_sql = "SELECT COUNT(*) as item_count FROM ITEM_TB WHERE title LIKE '%$_GET[p_search]%' AND trade_state = 3;";
				} else {
		        	echo "<script>alert('Not valid value');</script>";
		            echo "<script>location.href='/';</script>";			
				}

	    	}        
	    }
	}


	$count_result = mysqli_query($connect, $count_sql);
	$count_row = mysqli_fetch_array($count_result);
	$item_count = $count_row["item_count"];

	$pages = $item_count/8 + 1;

	include "./module/tradeHistory/tradeHistoryTable_module.php";
?>
	<div class="contents_bottom_bar">
    	<?php
    		echo "<span class='pages'>";
    		for ($i = 1; $i < $pages; $i++){
    			if(isset($_GET["trade"])){
					if(isset($_GET["p_search"])){
	    				echo "<span><a class='page' href='tradeHistory.php?trade=$_GET[trade]&p_search=$_GET[p_search]&page=$i'>$i</a></span>";
	    			} else {
	    				echo "<span><a class='page' href='tradeHistory.php?trade=$_GET[trade]&page=$i'>$i</a></span>";
	    			}
    			} else {
					if(isset($_GET["p_search"])){
	    				echo "<span><a class='page' href='tradeHistory.php?p_search=$_GET[p_search]&page=$i'>$i</a></span>";
	    			} else {
	    				echo "<span><a class='page' href='tradeHistory.php?page=$i'>$i</a></span>";
	    			}
    			}
    			
    		}
    		echo "</span>";

    	?>
    </div>
</div>
<script>
	$(".category_bar > ul > li > a").click(function(){
        $(".category_bar > ul > li").removeClass("current");
        $(this).parents().addClass("current");
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
<?php
	if(isset($_GET["trade"])){
        if($_GET["trade"] == "1"){
            echo"<script>$('.trade_sell > a').trigger('click');</script>";
        } else if($_GET["trade"] == "2"){
            echo"<script>$('.trade_buy > a').trigger('click');</script>";
        } else if($_GET["trade"] == "3"){
            echo"<script>$('.trade_complete > a').trigger('click');</script>";
        }
    }
?>