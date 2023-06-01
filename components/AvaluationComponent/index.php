<?php
    function getCarouselStars($aval) {
        echo '<div class="_avaluation_carouselStars">';
        $stars = 0;
        while($aval > 0.5) {
            echo '<img src="../../assets/icons/star_black.svg" alt="full star"> </img>';
            $aval--;
            $stars++;
        }
        if ($aval == 0.5) {
            echo '<img src="../../assets/icons/star_half_black.svg" alt="half star"> </img>';
            $aval = 0;
            $stars++;
        }
        while($stars != 5.0) {
            echo '<img src="../../assets/icons/star_border_black.svg" alt="empty star"> </img>';
            $stars++;
        }
        echo '</div>';
    }

    function getSearchStars($aval) {
        $response = '';
        $response .= '<div class="_avaluation_searchStars">';
        $stars = 0;
        while($aval > 0.5) {
            $response .= '<img src="../../assets/icons/star_black.svg" alt="full star"> </img>';
            $aval--;
            $stars++;
        }
        if ($aval == 0.5) {
            $response .= '<img src="../../assets/icons/star_half_black.svg" alt="half star"> </img>';
            $aval = 0;
            $stars++;
        }
        while($stars != 5.0) {
            $response .= '<img src="../../assets/icons/star_border_black.svg" alt="empty star"> </img>';
            $stars++;
        }
        $response .= '</div>';
        return $response;
    }

    function getRestPageStars($aval) {
        echo '<div class="_avaluation_restPageStars">';
        $stars = 0;
        while($aval > 0.5) {
            echo '<img class="_avaluation_restPageSingleStar" src="../../assets/icons/star_black.svg" alt="full star"> </img>';
            $aval--;
            $stars++;
        }
        if ($aval == 0.5) {
            echo '<img class="_avaluation_restPageSingleStar" src="../../assets/icons/star_half_black.svg" alt="half star"> </img>';
            $aval = 0;
            $stars++;
        }
        while($stars != 5.0) {
            echo '<img class="_avaluation_restPageSingleStar" src="../../assets/icons/star_border_black.svg" alt="empty star"> </img>';
            $stars++;
        }
        echo '</div>';
    }
    function getRestReviewStars($aval) {
        echo '<div class="_avaluation_restPageStars">';
        $stars = 0;
        while($aval > 0.5) {
            echo '<img class="_avaluation_restReviewSingleStar" src="../../assets/icons/star_black.svg" alt="full star"> </img>';
            $aval--;
            $stars++;
        }
        if ($aval == 0.5) {
            echo '<img class="_avaluation_restReviewSingleStar" src="../../assets/icons/star_half_black.svg" alt="half star"> </img>';
            $aval = 0;
            $stars++;
        }
        while($stars != 5.0) {
            echo '<img class="_avaluation_restReviewSingleStar" src="../../assets/icons/star_border_black.svg" alt="empty star"> </img>';
            $stars++;
        }
        echo '</div>';
    }

    
?>
