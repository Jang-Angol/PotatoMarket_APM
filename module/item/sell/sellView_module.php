<div class="main_contents">
    <hr style="margin: 20px 0px 0px; border: solid 1px #495464; width: 100%;">
    <div class="trade_item_view">
        <div class="trade_item_title">
            <span class="trade_state trade_item_state_sell"></span>
            <span class="trade_server server_icon_wolf"></span>
            <span class="item_name">랑그히리스 체이서 아머(남성용)</span>
            <span class="trade_user_name">WF앙골군</span>
            <span class="trade_item_date">2021.01.27</span>
        </div>
        <div class="trade_item_img">
            <div class="img-box">
                <img src="../img/item1.png">
            </div>
        </div>
        <div class="trade_item_info">
            <table>
                <tbody>
                    <tr>
                        <th>판매 가격</th>
                        <td class="item-price"><span>1억5천만골드</span></td>
                    </tr>
                    <tr>
                        <th>아이템 옵션</th>
                        <td class="item-opt"><span>희미 21, 의기 20, 어퍼19</span></td>
                    </tr>
                    <tr>
                        <th>설명</th>
                        <td><p>
                            전해 4회 남았고 방보 개조했습니다.
                        </p></td>
                    </tr>
                    <tr>
                        <th>검색 태그</th>
                        <td class="item-tag"><span>#남랑그 #랑그갑 #어퍼갑 #희미 #의기</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="trade_button">
            <button class="trade_apply">구매 신청</button><button id="apply_list_view_button"><span id="trade_number">2</span></button>
        </div>
        <div class="modal">
            <div class="trade_apply_layer">
                <form>
                    <div class="mb-2">
                        <label for="apply_price">신청가격</label><input type="text" id="apply_price"/>
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
        <div class="trade_apply_table">
            <table>
                <tbody>
                    <tr class="trade_apply_table_header"><th>신청 상태</th><th>신청 가격</th></tr>
                    <tr><td><span>구매신청</span></td><td><span>1억5천숲</span></td></tr>
                    <tr><td><span>구매신청</span></td><td><span>1억6천숲</span></td></tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="back_button">
        <button onClick="history.back()">뒤로가기</button>
    </div>
</div>
<script>
    $(".trade_apply").click(function(){
        $(".modal").attr("style","display:block;");
    });
    $(".close_modal").click(function(){
        $(".modal").attr("style","display:none;");
    });
    $("#apply_list_view_button").click(function(){
        if($(".trade_apply_table").css("display")=="none"){
            $(".trade_apply_table").attr("style","display:block;");
        } else{
            $(".trade_apply_table").attr("style","display:none;");
        }
    });
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