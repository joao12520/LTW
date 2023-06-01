<?php
    function getCategoryButton($text) {
        echo '<a class="_categories_categoryButton" href="#category_' . $text . '">'.  $text . '</a>';
    }

    function getAllCategory(): array{
        $db = new PDO('sqlite:../../Database/database.db');
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stmt = $db->prepare('SELECT * FROM Category');
        $stmt->execute();
        return $stmt->fetchAll();;
    }

    function getCategoriesBar($path, $cats = array("")) {
        echo '<div id="categories_bar" class="_categories_categoriesBar">';
            foreach ($cats as $cat) {
                echo getCategoryButton($cat["nameCategory"]);
            }
        //echo '<a class="_categories_categoryButton">Ver Mais</a>';
        echo '</div>';
        echo '<a id="_categoryPull" class="_categories_categoriesPull _categoriesPullHide" href="#categories_bar">
                <img src="' . $path . 'assets/icons/menu_book_black.svg" height=40 width=40>
            </a>';
    }

    function getCategoryIndicator($text) {
        echo '<div class="_categories_categoryIndicator" id="category_' . $text . '">'.  $text . '</div>';
    }

    function getAllCategoryRestaurants($cat, $items){
        getCategoryIndicator($cat["nameCategory"]);
        echo '<div class="_restaurantRow">';
        foreach($items as $item){
            if ($item["categoryID"] == $cat["categoryID"])
                getRestaurantCard('../../', false, $item);
        }
        echo '</div>';
    }
?>