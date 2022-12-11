<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="public/css/style.css">
  <script type="module" src="public/js/scripts.js" defer></script>
  <script src="public/js/basket.js"></script>
  <script type="module" src="public/js/cart.js"></script>
</head>
<body>

    <?php include 'components/bar.php'?>
    <div id="content">
    <?php include 'components/sidebar.php' ?>

    <div class="main">
      <ul id="items">
      </ul>
      <div id="cart_sum_up">
        <div class="sum_basket_div">Razem: <span id="sum_basket_span"></span></div>
        <div class="sum_basket_div"><a href="payment">Payment</a></div>
      </div>
    </div>
  </div>
</body>
</html>

<template id="cart_item_template">
  <div class="buy_item cart_item">
    <div class="item_description">
      <div class="item_image_div">
        <img class="item_image"/>
      </div>
      <a class="store_desc"></a>
    </div>
    <div class="item_quantity">
      Ilość<br>
      <div class="items_quantity_block">
        <button class="item_quantity_leaf item_plus">+</button>
        <button class="item_quantity_leaf item_digits" disabled></button>
        <button class="item_quantity_leaf item_minus">-</button>
        <button class="price" disabled="true"></button>
      </div>
    </div>
  </div>
</template>
