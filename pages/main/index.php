<!DOCTYPE html>
<html lang="en-US">

    <head>
        <title>Página Inicial</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../styles.css" rel="stylesheet">
        <link href="styles.css" rel="stylesheet">
        <script>
            if (location.href=='http://localhost:9000/pages/main')
                location.href='../pages/main/index.php'
        </script>
        <script src="../../script.js" defer></script>
        <?php
        session_start();
        require_once('../../components/TopBar/index.php');
        require('../../components/SearchComponent/index.php');
        require('../../components/AvaluationComponent/index.php');
        require_once('../../components/Footer/index.php');
        require('../../components/Categories/index.php');
        require('../../components/RestaurantCard/index.php');


        $cats = getAllCategory();

        $db = new PDO('sqlite:../../Database/database.db');
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stmt = $db->prepare('SELECT * FROM Restaurant');
        /** CHANGE AFTERWARDS HERE TO MAKE IT DYNAMIC, USING GET OR POST*/
        $stmt->execute();

        $items = $stmt->fetchAll();
        ?>
    </head>
    <body>
        <?php
        getTopBar("../../");
        getCategoriesBar("../../", $cats);

        foreach ($cats as $cat) {
            getAllCategoryRestaurants($cat, $items);
        }
        getFooter("../../");
        ?>
    </body>

</html>
