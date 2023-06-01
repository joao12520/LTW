<?php
/*Login Script */
// Perform Form Submission Checks

session_start();

extract($_POST);

if (isset($_POST["cardNumber"]) && isset($_POST["cardHolder"]) && isset($_POST["cardMonth"]) && isset($_POST["cardYear"]) && isset($_POST["cvv"])) {
    $cNumber = strip_tags($_POST["cardNumber"]);
    $cHolder = strip_tags($_POST["cardHolder"]);
    $cMonth = strip_tags($_POST["cardMonth"]);
    $cYear = strip_tags($_POST["cardYear"]);
    $c_cvv = strip_tags($_POST["cvv"]);
    $card_holder_ID = $_SESSION['clientID'];
} else {
    echo "error";
    die();
}

// Validation for Visa Card
$teste1 = preg_match('/4[0-9]{12}(?:[0-9]{3})/', $cNumber);
/* var_dump($teste1); */

$month_cmp = intval($cMonth);
$teste2 = (intval($month_cmp) >= 0 && $month_cmp <= 12);
/* var_dump($teste2); */

$year_cmp = intval("20" . $cYear);
$teste3 = ($year_cmp >= date("Y"));;
/* var_dump($teste3);*/

$teste4 = (strlen($c_cvv) == 3);
/* var_dump($teste4); */

if (!($teste1 && $teste2 && $teste3 && $teste4)) {
    echo "error";
?> <script>
        alert("One of your inputs was not valid");
        document.location.href = "../personal/index.php";
    </script>
<?php
    die();
}

/**ELSE IS VALID AND CONTINUE */

// Validate form input date using PHP and sqlite3 best practices to avoid SQLI injections
// Connect to DB

$db = new PDO('sqlite:../../Database/database.db');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

/* Query 1 */
$query1 = $db->prepare('SELECT * FROM CreditCard WHERE clientID = :id');
$query1->bindParam(':id', $card_holder_ID);
$query1->execute();
$teste = $query1->fetch();

$action_type = "update";

if ($teste != false) {
    $query1 = $db->prepare('UPDATE CreditCard
                            SET cardNumber = :c_Number, expirationMonth = :exp_m, expirationYear = :exp_y, cvv = :cvv_
                            WHERE clientID = :id');
    $query1->bindParam(':c_Number', $cNumber);
    $query1->bindParam(':exp_m', $cMonth);
    $query1->bindParam(':exp_y', $cYear);
    $tmp = hash('sha256', $c_cvv);
    $query1->bindParam(':cvv_', $tmp);
    $query1->bindParam(':id', $card_holder_ID);
    $query1->execute();

} else {
    $query1 = $db->prepare('INSERT INTO CreditCard(cardNumber, expirationMonth, expirationYear, cvv, clientID) 
                            VALUES (:c_Number, :exp_m, :exp_y, :cvv_ , :id)');

    $query1->bindParam(':c_Number', $cNumber);
    $query1->bindParam(':exp_m', $cMonth);
    $query1->bindParam(':exp_y', $cYear);
    $tmp = hash('sha256', $c_cvv);
    $query1->bindParam(':cvv_', $tmp);
    $query1->bindParam(':id', $card_holder_ID);
    $query1->execute();

    $action_type = "insert"; 
}

?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Sem permissão</title>    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../styles.css" rel="stylesheet">
        <script src="../../script.js"></script> 
        <script>
            var act_type = "<?php echo $action_type ?>";
            if (act_type == "update") {
                alert("Update of card was successful");
            } else {
                alert("Card was inserted in our database!")
            }
            window.onload = function(e) {
                var timeLeft = 6;
                function redirectSucess() {
                    timeLeft -= 1;
                    document.getElementById("timeleft").innerHTML = "Vai ser redirecionado em " + timeLeft + " segundos";
                    if (timeLeft <= 0) window.location = "../main/index.php";
                }

                function redirectFail() {
                    timeLeft -= 1;
                    document.getElementById("timeleft").innerHTML = "Vai ser redirecionado em " + timeLeft + " segundos";
                    if (timeLeft <= 0) window.location = "../main/index.php";
                }

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        if (this.responseText == "success") {
                            document.getElementById("status").innerHTML = "Pedido encomendado";
                            setInterval(redirectSucess, 1000);
                        } else {
                            document.getElementById("status").innerHTML = "Falha ao pedir";
                            setInterval(redirectFail, 1000);
                        }
                    }
                }
                xmlhttp.open("get", "../../methods/finish_purchase.php?rest_id=" + document.getElementById("status").getAttribute("data-id"), true);
                xmlhttp.send();
            }
        </script>
    </head>
    <body>
        <div class="construct">
            <img src = "../../assets\img\logo.png" alt="App Logo SVG" width=500/>
            <h1 id="status" <?php echo 'data-id=' . $_POST['rest_id']; ?>> A realizar pedido </h1>
            <h3 id="timeleft">  </h3>
        <div>
    </body>
    <footer>
    </footer>
</html>
