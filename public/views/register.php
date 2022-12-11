<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="public/css/style.css">
<script type="module" src="public/js/register.js" defer></script>
</head>
<body>

  <?php include 'components/bar.php'?>

  <div id="content">
  <?php include 'components/sidebar.php' ?>

    <div class="main security_main">
      <div class="prompt">Rejestracja<br>lub <a href="login">Logowanie</a></div>
        <div class="security_box">
          <form class="security_form" action="register" method="POST" id="register_form">
            <?php if(isset($messages)) {foreach ($messages as $msg) echo $msg;}?>
            <div>email<input name="email" type="text" placeholder="email@email.com"></div>
            <div>hasło<input name="passwd" type="password"></div>
            <div>powtórz hasło<input name="c_passwd" type="password" class="no_valid"></div>
            <div>Imię<input name="fname" type="text" placeholder="Jan"></div>
            <div>Nazwisko<input name="lname" type="text" placeholder="Kowalski"></div>
            <div>Telefon<input name="phone" type="text" placeholder="+48 123 456 789"></div>
            <button type="submit" disabled id="register_button">Zarejestruj</button>
          </form>
        </div>
    </div>
  </div>
</body>
</html>
