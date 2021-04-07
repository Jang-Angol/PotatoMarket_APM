<div class="category_bar">
    <ul>
<?php
    if(isset($_POST["faq_category"])){
        if($_POST["faq_category"] == 1){
            echo<<<END
        <li><a class="faq_all">전체</a></li>
        <li class="current"><a class="faq_cite">사이트 이용</a></li>
        <li><a class="faq_trade">거래</a></li>
END;
        } else if($_POST["faq_category"] == 2){
            echo<<<END
        <li><a class="faq_all">전체</a></li>
        <li><a class="faq_cite">사이트 이용</a></li>
        <li class="current"><a class="faq_trade">거래</a></li>
END;
        }

    } else {
        echo<<<END
        <li class="current"><a class="faq_all">전체</a></li>
        <li><a class="faq_cite">사이트 이용</a></li>
        <li><a class="faq_trade">거래</a></li>
END;
    }
?>

    </ul>
</div>
<div class="faq_list">
    <ul>
<?php
   include "../../DB/database.php";

   if(isset($_POST["faq_category"])){
        $sql = "SELECT category, title, content FROM FAQ_TB WHERE category = $_POST[faq_category];";
        $result = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_array($result)){
            switch($row["category"]){
                case 1:
                    $category = "사이트 이용";
                    break;
                case 2:
                    $category = "거래";
                    break;
                default:
                    $category = "";
                    break;
            }
            echo<<<END
        <li class="faq_contents">
            <span class="faq_category">$category</span><span class="faq_title">$row[title]</span>
            <div class="faq_content"><p>$row[content]</p></div>
        </li>
END;
        }
   } else {
     $sql = "SELECT category, title, content FROM FAQ_TB;";
        $result = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_array($result)){
            switch($row["category"]){
                case 1:
                    $category = "사이트 이용";
                    break;
                case 2:
                    $category = "거래";
                    break;
                default:
                    $category = "";
                    break;
            }
            echo<<<END
        <li class="faq_contents">
            <span class="faq_category">$category</span><span class="faq_title">$row[title]</span>
            <div class="faq_content"><p>$row[content]</p></div>
        </li>
END;
        }
   } 
?>
    </ul>
</div>
<script>
    $(".category_bar > ul > li > a").click(function(){
        $(".category_bar > ul > li").removeClass("current");
        $(this).parent().addClass("current");
    });
    
    $(".faq_contents").click(function(){
        if($(this).children(".faq_content").is(":visible")){
            $(this).children(".faq_content").slideUp(300);
        }
        else{
            $(this).children(".faq_content").slideDown(300);
        }
    });
    $(".faq_all").click(function(){
        $.ajax({
            type: "post",
            url: "module/contact/FAQ_module.php",
            success : function connect(a){

                $("#contact_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });
    $(".faq_cite").click(function(){
        var hiddenForm = document.createElement("form");
        hiddenForm.setAttribute("method", "post");
        $("<input></input>").attr({type:"hidden", name:"faq_category", value:"1"}).appendTo(hiddenForm);
        var data = $(hiddenForm).serialize();
        $.ajax({
            type: "post",
            url: "module/contact/FAQ_module.php",
            data: data,
            success : function connect(a){

                $("#contact_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });
    $(".faq_trade").click(function(){
        var hiddenForm = document.createElement("form");
        hiddenForm.setAttribute("method", "post");
        $("<input></input>").attr({type:"hidden", name:"faq_category", value:"2"}).appendTo(hiddenForm);
        var data = $(hiddenForm).serialize();
        $.ajax({
            type: "post",
            url: "module/contact/FAQ_module.php",
            data: data,
            success : function connect(a){

                $("#contact_content").html(a); 
                
            },
            error : function error(){alert("error");}
        });
    });
</script>