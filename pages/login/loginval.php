<?php
/*Login Script */
extract($_POST);
// Enable Session 
session_start();
// Perform Form Submission Checks

$un = isset($_POST["username"]) ? $_POST["username"] : "";
$pw = isset($_POST["psw"]) ? $_POST["psw"] : "";

// Validate form input date using PHP and sqlite3 best practices to avoid SQLI injections
// Connect to DB

$teste;

function check_password_DB($username_, $password_)
{
    $db = new PDO('sqlite:../../Database/database.db');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    /* Query 1 */
    $stmt = $db->prepare("SELECT * FROM Client WHERE username = ?");
    $stmt->bindParam(1, $username_);
    $stmt->execute();
    $row = $stmt->fetchAll();
    

    if (sizeof($row) == 1) {
        global $info;
        $info = $row[0];
    
        $sha_info = $info['password'];
    } else return false;

    if (strcasecmp($sha_info, hash('sha256', $password_)) == 0) return true;
    else return false;
}

$returnVar = check_password_DB($un, $pw);

if ($returnVar) {
    // User entered valid data
    session_start();
    $_SESSION['clientID'] = $info['clientID'];
    $_SESSION['username'] = $info['username'];
    $_SESSION['isAdmin'] = $info['isAdmin'];
    
    header('Location: ../main/index.php');
} else {

    
    header('Location: index.php');
}
?>