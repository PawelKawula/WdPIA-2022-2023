const a_logout = document.querySelector("a[href='logout']")
export var shopping_cart = (function() {
    var cart = [];

    function Item(name, price, count) {
        this.name = name;
        this.price = price;
        this.count = count;
    }

    function save_cart() {
        sessionStorage.setItem('shopping_cart', JSON.stringify(cart));
    }


    function load_cart() {
        cart = JSON.parse(sessionStorage.getItem('shopping_cart'));
    }

    if (sessionStorage.getItem("shopping_cart") != null) {
        load_cart();
    }


    var obj = {};

    obj.get_distinct_item_count = function() {
        return cart.length;
    }

    obj.add_item_to_cart = function(name, price, count) {
        for(var item in cart) {
            if(cart[item].name === name) {
                cart[item].count ++;
                save_cart();
                return;
            }
        }
        var item = new Item(name, price, count);
        cart.push(item);
        save_cart();
    }

    obj.set_count_for_item = function(name, count) {
        for(var i in cart) {
            if (cart[i].name === name) {
                cart[i].count = count;
                break;
            }
        }
    };

    obj.remove_item_from_cart = function(name) {
        for(var item in cart) {
            if(cart[item].name === name) {
                cart[item].count --;
                if(cart[item].count === 0) {
                    cart.splice(item, 1);
                }
                break;
            }
        }
        save_cart();
    }

    obj.remove_item_from_cart_all = function(name) {
        for(var item in cart) {
            if(cart[item].name === name) {
                cart.splice(item, 1);
                break;
            }
        }
        save_cart();
    }

    obj.clear_cart = function() {
        cart = [];
        save_cart();
    }

    obj.total_count = function() {
        var total_count = 0;
        for(var item in cart) {
            total_count += cart[item].count;
        }
        return total_count;
    }

    obj.total_cart = function() {
        var total_cart = 0;
        for(var item in cart) {
            total_cart += cart[item].price * cart[item].count;
        }
        return Number(total_cart.toFixed(2));
    }

    obj.list_cart = function() {
        var cart_copy = [];
        for(let i in cart) {
            let item = cart[i];
            let item_copy = {};
            for(let p in item) {
                item_copy[p] = item[p];
            }
            item_copy.total = Number(item.price * item.count).toFixed(2);
            cart_copy.push(item_copy)
        }
        return cart_copy;
    }

    return obj;
})();

display_cart();

export function clear_cart() {
    shopping_cart.clear_cart();
}

if (a_logout != null)
    a_logout.addEventListener("click", clear_cart, false);

export function display_cart() {
    document.getElementById('basket_count').innerHTML = shopping_cart.get_distinct_item_count();
}
