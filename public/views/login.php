<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="public/css/style.css">
  <script src="public/js/login.js" defer></script>
</head>
<body>

  <?php include 'components/bar.php'?>

  <div id="content">
  <?php include 'components/sidebar.php' ?>

    <div class="main security_main">
      <div class="prompt">Logowanie<br>lub <a href="register">Rejestracja</a></div>
      <div class="security_box">
        <form class="login" action="login" method="POST" id="login_form">
          <?php if (isset($messages)) foreach($messages as $msg) echo $msg; else echo 'no msg'?>
          <div>email<input name="email" type="text" placeholder="ex@email.com"></div>
          <div>hasło<input name="passwd" type="password" placeholder="admin"></div>
          <button type="submit" disabled>Zaloguj</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
