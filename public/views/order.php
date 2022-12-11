<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="public/css/style.css">
</head>
<body>

  <?php include 'components/bar.php' ?>
  <div id="content">
  <?php include 'components/sidebar.php' ?>
    <div class="main" id="order_main">
      <form>
        <div id="name_div">
          <div class="input_div">Imię<input name="fname"></div>
          <div class="input_div">Nazwisko<input name="lname"></div>
        </div>
        <div class="input_div">Email<input name="email"></div>
        <div class="input_div">Telefon<input name="telephone"></div><br>
        <button name="address">Adres</button><br><br><br><br>
        <button name="progress">W trakcie realizacji</button>
      </div>
      </form>
    </div>
  </div>
</body>
</html>
