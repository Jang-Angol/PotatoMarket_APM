<div class="contact_nav">
    <ul>
        <li><a id="FAQ">자주 묻는 질문</a></li>
        <li><a id="report">신고하기</a></li>
        <li><a id="proposal">건의사항</a></li>
        <li><a id="notice">공지사항</a></li>
    </ul>
</div>
<script>
	$(".contact_nav > ul > li > a").click(function(){
        $(".contact_nav > ul > li").removeClass("current");
        $(this).parent("li").addClass("current");
    });

    $("#FAQ").click(function(){
        $.ajax({
            type: "post",
            url: "module/contact/FAQ_module.php",
            success : function connect(a){

                $("#contact_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });

    $("#report").click(function(){
        $.ajax({
            type: "post",
            url: "module/contact/report/reportList_module.php",
            success : function connect(a){

                $("#contact_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });

    $("#proposal").click(function(){
        $.ajax({
            type: "post",
            url: "module/contact/proposal_module.php",
            success : function connect(a){

                $("#contact_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });

    $("#notice").click(function(){
        $.ajax({
            type: "post",
            url: "module/contact/notice/noticeList_module.php",
            success : function connect(a){

                $("#contact_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });

</script>
