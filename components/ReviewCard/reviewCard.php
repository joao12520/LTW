<?php function createReviewCard($review, $title)
{ ?>
    <div class="_reviewCard_cardReview">
        <div class="_reviewCard_header">
            <?php echo '<p class="_reviewCard_user">' .$review['username'] . '</p>';
            ?>
            <?php echo getRestReviewStars($review['score']); ?>
        </div>
        <p class="_reviewCard_comment"> <?php echo htmlspecialchars($review['comment']) ?> </p>
    </div>
    <?php 
        if ($review['response'] != NULL) {
    echo '<div class="_reviewCard_cardReviewResponse">
            <div class="_reviewCard_header">
                <p class="_reviewCard_user">' . $title . ' </p>
            </div>
            <p class="_reviewCard_comment"> ' . htmlspecialchars($review['response']) . ' </p>
        </div>';
        }
    ?>
<?php } ?>



<?php function createReview($title)
{ ?>
    <div id="_reviewCard_reviewFormSubmit" class="_reviewCard_writeCard">
        <p class="_reviewCard_user"> Avaliar restaurante: </p>
        <div class="_reviewCard_avalInput"> 
            <img id="_reviewCard_avalStar1" class="_avaluation_restCommentReviewSingleStar" src="../../assets/icons/star_border_black.svg" alt="full star" onclick="avalStars(1)" > </img>
            <img id="_reviewCard_avalStar2" class="_avaluation_restCommentReviewSingleStar" src="../../assets/icons/star_border_black.svg" alt="full star" onclick="avalStars(2)" > </img>
            <img id="_reviewCard_avalStar3" class="_avaluation_restCommentReviewSingleStar" src="../../assets/icons/star_border_black.svg" alt="full star" onclick="avalStars(3)" > </img>
            <img id="_reviewCard_avalStar4" class="_avaluation_restCommentReviewSingleStar" src="../../assets/icons/star_border_black.svg" alt="full star" onclick="avalStars(4)" > </img>
            <img id="_reviewCard_avalStar5" class="_avaluation_restCommentReviewSingleStar" src="../../assets/icons/star_border_black.svg" alt="full star" onclick="avalStars(5)" > </img>
        </div>
        <input restID="<?php echo $title ?>" id="_reviewCard_avalInput" name="_reviewCard_avalInput" class="_reviewCard_avalNumberInput" type="number" min="1" max="5" value="0"></input>
        <textarea class="_reviewCard_writeText" name="_reviewCard_writeText" id="_reviewCard_avalTextArea" maxlength="150"></textarea>
        <button class="_reviewCard_submitButton" onClick="reviewSubmit()"> Submeter Avaliação </button>
    </div>
<?php } ?>

