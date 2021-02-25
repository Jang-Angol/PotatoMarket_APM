<div class="report_table">
    <table>
        <tbody>
            <tr><th class="report_category">카테고리</th><th class="report_content">신고내용</th><th class="report_date">등록날짜</th><th class="report_state">처리상태</th></tr>
            <?php
                for ($i = 1; $i < 11; $i++){
                    echo '<tr><td class="report_category">사기</td><td class="report_title"><a id="'.$i.'">아이템 거래 사기 당했어요 ㅠ</a></td><td>21.02.11</td><td>처리중</td></tr>';
                }
            ?>
        </tbody>
    </table>
    <div class="paging">
        < 1 2 3 4 5 >
    </div>
    <div class="report_button">
        <button>신고하기</button>
    </div>
</div>
<script>
    $(".report_title > a").click(function(){
        $.ajax({
            type: "post",
            url: "module/mypage/report/reportView_module.php",
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });
    $(".report_button").click(function(){
        $.ajax({
            type: "post",
            url: "module/mypage/report/reportRegister_module.php",
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });
</script>