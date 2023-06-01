<?php 
    session_start();

    $rest_id = $_GET["rest_id"];

    $db = new PDO('sqlite:../Database/database.db');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    $response = '';
    if (isset($_SESSION["cart"][$rest_id])) {
        global $db;
        foreach (array_keys($_SESSION["cart"][$rest_id]) as $order) {
                $query1 = $db->prepare('SELECT * FROM Menu_Item
                            WHERE itemID = :itemID');
            $query1->bindParam(':itemID', $order);
            $query1->execute();

            $items = $query1->fetchAll();
            $response .= '<div  data-itemID="' . $order . '" id="_cartModal_product' . $order . '" class="_cartModal_product">
                            <div>
                                ' . $items[0]["nameMenuItem"] . '
                            </div>
                            <div>
                                ' . $_SESSION["cart"][$rest_id][$order] . '
                            </div>
                            <div>
                                ' . $_SESSION["cart"][$rest_id][$order] * $items[0]["price"]  . '
                            </div>
                            <button onclick=removeFromCart(' . '"_cartModal_product' . $order . '");>
                                X
                            </button>
                        </div>';
        }

        $response .= '<button class="_restPage_purchaseCart" onClick="purchaseCart()"> Comprar </button>';

        echo json_encode(array(count($_SESSION["cart"][$rest_id]), $response));
    } else {
        echo json_encode(array(0, $response));
    }
?>