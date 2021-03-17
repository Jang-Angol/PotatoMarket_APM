<?php
    $uri= $_SERVER['REQUEST_URI']; //uri를 구합니다.
    if($uri == "/module/contact/notice/noticeList_module.php"){
        include "../../../DB/database.php";
    } else {
        include "DB/database.php";
    }
?>
<?php
    $notice_sql = "SELECT no, category, title, date FROM NOTICE_TB ORDER BY no DESC;";
    $notice_result = mysqli_query($connect, $notice_sql);
?>
<div class="notice_list">
    <div class="notice">
        <table class="notice_table">
<?php
    while($row = mysqli_fetch_array($notice_result)){
        echo<<<END
        <tr><th class="label_$row[category]"></th><td class="notice_title"><a notice_id="$row[no]">$row[title]</a></td><td class="notice_date">$row[date]</td></tr>
END;
    }
?>
        </table>
    </div>
</div>
<script>
    $(".notice_title > a").click(function(){
        location.href = "noticeView.php" + "?" + "notice_id=" + $(this).attr("notice_id");
    });
</script>