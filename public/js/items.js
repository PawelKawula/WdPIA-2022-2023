import {shopping_cart, display_cart} from './basket.js'
let store_items = document.getElementsByClassName("buy_item");
document.getElementById("search_div").style.display = "block";

export function add_item_listener() {
    var name = this.parentElement.querySelector("button").innerHTML;
    var price = this.parentElement.querySelector(".price").innerHTML;
    shopping_cart.add_item_to_cart(name, price, 1)
    display_cart();
}