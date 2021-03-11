<?php
	include "../../DB/database.php";

	session_start();

	$trade_sql = "SELECT * FROM TRADE_TB WHERE item_no = $_POST[item_no];";
	$trade_result = mysqli_query($connect, $trade_sql);

	if((isset($_SESSION["user_no"]))&&($_SESSION["user_no"] == $_POST["user_no"])){
	echo<<<END
		<table>
	        <tbody>
	            <tr class="trade_apply_table_header"><th>신청자</th><th>신청 상태</th><th>신청 가격</th><th>신청수락</th></tr>
END;
		while($trade_row=mysqli_fetch_array($trade_result)){
			if($trade_row["apply_accept"] == 1){
				if($trade_row["apply_state"] == 3){
					$trade_state = "예약수락<br>(".$trade_row["reservation_date"].")";
				} else {
					$trade_state = "거래수락";
				}
			} else {
				if($trade_row["apply_state"] == 2){
					$trade_state = "판매신청";
				} else if($trade_row["apply_state"] == 1){
					$trade_state = "구매신청";
				} else if($trade_row["apply_state"] == 3){
					$trade_state = "예약신청<br>(".$trade_row["reservation_date"].")";
				}
			}
			$trade_user_sql = "SELECT server, user_name FROM USER_TB WHERE no = $trade_row[apply_user_no];";
			$trade_user_result = mysqli_query($connect, $trade_user_sql);
			$trade_user_row = mysqli_fetch_array($trade_user_result);
			switch($trade_user_row["server"]){
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
			echo"<tr id='$trade_row[no]'><td><span>$user_server$trade_user_row[user_name]</span></td>
			<td><span>$trade_state</span></td>
			<td><span class='apply-price'>$trade_row[apply_price]</span>
				<a class='hidden_price' style='display:none;'>$trade_row[apply_price]</a>
			</td>
			";
			if($trade_row["apply_accept"] != 1){
				echo"<td><span><a class='apply-accept'>수락하기</a></span></td></tr>";
			} else {
				echo"<td><span><a class='apply-cancle'>수락취소</a></span></td></tr>";
			}
			
		}
		echo<<<END
	        </tbody>
	    </table>
END;
	} else {
	echo<<<END
		<table>
	        <tbody>
	            <tr class="trade_apply_table_header"><th>신청 상태</th><th>신청 가격</th></tr>
END;
		while($trade_row=mysqli_fetch_array($trade_result)){
			if($trade_row["apply_accept"] == 1){
				if($trade_row["apply_state"] == 3){
					$trade_state = "예약수락<br>(".$trade_row["reservation_date"].")";
				} else {
					$trade_state = "거래수락";
				}
			} else {
				if($trade_row["apply_state"] == 2){
					$trade_state = "판매신청";
				} else if($trade_row["apply_state"] == 1){
					$trade_state = "구매신청";
				} else if($trade_row["apply_state"] == 3){
					$trade_state = "예약신청<br>(".$trade_row["reservation_date"].")";
				}
			}
			if(isset($_SESSION["user_no"])&&($_SESSION["user_no"]==$trade_row["apply_user_no"])){
				$trade_state = $trade_state." <a sclass='apply-delete'>(X)</a>";
			}
			echo"<tr id='$trade_row[no]'><td><span>$trade_state</span></td>
			<td><span class='apply-price'>$trade_row[apply_price]</span>
			</td></tr>";
		}
		echo<<<END
		        </tbody>
		    </table>
END;		
	}
	mysqli_close($connect);
?>
<script>
	//APPLY ACCEPT
    $(".apply-accept").click(function(){
        let trade_no = $(this).parents().parents().parents().attr("id");
        
        let tradeNo = document.createElement('input');
        tradeNo.setAttribute("type", "hidden");
        tradeNo.setAttribute("name", "trade_no");
        tradeNo.setAttribute("value", trade_no);

        $('#itemDataForm').append(tradeNo);

        let data = $('#itemDataForm').serialize();

        $.ajax({
            type: "post",
            url: "DB/tradeAccept.php",
            data: data,
            success : function connect(data){
                loadTradeTable();
                $('input[name="trade_no"]').remove();
            },
            error : function error(e){
                alert("error");
                console.log(e);
            }
        });
    });

    //APPLY ACCEPT
    $(".apply-cancle").click(function(){
        let trade_no = $(this).parents().parents().parents().attr("id");
        
        let tradeNo = document.createElement('input');
        tradeNo.setAttribute("type", "hidden");
        tradeNo.setAttribute("name", "trade_no");
        tradeNo.setAttribute("value", trade_no);

        $('#itemDataForm').append(tradeNo);

        let data = $('#itemDataForm').serialize();

        $.ajax({
            type: "post",
            url: "DB/tradeCancle.php",
            data: data,
            success : function connect(data){
                loadTradeTable();
                $('input[name="trade_no"]').remove();
            },
            error : function error(e){
                alert("error");
                console.log(e);
            }
        });
    });

    //APPLY DELETE
    $(".apply-delete").click(function(){
        let trade_no = $(this).parents().parents().parents().attr("id");
        
        let tradeNo = document.createElement('input');
        tradeNo.setAttribute("type", "hidden");
        tradeNo.setAttribute("name", "trade_no");
        tradeNo.setAttribute("value", trade_no);

        $('#itemDataForm').append(tradeNo);

        let data = $('#itemDataForm').serialize();

        $.ajax({
            type: "post",
            url: "DB/tradeApplyCancle.php",
            data: data,
            success : function connect(data){
                loadTradeTable();
                $('input[name="trade_no"]').remove();
                console.log(data);
            },
            error : function error(e){
                alert("error");
                console.log(e);
            }
        });
    });

	$(".apply-price").each( function() {convertPrice(this)});

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