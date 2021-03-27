<?php
    $uri= $_SERVER['REQUEST_URI']; //uri를 구합니다.
    if($uri == "/module/contact/notice/noticeList_module.php"){
        include "../../../DB/database.php";
    } else {
        include "DB/database.php";
    }
?>
<?php
    $notice_count = 8;
    $page = isset($_POST["page"]) ? intval($_POST["page"]) : 1;
    $offset = ($page-1)*$notice_count;

    $notice_sql = "SELECT no, category, title, date FROM NOTICE_TB ORDER BY no DESC LIMIT $offset, $notice_count;";
    $count_sql = "SELECT COUNT(*) as notice_count FROM NOTICE_TB;";

    $count_result = mysqli_query($connect, $count_sql);
    $count_row = mysqli_fetch_array($count_result);
    $notice_counts = $count_row["notice_count"];

    $pages = $notice_counts/8 + 1;

    if(!empty($_POST["page"])){
        $notice_sql = "SELECT no, category, title, date FROM NOTICE_TB ORDER BY no DESC LIMIT $offset, $notice_count;";
    }
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
    <div class="contents_bottom_bar">
        <?php
        if(!empty($_POST["pages"])){
            echo "<span class='pages'>";
            for ($i = 1; $i < $pages; $i++){
                echo "<span><a class='page' page_no='$i'>$i</a></span>";
            }
            echo "</span>";
        }
            mysqli_close($connect);
        ?>
    </div>
</div>
<script>
    $(".notice_title > a").click(function(){
        location.href = "noticeView.php" + "?" + "notice_id=" + $(this).attr("notice_id");
    });
    $(".page").click(function(){
        var hiddenForm = document.createElement("form");
        hiddenForm.setAttribute("method", "post");
        $("<input></input>").attr({type:"hidden", name:"page", value:$(this).attr("page_no")}).appendTo(hiddenForm);
        $("<input></input>").attr({type:"hidden", name:"pages", value:"1"}).appendTo(hiddenForm);
        var data = $(hiddenForm).serialize();
        $.ajax({
            type: "post",
            url: "module/contact/notice/noticeList_module.php",
            data: data,
            success : function connect(a){

                $("#contact_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });
</script>