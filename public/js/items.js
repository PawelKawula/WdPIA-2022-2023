import {shopping_cart, display_cart} from './basket.js'
let store_items = document.getElementsByClassName("items_item");
// document.getElementById("search_div").style.display = "block";

export function add_item_listener(card) {
    console.log(card);
    const name = card.querySelector(".card-title").innerHTML;
    const price = card.querySelector(".card-footer").innerHTML;
    const item_plus = card.querySelector(".item_plus");
    const item_minus = card.querySelector(".item_minus");
    const item_digits = card.querySelector(".item_digits");
    const item_buy = card.querySelector(".buy_button");
    item_plus.addEventListener("click", function (e) {
        item_digits.innerHTML = Number(item_digits.innerHTML) + 1;
        item_buy.disabled = false
    });
    item_minus.addEventListener("click", function(e) {
        let val = Math.max(parseInt(item_digits.innerHTML) - 1, 0);
        item_digits.innerHTML = val;
        item_buy.disabled = val === 0 ? true : false;
    });
    item_buy.addEventListener("click", function(e) {
        shopping_cart.add_item_to_cart(name, price, parseInt(item_digits.innerHTML));
        display_cart();
        item_digits.innerHTML = "0";
    });
    console.log("added event");
}
