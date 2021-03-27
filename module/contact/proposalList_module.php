<?php
    include"../../DB/database.php";

    $page = isset($_POST["page"]) ? intval($_POST["page"]) : 1;
    $proposal_count = 4*$page;
    $count_sql = "SELECT COUNT(*) as proposal_count FROM PROPOSAL_TB;";

    $count_result = mysqli_query($connect, $count_sql);
    $count_row = mysqli_fetch_array($count_result);
    $proposal_counts = $count_row["proposal_count"];

    $pages = $proposal_counts/4 + 1;

    $sql = "SELECT * FROM PROPOSAL_TB ORDER BY no DESC LIMIT 0, $proposal_count;";
    $result = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($result)){
    	$user_sql = "SELECT server, user_name FROM USER_TB WHERE no = $row[user_no];";
    	$user_result = mysqli_query($connect, $user_sql);
    	$user_row = mysqli_fetch_array($user_result);
    	echo<<<END
	    <div class="proposal card mb-3">
	        <div class="card-body">
	            <div class="card-title"><span class="server_icon_$user_row[server]"></span><span class="user_name">$user_row[user_name]</span></div>
	            <div class="card-text"><p>$row[content]</p></div>
	        </div>
	    </div>    
END;
    }
    if($page < $pages - 1){
      echo<<<END
    <div><button class="view_more" page_no=$page>더보기</button</div>
END;  
    }
    
    mysqli_close($connect);
?>
<script>
    $(".view_more").click(function(){
        var page = Number($(this).attr("page_no"))+1;
        var hiddenForm = document.createElement("form");
        hiddenForm.setAttribute("method", "post");
        $("<input></input>").attr({type:"hidden", name:"page", value: page}).appendTo(hiddenForm);
        var data = $(hiddenForm).serialize();
        $.ajax({
            type: "post",
            url: "module/contact/proposalList_module.php",
            data: data,
            success : function connect(a){

                $(".proposal_list").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });    
</script>