<?php 
    function getRestaurantOwnerInfo($rest) {

        $id = $rest["restaurantID"];

        $db = new PDO('sqlite:../../Database/database.db');
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stmt = $db->prepare('SELECT * FROM Menu_Item WHERE restaurantID = ?');
        $stmt->bindParam(1, $id, SQLITE3_INTEGER);
        /** CHANGE AFTERWARDS HERE TO MAKE IT DYNAMIC, USING GET OR POST*/
        $stmt->execute();

        $items = $stmt->fetchAll();

        echo
        '<form action="update_rest.php" enctype="multipart/form-data" method="POST" class="_businessPage_restContainer" id="_businessPage_previewID' . $id. '" data-id="' . $id . '" data-name="' . $rest["name"] . '" data-location="' . $rest["location"] . '">
            <div class="_businessPage_editInfo">';
        getRestaurantCardNumberedPreview($id, $rest["photo"]);
        echo '<div class="_businessPage_verticalBox">
                <div class="_businessPage_verticalBox">
                <input style="display:none;" value="' . $id . '" type="text" name="_businessPage_restID">
                    <label class="_businessPage_label" for="_businessPage_restName' . $id. '">Nome do Estabelecimento:</label>
                    <input class="_businessPage_textInput" value="' . $rest["name"] . '" placeholder="Nome do estabelecimento" type="text" id="_businessPage_restName' . $id. '" name="_businessPage_restName">
                </div>
                <div class="_businessPage_verticalBox">
                    <label class="_businessPage_label" for="_businessPage_restLoc' . $id. '">Localização do Estabelecimento:</label>
                    <input class="_businessPage_textInput" value="' . $rest["location"] .'" placeholder="Localização do estabelecimento" type="text" id="_businessPage_restLoc' . $id. '" name="_businessPage_restLoc">
                </div>
                </div>
                <div class="_businessPage_verticalBox">
                    <input class="_businessPage_submit" type="submit" value="Atualizar">
                </div>
            </div>
            <div id="_businessPage_foodCards' . $id. '" class="_businessPage_foodCards _businessPage_foodCardsHidden">';
            foreach ($items as $item) {
                createMenuItemCardNumberedPreview($item);
            }
            echo '
                <div class="_businessPage_editButtons">
                    <div id="_businessPage_addButton' . $id. '" class="_businessPage_addButton" onclick="addFoodCards(' . $id. ')">
                        <img src="../../assets/icons/add_black.svg" height=42>
                    </div>
                </div>
            </div>
            <div id="_businessPage_expandButton' . $id. '" class="_businessPage_expandButton" onclick="expandFoodCards(' . $id. ')">
                <img src="../../assets/icons/expand_more_black.svg">
            </div>';
        echo '</form>';
    }
?>