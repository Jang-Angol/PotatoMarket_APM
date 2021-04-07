<div class="modal">
    <div class="trade_apply_layer">
        <form id="tradeApplyForm" name="tradeApplyForm" method="post">
            <?php
                echo "<input type='hidden' name='apply_state' value='$row[trade_type]'>";
                echo "<input type='hidden' name='item_no' value='$_GET[id]'>";
                if(isset($_SESSION["user_no"])){
                    echo "<input type='hidden' name='apply_user_no' value='$_SESSION[user_no]'>";
                }
            ?>
            <div class="mb-2">
                <label for="apply_price">신청가격</label><input type="number" id="apply_price" name="apply_price"/>
                <div id="price-preview"></div>
            </div>
            <div class="mb-2">
                <input type="checkbox" id="apply_reservation" name="reservationChk"/><label for="apply_reservation">예약</label>
                <input type="date" name="reservation_date" class="reservation_date" max="9999-12-31"/>
            </div>
            <div>
                <button id="apply" type="button">신청</button><button class="close_modal" type="button">닫기</button>
            </div>
        </form>
    </div>
    <div class="modal_layer"></div>
</div>
<script>
    $(".close_modal").click(function(){
        $(".modal").attr("style","display:none;");
    });

    $("#apply").click(function(){
        var data = $('#tradeApplyForm').serialize();

        console.log(data);

        $.ajax({
            type: "post",
            url: "DB/tradeApply.php",
            data: data,
            success : function connect(data){
                $(".modal").attr("style","display:none;");
                loadTradeTable();
                
            },
            error : function error(e){
                alert("error");
                console.log(e);
            }
        });
    })
    
    //item price preview converting
    $("#apply_price").keyup(function(){convertApplyPrice();});

    function convertApplyPrice(){
        var apply_price = $("#apply_price").val();

        if($("#apply_price").val()==""){ $("#price-preview").html(""); return 0;}
        if($("#apply_price").val().indexOf(0) == 0){
            console.log("not valid price");
            alert("0으로 시작하는 가격은 입력할 수 없습니다.");
            $("#apply_price").val('');
            return false;
        }

        if(apply_price.length>11){
            alert("가격은 최대 999억까지 가능합니다.");
            $("#apply_price").val('');
            $("#price-preview").empty();
        }
        if(apply_price.length<5){

            $("#price-preview").html(apply_price+"골드");

        } else if(5<=apply_price.length&&apply_price.length<9){
            //ten thousand
            var low = apply_price.substring(apply_price.length-4,apply_price.length);
            var middle = apply_price.substring(0,apply_price.length-4);
            
            if(low=="0000"){ low = "";}

            $("#price-preview").html(middle+"만"+low+"골드");

        } else if(9<=apply_price.length&&apply_price.length<12){
            
            var low = apply_price.substring(apply_price.length-4,apply_price.length);
            var middle = apply_price.substring(apply_price.length-8,apply_price.length-4);
            var high = apply_price.substring(0,apply_price.length-8);

            if(low=="0000"){low = "";}
            if(middle=="0000"){middle = "";}

            if(middle==""){
                $("#price-preview").html(high+"억"+low+"골드");
            } else {
                $("#price-preview").html(high+"억"+middle+"만"+low+"골드");
            }
        }
        
    }
</script>