<?php
    session_start();
?>
<header>
    <div class="top_bar">
<?php
    if(isset($_SESSION["user_no"])){
        switch($_SESSION["user_server"]){
            case 0:
                $user_server = "DEV";
                break;
            case 1: 
                $user_server = "LT";
                break;
            case 2:
                $user_server = "HP";
                break;
            case 3:
                $user_server = "MD";
                break;
            case 4:
                $user_server = "WF";
                break;
            default:
                echo "Not valid value";
                exit;
    }
        echo "<span><a>".$user_server.$_SESSION['user_name']."</a></span>";
echo<<<_END
        <span><a href="mypage.php">마이페이지</a></span>
        <span><a href="DB/logout.php">로그아웃</a></span>
        <span><a href="contact.php">문의하기</a></span>
        </div>
_END;
    } else {
echo<<<_END
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
    var searchCheck = /[^a-zA-Z0-9가-힣ㄱ-ㅎㅏ-ㅣ\,\.\?\!\(\)\s]/;
    function searchChk(){
        if($("#header_search").val()==""){
            alert("검색창에 값을 입력해주세요.");
            return false;
        } else{
            if(searchCheck.test($("#header_search").val())){
                alert("not valid input");
                return false;
            } else{
                //alert("success");
                return true;
            }
        }
    }
</script>