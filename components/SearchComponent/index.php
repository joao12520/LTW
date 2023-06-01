<?php 
    function getSearchModal() {
        echo 
        '<div id="_searchComp_search" class="_searchComp_search _searchComp_searchClosed"> 
            <div id="_searchComp_modal" class="_searchComp_modal _searchComp_modalClosed"> 
                <input id="_searchComp_searchInput" class="_searchComp_searchInput" type="text" name="search" placeholder="Procurar...">
                <div id="livesearch" class="_searchComp_resultsContainer">
                </div>
            </div>
            <div id="_searchComp_container" class="_searchComp_container _searchComp_containerClosed"> 
            </div>
        </div>';
    }

    function getRestaurantSearchCard($restaurant){
        return  
        '<a class="_restaurantCard_searchCard" href="../../pages/restaurant/index.php?rest_id=' . $restaurant['restaurantID'] . '">
            <div class="_restaurantCard_searchText">
                <div class="_restaurantCard_searchCardName" >' . $restaurant['name'] . '</div>
                <div class="_restaurantCard_searchCardLocation" >' . $restaurant['location'] . '</div>
            </div>
            <div class="_restaurantCard_searchCardCategories">' .
                getSearchStars(3.5) . '
                <div class="_restaurantCard_searchCardCat">' . $restaurant['foodType'] . '</div>
            </div>
        </a>';
    }
?>