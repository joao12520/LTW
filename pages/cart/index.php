<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Carrinho</title>    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../styles.css" rel="stylesheet">
        <script src="../../script.js"></script> 
        <script>
        if (location.href=='http://localhost:9000/pages/cart')
            location.href='../pages/cart/index.php'
    </script>
    </head>
    <?php
        require_once('../../components/TopBar/index.php');
        require('../../components/SearchComponent/index.php');

        getTopBar("../../");

        
    ?>
    <body>
        <div class="construct">
            <img src = "../../assets\img\logo.png" alt="App Logo SVG" width=500/>
            <h1> Carrinho </h1>
            <h3> Em construção </h3>
        <div>
    </body>
    <footer>
    </footer>
</html>
