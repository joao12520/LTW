<?php 
    session_start();

    $rest_id = $_GET['rest_id'];
    $item = $_GET['item_id'];

    if (isset($_SESSION["cart"][$rest_id][$item])) {
        if (!in_array((int)$item, array_keys($_SESSION["cart"][$rest_id]))) {
            return "does not exist";
        } else {
            unset($_SESSION["cart"][$rest_id][$item]);
        }
    }

    echo json_encode($_SESSION["cart"][$res_id]);
?>