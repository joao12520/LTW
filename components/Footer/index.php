<?php 
    function getFooter($path) {
        echo 
        '<footer id="_footer_footer" class="_footer_footer">
            <img class="_topBar_margin"src = "..\..\assets\img\logo.png" alt="App Logo SVG" height=50/>
                        <a class="_topBar_drawerNormalButton" href="..\..\pages\business\index.php">
                            Gerir conta empresarial
                        </a>
                        <a class="_topBar_drawerNormalButton" href="..\..\pages\businessAddRest\index.php">
                            Adicionar restaurante
                        </a>

                        <a class="_topBar_drawerNormalButton" href="..\..\pages\business\viewOrders.php">
                            Review your Orders
                        </a>
                        
                        <a class="_topBar_drawerNormalButton" href="..\../pages/login/logout.php">
                            Logout
                        </a>
                        
                        <a class="_topBar_drawerNormalButton" href="https://www.livroreclamacoes.pt/Inicio/">
                            Livro de Reclamações
                        </a>
        </footer>';
    }
