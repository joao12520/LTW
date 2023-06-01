<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Empresa</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../styles.css" rel="stylesheet">
    <link href="viewOrders.css" rel="stylesheet">
    <script src="../../script.js"></script>
    <script src="edit.js"></script>

    <script>
        if (location.href == 'http://localhost:9000/pages/business')
            location.href = '../pages/business/index.php'
    </script>
</head>

<?php
session_start();
require_once('../../components/TopBar/index.php');
require('../../components/SearchComponent/index.php');
require('../../components/AvaluationComponent/index.php');
require('../../components/RestaurantOwnerInfo/index.php');
require('../../components/RestaurantCard/index.php');
require('../../components/Food_Card/menu_card.php');

getTopBar("../../");

if (!$_SESSION["isAdmin"]) {
    ?> <script> window.location.replace("../error/denied.php");</script> <?php
}



$db = new PDO('sqlite:../../Database/database.db');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$teste = $db->prepare('SELECT * FROM restaurant WHERE Restaurant.clientID = :id');
$teste->bindParam(":id", $_SESSION["clientID"], SQLITE3_INTEGER);

$teste->execute();
$restaurants = $teste->fetchAll();
/** Query para list de items */

function getOrdersFromRestaurant($db, $rest_id)
{
    /** Query para lista de orders */
    $stmt = $db->prepare('SELECT OrderClient.orderID, client_.username, OrderClient.orderStatus, Restaurant.name, Restaurant.photo, Restaurant.location
FROM Client INNER JOIN Restaurant ON (Client.clientID = Restaurant.clientID AND Client.clientID = :id_dono AND Client.isAdmin = 1 AND Restaurant.restaurantID = :rest_id)
INNER JOIN OrderClient ON (Restaurant.restaurantID = OrderClient.restaurantID) 
INNER JOIN Client "client_" ON (client_.clientID = OrderClient.clientID)');
    $stmt->bindParam(":id_dono", $_SESSION["clientID"], SQLITE3_INTEGER);
    $stmt->bindParam(":rest_id", $rest_id, SQLITE3_INTEGER);

    /** CHANGE AFTERWARDS HERE TO MAKE IT DYNAMIC, USING GET OR POST*/
    $stmt->execute();
    $orders = $stmt->fetchAll();

    return $orders;
}

function getItemsFromOrder($db, $order_id)
{
    # MUDAR PARA BINDPARAM ORDERID = O QUE RECEBE DE CIMA
    $stm2 = $db->prepare('SELECT Menu_Item.nameMenuItem, Menu_Item.price, OrderItem.quantity
    FROM OrderClient INNER JOIN OrderItem ON (OrderClient.orderID = OrderItem.orderID AND OrderClient.orderID = :order_id) 
    INNER JOIN Menu_Item ON (Menu_Item.itemID = OrderItem.itemID)');
    $stm2->bindParam(":order_id", $order_id, SQLITE3_INTEGER);
    $stm2->execute();
    $items = $stm2->fetchAll();

    return $items;
}
?>

<body>


    <div class="_businessPage_restListTitle">
        <h1> Orders </h1>
    </div>
    <div class="_businessPage_restList">
        <?php

        foreach ($restaurants as $restaurant) {
            getRestaurantInfo($restaurant, $orders, $db);
        }

        ?>
    </div>
</body>

<?php

?>

<?php
function getRestaurantInfo($restaurant, $orders, $db)
{
?>
    <div class="_businessPage_restContainer" id="_businessPage_previewID<?php echo $restaurant["restaurantID"] ?>">
        <div class="_businessPage_editInfo">
            <?php getRestaurantCard_($restaurant) ?>
            <div class="_businessPage_verticalBox">


            </div>
        </div>

        <div id="_businessPage_foodCards<?php echo $restaurant["restaurantID"] ?>" class="_businessPage_foodCards _businessPage_foodCardsHidden"> <?php
                                                                                                                                                    $items = getOrdersFromRestaurant($db, $restaurant["restaurantID"]);
                                                                                                                                                    foreach ($items as $order) {
                                                                                                                                                        createOrderNumberedPreview($db, $order);
                                                                                                                                                    }
                                                                                                                                                    ?>
            <div class="_businessPage_editButtons">
                <!-- <div id="_businessPage_addButton<?php echo $restaurant["restaurantID"] ?>" class="_businessPage_addButton" onclick="addFoodCards(<?php echo $restaurant["restaurantID"] ?>)">
                    <img src="../../assets/icons/add_black.svg" height=42>
                </div> -->
            </div>
        </div>
        <div id="_businessPage_expandButton<?php echo $restaurant["restaurantID"] ?>" class="_businessPage_expandButton" onclick="expandFoodCards(<?php echo $restaurant["restaurantID"] ?>)">
            <img src="../../assets/icons/expand_more_black.svg">
        </div>
    </div>
<?php
}

function getRestaurantCard_($restaurant)
{
?>

    <a class="_restaurantCard_card _restaurantCard_preview <?php echo $restaurant["restaurantID"] ?>">
        <div class="_restaurantCard_image" id="_restaurantCard_infoImgPreview<?php echo $restaurant["restaurantID"] ?>" style="background-image: url(../../assets/<?php echo $restaurant['photo'] ?>">
        </div>
        <div class="_restaurantCard_aval">
            <span> 4.5 </span>
        </div>
        <div class="_restaurantCard_fav">
            <img src="../../assets/icons/star_border_black.svg" alt="favoriteIcon" width=32 height=32> </img>
        </div>
        <div class="_restaurantCard_info">
            <span class="_restaurantCard_infoName" id="_restaurantCard_infoNamePreview<?php echo $restaurant["restaurantID"] ?>">
                <?php echo $restaurant["name"] ?>
            </span>
            <span class="_restaurantCard_infoLoc" id="_restaurantCard_infoLocPreview<?php echo $restaurant["restaurantID"] ?>">
                <?php echo $restaurant["location"] ?>
            </span>
        </div>
    </a>
<?php
}
?>

<?php function createOrderNumberedPreview($db, $order)
{
?>

    <div class="_foodCard_editCard">
        <div class="_foodCard_editCardNameBar">
            <div>
                <input style="width: 50em;" class="_foodCard_editCardName" type="text" <?php echo 'id="foodCardName' . $order['orderID'] . '"'; ?> name="foodCardName" value="<?php echo 'OrderID: #' . $order['orderID'] . '     |   Client: ' . $order["username"] . '     |   Status: ' . $order['orderStatus'] ?>" maxlength="70" readonly="true">
            </div>
            <div class="_foodCard_buttons">
                <img <?php echo 'id="_foodCard_editCardUpdate' . $order['orderID'] . '"'; ?> class="_foodCard_editCardUpdate _foodCard_editButtonHide" title="Atualizar" src="../../assets/icons/done_black.svg" class="_foodCard_buttonToHide" width=36>
                <img <?php echo 'id="_foodCard_editCardRemove' . $order['orderID'] . '"'; ?>class="_foodCard_editCardRemove _foodCard_editButtonHide" title="Remover" src="../../assets/icons/delete_black.svg" width=36>
            </div>

            <?php echo '
          <div id="_foodCard_editCardExpandButton' . $order['itemID'] . '" class="_foodCard_editCardExpandButton" onclick="expandSingleFoodCard(' . $order["orderID"] . ')">
            <img src="../../assets/icons/expand_more_black.svg" width=36>
          </div>';
            ?>
        </div>
        <div class="_foodCard_editCardDetails _foodCard_editCardDetailsHidden" <?php echo 'id="_foodCard_editId' . $order['orderID'] . '"'; ?>>

            <div class="_foodCard_editCardDescriptionBox">
                <div>
                    <?php $items = getItemsFromOrder($db, $order["orderID"]); ?>
                    <ol class="rectangle-list">
                        <?php foreach ($items as $item) { ?>
                            <li><a><?php echo $item["nameMenuItem"] . "  x  " . $item["quantity"] ?></a></li>

                        <?php } ?>
                    </ol>

                    <form method="post" action="editOrderStatus.php">

                        <input name="orderID" hidden value="<?php echo $order["orderID"] ?>" readonly>
                        <div class="selector">
                            <select name="state">
                                <option value="Received">Received</option>
                                <option value="Being Prepared" selected>Being Prepared</option>
                                <option value="Complete">Complete</option>
                                <option value="Delivering">Delivering</option>
                            </select>
                            <button type="submit"> Update </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
<?php } ?>