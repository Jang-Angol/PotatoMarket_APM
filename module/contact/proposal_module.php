<?php
    session_start();
?>
<div class="proposal_list"></div>
<?php
    if(isset($_SESSION["user_no"])){
    echo<<<END
<div class="proposal_register">
    <form id ="proposalForm" name="proposalForm" method="post" onsubmit="return registerChk();">
        <div class="proposal card">
            <div class="card-body">
                <div class="card-title"><span class="server_icon_$_SESSION[user_server]"></span><span class="user_name">$_SESSION[user_name]</span></div>
                <div class="card-text"><textarea name="content" rows="3" maxlength="255" wrap="virtual" class="form-control"></textarea></div>
                <button class="proposal_submit" type="button">등록</button>
            </div>
        </div>
    </form>
</div>
END;   
    }
    
?>

<script>
    $(document).ready(function(){
        loadProposalList();
    })
    //Regular Expression
    var RegExpJS = /<script[^>]*>((\n|\r|.)*?)<\/script>/img;
    var sqlProtect = /[\'\"\;\\\#\=\&]/g;

    $(".proposal_submit").click(function(){
        var data = $('#proposalForm').serialize();

        $.ajax({
            type: "post",
            url: "../../DB/proposalRegister.php",
            data: data,
            success : function connect(data){
                loadProposalList();
                
            },
            error : function error(e){
                alert("error");
                console.log(e);
            }
        });

        $("textarea[name='content']").val("");
    })

    function loadProposalList(){
        $.ajax({
            type: "post",
            url: "module/contact/proposalList_module.php",
            success : function connect(a){

                $(".proposal_list").html(a);

            },
            error : function error(){alert("error");}
        });
    }

    function registerChk(){
        var check = true;
        var content = $("textarea[name='content']").val();
        if(RegExpJS.test(content)){
            check = false;
        }
        if(sqlProtect.test(content)){
            check = false;
        }
        return check;
    }
</script>