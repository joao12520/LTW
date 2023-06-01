<?php

session_start();

if (!isset($_FILES['photo']['tmp_name'])) echo "cona";

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["contact"]) && isset($_POST["address"])) {
    $un = $_POST["username"];
    $pw = $_POST["password"];
    $pw2 = $_POST["password2"];
    $ph = $_POST["contact"];
    $adr = $_POST["address"];
} else {
    echo "error";
    die();
}

$teste1 = ((strlen($un) >= 8) && preg_match('/[A-Z]/', $un)  && preg_match('/[0-9]/', $un));

$teste2 = ((strlen($pw) >= 10) && preg_match('/[A-Z]/', $pw) && preg_match('/[0-9]/', $pw) && preg_match('/[\!\@\#\$\%\^\&\*\)\(\+\=\.\<\>\{\}\[\]\:\;\'\"\|\~\`\_\-]/', $pw));

$teste3 = $pw == $pw2;

$teste4 = preg_match('/^[9][1236]\d{7}$/', $ph);


if (!$teste1) {
?> <script>
        alert("Invalid Username!")
        document.location.href = "../personal/index.php";
    </script> <?php die();
            }
            if (!$teste2) {
                ?> <script>
        alert("New password is Invalid!")
        document.location.href = "../personal/index.php";
    </script> <?php die();
            }
            if (!$teste3) {
                ?> <script>
        alert("New passwords do not match!")
        document.location.href = "../personal/index.php";
    </script> <?php die();
            }
            if (!$teste4) {
                ?> <script>
        alert("Invalid Portuguese phone number!")
        document.location.href = "../personal/index.php";
    </script> <?php die();
            }

            if (isset($_FILES["photo"])) {
                $target = '../../assets/UserPhotos/' . $_SESSION["clientID"] . '.jpg';
                move_uploaded_file($_FILES['photo']['tmp_name'], $target);
            } else {
                $target = "../../assets/UserPhotos/" . $_SESSION["clientID"] . '.jpg';
            }

            $db = new PDO('sqlite:../../Database/database.db');
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


            $query1 = $db->prepare('UPDATE Client
            SET username = :un, password = :pw, address = :adr, phoneNumber = :ph, profilePhoto = :photo
            WHERE clientID = :id');
            $query1->bindParam(":un", $un);
            $query1->bindParam(":pw", hash('sha256', $pw));
            $query1->bindParam(":ph", $ph);
            $query1->bindParam(":adr", $adr);
            $query1->bindParam(":photo", $target);
            $query1->bindParam(":id", $_SESSION["clientID"]);

            $query1->execute();
                ?>
<script>
    alert("Update was successful!");
    document.location.href = "../personal/index.php";
</script>
<?php

?>