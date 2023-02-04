import {find_get_parameter} from './scripts.js';
import {add_item_listener} from './items.js'

const pagination_numbers = document.querySelector(".pagination");
const list_items = document.getElementById("items_content");
const prev_button = document.getElementById("prev_button");
const next_button = document.getElementById("next_button");
const pagination_limit = 4;

let page_count = 1;
localStorage.setItem("current_page", 1);
localStorage.setItem("basket", JSON.stringify(new Map()));

function create_item(item) {
  const template = document.querySelector("#new_template");
  const clone = template.content.cloneNode(true);
  const image = clone.querySelector("img");
  image.src = `public/img/${item.name}.jpeg`;
  const title = clone.querySelector(".card-title");
  title.innerHTML = item.name;
  const price = clone.querySelector(".card-footer");
  price.innerHTML = item.price;
  add_item_listener(clone);
  list_items.appendChild(clone);
}

function populate(items) {
  for (let i = 0; i < items.length; ++i)
    create_item(items[i]);
}

function get_items_count() {
  var category = localStorage.getItem("category");
  category = category === null ? "" : category;
  var name = find_get_parameter("search")
  name = name === null ? "" : name;
  return fetch("/get_items_count", {
    method: "POST",
    headers: {
      'Content-type': 'application/json'
    },
    body: JSON.stringify({"name": name, "category": category})
    }
  ).then(async function (resp) {
    var count = JSON.parse(await resp.text()).count;
    
    return count;
  });
}

function get_items() {
  var category = localStorage.getItem("category");
  category = category === null ? "" : category;
  var name = find_get_parameter("search")
  name = name === null ? "" : name;
  return fetch("/get_items", {
        method: "POST",
        headers: {
          'Content-type': 'application/json'
        },
        body: JSON.stringify({"name": name, "category": category, "start": (current_page - 1) * pagination_limit, "interval": pagination_limit})
      }
  ).then(async function (resp) {
        var json = await resp.json();
        return json;
      }
  ).
  then(function (items) {
    populate(items);
  });
}


async function get_page_count() {
  var items_count = await get_items_count()
  var x = Math.ceil(await get_items_count() / pagination_limit);
  page_count = x;
  return x;
}
let current_page;

const append_page_number = (index) => {
  const li = document.createElement("li");
  const button = document.createElement("button")
  li.appendChild(button);
  li.className = "page-item";
  button.className = "page-link";
  button.classList.add("pagination_number")
  button.innerHTML = index;
  button.setAttribute("page_index", index);
  pagination_numbers.insertBefore(li, next_button);
};
const get_pagination_numbers = async () => {
  var max = await get_page_count();
  for (let i = 1; i <= max; i++) {
    append_page_number(i);
  }
};

const disable_button = (button) => {
  button.classList.add("disabled");
  button.setAttribute("disabled", true);
  button.querySelector("button").setAttribute("disabled", true);
};
const enable_button = (button) => {
  button.classList.remove("disabled");
  button.removeAttribute("disabled");
};
const handle_page_buttons_status = () => {
  disable_button(prev_button);
  disable_button(next_button);
  if (current_page !== 1) {
    enable_button(prev_button);
  }
  
  if (page_count !== current_page) {
    enable_button(next_button);
  }
};

window.addEventListener("load", async () => {
  await get_pagination_numbers();
  set_current_page(1);

  prev_button.addEventListener("click", () => {
    set_current_page(current_page - 1);
  });
  next_button.addEventListener("click", () => {
    set_current_page(current_page + 1);
  });

  document.querySelectorAll(".pagination_number").forEach((button) => {
    const page_index = Number(button.getAttribute("page_index"));
    if (page_index) {
      button.addEventListener("click", () => {
        set_current_page(page_index);
      });
    }
  });
});

const set_current_page = (page_num) => {
  current_page = page_num;

  handle_active_page_number()
  handle_page_buttons_status()

  console.log("click")
  list_items.innerHTML = "";
  populate(get_items());
};

const handle_active_page_number = () => {
  document.querySelectorAll(".pagination_number").forEach((button) => {
    button.classList.remove("active");

    const page_index = Number(button.getAttribute("page_index"));
    if (page_index == current_page) {
      button.classList.add("active");
    }
  });
};
