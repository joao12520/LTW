<?php 
    session_start();

    $rest_id = $_GET['rest_id'];

    try {
        global $rest_id;
        $db2 = new PDO('sqlite:../Database/database.db');
        $db2->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stmt0 = $db2->prepare('SELECT orderID FROM OrderClient ORDER BY orderID DESC LIMIT 1');

        $stmt0->execute();

        $items0 = $stmt0->fetchAll();

        $order = $items0[0]["orderID"] + 1;
        
        $user_id = $_SESSION["clientID"];
        $db = new PDO('sqlite:../Database/database.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO OrderClient (orderID, restaurantID, clientID, orderStatus)
            VALUES ('$order', '$rest_id', '$user_id', 'Received')";
        $db->exec($sql);
        foreach(array_keys($_SESSION["cart"][$rest_id]) as $item) {
            $item_qtd = $_SESSION["cart"][$rest_id][$item];
            $sql2 = "INSERT INTO OrderItem (itemID, quantity, orderID) VALUES ('$item', '$item_qtd', '$order')";
            $db->exec($sql2);
        }

        unset($_SESSION["cart"][$rest_id]);

        echo "success";

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>
