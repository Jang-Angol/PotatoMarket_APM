<div class="modal">
    <table class="search_table">
        <tbody>
            <tr><th>서버</th><td><select id="server">
                <option value="0">전체</option>
                <option value="1">류트</option>
                <option value="2">하프</option>
                <option value="3">만돌</option>
                <option value="4">울프</option>
            </select></td></tr>
            <tr><th>거래상태</th><td><span><input type="checkbox" id="trade_all"/><label for="trade_all">전체</label></span><span><input type="checkbox" id="trade_ing"/><label for="trade_ing">판매중</label></span><span><input type="checkbox" id="trade_reservation"/><label for="trade_reservation">예약중</label></span><span><input type="checkbox" id="trade_complete"/><label for="trade_complete">거래완료</label></span></td></tr>
            <tr><th>아이템명</th><td><span><input id="item_name" type="text" placeholder="아이템 이름 검색"/></span></td></tr>
            <tr><th>아이템 가격</th><td><span><input id="item_price_low" type="text" placeholder="골드"/></span> ~ <span><input id="item_price_high" type="text" placeholder="골드"/></span></td></tr>
            <tr><th>아이템 옵션</th><td><span><input id="item_opt1" type="text" placeholder="옵션1"/></span> , <span><input id="item_opt2" type="text" placeholder="옵션2"/></span> , <span><input id="item_opt3" type="text" placeholder="옵션3"/></span></td></tr>
        </tbody>
    </table>
    <div class="detail_search_button">
        <button><img src="../img/loupe_whilte.png"/>검색</button>
    </div>
    <div class="close_detail_search">
        <button>상세검색 닫기</button>
    </div>
    <div class="modal_layer"></div>
</div>
<script>
    //for Detail Search
    $(".close_detail_search > button").click(function(){
        $(".modal").attr("style","display:none;");
    });
    $("#trade_all").click(function(){
        if($(this).is(":checked")){
            $("input:checkbox").each(function(){
                this.checked =true;
            })
        } else {
            $("input:checkbox").each(function(){
                this.checked =false;
            })
        }
    });
</script>