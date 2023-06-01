<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Sem permissão</title>    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../styles.css" rel="stylesheet">
        <script src="../../script.js"></script> 
        <script>
            if (location.href=='http://localhost:9000/pages/error')
                location.href='../pages/error/denied.php'
            
            setInterval(redirectTimer, 1000);

            var timeLeft = 6;
            function redirectTimer() {
                timeLeft -= 1;
                document.getElementById("timeleft").innerHTML = "Vai ser redirecionado em " + timeLeft + " segundos";
                if (timeLeft <= 0) window.location = "../main/index.php";
            }
        </script>
    </head>
    <body>
        <div class="construct">
            <img src = "../../assets\img\logo.png" alt="App Logo SVG" width=500/>
            <h1> Não tem permissão para aceder a esta página </h1>
            <h3 id="timeleft"> Vai ser redirecionado em 6 segundos </h3>
        <div>
    </body>
    <footer>
    </footer>
</html>
