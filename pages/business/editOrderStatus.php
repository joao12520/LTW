<?php

$orderID;
$state;

if (isset($_POST["orderID"]) && isset($_POST["state"])) {
    $orderID = $_POST["orderID"];
    $state = $_POST["state"];
}

var_dump($orderID);
var_dump($state);

$db = new PDO('sqlite:../../Database/database.db');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

/** Query para lista de orders */
$stmt = $db->prepare('SELECT orderStatus FROM OrderClient WHERE orderID = :o_id');
$stmt->bindParam(":o_id", $orderID, SQLITE3_INTEGER);

/** CHANGE AFTERWARDS HERE TO MAKE IT DYNAMIC, USING GET OR POST*/
$stmt->execute();
$res = $stmt->fetch();

if ($res["orderStatus"] == $state) {
?> <script>
        document.location.href = "../business/viewOrders.php";
    </script>
<?php
} else {
    $stmt2 = $db->prepare('UPDATE OrderClient SET orderStatus = :st WHERE orderID = :id');
    $stmt2->bindParam(":id", $orderID, SQLITE3_INTEGER);
    $stmt2->bindParam(":st", $state);

    /** CHANGE AFTERWARDS HERE TO MAKE IT DYNAMIC, USING GET OR POST*/
    $stmt2->execute();

?>

    <script>
        document.location.href = "../business/viewOrders.php";
    </script>
<?php
}
?>