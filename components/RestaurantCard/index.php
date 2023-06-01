<?php 
    function getRestaurantCard($path, $favorite, $item) {
        echo 
        '<a class="_restaurantCard_card" href="' . "../../" . "pages/restaurant/index.php?rest_id=" . $item['restaurantID'] . '">
            <div class="_restaurantCard_image" style="background-image: url(' . $path. "assets/" . $item['photo'] . '" . );">
            </div>
            <div class="_restaurantCard_aval">
                <span>';
                echo '4.5'; // CHANGE DINAMICALLY
            echo '</span>
            </div>
            <div class="_restaurantCard_fav">
                <img src="';
                 echo ($favorite ? $path . 'assets/icons/star_black.svg' : $path .'assets/icons/star_border_black.svg');
            echo '" alt="favoriteIcon" width=32 height=32> </img>
            </div>
            <div class="_restaurantCard_info">
                <span class="_restaurantCard_infoName" >';
                echo $item['name'];
            echo'</span>
                <span class="_restaurantCard_infoLoc" >';
                echo $item['location'];
            echo'</span>
            </div>
        </a>';
    }

    function getRestaurantCardPreview() {
        echo 
        '<a class="_restaurantCard_card _restaurantCard_preview" >
            <div class="_restaurantCard_image" id="_restaurantCard_infoImgPreview" style="background-image: url(../../assets/img/rest_preview.svg)";">
            </div>
            <div class="_restaurantCard_aval">
                <span> 4.5 </span>
            </div>
            <div class="_restaurantCard_fav">
                <img src="../../assets/icons/star_border_black.svg" alt="favoriteIcon" width=32 height=32> </img>
            </div>
            <div class="_restaurantCard_info">
                <span class="_restaurantCard_infoName" id="_restaurantCard_infoNamePreview">
                    Estabelecimento
                </span>
                <span class="_restaurantCard_infoLoc" id="_restaurantCard_infoLocPreview">
                    Localização
                </span>
            </div>
        </a>';
    }

    function getRestaurantCardNumberedPreview($num, $path) {
        echo 
        '<a class="_restaurantCard_card _restaurantCard_preview' . $num. '" >
            <div class="_restaurantCard_image" id="_restaurantCard_infoImgPreview' . $num. '" style="background-image: url(../../assets/' . $path . ')";">
            </div>
            <div class="_restaurantCard_aval">
                <span> 4.5 </span>
            </div>
            <div class="_restaurantCard_fav">
                <img src="../../assets/icons/star_border_black.svg" alt="favoriteIcon" width=32 height=32> </img>
            </div>
            <div class="_restaurantCard_info">
                <span class="_restaurantCard_infoName" id="_restaurantCard_infoNamePreview' . $num. '">
                    Estabelecimento
                </span>
                <span class="_restaurantCard_infoLoc" id="_restaurantCard_infoLocPreview' . $num. '">
                    Localização
                </span>
            </div>
        </a>';
    }
?>

