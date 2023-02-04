<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="public/css/style.css">
  <link rel="stylesheet" href="public/css/payment.css">
  <script src="/public/js/basket.js" defer></script>
  <script type="module" src="/public/js/payment.js" defer></script>
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css" />
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js" defer></script>
</head>
  <body>
    <?php include 'navigation.php'?>
    <div class="card mb-3 col-8 mx-auto my-5 rounded-5">
      <div class="row g-0">
        <div class="d-flex align-items-center col-md-4 text-center justify-content-center rounded-start">
          <h4 class="card-title">Płatność</h4>
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">Wybór metody</h5>
            <form action="payment" method="POST" id="payment_form">
              <input id="payment_blik" class="d-none" value="blik" type="radio" name="payment_method"/>
              <label class="drinkcard_cc" style="background-image: url(public/img/blik.svg)" for="payment_blik"></label>
              <input id="payment_visa_mastercard" class="d-none" value="visa_mastercard" type="radio" name="payment_method"/>
              <label class="drinkcard_cc" style="background-image: url(public/img/visa.svg)" for="payment_visa_mastercard"></label>
              <input id="payment_przelewy24" class="d-none" value="przelewy24" type="radio" name="payment_method" disabled/>
              <label class="drinkcard_cc disabled_payment" style="background-image: url(public/img/przelewy.svg)" for="payment_przelewy24"></label>
              <input id="payment_gpay" class="d-none" value="gpay" type="radio" name="payment_method" disabled/>
              <label class="drinkcard_cc disabled_payment" style="background-image: url(public/img/gpay.svg)" for="payment_gpay"></label>
              <input type="text" hidden="hidden" name="items">
              <div id="payment_details_div"></div>
              <button type="submit" disabled>Zapłać</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php include 'modal.php' ?>
  </body>
</html>