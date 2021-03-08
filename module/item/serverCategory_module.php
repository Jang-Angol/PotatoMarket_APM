<div class="category_bar">
    <ul>
        <li class="category_all"><a href="?">전체</a></li>
        <li class="category_lute"><a href="?server=lute">류트</a></li>
        <li class="category_harp"><a href="?server=harp">하프</a></li>
        <li class="category_mandoline"><a href="?server=mandoline">만돌</a></li>
        <li class="category_wolf"><a href="?server=wolf">울프</a></li>
    </ul>
    <div class="open_detail_search">
        <button><img src="../img/loupe_whilte.png"/>상세검색</button>
    </div>
</div>
<?php
    if(!isset($_GET["server"])){
        echo "<script>$('.category_all').addClass('current');</script>";
    }
?>
<script>
    //for Category
    $(".category_bar > ul > li > a").click(function(){
        $(".category_bar > ul > li").removeClass("current");
        $(".banner > div").removeClass("current");
        var category = $(this).parents().attr("class");
        $("."+category).addClass("current");
    });
    //for detail search
    $(".open_detail_search > button").click(function(){
        $(".modal").attr("style","display:block;");
    });
</script>
<?php
    if(isset($_GET["server"])){
        if($_GET["server"] == "lute"){
            echo"<script>$('.category_lute > a').trigger('click');</script>";
        } else if($_GET["server"] == "harp"){
            echo"<script>$('.category_harp > a').trigger('click');</script>";
        } else if($_GET["server"] == "mandoline"){
            echo"<script>$('.category_mandoline > a').trigger('click');</script>";
        } else if($_GET["server"] == "wolf"){
            echo"<script>$('.category_wolf > a').trigger('click');</script>";
        }
    }
?>