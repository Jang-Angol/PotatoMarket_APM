<?php
    include "DB/database.php";
?>
<div class="sellItemList">
    <div class="sell_item row">
<?php
    if(!isset($sql)){
        $sql = "SELECT no, trade_type, trade_state, server, title, price FROM ITEM_TB WHERE trade_type = 1 ORDER BY no DESC LIMIT 8;";
    }
    //var_dump($sql);
    
    $result = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_array($result)){
        // GET ITEM INFO
        // GET IMG SRC
        $img_sql = "SELECT img_src FROM ITEM_IMG_TB WHERE item_no = ".$row["no"].";";
        $img_result = mysqli_query($connect, $img_sql);
        $img_row = mysqli_fetch_array($img_result);
        if($img_row){
            $img_src = $img_row["img_src"];
        } else {
            $img_src = "img/fashion3.jpg";
        }
        // GET OPT INFO
        $opt_sql = "SELECT opt FROM ITEM_OPT_TB WHERE item_no = ".$row["no"].";";
        $opt_result = mysqli_query($connect, $opt_sql);
        $opt = [] ;
        while($opt_row = mysqli_fetch_array($opt_result)){
            array_push($opt, $opt_row["opt"]);
        }

echo<<<END
        <div class="list_item card mb-3 col-4 col-lg-3">
            <a href="itemSellView.php?id=$row[no]">
                <div class="card-header">
                    <span class="trade_item_state_$row[trade_type]$row[trade_state]"></span>
                </div>
                <div class="item_name server_icon_$row[server]"><span>$row[title]</span></div>
                <div class="card_img"><img class="item_img" src="$img_src"/></div>
                <div class="card-body">
                    <div class="card-title"><span class="item_price">$row[price]</span></div>
                    <div class="card-text">
END;
                        foreach($opt as $value){
                            echo "<span class='item_opt'>".$value."</span>";
                        }
echo<<<END
                    </div>
                </div>
            </a>
        </div>
END;
        while($row = mysqli_fetch_array($result)){
            // GET IMG SRC
            $img_sql = "SELECT img_src FROM ITEM_IMG_TB WHERE item_no = ".$row["no"].";";
            $img_result = mysqli_query($connect, $img_sql);
            $img_row = mysqli_fetch_array($img_result);
            if($img_row){
                $img_src = $img_row["img_src"];
            } else {
                $img_src = "img/fashion3.jpg";
            }
            // GET OPT INFO
            $opt_sql = "SELECT opt FROM ITEM_OPT_TB WHERE item_no = ".$row["no"].";";
            $opt_result = mysqli_query($connect, $opt_sql);
            $opt = [] ;
            while($opt_row = mysqli_fetch_array($opt_result)){
                array_push($opt, $opt_row["opt"]);
            }

echo<<<END
        <div class="list_item card mb-3 col-4 col-lg-3">
            <a href="itemSellView.php?id=$row[no]">
                <div class="card-header">
                    <span class="trade_item_state_$row[trade_type]$row[trade_state]"></span>
                </div>
                <div class="item_name server_icon_$row[server]"><span>$row[title]</span></div>
                <div class="card_img"><img class="item_img" src="$img_src"/></div>
                <div class="card-body">
                    <div class="card-title"><span class="item_price">$row[price]</span></div>
                    <div class="card-text">
END;
                        foreach($opt as $value){
                            echo "<span class='item_opt'>".$value."</span>";
                        }
echo<<<END
                    </div>
                </div>
            </a>
        </div>
END;
        }
    } else {
        echo "</div><div class='item_list_blink'>등록된 아이템이 없습니다";
    }
    
    mysqli_close($connect);
    unset($sql);
?>
    </div>
</div>
<script>
    //item price converting
    $(".item_price").each( function() {convertPrice(this)});

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