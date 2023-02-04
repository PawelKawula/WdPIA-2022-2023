<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="public/css/style.css">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css" />
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js" defer></script>
  <script type="module" src="public/js/scripts.js" defer></script>
  <script src="public/js/basket.js"></script>
  <script type="module" src="public/js/cart.js"></script>
</head>
<body>
  <?php include 'navigation.php'; ?>
  <div class="row row-cols-1 g-4 my-4 mx-4 align-items-center" id="cart_content">
  </div>
  <button class="btn btn-primary col-2 mx-5" disabled="">Razem: <span id="sum_basket_span"></span></button>
  <button class="btn btn-primary col-2 float-end mx-5 text-white"><a href="payment" class="text-white">Payment</a></button>
  <?php include 'modal.php'; ?>
</body>
</html>
<template id="new_cart_template">
  <div class="col w-100">
    <div class="card items_item w-100">
      <div class="row">
        <div class="col-4">
          <img src="" class="img-fluid rounded-start" alt="" style="object-fit: scale-down"/>
        </div>
        <div class="col-8 my-auto">
          <div class="card-body d-flex justify-content-between text-center">
            <h5 class="card-title"></h5>
            <p class="card-text"></p>
            <div class="d-flex justify-content-center flex-md-row flex-sm-column">
              <button class="btn btn-primary col-2 px-4 py-2 item_plus text-center d-md-inline-block d-none" >+</button>
              <button class="btn btn-secondary col-2 px-4 py-2 item_digits text-center" disabled>0</button>
              <button class="btn btn-danger col-2 px-4 py-2 item_minus text-center d-md-inline-block d-none">-</button>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer text-center"></div>
    </div>
  </div>
</template>