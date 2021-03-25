<div class="category_bar">
    <ul>
<?php
    if(isset($_POST["apply_accept"])){
        if($_POST["apply_accept"] == 0){
            echo<<<END
        <li><a class="trade_all">전체 판매 신청 내역</a></li>
        <li class="current"><a class="trade_ing">판매 신청 중인 내역</a></li>
        <li><a class="trade_complete">판매 수락 내역</a></li>
END;
        } else if ($_POST["apply_accept"] == 1) {
            echo<<<END
        <li><a class="trade_all">전체 판매 신청 내역</a></li>
        <li><a class="trade_ing">판매 신청 중인 내역</a></li>
        <li class="current"><a class="trade_complete">판매 수락 내역</a></li>
END;
        } else {
            echo "<script>alert('Not valid access');
            window.location.href='/';</script>";
        }
    } else {
            echo<<<END
        <li class="current"><a class="trade_all">전체 판매 신청 내역</a></li>
        <li><a class="trade_ing">판매 신청 중인 내역</a></li>
        <li><a class="trade_complete">판매 수락 내역</a></li>
END;
    }
?>
        
    </ul>
</div>
<div class="user_trade_history_table">
    <table>
        <tbody>
<?php
    session_start();

    include "../../DB/database.php";

    if(!isset($_SESSION["user_no"])){
        echo "<script>alert('로그인 후 이용이 가능합니다..');
            window.location.href='/login.php';</script>";
    } else {
        if(isset($_POST["apply_accept"])){
            $sql = "SELECT TRADE_TB.no, TRADE_TB.apply_accept, TRADE_TB.apply_state, ITEM_TB.no as item_no, ITEM_TB.title, ITEM_TB.server, TRADE_TB.apply_price, TRADE_TB.date FROM TRADE_TB LEFT JOIN ITEM_TB ON TRADE_TB.item_no = ITEM_TB.no WHERE TRADE_TB.apply_user_no = $_SESSION[user_no] AND ITEM_TB.trade_type = 2 AND TRADE_TB.apply_accept = $_POST[apply_accept] ORDER BY no DESC;";
        } else {
            $sql = "SELECT TRADE_TB.no, TRADE_TB.apply_accept, TRADE_TB.apply_state, ITEM_TB.no as item_no, ITEM_TB.title, ITEM_TB.server, TRADE_TB.apply_price, TRADE_TB.date FROM TRADE_TB LEFT JOIN ITEM_TB ON TRADE_TB.item_no = ITEM_TB.no WHERE TRADE_TB.apply_user_no = $_SESSION[user_no] AND ITEM_TB.trade_type = 2 ORDER BY no DESC;";
        }
        
        $result = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_array($result)){
            echo<<<END
            <tr><td class="trade_apply_state_$row[apply_accept]$row[apply_state]"></td><td class="trade_ server server_icon_$row[server]"></td><td class="trade_title"><a href="itemBuyView.php?id=$row[item_no]">$row[title]</a></td><td class="trade_price">$row[apply_price]</td><td class="trade_time">$row[date]</td></tr>
END;
        }
    }
    mysqli_close($connect);
?>
        </tbody>
    </table>
</div>
<script>
    $(".category_bar > ul > li").click(function(){
        $(".category_bar > ul > li").removeClass("current");
        $(this).addClass("current");
    });

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

    $(".trade_all").click(function(){
        $.ajax({
            type: "post",
            url: "module/mypage/sellHistory_module.php",
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });
    $(".trade_ing").click(function(){
        var hiddenForm = document.createElement("form");
        hiddenForm.setAttribute("method", "post");
        $("<input></input>").attr({type:"hidden", name:"apply_accept", value:"0"}).appendTo(hiddenForm);
        var data = $(hiddenForm).serialize();
        $.ajax({
            type: "post",
            url: "module/mypage/sellHistory_module.php",
            data: data,
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });
    $(".trade_complete").click(function(){
        var hiddenForm = document.createElement("form");
        hiddenForm.setAttribute("method", "post");
        $("<input></input>").attr({type:"hidden", name:"apply_accept", value:"1"}).appendTo(hiddenForm);
        var data = $(hiddenForm).serialize();
        $.ajax({
            type: "post",
            url: "module/mypage/sellHistory_module.php",
            data: data,
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });
</script>