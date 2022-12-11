<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="public/css/style.css">
  <link rel="stylesheet" href="public/css/payment.css">
  <script src="/public/js/basket.js" defer></script>
  <script type="module" src="/public/js/payment.js" defer></script>
</head>
<body>

  <?php include 'components/bar.php'?>

  <div id="content">
  <?php include 'components/sidebar.php' ?>

    <div class="main security_main">
      <div class="prompt">Płatność</div>
        <div class="security_box">
          <?php if (isset($messages)) foreach($messages as $msg) echo $msg; else echo 'no msg'?>
          <form id="payment_form" method="post" action="payment">
            <div id="payments_div">
              <input id="payment_blik" value="blik" type="radio" name="payment_method"/>
              <label class="drinkcard_cc" style="background-image: url(public/img/blik.svg)" for="payment_blik"></label>
              <input id="payment_visa_mastercard" value="visa_mastercard" type="radio" name="payment_method"/>
              <label class="drinkcard_cc" style="background-image: url(public/img/visa.svg)" for="payment_visa_mastercard"></label>
              <input id="payment_przelewy24" value="przelewy24" type="radio" name="payment_method" disabled/>
              <label class="drinkcard_cc disabled_payment" style="background-image: url(public/img/przelewy.svg)" for="payment_przelewy24"></label>
              <input id="payment_gpay" value="gpay" type="radio" name="payment_method" disabled/>
              <label class="drinkcard_cc disabled_payment" style="background-image: url(public/img/gpay.svg)" for="payment_gpay"></label>
              <input type="text" hidden="hidden" name="items">
              <div id="payment_details_div"></div>
            </div>
            <button type="submit" disabled>Zapłać</button>
          </form>
        </div>
    </div>
  </div>
</body>
</html>
