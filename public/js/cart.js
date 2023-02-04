import {display_cart, shopping_cart} from "./basket.js";
const cart_content = document.getElementById("cart_content")

function populate_cart() {
    let cart_copy = shopping_cart.list_cart();
    cart_content.innerHTML = "";
    for (let i = 0; i < cart_copy.length; ++i) {
        create_cart_item(cart_copy[i]);
    }
    // document.getElementById("sum_basket_span").innerHTML = shopping_cart.total_cart();
}

function create_cart_item(item) {
    const template = document.querySelector("#new_cart_template");
    const clone = template.content.cloneNode(true);
    const image = clone.querySelector("img");
    image.src = `public/img/${item.name}.jpeg`;
    const title = clone.querySelector(".card-title");
    title.innerHTML = item.name;
    const price = clone.querySelector(".card-footer");
    price.innerHTML = item.total;
    const quantity = clone.querySelector(".item_digits");
    quantity.innerHTML = item.count;
    const plus = clone.querySelector(".item_plus");
    plus.addEventListener("click", function(event) {
        shopping_cart.add_item_to_cart(item.name, 0, 1);
        populate_cart();
        update_sum_span();
    });
    const minus = clone.querySelector(".item_minus");
    minus.addEventListener("click", function(event) {
        shopping_cart.remove_item_from_cart(item.name);
        populate_cart();
        display_cart();
        update_sum_span();
    })
    cart_content.appendChild(clone);
}

populate_cart();
function update_sum_span() {
    document.getElementById("sum_basket_span").innerHTML = shopping_cart.total_cart();
}
update_sum_span();
