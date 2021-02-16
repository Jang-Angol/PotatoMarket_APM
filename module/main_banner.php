<div class="main_banner">
    <div class="slideshow-container">
        <div class="mySlides fade">
          <img src="../img/banner1.jpg"/>
        </div>
        <div class="mySlides fade">
          <img src="../img/banner2.jpg"/>
        </div>
        <div class="mySlides fade">
          <img src="../img/banner3.jpg"/>
        </div>
        <div class="dots">
          <span class="dot" value="1"></span> 
          <span class="dot" value="2"></span> 
          <span class="dot" value="3"></span> 
        </div>
    </div>
</div>
<script>
  var slideIndex = 0;
  showSlides();

  function showSlides() {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");

      for (i = 0; i < slides.length; i++) {
         slides[i].style.display = "none";  
      }
      slideIndex++;
      if (slideIndex > slides.length) {slideIndex = 1}    
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";  
      dots[slideIndex-1].className += " active";
      setTimeout(showSlides, 4000); // Change image every 4 seconds
  }
</script>