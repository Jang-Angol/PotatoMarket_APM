<div class="modal">
    <form method="get" name="detail_search" action='<?php echo "$_SERVER[PHP_SELF]"?>' onsubmit="return detailSearchCheck();">
        <table class="search_table">
            <tbody>
                <tr><th>서버</th><td><select id="server" name="server">
                    <option value="">전체</option>
                    <option value="lute">류트</option>
                    <option value="harp">하프</option>
                    <option value="mandoline">만돌</option>
                    <option value="wolf">울프</option>
                </select></td></tr>
                <tr><th>거래상태</th><td>
                    <span><input type="checkbox" id="trade_all" name="trade_all" checked/><label for="trade_all">전체</label></span>
                    <span><input type="checkbox" id="trade_ing" name="trade_ing" checked/><label for="trade_ing">거래중</label></span>
                    <span><input type="checkbox" id="trade_reservation" name="trade_reservation" checked/><label for="trade_reservation">예약중</label></span>
                    <span><input type="checkbox" id="trade_complete" name="trade_complete" checked/><label for="trade_complete">거래완료</label></span>
                </td></tr>
                <tr><th>아이템명</th><td><span><input id="item_name" name="title" type="text" placeholder="아이템 이름 검색"/></span></td></tr>
                <tr><th>아이템 가격</th><td><span><input id="item_price_low" name="price_low" type="number" placeholder="골드"/></span> ~ <span><input id="item_price_high" name="price_high" type="number" placeholder="골드"/></span></td></tr>
                <tr><th>아이템 옵션</th><td><span><input id="item_opt1" name="item_opt1" type="text" maxlength="8" placeholder="옵션1"/></span> , <span><input id="item_opt2" name="item_opt2" type="text" maxlength="8" placeholder="옵션2"/></span> , <span><input id="item_opt3" name="item_opt3" type="text" maxlength="8" placeholder="옵션3"/></span></td></tr>
            </tbody>
        </table>
        <div class="detail_search_button">
            <button><img src="../img/loupe_whilte.png"/>검색</button>
        </div>
    </form>
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
    $("#trade_ing").click(function(){
        if($("#trade_all").is(":checked")){
            $("#trade_all").prop("checked",false);
        }
    });
    $("#trade_reservation").click(function(){
        if($("#trade_all").is(":checked")){
            $("#trade_all").prop("checked",false);
        }
    });
    $("#trade_complete").click(function(){
        if($("#trade_all").is(":checked")){
            $("#trade_all").prop("checked",false);
        }
    });

    //for detail search check
    var nameCheck = /[^a-zA-Z0-9가-힣ㄱ-ㅎㅏ-ㅣ\,\.\?\!\(\)\s]/;
    var optionCheck = /[^가-힣0-9]/;

    function detailSearchCheck(){
        //category check
        if($("input:checkbox:checked").length<1){
            alert("error-category: please check category");
            return false;
        }
        //namecheck
        if($("#item_name").val()==""){
            alert("error-name-blink");
            return false;
        } else{
            if(nameCheck.test($("#item_name").val())){
                alert("error-name: invalid value");
                return false;
            }
        }
        //price check
        if($("#item_price_low").val().length>12||$("#item_price_high").val().length>12){
            alert("error-price: invalid value");
            return false;
        } else{
            if($("#item_price_low").val()!=""&&$("#item_price_high").val()!="")
            {
                if(Number($("#item_price_low").val())>Number($("#item_price_high").val())){
                    alert("error-price: invalid value / low is must lower than high");
                    return false;
                }
            }   
        }
        //optionCheck
        if(optionCheck.test($("#item_opt1").val())||optionCheck.test($("#item_opt2").val())||optionCheck.test($("#item_opt3").val())){
            alert("error-option: invalid value");
            return false;
        }

        return true;
    }
</script>