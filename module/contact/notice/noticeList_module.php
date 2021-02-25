<div class="notice_list">
    <div class="notice">
        <table class="notice_table">
            <tr><th class="label_notice"></th><td class="notice_title"><a id="notice_1">넥슨은 다람쥐를 뿌려라</a></td><td class="notice_date">2021.02.02</td></tr>
            <tr><th class="label_warning"></th><td class="notice_title"><a id="notice_2">넥슨은 다람쥐를 뿌려라</a></td><td class="notice_date">2021.02.02</td></tr>
            <tr><th class="label_fatch"></th><td class="notice_title"><a id="notice_3">넥슨은 다람쥐를 뿌려라</a></td><td class="notice_date">2021.02.02</td></tr>
            <tr><th class="label_notice"></th><td class="notice_title"><a id="notice_4">넥슨은 다람쥐를 뿌려라</a></td><td class="notice_date">2021.02.02</td></tr>
            <tr><th class="label_warning"></th><td class="notice_title"><a id="notice_5">넥슨은 다람쥐를 뿌려라</a></td><td class="notice_date">2021.02.02</td></tr>
            <tr><th class="label_fatch"></th><td class="notice_title"><a id="notice_6">넥슨은 다람쥐를 뿌려라</a></td><td class="notice_date">2021.02.02</td></tr>
        </table>
    </div>
</div>
<script>
    $(".notice_title > a").click(function(){
        location.href = "noticeView.php" + "?" + "notice_id=" + $(this).attr("id");
    });
</script>