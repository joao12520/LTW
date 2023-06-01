<?php
    session_start();
    $orderID = $_GET["food_id"];
    $orderName = $_GET["title"];
    $orderPrice = $_GET["price"];
    $orderDesc = $_GET["descr"];

    $db = new PDO('sqlite:../Database/database.db');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    if (!isset($_SESSION['clientID'])) {
        echo 'no session';
        die();
    }

    $stmt = $db->prepare('SELECT nameMenuItem FROM Menu_Item INNER JOIN Restaurant ON Menu_Item.restaurantID = Restaurant.restaurantID INNER JOIN Client ON Client.clientID = Restaurant.clientID WHERE Client.clientID = :client_id AND Menu_Item.itemID = :item_id;');
    $stmt->bindParam(":client_id", $_SESSION['clientID'], SQLITE3_INTEGER);
    $stmt->bindParam(":item_id", $orderID, SQLITE3_INTEGER);

    $stmt->execute();

    $items = $stmt->fetchAll();

    if (count($items) > 0) {
        try {
            global $db;
            $stmt2 = $db->prepare('UPDATE Menu_Item SET nameMenuItem = :item_name, price = :item_price, description = :item_desc WHERE itemID = :item_id;');
            $stmt2->bindParam(":item_name", $orderName);
            $stmt2->bindValue(":item_price", $orderPrice);
            $stmt2->bindParam(":item_desc", $orderDesc);
            $stmt2->bindParam(":item_id", $orderID);

            if(!$stmt2->execute()) echo $stmt->error;

            echo "success";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        echo 'no permission';
        die();
    }
?>