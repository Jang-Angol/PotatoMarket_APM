<div class="report_table">
    <table>
        <tbody>
            <tr><th class="report_category">카테고리</th><th class="report_content">신고내용</th><th class="report_date">등록날짜</th><th class="report_state">처리상태</th></tr>
            <?php
                session_start();

                if(!isset($_SESSION["user_no"])){
                    echo "<script>alert('로그인 후 등록이 가능합니다..');
                    window.location.href='/login.php';</script>";
                }

                include"../../../DB/database.php";

                $report_count = 4;
                $page = isset($_POST["page"]) ? intval($_POST["page"]) : 1;
                $offset = ($page-1)*$report_count;

                $count_sql = "SELECT COUNT(*) as report_count FROM REPORT_TB WHERE user_no = $_SESSION[user_no];";

                $count_result = mysqli_query($connect, $count_sql);
                $count_row = mysqli_fetch_array($count_result);
                $report_counts = $count_row["report_count"];

                $pages = $report_counts/4 + 1;

                $sql = "SELECT no, category, title, date, state FROM REPORT_TB WHERE user_no = $_SESSION[user_no] ORDER BY no DESC LIMIT $offset, $report_count;";

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
                    <tr><td class="report_category">$category</td><td class="report_title"><a id=$row[no]>$row[title]</a></td><td>$row[date]</td><td>$state</td></tr>
END;
                    while($row = mysqli_fetch_array($result)){
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
                    <tr><td class="report_category">$category</td><td class="report_title"><a id=$row[no]>$row[title]</a></td><td>$row[date]</td><td>$state</td></tr>
END;
                    }                    
                } else {
                    echo '<tr><td></td><td class="report_blink">신고한 내용이 없습니다.</td></tr>';
                }
            ?>
        </tbody>
    </table>
    <div class="contents_bottom_bar">
        <?php
            echo "<span class='pages'>";
            for ($i = 1; $i < $pages; $i++){
                echo "<span><a class='page' page_no='$i'>$i</a></span>";
            }
            echo "</span>";

            mysqli_close($connect);
        ?>
    </div>
    <div class="report_button">
        <button>신고하기</button>
    </div>
</div>
<script>
    $(".report_title > a").click(function(){
        var hiddenForm = document.createElement("form");
        hiddenForm.setAttribute("method", "post");
        $("<input></input>").attr({type:"hidden", name:"report_no", value:$(this).attr("id")}).appendTo(hiddenForm);
        var data = $(hiddenForm).serialize();
        $.ajax({
            type: "post",
            url: "module/mypage/report/reportView_module.php",
            data: data,
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });
    $(".report_button > button").click(function(){
        $.ajax({
            type: "post",
            url: "module/mypage/report/reportRegister_module.php",
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });
    $(".page").click(function(){
        var hiddenForm = document.createElement("form");
        hiddenForm.setAttribute("method", "post");
        $("<input></input>").attr({type:"hidden", name:"page", value:$(this).attr("page_no")}).appendTo(hiddenForm);
        var data = $(hiddenForm).serialize();
        $.ajax({
            type: "post",
            url: "module/mypage/report/reportList_module.php",
            data: data,
            success : function connect(a){

                $("#mypage_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });
</script>