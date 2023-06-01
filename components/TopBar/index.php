<?php 
    function getTopBar($path) {
        session_start();
        getSearchModal();
        echo 
        '<div class="_topBar_topBar">
            <img onclick="openDrawer()" id="_topBar_openDrawer" class="_topBar_margin" src = "..\..\assets\icons\menu_black.svg" alt="App Logo SVG" height=36/>
            <a class="_topBar_Logo" href="' . $path . "pages/main/index.php" . '">
                <img class="_topBar_margin"src = "..\..\assets\img\logo.png" alt="App Logo SVG" height=50/>
            </a>
            <a class="_topBar_MenuIcon" href="' . $path . "pages/main/index.php" . '">
                <img id="food" src = "..\..\assets\icons\lunch_dining_black.svg" alt="lunch dining icon" height=24/>
            </a>
            <div class="_topBar_searchBar"></div>
            <a id="search" class="_topBar_buttonStyle">
                <div class="_topBar_button">
                    <img src = "..\..\assets\icons\search_black.svg" alt="search icon" height=24/>
                    <p>Procurar</p>
                </div>
            </a>
            <a class="_topBar_buttonStyle" id = "shoppingCartButton" >' /* href="' . $path . "pages/cart/index.php" . '" */  .
               ' <div class="_topBar_button">
                    <img id="cart" src = "..\..\assets\icons\shopping_cart_black.svg" alt="shopping cart icon" height=24/>
                    <p>Carrinho</p>
                </div>
                <div class="productsOnCart hide">
                <div class="overlay"></div>
                <div class="top">
        
                    <h3>Cart</h3>
                </div>
                <ul id="buyItems">
                    <h4 class="empty">Your shopping cart is empty</h4>
                    <!-- <li class="buyItem">
                                <img src="Images/producs-images/Mobiles/galaxynote10.png">
                                <div>
                                    <h5>Products Name</h5>
                                    <h6>$199</h6>
                                    <div>
                                        <button>-</button>
                                        <span class="countOfProduct">1</span>
                                        <button>+</button>
                                    </div>
                                </div>
                            </li> -->
                </ul>
                <button class="btn checkout hidden">Check out</button>
            </div>
            </a>';
            if ($_SESSION["clientID"] == NULL) {
                echo '<a class="_topBar_buttonStyle" href="' . $path . "pages/login/index.php" . '">
                        <div class="_topBar_button">
                            <img id="account" src = "..\..\assets\icons\person_black.svg" alt="account icon" height=24/>';
            }
            else if ($_SESSION["clientID"] != NULL) {
                echo '<a class="_topBar_buttonStyle" href="' . $path . "pages/personal/index.php" . '">
                        <div class="_topBar_button">
                            <img id="account" src = "..\..\assets\icons\person_black.svg" alt="account icon" height=24/>';
            }
            else if ($_SESSION["isAdmin"] == 1) {
                echo '<a class="_topBar_buttonStyle" href="' . $path . "pages/personal/index.php" . '">
                        <div class="_topBar_button">
                            <img id="account" src = "..\..\assets\icons\briefcase_black.svg" alt="business account icon" height=24/>';
            }
            
                    echo '<p>';
                    if ($_SESSION["username"] == NULL) {
                        echo 'Iniciar Sessão';
                    } else {
                        echo $_SESSION["username"];
                    }
                    echo '</p>
                </div>
            </a>
            <div id="_topBar_drawer" class="_topBar_drawer _topBar_drawerClosed">
                <div id="_topBar_drawerContainer" class="_topBar_drawerContainer _topBar_drawerContainerClosed"> 
                    <div class="_topBar_drawerContent">
                        <a class="_topBar_drawerLogo" href="..\..\pages\main\index.php">
                            <img src = "..\..\assets\img\logo.png" alt="App Logo SVG" height=60/>
                        </a>
                        <a class="_topBar_drawerNormalButton" href="..\..\pages\login\index.php">
                            Iniciar Sessão
                        </a>
                        <a class="_topBar_drawerNormalButton" href="..\..\pages\business\index.php">
                            Gerir conta empresarial.
                        </a>
                        <a class="_topBar_drawerNormalButton" href="..\..\pages\businessAddRest\index.php">
                            Adicionar restaurante.
                        </a>
                        <a class="_topBar_drawerNormalButton" href="..\..\pages/login/logout.php">
                            Logout
                        </a>
                    </div>
                </div>
                <a id="_topBar_drawerOverlay" class="_topBar_drawerOverlay _topBar_drawerOverlayClosed" > </a>
            </div>
        </div>';
    }
?>