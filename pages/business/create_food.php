<?php
    session_start();
    var_dump($_POST);

    $restID = $_POST["addfoodCardRest"];
    $itemName = $_POST["addfoodCardTitle"];
    $itemPrice = $_POST["addfoodCardPrice"];
    $itemDescription = $_POST["addfoodCardDescription"];

    $db = new PDO('sqlite:../../Database/database.db');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    if (!isset($_SESSION['clientID'])) {
        echo 'failed';
        header('Location: index.php');
        die();
    }

    $stmt = $db->prepare('SELECT * FROM Restaurant INNER JOIN Client ON Client.clientID = Restaurant.clientID WHERE Client.clientID = :client_id AND Restaurant.restaurantID = :rest_id');
    $stmt->bindParam(":client_id", $_SESSION['clientID'], SQLITE3_INTEGER);
    $stmt->bindParam(":rest_id", $restID, SQLITE3_INTEGER);

    $stmt->execute();

    $items = $stmt->fetchAll();

    if (count($items) > 0) {
        try {
            global $db;
            $db2 = new PDO('sqlite:../../Database/database.db');
            $query1 = $db2->prepare('SELECT itemID FROM Menu_Item ORDER BY itemID DESC LIMIT 1;');
            $query1->execute();
            $items0 = $query1->fetchAll();


            $itemID = $items0[0]["itemID"] + 1;

            $query2 = $db->prepare('INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) 
            VALUES (:item_id, :item_name, :item_category, :item_price, :item_stock, :item_descr, :item_photo, :item_rest);');
            var_dump($query2);
            $query2->bindParam(":item_id", $itemID, SQLITE3_INTEGER);
            $query2->bindParam(":item_name", $itemName);
            $query2->bindValue(":item_category", 1, SQLITE3_INTEGER);
            $query2->bindParam(":item_price", $itemPrice);
            $query2->bindValue(":item_stock", 100);
            $query2->bindParam(":item_descr", $itemDescription);
            $query2->bindValue(":item_photo", "MenuRestPhotos/McDonalds/3.jpeg");
            $query2->bindParam(":item_rest", $restID, SQLITE3_INTEGER);


            echo $query2->execute();

            header('Location: index.php');
            echo 'success';
        } catch (PDOException $e) {
            header('Location: index.php');
            echo $e->getMessage();
        }
    } else {
        echo 'failed';
        header('Location: index.php');
        die();
    }
?>
