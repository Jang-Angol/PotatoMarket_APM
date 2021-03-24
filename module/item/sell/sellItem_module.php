<?php
    include "DB/database.php";
?>
<div class="sell_item_contents container">

<?php
	$item_count = 8;
	$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
	$offset = ($page-1)*$item_count;

	if(!isset($_GET["server"])||empty($_GET["server"])){
        $sql = "SELECT ITEM_TB.no, ITEM_TB.trade_type, ITEM_TB.trade_state, ITEM_TB.server, ITEM_TB.title, ITEM_TB.price FROM ITEM_TB";
        $count_sql = "SELECT COUNT(*) as item_count FROM ITEM_TB";

        //FOR DETAIL SEARCH
        if(!empty($_GET["item_opt1"])||!empty($_GET["item_opt2"])||!empty($_GET["item_opt3"])){
            $sql = $sql." LEFT JOIN ITEM_OPT_TB ON ITEM_TB.no = ITEM_OPT_TB.item_no WHERE ITEM_TB.trade_type = 1";
            $count_sql = $count_sql." LEFT JOIN ITEM_OPT_TB ON ITEM_TB.no = ITEM_OPT_TB.item_no WHERE ITEM_TB.trade_type = 1";
            if(!empty($_GET["item_opt1"])){
                $sql = $sql." AND ITEM_OPT_TB.opt LIKE '%$_GET[item_opt1]%'";
                $count_sql = $count_sql." AND ITEM_OPT_TB.opt LIKE '%$_GET[item_opt1]%'";
            }
            if(!empty($_GET["item_opt2"])){
                $sql = $sql." AND ITEM_OPT_TB.opt LIKE '%$_GET[item_opt2]%'";
                $count_sql = $count_sql." AND ITEM_OPT_TB.opt LIKE '%$_GET[item_opt2]%'";
            }
            if(!empty($_GET["item_opt3"])){
                $sql = $sql." AND ITEM_OPT_TB.opt LIKE '%$_GET[item_opt2]%'";
                $count_sql = $count_sql." AND ITEM_OPT_TB.opt LIKE '%$_GET[item_opt2]%'";
            }
        } else {
            $sql = $sql." WHERE ITEM_TB.trade_type = 1";
            $count_sql = $count_sql." WHERE ITEM_TB.trade_type = 1";
        }

        if(!empty($_GET["trade_all"])||empty($_GET["title"])){

        } else {
            $sql = $sql." AND ITEM_TB.trade_state IN (0";
            $count_sql = $count_sql." AND ITEM_TB.trade_state IN (0";

            if(!empty($_GET["trade_ing"])){
                $sql = $sql.",1";
                $count_sql = $count_sql.",1";
            }
            if(!empty($_GET["trade_reservation"])){
                $sql = $sql.",2";
                $count_sql = $count_sql.",2";
            }
            if(!empty($_GET["trade_complete"])){
                $sql = $sql.",3";
                $count_sql = $count_sql.",3";
            }

            $sql = $sql.")";
            $count_sql = $count_sql.")";
        }
        if(!empty($_GET["title"])){
            //TO DO CHECK
            $sql = $sql." AND ITEM_TB.title LIKE '%$_GET[title]%'";
            $count_sql = $count_sql." AND ITEM_TB.title LIKE '%$_GET[title]%'";
        }
        if(!empty($_GET["price_low"])){
            //TO DO CHECK
            $sql = $sql." AND ITEM_TB.price > $_GET[price_low]";
            $count_sql = $count_sql." AND ITEM_TB.price > $_GET[price_low]";
        }
        if(!empty($_GET["price_high"])){
            //TO DO CHECK
            $sql = $sql." AND ITEM_TB.price < $_GET[price_high]";
            $count_sql = $count_sql." AND ITEM_TB.price < $_GET[price_high]";
        }



        $sql = $sql." ORDER BY no DESC LIMIT $offset, $item_count;";
        $count_sql = $count_sql.";";

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

        $sql = "SELECT ITEM_TB.no, ITEM_TB.trade_type, ITEM_TB.trade_state, ITEM_TB.server, ITEM_TB.title, ITEM_TB.price FROM ITEM_TB";
        $count_sql = "SELECT COUNT(*) as item_count FROM ITEM_TB";

        //FOR DETAIL SEARCH
        if(!empty($_GET["item_opt1"])||!empty($_GET["item_opt2"])||!empty($_GET["item_opt3"])){
            $sql = $sql." LEFT JOIN ITEM_OPT_TB ON ITEM_TB.no = ITEM_OPT_TB.item_no WHERE ITEM_TB.trade_type = 1 AND ITEM_TB.server = $item_server";
            $count_sql = $count_sql." LEFT JOIN ITEM_OPT_TB ON ITEM_TB.no = ITEM_OPT_TB.item_no WHERE ITEM_TB.trade_type = 1 AND ITEM_TB.server = $item_server";
            if(!empty($_GET["item_opt1"])){
                $sql = $sql." AND ITEM_OPT_TB.opt LIKE '%$_GET[item_opt1]%'";
                $count_sql = $count_sql." AND ITEM_OPT_TB.opt LIKE '%$_GET[item_opt1]%'";
            }
            if(!empty($_GET["item_opt2"])){
                $sql = $sql." AND ITEM_OPT_TB.opt LIKE '%$_GET[item_opt2]%'";
                $count_sql = $count_sql." AND ITEM_OPT_TB.opt LIKE '%$_GET[item_opt2]%'";
            }
            if(!empty($_GET["item_opt3"])){
                $sql = $sql." AND ITEM_OPT_TB.opt LIKE '%$_GET[item_opt2]%'";
                $count_sql = $count_sql." AND ITEM_OPT_TB.opt LIKE '%$_GET[item_opt2]%'";
            }
        } else {
            $sql = $sql." WHERE ITEM_TB.trade_type = 1 AND ITEM_TB.server = $item_server";
            $count_sql = $count_sql." WHERE ITEM_TB.trade_type = 1 AND ITEM_TB.server = $item_server";
        }

        if(!empty($_GET["trade_all"])||empty($_GET["title"])){

        } else {
            $sql = $sql." AND ITEM_TB.trade_state IN (0";
            $count_sql = $count_sql." AND ITEM_TB.trade_state IN (";

            if(!empty($_GET["trade_ing"])){
                $sql = $sql.",1";
                $count_sql = $count_sql.",1";
            }
            if(!empty($_GET["trade_reservation"])){
                $sql = $sql.",2";
                $count_sql = $count_sql.",2";
            }
            if(!empty($_GET["trade_complete"])){
                $sql = $sql.",3";
                $count_sql = $count_sql.",3";
            }

            $sql = $sql.")";
            $count_sql = $count_sql.")";
        }
        if(!empty($_GET["title"])){
            //TO DO CHECK
            $sql = $sql." AND ITEM_TB.title LIKE '%$_GET[title]%'";
            $count_sql = $count_sql." AND ITEM_TB.title LIKE '%$_GET[title]%'";
        }
        if(!empty($_GET["price_low"])){
            //TO DO CHECK
            $sql = $sql." AND ITEM_TB.price > $_GET[price_low]";
            $count_sql = $count_sql." AND ITEM_TB.price > $_GET[price_low]";
        }
        if(!empty($_GET["price_high"])){
            //TO DO CHECK
            $sql = $sql." AND ITEM_TB.price < $_GET[price_high]";
            $count_sql = $count_sql." AND ITEM_TB.price < $_GET[price_high]";
        }



        $sql = $sql." ORDER BY no DESC LIMIT $offset, $item_count;";
        $count_sql = $count_sql.";";
    }
	
	$count_result = mysqli_query($connect, $count_sql);
	$count_row = mysqli_fetch_array($count_result);
	$item_count = $count_row["item_count"];

	$pages = $item_count/8 + 1;

	mysqli_close($connect);

    include "./module/item/serverCategory_module.php";

    include "./module/item/sell/sellList_module.php";

?>
    <div class="contents_bottom_bar">
    	<?php
    		echo "<span class='pages'>";
    		for ($i = 1; $i < $pages; $i++){
                $url = $_SERVER["REQUEST_URI"];
                if(empty($_SERVER["QUERY_STRING"])){
                    echo "<span><a class='page' href='$url?page=$i'>$i</a></span>";
                } else {
                    if(!empty($_GET["page"])){
                        $url = substr($url, 0, -5-strlen($_GET["page"]));
                    }
                    if($url[strlen($url)-1]=='?'||$url[strlen($url)-1]=='&'){
                        echo "<span><a class='page' href='{$url}page=$i'>$i</a></span>";
                    } else {
                        echo "<span><a class='page' href='$url&page=$i'>$i</a></span>";
                    }
                }

    		}
    		echo "</span>";

    	?>
        <span><button onClick="location.href='itemSellRegister.php'">등록하기</button></span>
    </div>
    
</div>