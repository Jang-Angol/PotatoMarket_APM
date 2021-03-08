<?php
    include "DB/database.php";
?>
<div class="sell_item_contents container">

<?php
	$item_count = 8;
	$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
	$offset = ($page-1)*$item_count;

	if(!isset($_GET["server"])){
        $sql = "SELECT no, user_no, trade_type, trade_state, server, title, price, date FROM ITEM_TB WHERE trade_type = 2 ORDER BY no DESC LIMIT $offset, $item_count;";
        $count_sql = "SELECT COUNT(*) as item_count FROM ITEM_TB WHERE trade_type = 2;";
    } else {
        if ($_GET["server"] == "lute"){
        	$item_server = 1;
        } else if ($_GET["server"] == "harp"){
        	$item_server = 2;
        } else if ($_GET["server"] == "mandoline"){
        	$item_server = 3;
        } else if ($_GET["server"] == "wolf"){
        	$item_server = 4;
        } else {
        	echo "<script>alert('Not valid value');</script>";
            echo "<script>location.href='/';</script>";
	    }

        $sql = "SELECT no, user_no, trade_type, trade_state, server, title, price, date FROM ITEM_TB WHERE trade_type = 2 AND server = $item_server ORDER BY no DESC LIMIT $offset, $item_count;";
        $count_sql = "SELECT COUNT(*) as item_count FROM ITEM_TB WHERE trade_type = 2 AND server= $item_server;";
    }
	
	$count_result = mysqli_query($connect, $count_sql);
	$count_row = mysqli_fetch_array($count_result);
	$item_count = $count_row["item_count"];

	$pages = $item_count/8 + 1;

	mysqli_close($connect);

    include "./module/item/serverCategory_module.php";

    include "./module/item/buy/buyList_module.php";

?>
    <div class="contents_bottom_bar">
        <?php
            echo "<span class='pages'>";
            for ($i = 1; $i < $pages; $i++){
                if(isset($_GET["server"])){
                    echo "<span><a class='page' href='itemBuy.php?server=$_GET[server]&page=$i'>$i</a></span>";
                } else {
                    echo "<span><a class='page' href='itemBuy.php?page=$i'>$i</a></span>";
                }
            }
            echo "</span>";

        ?>
        <span><button onClick="location.href='itemBuyRegister.php'">등록하기</button></span>
    </div>
    
</div>