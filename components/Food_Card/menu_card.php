<?php function createMenuItemCard($item)
{ ?>
  <?php $realpath = "/../../assets/" . $item['photo'] ?>

  <div <?php echo 'id="_foodCard_cardId'. $item['itemID'] .'"' ?> class="_foodCard_card" data-ID=<?php echo $item['itemID']?> <?php echo 'onclick="openFoodModal(' . "_foodCard_cardId" . $item['itemID'] .')"' ?> >
    <div data-srce = <?php echo $realpath ?> style="background-image: url(' <?php echo $realpath ?>')" class="_foodCard_cardImage" >
    </div>
    <div class="_foodCard_infoColumn">
      <div class="_foodCard_cardInfoContainer">
        <h1 class="_foodCard_cardInfoHeading">
          <div class="_foodCard_cardInfoHeadingName">
              <?php echo $item['nameMenuItem'] ?>
          </div>
          <img class="_foodCard_icon" src="../../assets/icons/add_shopping_cart_black.svg" height=26>
        </h1>
        <?php 
        echo '<p class="_foodCard_priceTag"> ' . $item['price'] . ' € </p>';
        ?>
        <div class="_foodCard_cardInfoPara">
          <?php echo $item['description'] ?>
        </div>
      </div>
    </div>
  </div>
<?php } ?>


<?php function createMenuItemCardNumberedPreview($item) {
  ?>
  <?php $realpath = "/../../assets/" . $item['photo'] ?>
  
  <div class="_foodCard_editCard">
    <div class="_foodCard_editCardNameBar">
      <div>
        <input class="_foodCard_editCardName" type="text" <?php echo 'id="foodCardName' . $item['itemID'] . '"'; ?> name="foodCardName" <?php echo 'value="' . $item['nameMenuItem'] . '"';?> maxlength="30" readonly="true">
      </div>
      <div class="_foodCard_buttons">
        <img <?php echo 'id="_foodCard_editCardUpdate' . $item['itemID'] . '"'; ?> class="_foodCard_editCardUpdate _foodCard_editButtonHide" title="Atualizar" src="../../assets/icons/done_black.svg" class="_foodCard_buttonToHide" width=36 <?php echo 'data-id="' . $item['itemID'] . '"' ?> onClick="updateFoodCard(this);">
        <img <?php echo 'id="_foodCard_editCardRemove' . $item['itemID'] . '"'; ?>class="_foodCard_editCardRemove _foodCard_editButtonHide" title="Remover" src="../../assets/icons/delete_black.svg" width=36 <?php echo 'data-id="' . $item['itemID'] . '"' ?> onClick="deleteFoodCard(this);" >
        <?php echo '
          <div id="_foodCard_editCardExpandButton' . $item['itemID']. '" class="_foodCard_editCardExpandButton" onclick="expandSingleFoodCard(' . $item['itemID']. ')">
            <img src="../../assets/icons/expand_more_black.svg" width=36>
          </div>';
        ?>
      </div>
    </div>
    <div class="_foodCard_editCardDetails _foodCard_editCardDetailsHidden" <?php echo 'id="_foodCard_editId' . $item['itemID'] . '"'; ?>>
      <div>
          <div style="background-image: url(' <?php echo $realpath ?>')" class="_foodCard_editCardCardImage" >
          </div>
      </div>
      <div class="_foodCard_editCardDescriptionBox" >
        <div>
          Descrição:
          <br>
          <textarea class="_foodCard_editCardDescription" name="foodCardDescription" <?php echo 'value="' . $item['description'] . '"'; ?> <?php echo 'id="_foodCard_editDescriptionId' . $item['itemID'] . '"'; ?> maxlength="300" >
          </textarea>
        </div>
        <div>
          Preço: 
          <input class="_foodCard_editCardPrice" type="number" required name="foodCardPrice" min="0" value="<?php echo $item['price'];?>" <?php echo 'id="_foodCard_editPriceId' . $item['itemID'] . '"'; ?> step=".01">
          €
        </div>
      </div>
    </div>
  </div>
<?php }?>
