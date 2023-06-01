<?php
session_start();

$phrase  = $_POST['_businessAddRest_restName'];
$threats = array(" ", ".", "/", "\\");
$safe  = array("", "", "", "");

$newphrase = str_replace($threats, $safe, $phrase);

echo '<p>newphrase</p>';
var_dump($newphrase);
echo '<p>newphrase</p>';

$originalFileName = "../../assets/tmpPics/" . $newphrase . ".jpg";

var_dump($_FILES['_businessAddRest_restImgInput']['tmp_name']);

try {
    global $_FILES;
    global $originalFileName;
    $db = new PDO('sqlite:../../Database/database.db');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt2 = $db->prepare('SELECT restaurantID FROM Restaurant ORDER BY restaurantID DESC LIMIT 1');

    $stmt2->execute();

    $items2 = $stmt2->fetchAll();

    $rest_id = $items2[0]["restaurantID"] + 1;

    /** Even if there are html or scripts tags, they won't be output into DB */
    $rest_name = strip_tags($_POST['_businessAddRest_restName']);
    $rest_category = strip_tags($_POST['_businessAddRest_foodTypes']);
    $rest_location = strip_tags($_POST['_businessAddRest_restLoc']);
    $rest_opening = strip_tags($_POST['_businessAddRest_restOpening']);
    $rest_closing = strip_tags($_POST['_businessAddRest_restClosing']);

    /** Quick verification for invalid hour format */
    $teste1 = preg_match('/(00|[01][0-9]|2[0-3]):([0-5][0-9])/', $rest_opening);
    $teste2 = preg_match('/(00|[01][0-9]|2[0-3]):([0-5][0-9])/', $rest_closing);

    if (!($teste1 && $teste2)) {
        echo "error";
        die();
    }

    $rest_img = strip_tags("tmpPics/" . $newphrase . ".jpg");
    $rest_owner = $_SESSION["clientID"];

    echo '<p>ayo!</p>';
    echo $rest_owner;
    echo '<p>ayo!</p>';

    $db = new PDO('sqlite:../../Database/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO Restaurant (restaurantID, name, categoryID, location, photo, clientID)
        VALUES ('$rest_id', '$rest_name', '$rest_category', '$rest_location', '$rest_img', '$rest_owner')";
    echo '<p>ayo!</p>';
    echo $rest_id;
    echo '<p>ayo!</p>';
    $sql2 = "INSERT INTO Opening_Hours(restaurantID, opening, closing) VALUES ('$rest_id', '$rest_opening', '$rest_closing')";
    //INSERT INTO Restaurant(restaurantID, name, foodType, location, photo) VALUES (1, "McDonalds", "Burgers", "Vila Nova de Gaia", "PhotosRestaurants/mcdonalds.jpg");
    move_uploaded_file($_FILES['_businessAddRest_restImgInput']['tmp_name'], $originalFileName);
    $db->exec($sql);
    $db->exec($sql2);
    header("Location: status.php?st=1");
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
    header("Location: status.php?st=0");
}

$db = null;
    //header("Location: index.php");
