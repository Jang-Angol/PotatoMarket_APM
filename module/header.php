<header>
    <div class="top_bar nlogin">
        <span><a href="register.php">회원가입</a></span>
        <span><a href="login.php">로그인</a></span>
        <span><a href="contact.php">문의하기</a></span>
    </div>
    
    <div class="top_bar login">
        <span><a>마이페이지</a></span>
        <span><a>로그아웃</a></span>
        <span><a>문의하기</a></span>
    </div>
        
    <div class="middle_bar">
        <span class="logo">
            <a href="/">감자마켓</a>
        </span>
        <span class="search_bar">
            <input id="header_search" type="text" maxlength="30" placeholder="아이템을 검색해주세요."/>
            <button class="search_button"></button>
        </span>
    </div>
</header>
<script>
    //search check
    var searchCheck = /[^a-zA-Z0-9가-힣ㄱ-ㅎㅏ-ㅣ\,\.\?\!]/;

    $(".search_button").click(function(){
        if($("#header_search").val()==""){
            alert("검색창에 값을 입력해주세요.");
        } else{
            if(searchCheck.test($("#header_search").val())){
                alert("not valid input");
            } else{
                alert("success");
            }
        }
    })
</script>