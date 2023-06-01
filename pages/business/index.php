<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Empresa</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../styles.css" rel="stylesheet">
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
?> <script>
    window.location.replace("../error/denied.php");
</script> <?php
    }
?>
<body>
    <div class="_businessPage_restListTitle">
        Restaurants
    </div>
        <div class="_businessPage_restList">
            <?php 

                $db = new PDO('sqlite:../../Database/database.db');
                $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                $teste = $db->prepare('SELECT * FROM restaurant WHERE Restaurant.clientID = :id');
                $teste->bindParam(":id", $_SESSION["clientID"], SQLITE3_INTEGER);

                $teste->execute();
                $rests = $teste->fetchAll();

                foreach($rests as $rest) {
                    getRestaurantOwnerInfo($rest);
                }
            ?>
        </div>
        <div id="_businessPage_addFoodCardWrapper" class="_businessPage_addFoodCardWrapper _businessPage_addFoodCardWrapperHidden">
            <form action="create_food.php" enctype="multipart/form-data" method="POST" id="_businessPage_addFoodCard" class="_businessPage_addFoodCard _businessPage_addFoodCardHidden">
                <div class="_foodCard_addCardDetails" <?php echo 'id="_foodCard_addId' . $item['itemID'] . '"'; ?>>
                    <div style="background-image: url(' <?php echo $realpath ?>')" class="_foodCard_addCardCardImage" >
                    </div>
                </div>
                <div class="_foodCard_addCardDescriptionBox">
                    <input id="_foodCard_addCardRestID" style="display: none;" type="number" name="addfoodCardRest" value="0">
                    <div>
                        Nome do Prato:
                        <input class="_foodCard_addCardTitle" type="text" required name="addfoodCardTitle" min="0" value="Nome do Prato" step=".01">
                    </div>
                    <div>
                        Descrição:
                        <br>
                        <textarea class="_foodCard_addCardDescription" name="addfoodCardDescription" value="Breve descrição do prato." maxlength="300">
                        </textarea>
                    </div>
                    <div>
                        Preço:
                        <input class="_foodCard_addCardPrice" type="number" required name="addfoodCardPrice" min="0" value="1.00" step=".01">
                        €
                    </div>
                </div>
                <div class="_foodCard_addCardButtonBox">
                    <button type="submit" >
                        Create
                    </button>
                    <div onClick="closeFoodCardAdder()">
                        Close 
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
</footer>

</html>