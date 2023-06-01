<?php 
    session_start();

    $rest_id = $_GET['rest_id'];
    $item = $_GET["item_id"];
    $qtd = $_GET["qtd"];

    if (isset($_SESSION["cart"][$rest_id][$item])) {
        $_SESSION["cart"][$rest_id][$item] += $qtd;
    } else {
        $_SESSION["cart"][$rest_id][$item] = $qtd;
    }

    echo json_encode(array($rest_id, $item));
?>