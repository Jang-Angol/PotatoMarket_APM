<div class="category_bar">
    <ul>
        <li class="current"><a>전체</a></li>
        <li><a>사이트 이용</a></li>
        <li><a>거래</a></li>
    </ul>
</div>
<div class="faq_list">
    <ul>
        <li class="faq_contents">
            <span class="faq_category">사이트 이용</span><span class="faq_title">감자마켓은 어떻게 이용하나요?</span>
            <div class="faq_content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis hendrerit dolor magna eget est lorem ipsum dolor sit.</div>
        </li>
        <li class="faq_contents">
            <span class="faq_category">사이트 이용</span><span class="faq_title">감자마켓은 어떻게 이용하나요?</span>
            <div class="faq_content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis hendrerit dolor magna eget est lorem ipsum dolor sit.</div>
        </li>
        <li class="faq_contents">
            <span class="faq_category">사이트 이용</span><span class="faq_title">감자마켓은 어떻게 이용하나요?</span>
            <div class="faq_content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis hendrerit dolor magna eget est lorem ipsum dolor sit.</div>
        </li>
        <li class="faq_contents">
            <span class="faq_category">사이트 이용</span><span class="faq_title">감자마켓은 어떻게 이용하나요?</span>
            <div class="faq_content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis hendrerit dolor magna eget est lorem ipsum dolor sit.</div>
        </li>
        <li class="faq_contents">
            <span class="faq_category">사이트 이용</span><span class="faq_title">감자마켓은 어떻게 이용하나요?</span>
            <div class="faq_content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis hendrerit dolor magna eget est lorem ipsum dolor sit.</div>
        </li>
        <li class="faq_contents">
            <span class="faq_category">사이트 이용</span><span class="faq_title">감자마켓은 어떻게 이용하나요?</span>
            <div class="faq_content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis hendrerit dolor magna eget est lorem ipsum dolor sit.</div>
        </li>
        <li class="faq_contents">
            <span class="faq_category">사이트 이용</span><span class="faq_title">감자마켓은 어떻게 이용하나요?</span>
            <div class="faq_content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis hendrerit dolor magna eget est lorem ipsum dolor sit.</div>
        </li>
        <li class="faq_contents">
            <span class="faq_category">사이트 이용</span><span class="faq_title">감자마켓은 어떻게 이용하나요?</span>
            <div class="faq_content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis hendrerit dolor magna eget est lorem ipsum dolor sit.</div>
        </li>
        <li class="faq_contents">
            <span class="faq_category">사이트 이용</span><span class="faq_title">감자마켓은 어떻게 이용하나요?</span>
            <div class="faq_content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis hendrerit dolor magna eget est lorem ipsum dolor sit.</div>
        </li>
    </ul>
</div>
<script>
    $(".category_bar > ul > li").click(function(){
        $(".category_bar > ul > li").removeClass("current");
        $(this).addClass("current");
    });
    
    $(".faq_contents").click(function(){
        if($(this).children(".faq_content").is(":visible")){
            $(this).children(".faq_content").slideUp(300);
        }
        else{
            $(this).children(".faq_content").slideDown(300);
        }
    });
</script>