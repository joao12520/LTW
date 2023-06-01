<?php 
    session_start();


    if ($_SESSION["clientID"] == NULL) {
        echo 'Failed: No user logged';
        exit();
    }

    $db = new PDO('sqlite:../../Database/database.db');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $aval = $_GET["aval"];
    $rev = $_GET["rev"];
    $rest = $_GET["restID"];
    $client = $_SESSION["clientID"];


    $stmt2 = $db->prepare("SELECT * FROM Restaurant_Review WHERE restaurantID = '$rest' AND clientID = '$client' ORDER BY restaurantID DESC LIMIT 1");

    $stmt2->execute();

    $items2 = $stmt2->fetchAll();

    var_dump($items2);

    //echo 'aval:' . $aval . ' rev:' . $rev . ' rest:' . $rest . 'client: ' . $client;
    
    try {
        global $items2;
        global $aval;
        global $rev;
        global $rest;
        global $client;
        
        if (count($items2) > 0) {
            $db = new PDO('sqlite:../../Database/database.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare('INSERT INTO Restaurant_Review (restaurant_id, clientID, score, comment, response VALUES (?,?,?,?,?)');
            $stmt->execute();
            echo 'Sucess Updated!';
        } else {
            $db = new PDO('sqlite:../../Database/database.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Restaurant_Review (restaurantID, clientID, score, comment)
            VALUES ('$rest', '$client', '$aval', '$rev')";
 
            $db->exec($sql);
            echo 'Sucess Added!';
        }
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
    
?>