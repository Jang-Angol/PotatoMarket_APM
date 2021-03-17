<div class="contact_contents container">
    <div id="contact_content">
        <?php
            include "DB/database.php";
            $sql = "SELECT category, title, content, date FROM NOTICE_TB WHERE no = $_GET[notice_id];";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_array($result);
            $pre_sql = "SELECT no, title FROM NOTICE_TB WHERE no < $_GET[notice_id] ORDER BY no DESC LIMIT 1;";
            $pre_result = mysqli_query($connect, $pre_sql);
            $pre = mysqli_fetch_array($pre_result);
            $next_sql = "SELECT no, title FROM NOTICE_TB WHERE no > $_GET[notice_id] ORDER BY no ASC LIMIT 1;";
            $next_result = mysqli_query($connect, $next_sql);
            $next = mysqli_fetch_array($next_result);

        echo<<<END
        <div class="notice_view">
            <div class="notice_title">
                <table class="notice_table">
                    <tbody>
                        <tr><th class="label_$row[category]"></th><td class="notice_title">$row[title]</td><td class="notice_date">$row[date]</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="notice_view_contents">
                <pre>$row[content]</pre>
            </div>
END;
            echo<<<END
            <div>
                <ul>
END;
                if($pre){
                    echo "<li class='notice_pre'><a href='noticeView.php?notice_id=$pre[no]'><span>이전글</span><span>$pre[title]</span></a></li>";
                } else {
                    echo "<li class='notice_pre'><span>이전글</span><span>존재하지 않습니다</span></li>";
                }
                if($next){
                    echo "<li class='notice_next'><a href='noticeView.php?notice_id=$next[no]'><span>다음글</span><span>$next[title]</span></a></li>";
                } else {
                    echo "<li class='notice_next'><span>다음글</span><span>존재하지 않습니다</span></li>";
                }
            echo<<<END
                </ul>
            </div>
        </div>
END;
        ?>
        <div class="back_button">
            <button onClick="location.href='contact.php'">뒤로가기</button>
        </div>
    </div>
</div>
<script>
    function backNoticeList(){
        $.ajax({
            type: "post",
            url: "module/contact/notice/noticeList_module.php",
            success : function connect(a){

                $("#contact_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    }
</script>