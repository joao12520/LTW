<?php $db = new PDO('sqlite:../../Database/database.db');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

/* Query 1 */
$stmt = $db->prepare('SELECT CartItem.itemID, Menu_Item.nameMenuItem, CartItem.quantity, Menu_Item.photo, Menu_Item.price
                      FROM Cart INNER JOIN CartItem ON (Cart.cartID = CartItem.cartID) INNER JOIN Menu_Item ON (CartItem.itemID == Menu_Item.itemID)
                      WHERE Cart.clientID == 1 /** ? */
                    ');
/* $stmt->bindParam(1, $_SESSION['clientID'], SQLITE3_INTEGER); */
$stmt->execute();
$items = $stmt->fetchAll();

$array_to_send = json_encode($items);

?>

<script type="text/javascript"> let productsInCart = <?php echo $array_to_send ?>; </script>