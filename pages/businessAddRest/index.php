<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Registo de Restaurante</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../styles.css" rel="stylesheet">
    <script src="../../script.js"></script>
    <script src="register.js"></script>
    <script>
        if (location.href == 'http://localhost:9000/pages/businessAddRest')
            location.href = '../pages/businessAddRest/index.php'
    </script>
    <?php
    require('../../components/RestaurantCard/index.php');
    session_start();
    if (!$_SESSION["isAdmin"]) {
    ?> <script>
            window.location.replace("../error/denied.php");
        </script> <?php
                }
                    ?>
</head>

<body>
    <div class="_businessAddRest_background">
        <a href="../main/index.php" class="_businessAddRest_logo">
            <img src="../../assets\img\logo.png" alt="App Logo SVG" width=200 />
        </a>
        <form name="_businessAddRest_form" action="register.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data" class="_businessAddRest_mainCard">
            <p class="_businessAddRest_title">
                Registar Restaurante
            </p>
            <div class="_businessAddRest_mainBox">
                <div class="_businessAddRest_verticalBox">
                    <div class="_businessAddRest_inputVerticalBox">
                        <label class="_businessAddRest_label" for="_businessAddRest_restName">Restaurante:</label>
                        <input class="_businessAddRest_textInput" placeholder="Nome do estabelecimento" type="text" id="_businessAddRest_restName" name="_businessAddRest_restName" required>
                    </div>
                    <div class="_businessAddRest_inputVerticalBox">
                        <label class="_businessAddRest_label" for="_businessAddRest_restLoc">Localização:</label>
                        <input class="_businessAddRest_textInput" placeholder="Localização" type="text" id="_businessAddRest_restLoc" name="_businessAddRest_restLoc" required>
                    </div>
                    <div class="_businessAddRest_inputVerticalBox">
                        <label class="_businessAddRest_label" for="_businessAddRest_restCat">Categoria:</label>
                        <select class="_businessAddRest_select" id="_businessAddRest_foodTypes" name="_businessAddRest_foodTypes">
                            <?php
                            $db = new PDO('sqlite:../../Database/database.db');
                            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                            $stmt = $db->prepare('SELECT * FROM Category');

                            $stmt->execute();

                            $items = $stmt->fetchAll();

                            foreach ($items as $item) {
                                echo '<option value="' . $item["categoryID"] . '">';
                                echo $item["nameCategory"];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="_businessAddRest_inputVerticalBox">
                        <p class="_businessAddRest_label">Horário de Funcionamento:</p>
                        <div class="_businessAddRest_horizontalBox">
                            <div class="_businessAddRest_verticalBox">
                                <label class="_businessAddRest_secLabel" for="_businessAddRest_restOpening">Abertura:</label>
                                <input class="_businessAddRest_time" type="time" id="_businessAddRest_restOpening" name="_businessAddRest_restOpening" required>
                            </div>
                            <div class="_businessAddRest_verticalBox">
                                <label class="_businessAddRest_secLabel" for="_businessAddRest_restClosing">Fecho:</label>
                                <input class="_businessAddRest_time" type="time" id="_businessAddRest_restClosing" name="_businessAddRest_restClosing" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="_businessAddRest_verticalBox">
                    <div class="_businessAddRest_verticalBox">
                        <p class="_businessAddRest_label">Pré-visualização</p>
                        <?php
                        getRestaurantCardPreview();
                        ?>
                    </div>
                    <div class="_businessAddRest_verticalBox">
                        <label class="_businessAddRest_centerLabel" for="_businessAddRest_restImgInput">Imagem do Restaurante:</label>
                        <input class="_businessAddRest_imgSelector" type="file" id="_businessAddRest_restImgInput" name="_businessAddRest_restImgInput">
                        <input class="_businessAddRest_imgButton" type="button" id="_businessAddRest_restImgButton" value="Escolher Imagem" onclick="browseImg()">
                    </div>
                </div>
            </div>
            <input class="_businessAddRest_button" type="submit" value="Registar">
        </form>
    </div>
</body>
<footer>
</footer>

</html>