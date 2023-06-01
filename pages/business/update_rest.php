<?php
    session_start();

    $restID = $_POST["_businessPage_restID"];
    $restName = $_POST["_businessPage_restName"];
    $restLoc = $_POST["_businessPage_restLoc"];

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

            $query2 = $db->prepare('UPDATE Restaurant SET name = :item_name, location = :item_loc WHERE restaurantID = :item_id;');
            $query2->bindParam(":item_name", $restName);
            $query2->bindParam(":item_loc", $restLoc);
            $query2->bindParam(":item_id", $restID, SQLITE3_INTEGER);
            
            if(!$query2->execute()) echo $query2->error;
        
            echo 'success';
            header('Location: index.php');
        } catch (PDOException $e) {
            header('Location: index.php');
            echo $e->getMessage();
        }
    } else {
        header('Location: index.php');
        echo 'failed';
        die();
    }
    header('Location: index.php');
?>
