<?php
    session_start();
?>
<header>
<?php
    if(isset($_SESSION["user_no"])){
echo<<<_END
        <div class="top_bar">
        <span><a href="mypage.php">마이페이지</a></span>
        <span><a href="DB/logout.php">로그아웃</a></span>
        <span><a href="contact.php">문의하기</a></span>
        </div>
_END;
    } else {
echo<<<_END
        <div class="top_bar">
        <span><a href="register.php">회원가입</a></span>
        <span><a href="login.php">로그인</a></span>
        <span><a href="contact.php">문의하기</a></span>
        </div>
_END;
    }
?>   
    <div class="middle_bar">
        <span class="logo">
            <a href="/">감자마켓</a>
        </span>
        <span class="search_bar">
            <form method="GET" id="searchForm" name="searchForm" action="tradeHistory.php" onsubmit="return searchChk();">
                <?php
                    if(isset($_GET["p_search"])){
                        echo '<input id="header_search" name="p_search" type="text" value="'.$_GET['p_search'].'"maxlength="30" placeholder="아이템을 검색해주세요."/>';
                    } else{
                        echo '<input id="header_search" name="p_search" type="text" maxlength="30" placeholder="아이템을 검색해주세요."/>';
                    }
                ?>
                
                <button type="submit" class="search_button"></button>
            </form>
        </span>
    </div>
</header>
<script>
    //search check
    var searchCheck = /[^a-zA-Z0-9가-힣ㄱ-ㅎㅏ-ㅣ\,\.\?\!\(\)]/;
    function searchChk(){
        if($("#header_search").val()==""){
            alert("검색창에 값을 입력해주세요.");
            return false;
        } else{
            if(searchCheck.test($("#header_search").val())){
                alert("not valid input");
                return false;
            } else{
                alert("success");
                return true;
            }
        }
    }
</script>