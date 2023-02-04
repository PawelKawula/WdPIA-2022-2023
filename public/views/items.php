<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css" />
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
  <script type="module" src="public/js/scripts.js" defer></script>
  <script type="module" src="public/js/basket.js" defer></script>
  <script type="module" src="public/js/pagination.js" defer></script>
  <script type="module" src="public/js/items.js" defer></script>
</head>
<body>
<?php include 'navigation.php' ?>
  <div class="row row-cols-1 row-cols-xs-2 row-cols-md-2 row-cols-xxl-4 g-4 my-4 mx-4" id="items_content">
  </div>
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item" id="prev_button"><button class="page-link" disabled>Previous</button></li>
      <li class="page-item" id="next_button"><button class="page-link" disabled>Next</button></li>
    </ul>
  </nav>
<?php include 'modal.php'; ?>
</body>
</html>
<template id="new_template">
  <div class="col">
    <div class="card items_item mx-auto" style="height: 100%; width: 22rem;">
      <img src="" class="card-img-top" alt="" style="object-fit: fill; width: 100%; height: 16vw;"/>
      <div class="card-body d-flex justify-content-between flex-column text-center">
        <h5 class="card-title"></h5>
        <p class="card-text"></p>
        <div class="col-12">
          <div class="row justify-content-center align-items-end">
            <button class="btn btn-primary col-2 item_plus mx-2" >+</button>
            <button class="btn btn-secondary col-2 item_digits" disabled>0</button>
            <button class="btn btn-danger col-2 item_minus mx-2">-</button>
          </div>
          <button class="btn btn-primary col-12 my-2 buy_button" disabled>Buy</button>
        </div>
      </div>
      <div class="card-footer text-center"></div>
    </div>
  </div>
</template>