<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Carrinho</title>    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../styles.css" rel="stylesheet">
        <script> 
            setInterval(redirectTimer, 1000);

            var timeLeft = 6;
            function redirectTimer() {
                timeLeft -= 1;
                document.getElementById("timeleft").innerHTML = "Vai ser redirecionado em " + timeLeft + " segundos";
                if (timeLeft <= 0) window.location = "index.php";
            }
        </script> 
    </head>
    <?php
        $status = $_GET['st']
    ?>
    <body>
        <div class="construct">
            <img src = "../../assets\img\logo.png" alt="App Logo SVG" width=500/>
            <?php 
                if ($status == 1) {
                    echo '<h1 class="_businessAddRest_status"> Restaurante adicionado com sucesso </h1>';
                } else {
                    echo '<h1 class="_businessAddRest_status"> Não foi possível adicionar o restaurante </h1>';
                }
            ?>
            <h3 class="_businessAddRest_status" id="timeleft"> Vai ser redirecionado em 6 segundos </h3>
        <div>
    </body>
    <footer>
    </footer>
</html>
