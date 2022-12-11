import {shopping_cart, display_cart} from "./basket.js";

const payment_form = document.getElementById("payment_form");
const payment_button = payment_form.querySelector("button")
const payment_inputs = payment_form.querySelectorAll("label")
const payment_details = document.getElementById("payment_details_div")
const payment_methods = payment_form.querySelectorAll("input[name='payment_method']")
let blik_validated = [false];
let card_holder_validated = [false];
let card_number_validated = [false];
let card_expiration_validated = [false];
let card_cvv_validated = [false];

display_cart();

payment_form.querySelector('input[name="items"]').value = JSON.stringify(shopping_cart.list_cart());

function display_payment_option(payment_option) {
    payment_details.innerHTML = ""
    switch (payment_option) {
        case "visa_mastercard":
            display_card_option();
            break;
        case 'blik':
            display_blik_option();
    }
}

for (let i = 0; i < payment_inputs.length; ++i)
    payment_inputs[i].addEventListener("click", function() {display_payment_option(payment_methods[i].value);}, false);

function display_card_option() {
    let inputs = [];
    inputs.push(add_payment_detail_input("Imie i nazwisko posiadacza", "holder_details", function(event){ card_holder_validated[0] = event.target.value.length > 0 && event.target.value.split(" ").length == 2 }));
    inputs.push(add_payment_detail_input("Numer karty", "credit_card", function(event) {event.target.value = separated_digits_validator(event.target.value, 4, 16, card_number_validated);}))
    inputs.push(add_payment_detail_input("Data ważności", "expiration_date", expiration_date_validator))
    inputs.push(add_payment_detail_input("CVV", "cvv", function(event) {event.target.value = separated_digits_validator(event.target.value, 3, 3, card_cvv_validated);}))
    for (let i = 0; i < inputs.length; ++i)
        inputs[i].addEventListener("keyup", payment_button_click_card, false);
}

function payment_button_click_card() {
    payment_button.disabled = !(card_holder_validated[0] && card_number_validated[0] && card_expiration_validated[0] && card_cvv_validated[0]);
}

function payment_button_click_blik() {
    payment_button.disabled = !blik_validated[0];
}

function display_blik_option() {
    add_payment_detail_input("Kod blik", "blik", function(event) {event.target.value = separated_digits_validator(event.target.value, 3, 6, blik_validated);}).addEventListener("keyup", payment_button_click_blik, false);
}

function add_payment_detail_input(display, name, validator) {
    let div = document.createElement("div");
    div.innerHTML = display
    let input = document.createElement("input");
    input.setAttribute("name", name);
    input.addEventListener('keyup', validator);
    div.appendChild(input);
    payment_details.appendChild(div);
    return input;
}

function separated_digits_validator(value, range, max, is_validated) {
    var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
    var matches = v.match(new RegExp('\\d{' + range + ',' + max + '}', 'g'));
    var match = matches && matches[0] || ''
    var parts = []
    for (let i=0, len=match.length; i<len; i+=range) {
        parts.push(match.substring(i, i+range))
    }
    if (parts.length) {
        if (matches[0].length === max)
            is_validated[0] = true;
        else
            is_validated[0] = false;
        return parts.join(' ')
    } else {
        return value;
    }
}
function expiration_date_validator(event) {
    var v = event.target.value.replace(/\s+/g, '').replace(/[^0-9,/]/gi, '')
    if (v.length < 5) {
        card_expiration_validated[0] = false;
        return;
    }
    card_expiration_validated[0] = true;
    var matches = v.match(/(0\d|1[0,1,2])\/\d{2}/gi);
    var match = matches && matches[0] || ''
    event.target.value = match;
}
