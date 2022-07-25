

var slides = document.getElementsByClassName("mySlides");

var slideIndex = 1;
var x = window.matchMedia("(max-width: 992px)")
media(x) // Call listener function at run time
x.addListener(media) // Attach listener function on state changes

function media(x){
    if(x.matches){
        showSlides(slideIndex);
    }else{
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
    }
}

function plusSlides(n) {
    
  var slides = document.getElementsByClassName("mySlides");
    if(slideIndex <= slides.length - 4 || slideIndex >= 1){
        
  showSlides(slideIndex += n);
    }
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}


var x = window.matchMedia("(max-width: 992px)")
console.log(x)

function showSlides(n) {
  var i;
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  slides[slideIndex-1].style.display = "block";
}
