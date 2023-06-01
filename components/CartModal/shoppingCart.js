// the code here will run when all the HTML is loaded (but the css and the images may miss)
let parentElement = document.getElementById('buyItems');
let cartSumPrice = document.querySelector("#sum-prices");
let products = document.querySelectorAll('.card');

function updateProductsInCart(product) {
    for (let i = 0; i < productsInCart.length; i++) {
        if ((productsInCart[i].id = product.id)) {
            productsInCart[i].count += 1;
            productsInCart[i].price =
                productsInCart.basePrice * productsInCart[i].count;
            return;
        }
    }
    productsInCart.push(product);
}
const countTheSumPrice = function () {
    let total = 0;

    productsInCart.forEach((product) => {
        total += product.price;
    });

    return total;
};

const addItemToCart = function (product) {
    return `
				<li class="buyItem">
					<img src="../../assets/${product['photo']}">
					<div>
						<h5>${product['nameMenuItem']}</h5>
						<h6>${product['price'] * product['quantity']} €</h6>
						<div>
							<button class="button-minus" data-id=${product['itemID']}>-</button>
							<span class="countOfProduct">${product['quantity']}</span>
							<button class="button-plus" data-id=${product['itemID']}>+</button>
						</div>
					</div>
				</li>
    `;

}
const updateShoppingCartHTML = function () { // 3
    localStorage.setItem('shoppingCart', JSON.stringify(productsInCart));
    if (productsInCart.length > 0) {
        let result = productsInCart.map(product => {
            return addItemToCart(product);
        });
        parentElement.innerHTML = result.join('');
        document.querySelector('.checkout').classList.remove('hide');

    } else {
        document.querySelector('.checkout').classList.add('hide');
        parentElement.innerHTML = '<h4 class="empty">Your shopping cart is empty</h4>';
        cartSumPrice.innerHTML = '';
    }
}

for (let i = 0; i < products.length; i++) {
    products[i].addEventListener("click", (e) => {
        if (e.target.classList.contains("addToCart")) {
            /** To Acess ID stored in button */
            const productID = e.target.dataset.id;
            const tmp = e.target.parentElement;

            const productName = tmp.querySelector('_foodCard_cardInfoHeading').innerHTML;
            const productPrice = tmp.querySelector("_foodCard_priceTag").innerHTML;

            const img = tmp.parentElement.querySelector(".card-image-container").querySelector('.card-image').dataset.srce;

            let productToCart = {
                nameMenuItem: productName.trim(),
                photo: img,
                quantity: 1,
                itemID: productID,
                price: parseFloat(productPrice) /** makes string an integer */
            };
            console.log(productToCart);
            updateProductsInCart(productToCart);
            updateShoppingCartHTML();
        }
    });
};


parentElement.addEventListener('click', (e) => {
    const isPlusButton = e.target.classList.contains('button-plus');
    const isMinusBUttom = e.target.classList.contains('button-minus');

    if (isMinusBUttom || isPlusButton) {
        for (let i = 0; i < productsInCart.length; i++) {
            if (productsInCart[i]['itemID'] == e.target.dataset.id) {

                if (isPlusButton) {
                    productsInCart[i]['quantity']++;

                }
                if (isMinusBUttom) {

                    productsInCart[i]['quantity']--;
                    if (productsInCart[i]['quantity'] == 0) {
                        productsInCart.splice(i, 1);
                    }
                }
            }

        }
        updateShoppingCartHTML();
    }
});

updateShoppingCartHTML();
