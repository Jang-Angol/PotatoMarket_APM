<div class="category_bar">
    <ul>
        <li class="category_all"><a>전체</a></li>
        <li class="category_lute"><a>류트</a></li>
        <li class="category_harp"><a>하프</a></li>
        <li class="category_mandoline"><a>만돌</a></li>
        <li class="category_wolf"><a>울프</a></li>
    </ul>
    <div class="open_detail_search">
        <button><img src="../img/loupe_whilte.png"/>상세검색</button>
    </div>
</div>
<script>
//for Category
    $(document).ready(function(){
        $(".category_all").addClass("current");
    });
    $(".category_bar > ul > li").click(function(){
        $(".category_bar > ul > li").removeClass("current");
        $(".banner > div").removeClass("current");
        var category = $(this).attr("class");
        $("."+category).addClass("current");
    });
    //for detail search
    $(".open_detail_search > button").click(function(){
        $(".modal").attr("style","display:block;");
    });
</script>