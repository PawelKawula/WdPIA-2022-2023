<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css" />
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js" defer></script>
  <script src="public/js/scripts.js" type="module" defer></script>
  <script src="public/js/login.js" defer></script>
</head>
<body class="bg-primary-subtl">
  <?php include 'navigation.php'?>
  <div class="card mb-3 col-8 mx-auto my-5 rounded-5">
    <div class="row g-0">
      <div class="d-none d-md-flex col-2 col-md-4 justify-content-center align-items-center text-center">
        <h4 class="card-title">Logowanie lub <a type="button" class="btn btn-primary" href="register">Rejestracja</a></h4>
      </div>
      <div class="col-12 col-md-8 ">
        <div class="card-body">
          <h5 class="card-title">Logowanie <span class="d-inline d-md-none">lub <a type="button" class="btn btn-primary" href="register">Rejestracja</a></span></h5>
          <form class="col-12 col-md-8" action="login" method="POST" id="login_form">
            <div class="form-floating mb-3">
              <input name="email" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
              <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
              <input name="passwd" type="password" class="form-control" id="floatingPassword" placeholder="Password">
              <label for="floatingPassword">Password</label>
            </div>
            <button type="submit" class="btn btn-primary float-end my-4">Logowanie</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include 'modal.php' ?>
</body>
</html>
