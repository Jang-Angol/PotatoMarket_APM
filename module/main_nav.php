<nav>
    <ul class="nav_list">
        <li class="main_menu"><a> 판매 </a>
            <ul class="submenu">
                <li><a>류트</a></li>
                <li><a>하프</a></li>
                <li><a>만돌</a></li>
                <li><a>울프</a></li>
            </ul>
        </li>
        <li class="main_menu"><a> 구매 </a>
            <ul class="submenu">
                <li><a>류트</a></li>
                <li><a>하프</a></li>
                <li><a>만돌</a></li>
                <li><a>울프</a></li>
            </ul>
        </li>
        <li class="main_menu"><a>시세검색</a></li>
        <li class="main_menu"><a>거래내역</a></li>
    </ul>
</nav>
<script>
    $(".main_menu").hover(function (){
            $(this).children(".submenu").filter(":not(:visible)").slideDown(500);
            }, function(){
                $(this).children(".submenu").filter(":visible").slideUp(500);
    });
</script>