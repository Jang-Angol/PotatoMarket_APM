<div class="modal">
    <div class="trade_apply_layer">
        <form>
            <div class="mb-2">
                <label for="apply_price">신청가격</label><input type="number" id="apply_price"/>
                <div id="price-preview"></div>
            </div>
            <div class="mb-2">
                <input type="checkbox" id="apply_reservation"/><label for="apply_reservation">예약</label>
                <input type="date" class="reservation_date" max="9999-12-31"/>
            </div>
            <div>
                <button id="apply">신청</button><button class="close_modal" type="button">닫기</button>
            </div>
        </form>
    </div>
    <div class="modal_layer"></div>
</div>
<script>
    //item price preview converting
    $("#apply_price").keydown(function(){convertPrice();});

    function convertPrice(){
        var price = $("#apply_price").val();

        if($("#apply_price").val()==""){ $("#price-preview").html(""); return 0;}

        if(price.length>11){
            alert("가격은 최대 999억까지 가능합니다.");
        }
        if(price.length<5){

            $("#price-preview").html(price+"골드");

        } else if(5<=price.length&&price.length<9){
            //ten thousand
            var low = price.substring(price.length-4,price.length);
            var middle = price.substring(0,price.length-4);
            
            if(low=="0000"){ low = "";}

            $("#price-preview").html(middle+"만"+low+"골드");

        } else if(9<=price.length&&price.length<12){
            
            var low = price.substring(price.length-4,price.length);
            var middle = price.substring(price.length-8,price.length-4);
            var high = price.substring(0,price.length-8);

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