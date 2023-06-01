window.onload = function (e) {

    var previews = document.getElementsByClassName("_businessPage_restContainer");

    function updateRestNamePreview(id) {
        if (typeof(id) != typeof("1")) {
            id = id.target.id.substring(id.target.id.search("restName")+8);
        }
        let str = document.getElementById("_businessPage_restName" + String(id)).value;
        if (str == "")
            document.getElementById("_restaurantCard_infoNamePreview" + String(id)).innerHTML = "Estabelecimento";
        else
            document.getElementById("_restaurantCard_infoNamePreview" + String(id)).innerHTML = str;
    }

    function updateRestLocPreview(id) {
        if (typeof(id) != typeof("1")) {
            id = id.target.id.substring(id.target.id.search("restLoc")+7);
        }
        let str =  document.getElementById("_businessPage_restLoc" + String(id)).value;
        if (str == "")
            document.getElementById("_restaurantCard_infoLocPreview" + String(id)).innerHTML = "Localização";
        else
            document.getElementById("_restaurantCard_infoLocPreview" + String(id)).innerHTML = str;
    }

    Array.from(previews).forEach(element => {
        let id = element.id.substring(element.id.search("ID")+2);
        if (document.getElementById("_businessPage_restName" + String(id)) == null)
        {
            console.log("NULL", id);
            return;
        }


        document.getElementById("_businessPage_restName" + String(id)).addEventListener("keyup", updateRestNamePreview.bind(id));
        document.getElementById("_businessPage_restLoc" + String(id)).addEventListener("keyup", updateRestLocPreview.bind(id));
    
        updateRestLocPreview(id);
        updateRestNamePreview(id);
    })


    Array.from(document.getElementsByClassName("_foodCard_editCardDescription")).forEach(element => {
        element.value = element.getAttribute("value");
    })

}

function expandFoodCards(id) {
    if (document.getElementById("_businessPage_foodCards" + id).className == "_businessPage_foodCards _businessPage_foodCardsShow") {
        document.getElementById("_businessPage_foodCards" + id).className = "_businessPage_foodCards _businessPage_foodCardsHidden";
        document.getElementById("_businessPage_expandButton" + id).className = "_businessPage_expandButton";
    }
    else {
        document.getElementById("_businessPage_foodCards" + id).className = "_businessPage_foodCards _businessPage_foodCardsShow";
        document.getElementById("_businessPage_expandButton" + id).className = "_businessPage_expandButton _businessPage_expandButtonUpsideDown";
    }
}

function expandSingleFoodCard(id) {
    if (document.getElementById("_foodCard_editId" + id).className == "_foodCard_editCardDetails _foodCard_editCardDetailsShow") {
        document.getElementById("_foodCard_editId" + id).className = "_foodCard_editCardDetails _foodCard_editCardDetailsHidden";
        document.getElementById("_foodCard_editCardExpandButton" + id).className = "_foodCard_editCardExpandButton";
        document.getElementById("_foodCard_editCardUpdate" + id).className = "_foodCard_editCardUpdate _foodCard_editButtonHide";
        document.getElementById("_foodCard_editCardRemove" + id).className = "_foodCard_editCardRemove _foodCard_editButtonHide";
    }
    else {
        document.getElementById("_foodCard_editId" + id).className = "_foodCard_editCardDetails _foodCard_editCardDetailsShow";
        document.getElementById("_foodCard_editCardExpandButton" + id).className = "_foodCard_editCardExpandButton _foodCard_expandButtonUpsideDown";
        document.getElementById("_foodCard_editCardUpdate" + id).className = "_foodCard_editCardUpdate";
        document.getElementById("_foodCard_editCardRemove" + id).className = "_foodCard_editCardRemove";
    }
}


function addFoodCards(id) {
    document.getElementById("_businessPage_addFoodCardWrapper").className = "_businessPage_addFoodCardWrapper _businessPage_addFoodCardWrapperShow"
    document.getElementById("_businessPage_addFoodCard").className = "_businessPage_addFoodCard _businessPage_addFoodCardShow";
    document.getElementById("_foodCard_addCardRestID").value = id;
}

function closeFoodCardAdder() {
    document.getElementById("_businessPage_addFoodCardWrapper").className = "_businessPage_addFoodCardWrapper _businessPage_addFoodCardWrapperHidden"
    document.getElementById("_businessPage_addFoodCard").className = "_businessPage_addFoodCard _businessPage_addFoodCardHidden"
}