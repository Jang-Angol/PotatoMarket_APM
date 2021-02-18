<nav>
    <ul class="nav_list">
        <li class="main_menu"><a href="itemSell.php"> 판매 </a>
            <ul class="submenu">
                <li><a href="itemSell.php?lute">류트</a></li>
                <li><a href="itemSell.php?harp">하프</a></li>
                <li><a href="itemSell.php?mandoline">만돌</a></li>
                <li><a href="itemSell.php?wolf">울프</a></li>
            </ul>
        </li>
        <li class="main_menu"><a href="itemBuy.php"> 구매 </a>
            <ul class="submenu">
                <li><a href="itemBuy.php?lute">류트</a></li>
                <li><a href="itemBuy.php?harp">하프</a></li>
                <li><a href="itemBuy.php?mandoline">만돌</a></li>
                <li><a href="itemBuy.php?wolf">울프</a></li>
            </ul>
        </li>
        <li class="main_menu"><a>시세검색</a></li>
        <li class="main_menu"><a href="tradeHistory.php">거래내역</a></li>
    </ul>
</nav>
<script>
    $(".main_menu").hover(function (){
            $(this).children(".submenu").filter(":not(:visible)").slideDown(500);
            }, function(){
                $(this).children(".submenu").filter(":visible").slideUp(500);
    });
</script>