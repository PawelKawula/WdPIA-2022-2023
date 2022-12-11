import {shopping_cart} from "./basket.js";

function populate_cart() {
    let cart_copy = shopping_cart.list_cart();
    
    document.getElementById("items").innerHTML = "";
    for (let i = 0; i < cart_copy.length; ++i) {
        
        create_cart_item(cart_copy[i]);
    }
    document.getElementById("sum_basket_span").innerHTML = shopping_cart.total_cart();
}

function create_cart_item(item) {
    const template = document.querySelector("#cart_item_template");
    const clone = template.content.cloneNode(true);
    const image = clone.querySelector("img");
    image.src = `public/img/${item.name}.jpeg`;
    const title = clone.querySelector(".store_desc");
    title.innerHTML = item.name;
    const price = clone.querySelector(".price");
    price.innerHTML = item.total;
    const quantity = clone.querySelector(".item_digits");
    quantity.innerHTML = item.count;
    const plus = clone.querySelector(".item_plus");
    plus.addEventListener("click", function(event) {
        shopping_cart.add_item_to_cart(item.name, 0, 1);
        populate_cart();
    });
    const minus = clone.querySelector(".item_minus");
    minus.addEventListener("click", function(event) {
        shopping_cart.remove_item_from_cart(item.name);
        populate_cart();
    })
    document.getElementById("items").appendChild(clone);
}

populate_cart();