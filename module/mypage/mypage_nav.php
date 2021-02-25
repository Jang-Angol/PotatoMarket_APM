<div class="mypage_nav">
    <ul>
        <li class="main_menu current"><a id="tradeOverView">나의 거래내역</a>
            <ul class="submenu">
                <li><a id="sellHistory">판매내역</a></li>
                <li><a id="buyHistory">구매내역</a></li>
            </ul>
        </li>
        <li><a id="warn">경고내역</a></li>
        <li><a id="modifyInfo">내 정보 수정</a></li>
        <li><a id="report">신고하기</a></li>
    </ul>
</div>
<script>
    $(".main_menu").hover(function (){
            $(this).children(".submenu").filter(":not(:visible)").slideDown(500);
            }, function(){
                $(this).children(".submenu").filter(":visible").slideUp(500);
    });

    $(".mypage_nav > ul > li > a").click(function(){
        $(".mypage_nav > ul > li").removeClass("current");
        $(this).parent("li").addClass("current");
    });

    $(document).ready(function(){
        $.ajax({
            type: "post",
            url: "module/mypage/tradeOverView_module.php",
            success : function connect(a){

                $("#mypage_content").html(a); 

            },
            error : function error(){alert("error");}
        });
    });

    $("#tradeOverView").click(function(){
        $.ajax({
            type: "post",
            url: "module/mypage/tradeOverView_module.php",
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });

    $("#sellHistory").click(function(){
        $.ajax({
            type: "post",
            url: "module/mypage/sellHistory_module.php",
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });

    $("#buyHistory").click(function(){
        $.ajax({
            type: "post",
            url: "module/mypage/buyHistory_module.php",
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });
            
    $("#warn").click(function(){
        $.ajax({
            type: "post",
            url: "module/mypage/warn_module.php",
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });

    $("#modifyInfo").click(function(){
        $.ajax({
            type: "post",
            url: "module/mypage/modifyInfo_module.php",
            success : function connect(a){

                $("#mypage_content").html(a); 
            },
            error : function error(){alert("error");}
        });
    });

    $("#report").click(function(){
        $.ajax({
            type: "post",
            url: "module/mypage/report/reportList_module.php",
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });
</script>