<!DOCTYPE html>

<html lang="en-US">

<head>
    <title>Página Pessoal</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../styles.css" rel="stylesheet">
    <link rel="stylesheet" href="personal.css">
    <script defer type="text/javascript" src="edit.js">

    </script>

    <script defer type="text/javascript" src="../../script.js"> </script>
    <script>
        if (location.href == 'http://localhost:9000/pages/personal')
            location.href = '../pages/personal/index.php'
    </script>

</head>
-<?php
    require_once('../../components/TopBar/index.php');
    require('../../components/SearchComponent/index.php');
    session_start();
    getTopBar("../../");
    ?>

<?php

$db = new PDO('sqlite:../../Database/database.db');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$stmt = $db->prepare('SELECT * FROM Client WHERE clientID = :id');
/** CHANGE AFTERWARDS HERE TO MAKE IT DYNAMIC, USING GET OR POST*/
$stmt->bindParam(':id', $_SESSION['clientID']);
$stmt->execute();

$items = $stmt->fetch();

$path = "../../assets/";
($items["profilePhoto"] == NULL) ? $path .= "UserPhotos/no_photo.jpg" : $path .= $items["profilePhoto"];

function getClientOrders($db)
{
    $query1 = $db->prepare('SELECT * FROM OrderClient INNER JOIN Restaurant ON (Restaurant.restaurantID = OrderClient.restaurantID AND OrderClient.clientID = :id)');
    $query1->bindParam(':id', $_SESSION['clientID']);
    $query1->execute();
    return $query1->fetchAll();
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

function createOrderNumberedPreview($db, $order)
{
?>

    <div class="_foodCard_editCard">
        <div class="_foodCard_editCardNameBar">
            <div>
                <input style="width: 50vw;" class="_foodCard_editCardName" type="text" <?php echo 'id="foodCardName' . $order['orderID'] . '"'; ?> name="foodCardName" value="<?php echo 'OrderID: #' . $order['orderID'] . '     |   Restaurant: ' . $order["name"] . '     |   Status: ' . $order['orderStatus'] ?>" maxlength="70" readonly="true">
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
                </div>
            </div>
        </div>
    </div>
<?php } ?>



<body>
    <div class="container">
        <div class="profile-box">

            <div class="image-c">
                <img src="<?php echo $path ?>" class="profile-pic">
                <a>

                    <button type="button" class="orders-profile-btn">
                        <span> Orders</span>
                    </button>
                    <button type="button" class="edit-profile-btn">
                        <span> Edit</span>
                    </button>
                </a>
            </div>
            <h3> <?php echo $items["username"] ?> </h3>
            <p> Telemóvel: <?php echo $items["phoneNumber"] ?> </p>

            <button onclick="location.href='../creditCard/index.php';" type="button">Multibanco</button>

            <div class="profile-bottom">
                <p>Introduz o teu cartão multibanco no botão acima.</p>
            </div>

        </div>

        <div class="profile-box-edit hide">

            <div class="image-c">
                <img src="<?php echo $path ?>" class="profile-pic">
                <a>
                    <button type="button" class="return-profile-btn">
                        <span> Return </span>
                    </button>
                </a>
            </div>
            <form style="border:none !important" class="form-c" method="POST" id="registerForm" action="editVal.php" enctype="multipart/form-data">

                <div class="usernameReg">
                    <label class="input-label" for="username"><b>Utilizador:</b></label>
                    <input type="text" placeholder="Nome de Utilizador" name="username" value="<?php echo $items["username"] ?>" required>

                </div>

                <div class="passwordReg">
                    <label class="input-label" for="password"><b>Palavra-passe:</b></label>
                    <input type="password" placeholder="Senha" name="password" required>

                </div>

                <div class="password2Reg">
                    <label class="input-label" for="password2"><b>Confirme a sua Palavra-passe:</b></label>
                    <input type="password" placeholder="Repita a sua senha" name="password2" required>

                </div>

                <div class="contactoReg">
                    <label class="input-label" for="contact"><b>Contacto:</b></label>
                    <input type="text" placeholder="Telemóvel/Telefone" name="contact" value="<?php echo $items["phoneNumber"] ?>" rrequired>

                </div>

                <div class="moradaReg">
                    <label class="input-label" for="address"><b>Morada:</b></label>
                    <input type="text" placeholder="Introduza a sua morada" name="address" value="<?php echo $items["address"] ?>" rrequired>

                </div>

                <div class="photoReg">
                    <label class="input-label" for="photo"><b>Foto de perfil: </b></label>
                    <input type="file" name="photo">

                </div>

                <div id="result"></div>

                <div class="button-container">
                    <button id="edit-submit"> Editar </button>

                </div>

            </form>


        </div>

        <div style="width: 70%; height: 70%" class="profile-box-orders hide">
            <a>

                <div class="image-c">
                    <a>
                        <button type="button" class="return-profile-orders-btn">
                            <span> Return </span>
                        </button>
                    </a>
                </div>

            </a>
            <h1 style="padding-bottom: 1em; color: black;"> Your Orders </h1>
            <?php $orders = getClientOrders($db);
            /* var_dump($orders); */
            foreach ($orders as $order) {

                echo createOrderNumberedPreview($db, $order);
            } ?>

        </div>




</body>

</html>