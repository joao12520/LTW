<?php
    function getPromoCarousel($path) {
        echo '
        <div class="_promo_carousel" href="#category_' . $text . '">
            <div class="_promo_carouselContainer">
                <div class="_promo_carouselImageContainer">
                    <a class="_promo_carouselImage" style="background-image: url(' . $path . 'assets/img/testImages/burger.jpg);"> </a>
                    <a class="_promo_carouselImage" style="background-image: url(' . $path . 'assets/img/testImages/eggtoast.jpg);"> </a>
                    <a class="_promo_carouselImage" style="background-image: url(' . $path . 'assets/img/testImages/fruitbowl.jpg);"> </a>
                    <a class="_promo_carouselImage" style="background-image: url(' . $path . 'assets/img/testImages/salad.jpg);"> </a>
                    <a class="_promo_carouselImage" style="background-image: url(' . $path . 'assets/img/testImages/pancakes.jpg);"> </a>
                    <a class="_promo_carouselImage" style="background-image: url(' . $path . 'assets/img/testImages/burger.jpg);"> </a>
                    <a class="_promo_carouselImage" style="background-image: url(' . $path . 'assets/img/testImages/eggtoast.jpg);"> </a>
                    <a class="_promo_carouselImage" style="background-image: url(' . $path . 'assets/img/testImages/fruitbowl.jpg);"> </a>
                </div>
                <a class="_promo_carouselInfo"> 
                    <p class="_promo_carouselInfoName">Bar da Biblioteca</p>
                    <p class="_promo_carouselInfoLoc">Rua D. Frei Vicente da Soledade e Castro 25, 4200-465 Porto</p>';
                    getCarouselStars("../../", 3.5);
                echo '</a>    
            </div>
        </div>';
    }
?>