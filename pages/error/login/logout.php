<?php
session_start();

if (isset($_SESSION["clientID"])) {
    session_destroy();
?>
    <script>
        alert("Logout successful")

        document.location.href = "../main/index.php";
    </script>
<?php
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
