<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css" />
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js" defer></script>
    <script type="module" src="public/js/register.js" defer></script>
  </head>
  <body class="bg-primary-subtl">
    <?php include 'navigation.php'?>
    <div class="col d-flex justify-content-center my-5">
      <div class="card items_item col-10">
        <div class="row">
          <div class="col-2 col-md-4 d-none d-md-flex align-items-center justify-content-center">
            <h5 class="card-title">Rejestracja lub <a type="button" class="btn btn-primary" href="login">Logowanie</a></h5>
          </div>
          <div class="col-12 col-sm-10 col-md-8 my-auto">
            <div class="card-body d-flex justify-content-center text-center">
              <form class="col-12 col-sm-10 col-md-6 my-5" action="register" metod="POST" id="registerForm">
                <div class="form-floating mb-3">
                  <input name="email" type="email" class="form-control" id="emailInput" placeholder="name@example.com">
                  <label for="emailInput">Adres email *</label>
                </div>
                <div class="form-floating mb-3">
                  <input name="passwd" type="password" class="form-control" id="passwordInput" placeholder="Password">
                  <label for="passwordInput">Hasło *</label>
                </div>
                <div class="form-floating mb-3">
                  <input name="cPasswd" type="password" class="form-control" id="confirmPasswordInput" placeholder="confirm Password">
                  <label for="confirmPasswordInput">Powtórz hasło *</label>
                </div>
                <div class="form-floating mb-3">
                  <input name="fname" type="text" class="form-control" id="fnameInput" placeholder="Imię">
                  <label for="fnameInput">Imię</label>
                </div>
                <div class="form-floating mb-3">
                  <input name="lname" type="text" class="form-control" id="lnameInput" placeholder="Nazwisko">
                  <label for="lnameInput">Nazwisko</label>
                </div>
                <div class="form-floating mb-3">
                  <input name="phone" type="number" class="form-control" id="phoneInput" placeholder="Nr. telefonu">
                  <label for="phoneInput">Numer telefonu</label>
                </div>
                <button type="submit" class="btn btn-primary float-end my-4">Rejestracja</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php include 'modal.php' ?>
  </body>
</html>
