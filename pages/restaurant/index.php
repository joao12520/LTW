<!DOCTYPE html>
<html lang="en-US">

<head>
    <?php
    $title = $_GET['rest_id'];
    $db = new PDO('sqlite:../../Database/database.db');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    /* Query 1 */
    $stmt = $db->prepare('SELECT name FROM Restaurant WHERE restaurantID = ?');
    $stmt->bindParam(1, $title, SQLITE3_INTEGER);
    $stmt->execute();
    $items = $stmt->fetchAll();

    $rest_name = $items[0]["name"];

    if ($title == NULL) {
        header("Location: ../error/notfound.php");
    }
    ?>
    <title>
        <?php echo $rest_name ?>
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../styles.css" rel="stylesheet">
    <script defer src="../../script.js"></script>
    <script>
        if (location.href == 'http://localhost:9000/pages/restaurant')
            location.href = '../pages/restaurant/index.php'
    </script>
</head>
<?php
require_once('../../components/TopBar/index.php');
require('../../components/SearchComponent/index.php');
require_once('../../components/Footer/index.php');
require_once('../../components/AvaluationComponent/index.php');
require_once('../../components/Food_Card/menu_card.php');
require_once('../../components/ReviewCard/reviewCard.php');
require('../../components/CartModal/shoppingCart.php');

$db = new PDO('sqlite:../../Database/database.db');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

/* Query 1 */
$stmt = $db->prepare('SELECT * FROM Menu_Item WHERE restaurantID = ?');
$stmt->bindParam(1, $title, SQLITE3_INTEGER);
$stmt->execute();
$items = $stmt->fetchAll();


/* Query 2 */
$stmt2 = $db->prepare('SELECT * FROM Restaurant WHERE restaurantID = ?');
$stmt2->bindParam(1, $title, SQLITE3_INTEGER);
$stmt2->execute();
$rest = $stmt2->fetch();

/* Query 3 */
$stmt3 = $db->prepare('SELECT Client.username, Restaurant_Review.comment, Restaurant_Review.score, Restaurant_Review.response
                        FROM Restaurant_Review INNER JOIN Client ON (Client.clientID == Restaurant_Review.clientID) 
                        WHERE restaurantID = :i');
$stmt3->bindParam(':i', $title, SQLITE3_INTEGER);

$stmt3->execute();
$reviews = $stmt3->fetchAll();
?>

<body>
    <div>
        <?php getTopBar("../../") ?>
        <div class="_restPage_container">
            <div class="_restPage_header">
                <div class="_restPage_nameLoc">
                    <h1 class="_restPage_restName"> <?php echo $rest['name'] ?></h1>
                    <div class="_restPage_restLoc">
                        <img src="../../assets/icons/location-sign.svg" width=24>
                        <?php echo $rest['location'] ?>
                    </div>
                </div>
                <div class="_restPage_restAvgReviews">
                    <?php
                    getRestPageStars(3.5);
                    echo '
                        <button onclick="restPageAddToFav(' . $title . ');" class="_restPage_addToFavButton"> 
                            Favorito 
                            <img src="../../assets/icons/star_black.svg" height=28> 
                        </button>';
                    ?>
                </div>
            </div>
            <div class="_restPage_body">
                <div class="_restPage_categ">
                    <p> Categoria 1 </p>
                    <p> Categoria 2 </p>
                    <p> Categoria 3 </p>
                    <p> Categoria 4 </p>
                    <p> Categoria 5 </p>
                    <p> Categoria 6 </p>
                    <p> Categoria 7 </p>
                    <p> Categoria 8 </p>
                    <p> Categoria 9 </p>
                    <p> Categoria 10 </p>
                    <p> Categoria 11 </p>
                    <p> Categoria 12 </p>
                </div>
                <div class="_restPage_cardDisplay">
                    <?php
                    foreach ($items as $item) {
                        createMenuItemCard($item);
                    }
                    ?>
                </div>
            </div>
            <div class="_restPage_aval">
                <h2 class="_restPage_reviewTitle"> Reviews </h2>
                <?php
                foreach ($reviews as $review) {
                    createReviewCard($review, $rest_name);
                }
                createReview($title);
                ?>
            </div>
        </div>
    </div>

    <div id="_restPage_cartButton" class="_restPage_cartButton" onclick="openRestCart('_restPage_cartButton')">
        <img src="../../assets/icons/shopping_basket.svg">
        <div id="_restPage_cartAmmount" class="_restPage_cartAmmount">
            0
        </div>
    </div>
    <div id="cartModal" class="_restPage_cartModal _restPage_cartModalClosed" data-restID="<?php echo $title; ?>">
    </div>
    <div id="purchaseModalWrapper" class="_restPage_purchaseModalWrapper _restPage_purchaseModalHidden">
        <div id="purchaseModal" class="_restPage_purchaseModal _restPage_purchaseModalHidden">
            <div class="_purchaseModal_descQtd">
                <div class="_purchaseModal_desc">
                    <img id="_purchaseModal_foodImg" src="../../assets/img/rest_preview.svg">
                    </img>
                    <h1 id="_purchaseModal_foodName" foodId="0">
                        FoodName
                    </h1>
                </div>
                <div class="_purchaseModal_qtd">
                    <button class="_purchaseModal_addToCart" id="_purchaseModal_minus" onclick="foodModalRem()">
                        -
                    </button>
                    <h2 id="_purchaseModal_qtd" class="_purchaseModal_qtd_number">
                        1
                    </h2>
                    <button class="_purchaseModal_addToCart" id="_purchaseModal_plus" onclick="foodModalAdd()">
                        +
                    </button>
                </div>
            </div>
            <div class="_purchaseModal_buttons">
                <button class="_purchaseModal_close" onclick="closeFoodModal()">
                    Cancel
                </button>
                <button id="_purchaseModal_addToCart" class="_purchaseModal_addToCart" onclick="addToCart()">
                    AddToCart
                </button>

                <div>
                    <div id="_purchaseModal_totalPrice" basePrice="2.00f">
                        0
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
getFooter("../../");
?>

</html>