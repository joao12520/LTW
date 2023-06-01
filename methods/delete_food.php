<?php
    session_start();
    $orderID = $_GET["food_id"];
    $db = new PDO('sqlite:../Database/database.db');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    if (!isset($_SESSION['clientID'])) {
        echo 'failed2';
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
            $stmt = $db->prepare('DELETE FROM Menu_Item WHERE itemID = :i_id;');

            $stmt->bindParam(":i_id", $orderID, SQLITE3_INTEGER);
            
            $stmt->execute();

            echo 'success';
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        echo 'failed';
        die();
    }
?>