var editButton = document.querySelector(".edit-profile-btn");
var ordersButton = document.querySelector(".orders-profile-btn");

var retButton = document.querySelector(".return-profile-btn");
var ordersRetButton = document.querySelector(".return-profile-orders-btn");
var boxInit = document.querySelector(".profile-box");
var boxEdit = document.querySelector(".profile-box-edit");
var orders = document.querySelector(".profile-box-orders");

editButton.addEventListener("click", function () {
  boxInit.classList.toggle("hide");
  boxEdit.classList.toggle("hide");
});

retButton.addEventListener("click", function () {
  boxInit.classList.toggle("hide");
  boxEdit.classList.toggle("hide");
});

ordersButton.addEventListener("click", function () {
  boxInit.classList.toggle("hide");
  orders.classList.toggle("hide");
});


ordersRetButton.addEventListener("click", function () {
  boxInit.classList.toggle("hide");
  orders.classList.toggle("hide");
});

function expandSingleFoodCard(id) {
  if (
    document.getElementById("_foodCard_editId" + id).className ==
    "_foodCard_editCardDetails _foodCard_editCardDetailsShow"
  ) {
    document.getElementById("_foodCard_editId" + id).className =
      "_foodCard_editCardDetails _foodCard_editCardDetailsHidden";
    document.getElementById("_foodCard_editCardExpandButton" + id).className =
      "_foodCard_editCardExpandButton";
    document.getElementById("_foodCard_editCardUpdate" + id).className =
      "_foodCard_editCardUpdate _foodCard_editButtonHide";
    document.getElementById("_foodCard_editCardRemove" + id).className =
      "_foodCard_editCardRemove _foodCard_editButtonHide";
  } else {
    document.getElementById("_foodCard_editId" + id).className =
      "_foodCard_editCardDetails _foodCard_editCardDetailsShow";
    document.getElementById("_foodCard_editCardExpandButton" + id).className =
      "_foodCard_editCardExpandButton _foodCard_expandButtonUpsideDown";
    document.getElementById("_foodCard_editCardUpdate" + id).className =
      "_foodCard_editCardUpdate";
    document.getElementById("_foodCard_editCardRemove" + id).className =
      "_foodCard_editCardRemove";
  }
}
