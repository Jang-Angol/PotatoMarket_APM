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
    //for load
    $(document).ready(function(){
        var url = location.href;

        var parameter = url.slice(url.indexOf('?') + 1, url.length);

        if(parameter=="server=lute"){
            $(".category_lute").trigger("click");
        } else if(parameter=="server=harp") {
            $(".category_harp").trigger("click");
        } else if(parameter=="server=mandoline") {
            $(".category_mandoline").trigger("click");
        } else if(parameter=="server=wolf") {
            $(".category_wolf").trigger("click");
        }
    })
    //for Category
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