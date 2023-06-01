<?php
/*Login Script */
// Perform Form Submission Checks

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["contact"]) && isset($_POST["nif"]) && isset($_POST["address"])) {
    $un = $_POST["username"];
    $pw = $_POST["password"];
    $ph = $_POST["contact"];
    $nf = $_POST["nif"];
    $adr = $_POST["address"];
    ($_POST["isAdmin"] == true) ? $isAdm = 1 : $isAdm = 0;
} else {
    echo "error";
    die();
}

var_dump($isAdm);


$teste1 = ((strlen($un) >= 8) && preg_match('/[A-Z]/', $un)  && preg_match('/[0-9]/', $un));

$teste2 = ((strlen($pw) >= 10) && preg_match('/[A-Z]/', $pw) && preg_match('/[0-9]/', $pw) && preg_match('/[\!\@\#\$\%\^\&\*\)\(\+\=\.\<\>\{\}\[\]\:\;\'\"\|\~\`\_\-]/', $pw));

$teste3 = preg_match('/^[9][1236]\d{7}$/', $ph);

$teste4 = preg_match('/^\d{9}$/', $nf);



if (!($teste1 && $teste2 && $teste3 && $teste4)) {
    echo "error";
    die();
}
/**ELSE IS VALID AND CONTINUE */



// Validate form input date using PHP and sqlite3 best practices to avoid SQLI injections
// Connect to DB

$db = new PDO('sqlite:../../Database/database.db');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


/* Query 1 */
$query1 = $db->prepare('SELECT clientID FROM Client order by clientID DESC LIMIT 1');
$query1->execute();
$teste = $query1->fetchAll();
$maxID = $teste[0]['clientID'] + 1;

if (isset($_FILES["photo"])) {
    $target = '../../assets/UserPhotos/' . $maxID . '.jpg';
    move_uploaded_file($_FILES['photo']['tmp_name'], $target);
};

$newPhotoPath = 'UserPhotos' . $maxID . '.jpg';


$tmp = hash('sha256', $pw);
$stmt = $db->prepare("INSERT INTO Client(clientID, username, password, address, phoneNumber, nif, profilePhoto, isAdmin) VALUES (:id, :nm, :pw, :adr, :ph, :nf, :img, :admn)");

$stmt->bindParam(':id', $maxID);
$stmt->bindParam(':nm', $un, PDO::PARAM_STR, 30);
$stmt->bindParam(':pw', $tmp, PDO::PARAM_STR, 256);
$stmt->bindParam(':adr', $adr, PDO::PARAM_STR, 30);
$stmt->bindParam(':ph', $ph);
$stmt->bindParam(':nf', $nf);
$stmt->bindParam(':img', $img, PDO::PARAM_STR, 50);
$stmt->bindParam(':admn', $isAdm);

$stmt->execute();

echo "success";
