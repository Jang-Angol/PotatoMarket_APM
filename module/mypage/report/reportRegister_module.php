<div class="report_register">
    <div class="report_register_contents">
        <div class="register-title">
            <span>
                <select class="category-select form-control">
                    <option value="">카테고리</option>
                    <option value="0">사기</option>
                    <option value="1">규정위반</option>
                    <option value="2">광고</option>
                    <option value="3">부적절한 게시물</option>
                </select>
            </span>
            <span><input type="text" class="form-control" placeholder="제목을 입력해주세요."></span>
        </div>
        <div class="register-table">
            <table>
                <tbody>
                    <tr><th>내용</th><td><textarea class="form-control" rows="10"></textarea></td></tr>
                    <tr><th>링크</th><td><input id="report_link" type="text"/></td></tr>
                    <tr><th>스크린샷</th><td><input type="file" class="form-control-file"/></td></tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="report_button">
        <button>신고하기</button>
    </div>
</div>
<div class="back_button">
    <button onClick="backReportList()">뒤로가기</button>
</div>
<script>
    function backReportList(){
        $.ajax({
            type: "post",
            url: "module/mypage/report/reportList_module.php",
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    }
</script>