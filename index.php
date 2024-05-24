<html>
    <head>
        <title>Scuderia Ferrari</title>
        <link rel="icon" href="./img/logo/white-horse.svg" type="image/x-icon">

        <link rel="stylesheet" type="text/css" href="./css/AllAroundF1.css">
        <link rel="stylesheet" type="text/css" href="./css/frontend.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    </head>
    <body>
        <div class="se-pre-con">
            <div class="logo-load">
                <img src="./img/logo/white-horse.svg" alt="">
            </div>
        </div>
        <nav class="navbar">
            <div class="container">
                <div class="navbar-links-left">
                </div>
                <div class="navbar-logo">
                    <a href="index.php"><img src="./img/logo/white-horse.svg" /></a>
                </div>
                <div class="navbar-icons">
                    <?php
                    session_start();

                    if(isset($_SESSION['user_id'])) {
                        echo '<button class="button-primary red-button" role="button" onclick="window.location.href=\'./php/logout.php\'">Log out</button>';
                    } else {
                        echo '<button class="button-primary yellow-button" role="button" onclick="window.location.href=\'./php/login.php\'">Sign in</button>';
                    }
                    ?>
                </div>
            </div>
        </nav>
        <section id="hero">
            <div class="slider">
                <div class="slide" id="slide1">
                    <div class="slide-row">
                        <img class="img-absolute" src="./img/car/slide-1.avif" alt="">
                        <div class="slide-col">
                            <div class="slide-up">
                                <img src="./img/logo/Scuderia_Ferrari_HP.png" alt="">
                            </div>
                            <div class="slide-down">
                                <p>Gran Premio di Monaco</p>
                                <h2>PROVE LIBERE 1: CHARLES QUINTO, CARLOS DECIMO</h2>
                                <a class="more" href="index.php">
                                    <span>SCOPRI DI PI&Ugrave;</span>
                                    <div class="icon">
                                        <i class="fa-regular fa-chevron-right"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide" id="slide2">
                    <div class="slide-row">
                        <img class="img-absolute" src="./img/car/sainz-home.avif" alt="">
                        <div class="slide-col">
                            <div class="slide-up">
                                <img src="./img/logo/Scuderia_Ferrari_HP.png" alt="">
                            </div>
                            <div class="slide-down">
                                <p>Gran Premio di Monaco</p>
                                <h2>CARLOS: "FONDAMENTALE UN VENERD&Igrave; SENZA INTOPPI"</h2>
                                <a class="more" href="index.php">
                                    <span>SCOPRI DI PI&Ugrave;</span>
                                    <div class="icon">
                                        <i class="fa-regular fa-chevron-right"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>      
                </div>
                <div class="slide" id="slide3">
                    <div class="slide-row">
                        <img class="img-absolute" src="./img/car/leclerc-home.avif" alt="">
                        <div class="slide-col">
                            <div class="slide-up">
                                <img src="./img/logo/Scuderia_Ferrari_HP.png" alt="">
                            </div>
                            <div class="slide-down">
                                <p>Gran Premio di Monaco</p>
                                <h2>CHARLES: "QUI IL PILOTA FA ANCORA LA DIFFERENZA"</h2>
                                <a class="more" href="index.php">
                                    <span>SCOPRI DI PI&Ugrave;</span>
                                    <div class="icon">
                                        <i class="fa-regular fa-chevron-right"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>         
                </div>
            </div>
            <div class="dots">
                <span class="dot" onclick="currentSlide('slide1', this)"></span>
                <span class="dot" onclick="currentSlide('slide2', this)"></span>
                <span class="dot" onclick="currentSlide('slide3', this)"></span>
            </div>
        </section>
    </body>
    <script>
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut(1000);
            currentSlide('slide1', document.getElementsByClassName('dot')[0]);
        });

        function currentSlide(slideId, dotElement) {
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
            dotElement.className += " active";
        }
    </script>
</html>