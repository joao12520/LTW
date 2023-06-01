window.onload = function (e) {
    myID = document.getElementById("_categoryPull");
    myFooter = document.getElementById("_footer_footer");
    
    var myScrollFunc = function () {
        var y = window.scrollY;
        if (y >= 80 && y < (this.document.body.scrollHeight - window.innerHeight - myFooter.offsetHeight)) {
            myID.className = "_categories_categoriesPull _categoriesPullShow"
        } else {
            myID.className = "_categories_categoriesPull _categoriesPullHide"
        }
    };
    
    
    window.addEventListener("scroll", myScrollFunc);
    
    //search modal
    mySearch = document.getElementById("_searchComp_search")
    mySearchContainer = document.getElementById("_searchComp_container");
    mySearchOverlay = document.getElementById("_searchComp_modal");
    const htmlElement = document.querySelector("html");
    
    var openSearchModal = function () {
        mySearch.className = "_searchComp_search _searchComp_searchOpen"
        mySearchContainer.className = "_searchComp_container  _searchComp_containerOpen"
        mySearchOverlay.className = "_searchComp_modal _searchComp_modalOpen"
        document.getElementById("_searchComp_searchInput").value = "";
        showResult();
        htmlElement.style.overflow = "hidden";
    }

    var closeSearchModal = function () {
        mySearch.className = "_searchComp_search _searchComp_searchClosed"
        mySearchContainer.className = "_searchComp_container _searchComp_containerClosed"
        mySearchOverlay.className = "_searchComp_modal _searchComp_modalClosed"
        htmlElement.style.overflow = "auto";
    }

    document.getElementById("search").addEventListener("click", openSearchModal);
    document.getElementById("_searchComp_container").addEventListener("click", closeSearchModal);

    // Searching

    var searchInputElement = document.getElementById("_searchComp_searchInput");

    function showResult() {
        let str = searchInputElement.value;
        if (str.length == 0) {
            document.getElementById("livesearch").innerHTML = "";
            return;
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("livesearch").innerHTML = this.responseText;
            }
        }

        xmlhttp.open("get", "../../components/SearchComponent/search.php?q=" + str, true);
        xmlhttp.send();
        
    }
    searchInputElement.addEventListener("keyup", showResult);
    
    
    updateCart();
};

/* Script for Cart */


const openShopCart = document.getElementById('shoppingCartButton');
    openShopCart.addEventListener('click', () => {
        const cart = document.querySelector('._cart_productsOnCart');
        cart.classList.toggle('hide');
        document.querySelector('body').classList.toggle('stopScrolling');
    });


function restPageAddToFav(id) {
    //print(id);
    console.log(id);
}

const openRestCart = function(id) {
    document.getElementById('shoppingCartButton').innerHTML = "";
    if (document.getElementById('cartModal').className == "_restPage_cartModal _restPage_cartModalOpen") {
        document.getElementById('cartModal').className = "_restPage_cartModal _restPage_cartModalClosed"
    } else {
        document.getElementById('cartModal').className = "_restPage_cartModal _restPage_cartModalOpen"
    }

    updateCart();
}

const openFoodModal = function(id) {
    const productID = id.dataset.id;

    const productName = id.querySelector('._foodCard_cardInfoHeadingName').innerHTML;
    const productPrice = id.querySelector("._foodCard_priceTag").innerHTML;

    const img = id.querySelector('._foodCard_cardImage').dataset.srce;
    

    let productToCart = {
        nameMenuItem: productName.trim(),
        photo: img,
        quantity: 1,
        itemID: productID,
        price: parseFloat(productPrice) /** makes string an integer */
    };

   
    document.getElementById('_purchaseModal_foodName').setAttribute('foodId', productToCart.itemID);
    document.getElementById('_purchaseModal_foodName').innerHTML = productToCart.nameMenuItem;
    document.getElementById('_purchaseModal_foodImg').setAttribute('src', productToCart.photo);
    document.getElementById('_purchaseModal_totalPrice').setAttribute('basePrice', productToCart.price);
    document.getElementById('_purchaseModal_totalPrice').innerHTML = productToCart.price + "  €";

    document.getElementById('_purchaseModal_addToCart').setAttribute("prodName", productToCart.nameMenuItem);
    document.getElementById('_purchaseModal_addToCart').setAttribute("prodBasePrice", productToCart.price);
    document.getElementById('_purchaseModal_addToCart').setAttribute("prodQtd", productToCart.quantity);
    document.getElementById('_purchaseModal_addToCart').setAttribute("prodId", productToCart.itemID);

    document.getElementById('purchaseModal').className = "_restPage_purchaseModal _restPage_purchaseModalShow"
    document.getElementById('purchaseModalWrapper').className = "_restPage_purchaseModalWrapper _restPage_purchaseModalShow"
}

const closeFoodModal = function(){
    document.getElementById('purchaseModal').className = "_restPage_purchaseModal _restPage_purchaseModalHidden"
    document.getElementById('purchaseModalWrapper').className = "_restPage_purchaseModalWrapper _restPage_purchaseModalHidden"
}

const foodModalRem = function(){
    if (parseInt(document.getElementById("_purchaseModal_qtd").innerHTML) > 1)
        document.getElementById("_purchaseModal_qtd").innerHTML = (parseInt(document.getElementById("_purchaseModal_qtd").innerHTML) - 1).toString();
        document.getElementById("_purchaseModal_totalPrice").innerHTML = (parseFloat(document.getElementById("_purchaseModal_totalPrice").getAttribute("basePrice")) * parseInt(document.getElementById("_purchaseModal_qtd").innerHTML)).toString() + " €";
        document.getElementById('_purchaseModal_addToCart').setAttribute("prodQtd", document.getElementById("_purchaseModal_qtd").innerHTML);
}

const foodModalAdd = function(){
    document.getElementById("_purchaseModal_qtd").innerHTML = (parseInt(document.getElementById("_purchaseModal_qtd").innerHTML) + 1).toString();
    document.getElementById("_purchaseModal_totalPrice").innerHTML = (parseFloat(document.getElementById("_purchaseModal_totalPrice").getAttribute("basePrice")) * parseInt(document.getElementById("_purchaseModal_qtd").innerHTML)).toString() + " €";
    document.getElementById('_purchaseModal_addToCart').setAttribute("prodQtd", document.getElementById("_purchaseModal_qtd").innerHTML);
}


/*
const addToCart = function(){
    document.getElementById("cartModal").innerHTML += `
    <div id="_cartModal_product` + document.getElementsByClassName("_cartModal_product").length +`" class="_cartModal_product">
        <div>
            ` + document.getElementById('_purchaseModal_addToCart').getAttribute("prodName") + `
        </div>
        <div>
            ` + document.getElementById('_purchaseModal_addToCart').getAttribute("prodQtd") + `
        </div>
        <div>
            ` + (document.getElementById('_purchaseModal_addToCart').getAttribute("prodQtd") * document.getElementById('_purchaseModal_addToCart').getAttribute("prodBasePrice")).toString()  + `
        </div>
        <button onclick="removeFromCart('_cartModal_product` + document.getElementsByClassName("_cartModal_product").length +`')">
            X
        </button>
    </div>`;
    closeFoodModal();
    updateCartCounter();
}
*/


const avalStars = function(aval) {
    if (aval == 1) {
        document.getElementById("_reviewCard_avalStar1").src="../../assets/icons/star_black.svg";
        document.getElementById("_reviewCard_avalStar2").src="../../assets/icons/star_border_black.svg";
        document.getElementById("_reviewCard_avalStar3").src="../../assets/icons/star_border_black.svg";
        document.getElementById("_reviewCard_avalStar4").src="../../assets/icons/star_border_black.svg";
        document.getElementById("_reviewCard_avalStar5").src="../../assets/icons/star_border_black.svg";
    } else if (aval == 2) {
        document.getElementById("_reviewCard_avalStar1").src="../../assets/icons/star_black.svg";
        document.getElementById("_reviewCard_avalStar2").src="../../assets/icons/star_black.svg";
        document.getElementById("_reviewCard_avalStar3").src="../../assets/icons/star_border_black.svg";
        document.getElementById("_reviewCard_avalStar4").src="../../assets/icons/star_border_black.svg";
        document.getElementById("_reviewCard_avalStar5").src="../../assets/icons/star_border_black.svg";
    } else if (aval == 3) {
        document.getElementById("_reviewCard_avalStar1").src="../../assets/icons/star_black.svg";
        document.getElementById("_reviewCard_avalStar2").src="../../assets/icons/star_black.svg";
        document.getElementById("_reviewCard_avalStar3").src="../../assets/icons/star_black.svg";
        document.getElementById("_reviewCard_avalStar4").src="../../assets/icons/star_border_black.svg";
        document.getElementById("_reviewCard_avalStar5").src="../../assets/icons/star_border_black.svg";
    } else if (aval == 4) {
        document.getElementById("_reviewCard_avalStar1").src="../../assets/icons/star_black.svg";
        document.getElementById("_reviewCard_avalStar2").src="../../assets/icons/star_black.svg";
        document.getElementById("_reviewCard_avalStar3").src="../../assets/icons/star_black.svg";
        document.getElementById("_reviewCard_avalStar4").src="../../assets/icons/star_black.svg";
        document.getElementById("_reviewCard_avalStar5").src="../../assets/icons/star_border_black.svg";
    } else if (aval == 5) {
        document.getElementById("_reviewCard_avalStar1").src="../../assets/icons/star_black.svg";
        document.getElementById("_reviewCard_avalStar2").src="../../assets/icons/star_black.svg";
        document.getElementById("_reviewCard_avalStar3").src="../../assets/icons/star_black.svg";
        document.getElementById("_reviewCard_avalStar4").src="../../assets/icons/star_black.svg";
        document.getElementById("_reviewCard_avalStar5").src="../../assets/icons/star_black.svg";
    }

    document.getElementById("_reviewCard_avalInput").setAttribute("value", aval.toString());
}


const reviewSubmit = function() {
    let rev = document.getElementById("_reviewCard_avalTextArea").value;
    let aval = document.getElementById("_reviewCard_avalInput").value;
    let restID = document.getElementById("_reviewCard_avalInput").getAttribute("restID");
    console.log(restID);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
        console.log("yo",this.responseText)
        }
    }
    xmlhttp.open("get", "review.php?aval=" + aval + "&rev=" + rev + "&restID=" + restID, true);
    xmlhttp.send();
}

function addToCart() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    }

    xmlhttp.open("get", "../../methods/add_to_cart.php?rest_id=" +  document.getElementById("cartModal").getAttribute("data-restID") + "&item_id=" + document.getElementById('_purchaseModal_addToCart').getAttribute("prodId") + "&qtd=" + document.getElementById('_purchaseModal_addToCart').getAttribute("prodQtd"), true);
    xmlhttp.send();

    closeFoodModal();
    updateCart();
}



function updateCart() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            document.getElementById("cartModal").innerHTML = res[1];
            updateCartCounter(res[0]);
        }
    }
    
    xmlhttp.open("get", "../../methods/get_cart.php?rest_id=" + document.getElementById("cartModal").getAttribute("data-restID"), true);
    xmlhttp.send();
}

const removeFromCart = function(id) {
    var itemID = document.getElementById(id).getAttribute("data-itemID");

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Removed from session");
        }
    }

    
    var restID = document.getElementById("cartModal").getAttribute("data-restID");
    xmlhttp.open("get", "../../methods/remove_from_cart.php?rest_id=" + restID + "&item_id=" + itemID, true);
    xmlhttp.send();
    updateCart();
}

const updateCartCounter = function(count) {
    document.getElementById("_restPage_cartAmmount").innerHTML = count;
}

const purchaseCart = function() {
    location.href= '../checkout/index.php?rest=' + document.getElementById("cartModal").getAttribute("data-restID");
}


//topBar drawer
myDrawer = document.getElementById("_topBar_drawer");
myDrawerContainer = document.getElementById("_topBar_drawerContainer");
myDrawerOverlay = document.getElementById("_topBar_drawerOverlay");

const openDrawer = function () {
    myDrawer.className = "_topBar_drawer _topBar_drawerOpen"
    myDrawerContainer.className = "_topBar_drawerContainer _topBar_drawerContainerOpen"
    myDrawerOverlay.className = "_topBar_drawerOverlay _topBar_drawerOverlayOpen"
}

const closeDrawer = function () {
    myDrawer.className = "_topBar_drawer _topBar_drawerClosed"
    myDrawerContainer.className = "_topBar_drawerContainer _topBar_drawerContainerClosed"
    myDrawerOverlay.className = "_topBar_drawerOverlay _topBar_drawerOverlayClosed"
}

document.getElementById("_topBar_openDrawer").addEventListener("click", openDrawer);
document.getElementById("_topBar_drawerOverlay").addEventListener("click", closeDrawer);

function updateFoodCard(el) {
    var foodID = el.getAttribute('data-id');
    foodTitle = document.getElementById("foodCardName" + foodID).value;
    foodPrice = document.getElementById("_foodCard_editPriceId" + foodID).value;
    foodDesc = document.getElementById("_foodCard_editDescriptionId" + foodID).value;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "success") {
                alert("" + foodTitle + " atualizado com sucesso.");
            }
            console.log(this.responseText);
        }
    }

    
    xmlhttp.open("get", "../../methods/update_food.php?food_id=" + foodID + "&title=" + foodTitle + "&price=" + foodPrice + "&descr=" + foodDesc, true);
    xmlhttp.send();
}

function deleteFoodCard(el) {
    var foodID = el.getAttribute('data-id');
    foodTitle = document.getElementById("foodCardName" + foodID).value;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "success") {
                alert("" + foodTitle + " eliminado com sucesso.");
                location.reload();
            }
            console.log(this.responseText);
        }
    }

    xmlhttp.open("get", "../../methods/delete_food.php?food_id=" + foodID, true);
    xmlhttp.send();
}


function createFoodCard(el) {
    var restID = el.getAttribute('data-id');
    

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "success") {
                alert("" + foodTitle + " criado com sucesso.");
            }
            console.log(this.responseText);
        }
    }
    
    xmlhttp.open("get", "../../methods/create_food.php?rest_id=" + restID + "&food_name=" + foodName + "&food_price=" + foodPrice + "&food_descr=" + foodDescr, true);
    xmlhttp.send();
}
