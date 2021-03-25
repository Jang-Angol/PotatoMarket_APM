<div class="report_view">
    <table>
        <tbody>
<?php
    session_start();

    if(!isset($_SESSION["user_no"])){
        echo "<script>alert('로그인 후 등록이 가능합니다..');
        window.location.href='/login.php';</script>";
    }
    if(!isset($_POST["report_no"])){
        echo "<script>alert('로그인 후 등록이 가능합니다..');
        window.location.href='/login.php';</script>";
    }

    include"../../../DB/database.php";

    $sql = "SELECT no, category, title, date, state, content, link FROM REPORT_TB WHERE no = $_POST[report_no];";
    //var_dump($sql);
    $result = mysqli_query($connect, $sql);
    //var_dump($result);
    if($row = mysqli_fetch_array($result)){
        switch($row["category"]){
            case 1:
                $category = "사기";
                break;
            case 2:
                $category = "규정위반";
                break;
            case 3:
                $category = "광고";
                break;
            case 4:
                $category = "부적절한 게시물";
                break;
            default:
                $category = "";
                break;
        }
        switch ($row["state"]) {
            case 0:
                $state = "접수중";
                break;
            case 1:
                $state = "처리중";
                break;
            case 2:
                $state = "처리완료";
                break;
            default:
                $state = "";
                break;
        }
        echo<<<END
        <tr><th>제목</th><td>$row[title]</td></tr>
            <tr><th>등록일</th><td>$row[date]</td></tr>
            <tr><th>카테고리</th><td class="report_category">$category</td></tr>
            <tr><th>처리상태</th><td>$state</td></tr>
            <tr><th>내용</th><td><pre>$row[content]</pre></td></tr>
            <tr><th>링크</th><td>$row[link]</td></tr>
            <tr><th>스크린샷</th><td>screenshot1.jpg</td></tr>
END;
    }
?>
            
        </tbody>
    </table>
    <table>
        <tbody>
<?php
    $sql = "SELECT content FROM REPORT_ANS_TB WHERE report_no = $_POST[report_no];";
    $result = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_array($result)){
        echo<<<END
            <tr><th>답변</th><td><pre>$row[content]</pre></td></tr>
END;
    }
    
?>
        </tbody>
    </table>
</div>
<div class="back_button">
    <button>뒤로가기</button>
</div>
<script>
    $(".back_button").click(function(){
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