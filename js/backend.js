function currentSlide(slideId) {
    // Nascondi tutte le slide
    var slides = document.getElementsByClassName('slide');
    for (var i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }

    // Rimuovi la classe "active" da tutti i puntini
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }

    // Mostra la slide corrente e rendi il puntino corrispondente attivo
    document.getElementById(slideId).style.display = "flex";  
    event.target.className += " active";
}