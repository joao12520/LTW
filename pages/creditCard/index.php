<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="creditCard.css" rel="stylesheet">
    <script>
        if (location.href == 'http://localhost:9000/pages/creditCard')
            location.href = '../pages/creditCard/index.php'
    </script>
</head>

<?php

session_start();

$c_number = "";
$c_name = "";
$c_month;
$c_year;
$c_cvv;

$db = new PDO('sqlite:../../Database/database.db');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$stmt = $db->prepare('SELECT Client.username, CreditCard.cardNumber, CreditCard.expirationMonth, CreditCard.expirationYear, CreditCard.cvv FROM Client INNER JOIN CreditCard ON (Client.clientID = CreditCard.clientID AND CreditCard.clientID = :id)');
/** CHANGE AFTERWARDS HERE TO MAKE IT DYNAMIC, USING GET OR POST*/
$stmt->bindParam(':id', $_SESSION['clientID'], PDO::PARAM_INT);
$stmt->execute();

$item = $stmt->fetch();

if ($item != NULL) {
    $c_name = $item["username"];
    $c_number = $item["cardNumber"];
    $c_month = $item["expirationMonth"];
    $c_year = $item["expirationYear"];
}

$rest_id = $_GET["rest"];

?>

<body>

    <div class="header">
        <h1>Add a card</h1>
    </div>

    <div class="container">

        <div class="card-container">

            <div class="front">
                <div class="image">
                    <img src="../../assets/img/cardImages/chip.png" alt="">
                    <img src="../../assets/img/cardImages/visa.png" alt="">
                </div>
                <div class="card-number-box"><?php echo $c_number ?></div>
                <div class="flexbox">
                    <div class="box">
                        <span>card holder</span>
                        <div class="card-holder-name"><?php echo $c_name ?></div>
                    </div>
                    <div class="box">
                        <span>expires</span>
                        <div class="expiration">
                            <span class="exp-month"> <?php echo $c_month . " /" ?></span>
                            <span class="exp-year"><?php echo $c_year ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="back">
                <div class="stripe"></div>
                <div class="box">
                    <span>cvv</span>
                    <div class="cvv-box"></div>
                    <img src="assets/img/cardImages/visa.png" alt="">
                </div>
            </div>

        </div>

        <form action="registerCard.php" enctype="multipart/form-data" method="POST">
            <div class="inputBox">
                <span>card number</span>
                <input type="text" maxlength="16" class="card-number-input" name="cardNumber" value="<?php echo $c_number ?>">
            </div>
            <div class="inputBox">
                <span>card holder</span>
                <input type="text" class="card-holder-input" name="cardHolder" value="<?php echo $c_holder ?>">
            </div>
            <div class="flexbox">
                <div class="inputBox">
                    <span>expiration mm</span>
                    <select id="" class="month-input" name="cardMonth" value="<?php echo $c_month ?>">
                        <option value="month" selected disabled>month</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>expiration yy</span>
                    <select id="" class="year-input" name="cardYear" value="<?php echo $c_year?>">
                        <option value="year" selected disabled>year</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>cvv</span>
                    <input type="text" maxlength="3" class="cvv-input" name="cvv" value="<?php echo $c_cvv?>">
                </div>
                <input type="text" value="<?php echo "$rest_id";?>" style="display: none;" name="rest_id">
            </div>
            <input type="submit" value="submit" class="submit-btn">

        </form>

    </div>

    <script>
        document.querySelector('.card-number-input').oninput = () => {
            document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
        }

        document.querySelector('.card-holder-input').oninput = () => {
            document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
        }

        document.querySelector('.month-input').oninput = () => {
            document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value + " / ";
        }

        document.querySelector('.year-input').oninput = () => {
            document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
        }

        document.querySelector('.cvv-input').onmouseenter = () => {
            document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
            document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
        }

        document.querySelector('.cvv-input').onmouseleave = () => {
            document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
            document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
        }

        document.querySelector('.cvv-input').oninput = () => {
            document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;
        }
    </script>
</body>

</html>